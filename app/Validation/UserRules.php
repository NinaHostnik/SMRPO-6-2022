<?php
namespace App\Validation;

use App\Models\UserModel;

class UserRules{

    public function validateUser(string $str, string $fields, array $data){
        $model = new UserModel();

        if(!isset($data['username'])){
            $data['username'] = session()->get('username');
        }

        $user = $model->where('username', $data['username'])
                      ->first();

        if (!$user){
            return false;
        }

        return password_verify($data['password'], $user['password']);
    }

    public function doesntExist(string $str, string $fields, array $data){
        $model = new UserModel();

        $user = $model->where('username', $data['username'])
            ->first();

        if (!$user){
            return true;
        }

        return false;
    }

    public function niPrejsnje(string $str, string $field, array $data){
        $passhash = session()->get('password');
        return !password_verify($data[$field],$passhash);
    }
}

?>