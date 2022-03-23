<?php

namespace app\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;

class ProjectsController extends BaseController
{

    public function allProjects(){
    $model = new ProjectModel();
    $projects = $model->getUsersProjects(session()->get('id'));
    $data = [
        'projekti'=>$projects,
    ];

    echo view('projects', $data);
    }

}
