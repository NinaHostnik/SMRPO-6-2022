<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;

class CardTableController extends BaseController
{

    public function cardTable(){

        $data = [
        ];

        echo view('subpages/cardTable/cardTable', $data);
    }

}