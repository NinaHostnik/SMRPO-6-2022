<?php
namespace App\Controllers;

use App\Models\UserModel;

class NewProjectController extends BaseController
{
    public function createProject()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'projectName' => 'required',
                'userList' => 'required'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                echo view("subpages/dodajanjeProjekta/dodajanje", $data);

            } else {
                $userList = json_decode($this->request->getVar('userList'),true);

                echo $userList;
            }
        } else {

            $model = new UserModel();

            $data['data'] = $model->readLookup();
            $data['roleList'] = array(array('id' => 'V', 'vloga' => 'produktni vodja'),
                                array('id' => 'S', 'vloga' => 'skrbnik metodologije'),
                                array('id' => 'C', 'vloga' => 'član razvojne skupine'));

            echo view("subpages/dodajanjeProjekta/dodajanje", $data);
        }
    }
}