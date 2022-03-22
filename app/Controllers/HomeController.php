<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;

class HomeController extends BaseController
{

    public function home(){

        $data = [
        ];

        echo view('home', $data);
    }

}
