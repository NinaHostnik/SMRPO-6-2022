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

    public function successAlert(){

        $uri = service('uri');
        $id = $uri->getSegment('2');
        $data = [
            'id'=>$id
        ];

        $alert = $uri->getSegment('3');
        if ($alert == 1) {
            echo '<script type="text/javascript">alert("Zgodba je bila dodana.");</script>';
        } else if ($alert == 2) {
            echo '<script type="text/javascript">alert("Sprint je bila dodan.");</script>';
        }
        echo view('subpages/cardTable/cardTable', $data);

    }

}