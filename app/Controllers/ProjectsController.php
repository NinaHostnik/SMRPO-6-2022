<?php
namespace App\Controllers;

use App\Models\NalogeModel;
use App\Models\ProjectModel;
use App\Models\UporabniskeZgodbeModel;
use App\Models\UserModel;

class ProjectsController extends BaseController
{

    public function allProjects(){
        $model = new ProjectModel();
        $projects = $model->getUsersProjects(session()->get('id'));
        $data = [
            'projekti'=>$projects,
        ];
        $feedbackAlert = session()->get('feedback');
        if ($feedbackAlert == 'projekt') {
            $popupdata = ['popup' => 'Projekt je bil dodan.'];
            echo view('partials/popup', $popupdata);
        }

        echo view('subpages/projekti/projects', $data);
    }

    public function backlog(){
        $model = new UporabniskeZgodbeModel();
        $modelnaloge = new NalogeModel();
        $modelusers = new UserModel();

        $users = $modelusers->findAll();
        #var_dump(session()->get("projectId"));
        $zgodbe = $model->pridobiZgodbe(session()->get("projectId"));
        $i = 0;
        foreach ($zgodbe as $zgodba){
            $naloge = $modelnaloge->pridobiNalogeZgodbe($zgodbe[$i]['idZgodbe']);
            #var_dump($naloge);
            #echo '<br>';

            if($naloge != null){
                $indexnaloge = 0;
                foreach ($naloge as $naloga){
                    if(isset($naloge[$i]['clan_ekipe'])){
                        $naloge[$indexnaloge]['clan_ekipe_name'] = ($modelusers->find($naloge[$indexnaloge]['clan_ekipe']))['username'];
                    }
                    $indexnaloge = $indexnaloge +1;
                }
                $zgodbe[$i]["naloge"] = $naloge;
            }
            else{
                $zgodbe[$i]["naloge"] = [];
            }
            $i = $i+1;
        }
        #var_dump($zgodbe);
        $data = [
            'zgodbe'=>$zgodbe,
        ];
        #var_dump($data);
        echo view('subpages/projekti/backlog',$data);
    }

    public function dodajZgodbo(){
        $zgodba_id = $this->request->getVar('idZgodbe');
        $opis_naloge = $this->request->getVar('taskName');
        $ocena_casa  = $this->request->getVar('taskTime');
        $clan_ekipe = $this->request->getVar('taskMember');

        $model = new NalogeModel();
        $newdata = [
            'zgodba_id' => $zgodba_id,
            'opis_naloge' => $opis_naloge,
            'ocena_casa' => $ocena_casa,
            'clan_ekipe' => $clan_ekipe,
            'potrjen' => 'N',
        ];
        $model->save($newdata);
        session()->setFlashdata(['popup'=>'naloga uspešno dodana']);
        return redirect()->to('/Pbacklog');

    }

}
