<?php

namespace App\Controllers;

use App\Models\NalogeModel;
use App\Models\UporabniskeZgodbeModel;

class MyTasksController extends BaseController
{
    public function myTasks() {
        $zgodbeModel = new UporabniskeZgodbeModel();
        $nalogeModel = new NalogeModel();
        $userID = session()->get('id');
        $projectID = session()->get('projectId');
        $mojeZgodbe = $zgodbeModel->getMyStories($userID, $projectID);
        $zgodbeNalog = $zgodbeModel->getMyStoryTasks($userID, $projectID);
        $naloge = $nalogeModel->pridobiMojeNaloge($userID, $projectID);
        $zgodbe = $zgodbeModel->pridobiZgodbe(session()->get("projectId"));

        $stories = $this->addTasksToStory($zgodbeNalog, $naloge);
        #var_dump($stories);


        $zgodberework = $this->pridobizgodbe($zgodbe);
        $data = [
            'zgodbe'=>$zgodberework,
        ];

        echo view('subpages/projekti/myTasks',$data);
    }

    function addTasksToStory($zgodbeNalog, $naloge) {
        foreach ($zgodbeNalog as $zgodba):
            $zgodba['naloge'] = array();
            $temp = array();
            foreach ($naloge as $naloga):
                if ($zgodba['idZgodbe'] === $naloga['zgodba_id']) $temp += $naloga;
            endforeach;
            $zgodba['naloge'] += $temp;
        endforeach;
        var_dump($zgodbeNalog);
        return $zgodbeNalog;
    }
}