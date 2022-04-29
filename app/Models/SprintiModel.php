<?php namespace App\Models;

use CodeIgniter\Model;

class SprintiModel extends Model{

    function zapisiVBazo(array $data){
        $table = 'sprinti';
        $speed=$data['speed'];
        $start=$data['start'];
        $end=$data['end'];
        $projekt=$data['projekt'];
        $query = $this->db-> query("INSERT INTO ". $table." (idProjekta, zacetniDatum, koncniDatum, hitrost, trenutniStatus) VALUES ('". $projekt."', '". $start."', '". $end."', '". $speed."', 'vpisana')");
        return $query;
    }

    function pridobiMaxIdSprinta(){
        $table = 'sprinti';
        $query = $this->db-> query("SELECT MAX(idSprinta) from ".$table."");
        $id = $query->getResultArray()[0]['MAX(idSprinta)'];
        return $id;
    }

    function getFirstAvailableDate(string $idProjekta) {
        $table = 'sprinti';
        $query = $this->db-> query("SELECT MAX(koncniDatum) AS kd FROM ".$table." WHERE idProjekta=".$idProjekta);
        #$row = $query->getResultArray();
        $returnDate = date("Y-m-d");
        if ($query != FALSE) {
            $row = $query->getResultArray();
            $returnDate = date("Y-m-d", strtotime($row[0]['kd'].'+1 day'));
        }
        // preveri ce je nedelja here
        if (date('l', strtotime($returnDate)) == 'Sunday') {
            $returnDate = date("Y-m-d", strtotime($returnDate.'+1 day'));
        }

        return $returnDate;
    }

    function preveriZaPrekrivanje(string $zacetniDatum, string $idProjekta){  #ce je ze ime v bazi vrne true
        $table = 'sprinti';
        $query=$this->db-> query("SELECT * FROM ".$table." WHERE idProjekta='". $idProjekta."'");
        $id = $query->getResultArray();
        if($id==NULL){
            return false;
        }
        foreach($id as $koncniDatum){
            if($zacetniDatum<$koncniDatum['koncniDatum']){
                return true;
            }
        }
        return false;
    }
    function preveriStatusUporabnika(int $uporabnik){
        $table='project_members';
        $query=$this->db-> query("SELECT * FROM ".$table." WHERE user_id=". $uporabnik." and role='S'");
        $id=$query->getResultArray();
        if($id==NULL){
            return false;
        }
        else{
            return true;
        }
    }

    public function getSprints($projectId): array
    {
        $query = $this->db->query("
            SELECT *
            FROM sprinti
            WHERE idProjekta = ?
        ",array($projectId));

        return $query->getResultArray();
    }

    public function getSprint($sprintId): array {
        $query=$this->db-> query("SELECT * FROM sprinti WHERE idSprinta = ".$sprintId);
        return $query->getResultArray()[0];
    }
    function vrziZgodboIzSprinta($idZgodbe){
        $query=$this->db->query("UPDATE uporabniskeZgodbe SET statusZgodbe='backlog', sprint=0 WHERE idZgodbe=".$idZgodbe);
    }
    function koncajSprint($idSprinta){
        $query=$this->db->query("UPDATE sprinti SET trenutniStatus='zakljucen' WHERE idSprinta=".$idSprinta);
    }
}
