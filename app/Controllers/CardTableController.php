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

        $feedbackAlert = session()->get('feedback');

        if ($feedbackAlert == 'zgodba') {
            $popupdata = ['popup' => 'Zgodba je bila dodana'];
            echo view('partials/popup', $popupdata);
        } else if ($feedbackAlert == 'sprint') {
            $popupdata = ['popup' => 'Sprint je bil dodan.'];
            echo view('partials/popup', $popupdata);
        }

        echo view('subpages/cardTable/cardTable', $data);
    }
}