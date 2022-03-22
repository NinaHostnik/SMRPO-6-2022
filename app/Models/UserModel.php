<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'permissions'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
        var_dump($data);
        //hash password
        $data = $this->passwordHash($data);


        return $data;
    }

    protected function beforeUpdate(array $data){
        //hash password
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data){
        if (isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function readLookup(): array
    {
        $query = $this->db->query("SELECT id, username FROM users");

        return $query->getResultArray();
    }

}