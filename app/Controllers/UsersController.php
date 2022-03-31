<?php

namespace App\Controllers;

use App\Models\ProjectMembersModel;
use App\Models\ProjectModel;
use App\Models\UserModel;

class UsersController extends BaseController
{

    public function createUser()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|doesntExist[username]',
                'name' => 'required',
                'surname' => 'required',
                'mail' => 'required|doesntExist[mail]',
                'permissions' => 'required',
                'password' => 'required|greater_than_equal_to_str[12]|less_than_equal_to_str[128]',
                'Ponovi_geslo' => 'required|matches[password]'
            ];

            $errors = [
                'username' => [
                    'doesntExist' => 'Uporabnik z vpisanim uporabniškim imenom že obstaja.'
                ],
                'mail' => [
                    'doesntExist' => 'Uporabnik z vpisanim mailom že obstaja.'
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                echo view('subpages/ustvarjanjeUporabnika/userCreate', $data);


            } else {
                $model = new UserModel();
                $pass = $this->request->getVar('password');
                $pass = str_replace(' ','&nbsp;',$pass);
                $newdata = [
                    'username' => $this->request->getVar('username'),
                    'ime' => $this->request->getVar('name'),
                    'priimek' => $this->request->getVar('surname'),
                    'mail' => $this->request->getVar('mail'),
                    'permissions' => $this->request->getVar('permissions'),
                    'password' => $pass,
                ];
                var_dump($newdata);
                $model->save($newdata);

                $popupdata = ['popup' => 'Uporabnik je bil uspešno narejen.'];
                $data = [];
                echo view('partials/popup',$popupdata);
                echo view('subpages/ustvarjanjeUporabnika/userCreate', $data);
            }
        } else {
            $data = [];

            echo view('subpages/ustvarjanjeUporabnika/userCreate', $data);

        }

    }

    public function login()
    {
            helper(['form']);

            if ($this->request->getMethod() == 'post') {

                $rules = [
                    'username' => 'required',
                    'password' => 'required|validateUser[username,password]',
                ];

                $errors = [
                    'password' => [
                        'validateUser' => 'Username or Password do not match'
                    ]
                ];

                if (!$this->validate($rules, $errors)) {
                    $data['validation'] = $this->validator;

                    echo view('subpages/login/login', $data);


                } else {
                    $model = new UserModel();

                    $user = $model->where('username', $this->request->getVar('username'))
                        ->first();

                    $projectsmodel = new ProjectMembersModel();
                    $userroles = $projectsmodel->getrole($user['id']);
                    $this->setUserSession($user,$userroles);

                    $newprofile = [
                        'lastLogin' => time(),
                    ];
                    $model->update(session()->get("id"), $newprofile);

                    if ($user['pas_change'] == 1){
                        return redirect()->to('/ponastavitevGesa');
                    }

                    return redirect()->to('/projekti');
                }

            } else {
                $data = [];
                echo view('subpages/login/login', $data);

            }


    }

    public function update_user(){
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'newusername' => 'required',
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'password' => 'required|validateUser[username,password]',
                'passwordNew' => 'required|greater_than_equal_to_str[12]|less_than_equal_to_str[128]|niPrejsnje[passwordNew]',
                'passwordCheck' => 'required|matches[passwordNew]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Uporabniško ime in geslo se ne ujemata'
                ],
                'passwordNew'=>[
                    'niPrejsnje' => 'Geslo se ne sme ujemati z prejšnjim geslom'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;

                echo view('user_update', $data);


            } else {
                $model = new UserModel();

                $newprofile = [
                    'id' => session()->get("id"),
                    'username' => $this->request->getPost('newusername'),
                    'password' => $this->request->getPost('passwordNew'),
                ];

                $model->update(session()->get("id"), $newprofile);


                session()->set('username', $this->request->getPost('newusername'));
                session()->set('password', $this->request->getPost('passwordNew'));

                $popupdata = ['popup' => 'Uporabnik je bil uspešno spremenjen.'];
                $data = [];

                
                echo view('partials/popup',$popupdata);
                echo view('user_update', $data);
            }

        } else {
            $data = [
            ];
            echo view('user_update', $data);
        }

    }

    public function odjava()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function ponastavitev(){
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'newpass' => 'required|greater_than_equal_to_str[12]|less_than_equal_to_str[128]|niPrejsnje[newpass]',
                'repass' => 'required|matches[newpass]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Uporabniško ime ali geslo se ne ujemata'
                ],
                'newpass'=>[
                    'niPrejsnje' => 'Geslo se ne sme ujemati z prejšnjim geslom'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;

                echo view('subpages/passwordChange/passwordChange', $data);


            } else {
                $model = new UserModel();

                $newprofile = [
                    'password' => $this->request->getPost('newpass'),
                    'pas_change' => 0,
                ];

                $model->update(session()->get("id"), $newprofile);
                session()->set('password', $this->request->getPost('newpass'));


                return redirect()->to('/projekti');

            }

        } else {
            $data = [
            ];
            echo view('subpages/passwordChange/passwordChange', $data);
        }
    }



}