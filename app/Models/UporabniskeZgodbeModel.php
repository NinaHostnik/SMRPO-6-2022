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
        $idZgodbe=$data['idZgodbe'];
        $query = $this->db-> query("INSERT INTO ". $table." (naslov, besedilo, prioriteta, poslovnaVrednost, sprejemniTesti, idProjekta, idZgodbe, statusZgodbe) VALUES ('". $ime."', '". $besedilo."', '". $prioriteta."', '". $poslovnaVrednost."', '". $sprejemniTesti."', '". $projekt."', '".$idZgodbe."', 'backlog')");
        return $query;
    }

    function pridobiMaxIdZgodbe(){
        $table = 'uporabniskeZgodbe';
        $query = $this->db-> query("SELECT MAX(idZgodbe) from ".$table."");
        $id = $query->getResultArray()[0]['MAX(idZgodbe)'];
        return $id;
    }

    function preveriCeJeZeIme(string $naslov){  #ce je ze ime v bazi vrne true
        $table = 'uporabniskeZgodbe';
        $query=$this->db-> query("SELECT * FROM ".$table." WHERE naslov='". $naslov."'");
        $id = $query->getResultArray();
        if($id==NULL){
            return false;
        }
        return true;
    }
}