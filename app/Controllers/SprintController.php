<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\SprintiModel;
use App\Models\UporabniskeZgodbeModel;
use App\Models\UserModel;
use DateTime;

class SprintController extends BaseController
{

    public function backlog(){
        $idZgodbe = $this->request->getVar('surname');
        $model = new SprintiModel();
        $sprints = $model->getSprints(session()->get("projectId"));
        $trenutnisprint = null;
        $nezakjucensprint = null;

        $date_now = new DateTime();
        #var_dump($sprints);
        foreach ($sprints as $sprint):
            $sprintstart = new DateTime($sprint['zacetniDatum']);
            $sprintend = new DateTime($sprint['koncniDatum']);

            if($sprintend<$date_now && $sprint['trenutniStatus']!='zakjucen'){
                $nezakjucensprint = $sprint;
                break;
            }

            if($sprintend>$date_now && $sprintstart<=$date_now){
                $trenutnisprint=$sprint;
                break;
            }
        endforeach;
        var_dump($trenutnisprint);
        $zgodbemodel = new UporabniskeZgodbeModel();
        if($nezakjucensprint == null){
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($trenutnisprint['idSprinta']);
            $data = [
                'sprint'=>$trenutnisprint,
                'nezakjucen'=>false,
                'zgodbe'=>$zgodbe,
            ];
            echo view('subpages/sprint/backlog', $data);        }
        else{
            var_dump($nezakjucensprint['idSprinta']);
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($nezakjucensprint['idSprinta']);
            $data = [
                'sprint'=>$nezakjucensprint,
                'nezakjucen'=>true,
                'zgodbe'=>$zgodbe,
            ];
            $popupdata = ['popup' => 'Zakjučite sprint preden začete novega'];
            echo view('partials/popup',$popupdata);
            echo view('subpages/sprint/backlog', $data);
        }




    }

    public function dodajZgodbo(){

    }
}