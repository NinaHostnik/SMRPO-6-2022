<?php

namespace App\Controllers;

use App\Models\UporabniskeZgodbeModel;

class MyTasksController extends BaseController
{
    public function myTasks() {
        $model = new UporabniskeZgodbeModel();
        $userID = session()->get('id');
        $projectID = session()->get('projectId');
        #$zgodbe = $model->getMyStories($userID, $projectID);
        $zgodbeNalog = $model->getMyStoryTasks($userID, $projectID);
        $naloge = $model->getMyTasks($userID, $projectID);
        var_dump($zgodbeNalog);
        var_dump($naloge);
        $zgodbe = $model->pridobiZgodbe(session()->get("projectId"));


        $zgodberework = $this->pridobizgodbe($zgodbe);
        #var_dump($zgodberework);
        $data = [
            'zgodbe'=>$zgodbe,
        ];

        echo view('subpages/projekti/myTasks',$data);
    }
}