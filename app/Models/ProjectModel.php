<?php namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model{

    protected  $table = 'project';
    protected $subtable = 'project_members';

    public function callStoringProcedure($ime, $userList, $roleList) {
        $query = $this->db->query("CALL save_project('". $ime. "','". $userList. "','". $roleList. "')");
        return $query->result();
    }
}