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
                $projectDescription = $this->request->getVar('projectDescription');

                $model->callStoringProcedure($projectName, $projectDescription, $users, $roles);
                (new ProjectsController)->allProjects();
            }
        } else {

            $model = new UserModel();
            $pmodel = new ProjectModel();

            $data['data'] = $model->readLookup();
            $data['projectName'] = $pmodel->getProjectName();
            $data['roleList'] = $pmodel->readRoles();

            echo view("subpages/dodajanjeProjekta/dodajanje", $data);
        }
    }
}