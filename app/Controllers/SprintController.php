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

        $date_now = new DateTime();
        foreach ($sprints as $sprint):
            $sprintstart = new DateTime($sprint['zacetniDatum']);
            $sprintend = new DateTime($sprint['koncniDatum']);

            if($sprintend>$date_now && $sprintstart<=$date_now){
                $trenutnisprint=$sprint;
            }
        endforeach;
        var_dump($trenutnisprint);


    }

    public function dodajZgodbo(){

    }
}