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
                'projectMembers' => 'required',
                'memberRoles' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $this->render_page("dodajanje", $data);


            } else {
                $model = new UserModel();

                $newdata = [
                    'username' => $this->request->getVar('username'),
                    'permissions' => $this->request->getVar('permissions'),
                    'password' => $this->request->getVar('password'),
                ];
                $model->save($newdata);

                return redirect()->to('/');
            }
        } else {

            $query = $this->db->query("SELECT * FROM users");

            $data = $query->getResultArray();
            $this->render_page("admin/userCreate", $data);

        }
    }
}