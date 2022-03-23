<?php namespace App\Models;

use CodeIgniter\Model;

class SprintiModel extends Model{

    function zapisiVBazo(array $data){
        $table = 'sprinti';
        $speed=$data['speed'];
        $start=$data['start'];
        $end=$data['end'];
        $projekt=$data['projekt'];
        $idSprinta=$data['idSprinta'];
        $query = $this->db-> query("INSERT INTO ". $table." (idProjekta, zacetniDatum, koncniDatum, hitrost, trenutniStatus, idSprinta) VALUES ('". $projekt."', '". $start."', '". $end."', '". $speed."', 'vpisana', '". $idSprinta."')");
        return $query;
    }

    function pridobiMaxIdSprinta(){
        $table = 'sprinti';
        $query = $this->db-> query("SELECT MAX(idSprinta) from ".$table."");
        $id = $query->getResultArray()[0]['MAX(idSprinta)'];
        return $id;
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
}
