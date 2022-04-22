<?php namespace App\Models;

use CodeIgniter\Model;

class NalogeModel extends Model
{
    protected $table = 'naloge';
    protected $allowedFields = ['zgodba_id', 'opis_naloge', 'ocena_casa','clan_ekipe','potrjen','dokoncan'];

    function pridobiNalogeZgodbe($idZgodbe){
        $query = $this->db->query("SELECT * from naloge WHERE zgodba_id = ".$idZgodbe);
        return $query->getResultArray();
    }
    function pridobiNalogoPoImenu($ime,$zgodba) {
        $query = $this->db->query("SELECT * from naloge WHERE opis_naloge = '$ime' AND zgodba_id = '$zgodba'");
        // var_dump($query);
        return $query->getResultArray();
    }

    function pridobiMojeNaloge($userID, $projectID) {
        $query = $this->db-> query("SELECT * FROM naloge WHERE clan_ekipe = '".$userID."' AND zgodba_id IN (SELECT idZgodbe FROM uporabniskeZgodbe WHERE idProjekta ='".$projectID."')");
        return $query->getResultArray();
    }

    function activateWork($taskId) {
        $this->db->query("CALL change_work_status(". $taskId.");");
    }

    function finishWork($taskId) {
        $this->db->query("CALL save_time(". $taskId.");");
    }

}