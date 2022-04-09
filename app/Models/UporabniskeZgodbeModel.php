<?php namespace App\Models;

use CodeIgniter\Model;

class UporabniskeZgodbeModel extends Model{

    function zapisiVBazo(array $data){
        $table = 'uporabniskeZgodbe';
        $ime=$data['ime'];
        $besedilo=$data['besedilo'];
        $prioriteta=$data['prioriteta'];
        $poslovnaVrednost=$data['poslovnaVrednost'];
        $sprejemniTesti=$data['sprejemniTesti'];
        $projekt=$data['projekt'];
        $query = $this->db-> query("INSERT INTO ". $table." (naslov, besedilo, prioriteta, poslovnaVrednost, sprejemniTesti, idProjekta, statusZgodbe) VALUES ('". $ime."', '". $besedilo."', '". $prioriteta."', '". $poslovnaVrednost."', '". $sprejemniTesti."', ". $projekt.", 'backlog')");
        return $query;
    }

    function pridobiMaxIdZgodbe(){
        $table = 'uporabniskeZgodbe';
        $query = $this->db-> query("SELECT MAX(idZgodbe) from ".$table."");
        $id = $query->getResultArray()[0]['MAX(idZgodbe)'];
        return $id;
    }

    function preveriCeJeZeIme(string $naslov, $idProjekta){  #ce je ze ime v bazi vrne true
        $table = 'uporabniskeZgodbe';
        $query=$this->db-> query("SELECT * FROM ".$table." WHERE UPPER(naslov)=UPPER('". $naslov."') AND idProjekta = ".$idProjekta);
        $id = $query->getResultArray();
        if($id==NULL){
            return false;
        }
        return true;
    }
    function preveriStatusUporabnika(int $uporabnik, int $projektId){
        $table='project_members';
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

    function pridobiZaporednoSt($idProjekta){
        $query = $this->db-> query("SELECT COUNT(*) + 1 AS c from uporabniskeZgodbe WHERE idProjekta = ".$idProjekta);
        $result = $query->getResultArray()[0]['c'];
        return $result;
    }

    function pridobiZgodbe($idProjekta){
        $query = $this->db-> query("SELECT * from uporabniskeZgodbe WHERE idProjekta = ".$idProjekta);
        return $query->getResultArray();
    }
}