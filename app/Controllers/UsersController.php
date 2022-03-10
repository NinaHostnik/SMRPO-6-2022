<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{

    public function createUser()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required',
                'permissions' => 'required',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                $this->render_page("register",$data);


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
            $this->render_page("admin/userCreate",$data);

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

                    $this->render_page("login",$data);


                } else {
                    $model = new UserModel();

                    $user = $model->where('username', $this->request->getVar('username'))
                        ->first();

                    $this->setUserSession($user);
                    return redirect()->to('/home');
                }

            } else {
                $data = [

                ];
                echo view('login', $data);
                //$this->render_page("login",$data);
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