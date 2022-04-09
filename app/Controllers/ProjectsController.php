<?php

namespace App\Controllers;

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
        #var_dump(session()->get("projectId"));
        $naloge = $model->pridobiZgodbe(session()->get("projectId"));
        $data = [
            'naloge'=>$naloge,
        ];
        #var_dump($data);
        echo view('subpages/projekti/backlog',$data);
    }

}
