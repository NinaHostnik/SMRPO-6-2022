<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;

class CardTableController extends BaseController
{

    public function cardTable(){

        $uri = service('uri');
        $id = $uri->getSegment('2');
        $data = [
            'id'=>$id
        ];

        echo view('subpages/cardTable/cardTable', $data);
    }

}