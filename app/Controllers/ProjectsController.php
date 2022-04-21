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
            session()->setFlashdata($popupdata);
            #echo view('partials/popup', $popupdata);
        }

        echo view('subpages/projekti/projects', $data);
    }



    public function backlog(){
        $model = new UporabniskeZgodbeModel();
        $zgodbe = $model->pridobiZgodbe(session()->get("projectId"));
        $zgodberework = $this->pridobizgodbe($zgodbe);
        $data = [
            'zgodbe'=>$zgodberework,
            'uporabniki'=>$this->pridobiUporabnike(),
        ];
        echo view('subpages/projekti/backlog',$data);
    }

    public function dodajNalogo(){

        $rules = [
            'idZgodbe' => 'required',
            'taskName' => 'required|doesntExistTask[taskName,idZgodbe]',
            'taskTime' => 'required|is_natural_no_zero',
        ];

        $errors = [
            'taskName' => [
                'doesntExistTask' => 'Naloga z tem imenom že obstaja.'
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            session()->setFlashdata(["errordata"=>$this->validator]);
            session()->setFlashdata(["idZgodbe"=>$this->request->getVar('idZgodbe')]);

            return redirect()->back();


        } else {
            $zgodba_id = $this->request->getVar('idZgodbe');
            $opis_naloge = $this->request->getVar('taskName');
            $ocena_casa = $this->request->getVar('taskTime');
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
            session()->setFlashdata(['popup' => 'naloga uspešno dodana']);
            return redirect()->back();
        }
    }

}
