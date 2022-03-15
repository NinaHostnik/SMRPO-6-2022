<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{

    public function createUser()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|doesntExist[username]',
                'permissions' => 'required',
                'password' => 'required|greater_than_equal_to_str[12]|less_than_equal_to_str[128]',
            ];

            $errors = [
                'username' => [
                    'doesntExist' => 'User already exists'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                echo view('subpages/ustvarjanjeUporabnika/userCreate', $data);


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

            // Utility variables - needed for building the page
            $data['heading'] = 'Registracija uporabnika';
            $data['usernameInput'] = array('type' => 'text', 'id' => 'username', 'label' => 'Uporabniško ime');
            $data['permissionsInput'] = array('type'=>'text', 'id'=>'permissions',  'label'=>'Dovoljenja');
            $data['passwordInput'] = array('type' => 'password', 'id' => 'password', 'label' => 'Geslo');
            $data['name'] = 'Registriraj';
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

                    $this->setUserSession($user);
                    return redirect()->to('/home');
                }

            } else {
                // Utility variables - needed for building the page
                $data['heading'] = 'Vpis';
                $data['usernameInput'] = array('type' => 'text', 'id' => 'username', 'label' => 'Uporabniško ime');
                $data['passwordInput'] = array('type' => 'password', 'id' => 'password', 'label' => 'Geslo');
                $data['name'] = 'Vpiši se';
                echo view('subpages/login/login', $data);
            }


    }

    public function update_user(){
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'username' => 'required',
                'newusername' => 'required',
                'password' => 'required|validateUser[username,password]',
                'newpass' => 'required',
                'repass' => 'required|matches[newpass]',

            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Username or Password do not match'
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
                    'password' => $this->request->getPost('newpass'),
                ];

                $model->update(session()->get("id"), $newprofile);

                $newprofile["permissions"] = session()->get("permissions");
                $this->setUserSession($newprofile);

                return redirect()->to('/profile');
            }

        } else {
            $data = [
            ];
            echo view('user_update', $data);
        }

    }



}