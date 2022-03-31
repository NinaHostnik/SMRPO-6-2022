<?php
namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UserModel;

class NewProjectController extends BaseController
{
    public function createProject() {
        $model = new UserModel();
        $pmodel = new ProjectModel();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'projectName' => 'required',
                'userList' => 'required'
            ];

            if (!$this->validate($rules)) {
                $this->stuffWentWrong('Ime projekta mora biti izpolnjeno in uporabniki dodani.');
            } else {

                $userList = json_decode($this->request->getVar('userList'),true);
                $keys = array();
                foreach (array_keys($userList) as $user) {
                    $keys[] = explode('/', $user)[0];
                }
                $users = implode(',', $keys);
                $roles = implode(',', array_column($userList, 'vlogaId'));
                $projectName = $this->request->getVar('projectName');
                $projectDescription = $this->request->getVar('projectDescription');
                $error = $pmodel->callStoringProcedure($projectName, $projectDescription, $users, $roles);
                if (!$error) {
                    session()->setFlashdata(['feedback' => 'projekt']);
                    (new ProjectsController)->allProjects();
                } else {
                    $this->stuffWentWrong($error);
                }
            }
        } else {

            $data['data'] = $model->readLookup();
            $data['projectName'] = $pmodel->getProjectName();
            $data['roleList'] = $pmodel->readRoles();
            $data['projectDescription'] = false;

            echo view("subpages/dodajanjeProjekta/dodajanje", $data);
        }
    }

    public function stuffWentWrong($error) {
        $model = new UserModel();
        $pmodel = new ProjectModel();

        $popupdata = ['errpopup' => $error];
        echo view('partials/errpopup', $popupdata);

        $data['data'] = $model->readLookup();
        $data['projectName'] = $this->request->getVar('projectName');
        $data['roleList'] = $pmodel->readRoles();
        $data['projectDescription'] = $this->request->getVar('projectDescription');

        echo view("subpages/dodajanjeProjekta/dodajanje", $data);
    }
}