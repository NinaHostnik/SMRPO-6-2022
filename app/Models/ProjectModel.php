<?php namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model{

    protected  $table = 'project';
    protected $subtableMembers = 'project_members';
    protected $subtableRoles = 'roles';

    public function callStoringProcedure($ime, $description, $userList, $roleList) {
        $result = $this->db->query("CALL save_project('". $ime. "','". $description. "','". $userList. "','". $roleList. "')");
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    public function getProjectName(): string
    {
        $query = $this->db->query("SELECT MAX(id) FROM project");
        $id = $query->getResultArray()[0]['MAX(id)'];
        $newId = (int)$id + 1;

        return 'P'.$newId;
    }

    public function readRoles(): array
    {
        $query = $this->db->query("SELECT id, name AS vloga FROM roles ORDER BY id DESC");

        return $query->getResultArray();
    }
}
