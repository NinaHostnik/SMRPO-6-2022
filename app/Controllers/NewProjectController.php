<?php
namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;

class NewProjectController extends BaseController
{
    public function createProject() {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'projectName' => 'required',
                'userList' => 'required'
            ];

            if (!$this->validate($rules)) {
                // TODO: dodaj error

            } else {
                $model = new ProjectModel();

                $userList = json_decode($this->request->getVar('userList'),true);
                $users = implode(',', array_keys($userList));
                $roles = implode(',', array_column($userList, 'vlogaId'));
                $projectName = $this->request->getVar('projectName');

                echo $model->callStoringProcedure($projectName, $users, $roles);
            }
        } else {

            $model = new UserModel();

            $data['data'] = $model->readLookup();

            // TODO: move this stuff to db
            $data['roleList'] = array(array('id' => 'V', 'vloga' => 'produktni vodja'),
                                array('id' => 'S', 'vloga' => 'skrbnik metodologije'),
                                array('id' => 'C', 'vloga' => 'član razvojne skupine'));

            echo view("subpages/dodajanjeProjekta/dodajanje", $data);
        }
    }
}