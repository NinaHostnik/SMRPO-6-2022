<?php namespace App\Models;

use CodeIgniter\Model;

class ProjectMembersModel extends Model{

    protected $table = 'users';
    protected $allowedFields = ['role', 'user_id', 'project_id'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    public function getrole($user): array
    {
        $query = $this->db->query(" SELECT project_id as project, role
                                        FROM project_members 
                                        WHERE project_members.user_id = ?",array($user));

        return $query->getResultArray();
    }

}
