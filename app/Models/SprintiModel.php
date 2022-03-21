<?php namespace App\Models;

use CodeIgniter\Model;

class SprintiModel extends Model{

    function zapisiVBazo(array $data){
        $table = 'sprinti';
        $ime=$data['ime'];
        $besedilo=$data['besedilo'];
        $prioriteta=$data['prioriteta'];
        $poslovnaVrednost=$data['poslovnaVrednost'];
        $sprejemniTesti=$data['sprejemniTesti'];
        $projekt=$data['projekt'];
        $idZgodbe=$data['idZgodbe'];
        $query = $this->db-> query("INSERT INTO ". $table." (naslov, besedilo, prioriteta, poslovnaVrednost, sprejemniTesti, idProjekta, idZgodbe, statusZgodbe) VALUES ('". $ime."', '". $besedilo."', '". $prioriteta."', '". $poslovnaVrednost."', '". $sprejemniTesti."', '". $projekt."', '".$idZgodbe."', 'backlog')");
        return $query;
    }

    function pridobiMaxIdSprinta(){
        $table = 'sprinti';
        $query = $this->db-> query("SELECT MAX(idSprinta) from ".$table."");
        $id = $query->getResultArray()[0]['MAX(idSprinta)'];
        return $id;
    }

    function preveriCeJeZeIme(string $naslov){  #ce je ze ime v bazi vrne true
        $table = 'sprinti';
        $query=$this->db-> query("SELECT * FROM ".$table." WHERE naslov='". $naslov."'");
        $id = $query->getResultArray();
        if($id==NULL){
            return false;
        }
        return true;
    }
    function preveriStatusUporabnika(int $uporabnik, int $projektId){
        $table='sprinti';
        $query=$this->db-> query("SELECT * FROM ".$table." WHERE user_id=". $uporabnik." and project_id=".$projektId." and role='V'");
        $id = $query->getResultArray();
        if($id==NULL){
            $query=$this->db-> query("SELECT * FROM ".$table." WHERE user_id=". $uporabnik." and role='S'");
            $id=$query->getResultArray();
            if($id==NULL){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return true;
        }
    }
}