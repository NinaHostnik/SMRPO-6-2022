<?php

namespace App\Controllers;

class MyTasksController extends BaseController
{
    public function myTasks() {
        $data = [];
        echo view('subpages/projekti/myTasks', $data);
    }
}