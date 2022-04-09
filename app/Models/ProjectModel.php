<?php namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model{

    protected  $table = 'project';
    protected $subtableMembers = 'project_members';
    protected $subtableRoles = 'roles';

    public function callStoringProcedure($ime, $description, $userList, $roleList) {
        $rs = $this->db->query("CALL save_project('". $ime. "','". $description. "','". $userList. "','". $roleList. "', @error)");
        $result = $this->db->query("SELECT @error AS errorMessage");
        $row = $result->getResultArray();
        if ($row) {
            return $row[0]['errorMessage'];
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

    public function getUsersProjects($userId): array
    {
        $query = $this->db->query("
            SELECT DISTINCT project.id, project.ime, project.opis
            FROM project
            LEFT JOIN project_members
            ON project_members.project_id = project.id
            WHERE project_members.user_id = ?
        ",array($userId));

        return $query->getResultArray();
    }

    public function getUser($userId): array
    {
        $query = $this->db->query("
            SELECT DISTINCT project.id, project.ime, project.opis
            FROM project
            LEFT JOIN project_members
            ON project_members.project_id = project.id
            WHERE project_members.user_id = ?
        ",array($userId));

        return $query->getResultArray();
    }

}
