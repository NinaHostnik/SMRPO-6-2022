<?php

namespace App\Controllers;

use App\Models\UporabniskeZgodbeModel;

class MyTasksController extends BaseController
{
    public function myTasks() {
        $model = new UporabniskeZgodbeModel();
        $zgodbe = $model->pridobiZgodbe(session()->get("projectId"));
        $zgodberework = $this->pridobizgodbe($zgodbe);
        $data = [
            'zgodbe'=>$zgodberework,
        ];

        echo view('subpages/projekti/myTasks',$data);
    }
}