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
                'password' => 'required',
            ];

            $errors = [
                'username' => [
                    'doesntExist' => 'User already exists'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                echo view("register", $data);


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

            $data = [

            ];
            echo view("register", $data);

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
    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'permissions' => $user['permissions'],
        ];

        session()->set($data);
        return true;
    }

}