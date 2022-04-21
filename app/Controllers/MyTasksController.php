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


        $zgodberework = $this->pridobizgodbe($zgodbe);
        $data = [
            'zgodbe'=>$zgodberework,
        ];

        echo view('subpages/projekti/myTasks',$data);
    }
}