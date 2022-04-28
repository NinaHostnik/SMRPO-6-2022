<?php namespace App\Models;

use CodeIgniter\Model;

class UporabniskeZgodbeModel extends Model{
    protected $table = 'uporabniskeZgodbe';
    protected $allowedFields = ['idZgodbe ', 'idProjekta ', 'naslov','besedilo','prioriteta','poslovnaVrednost','statusZgodbe ','casovnaZahtevnost','sprejemniTesti', 'sprint','potrjen'];

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
        $rezultatiQuery = $query->getResultArray();
        if($rezultatiQuery==NULL){
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

    function pridobiZgodbeSprinta($idSprinta){
        $query = $this->db-> query("SELECT * from uporabniskeZgodbe WHERE sprint = ".$idSprinta);
        return $query->getResultArray();
    }

    function saveTime($idZgodbe, $time) {
        $query = $this->db-> query("UPDATE uporabniskeZgodbe SET casovnaZahtevnost =".$time."  WHERE idZgodbe = ".$idZgodbe);
        return $query;

    }

    function pridobiZgodbo($idZgodbe)
    {
        $query = $this->db->query("SELECT * from uporabniskeZgodbe WHERE idZgodbe = " . $idZgodbe);
        return $query->getResultArray();
    }

    function updateSprint($idZgodbe, $sprint)
    {
        $query = $this->db->query("UPDATE uporabniskeZgodbe SET sprint = ?, statusZgodbe=? WHERE idZgodbe = ?",array($sprint, "sprint", $idZgodbe));
        return $query;
    }

    function getMyStories($userID, $projectID) {
        # gets all tasks assigned to user on current project
        $query = $this->db-> query("SELECT * from uporabniskeZgodbe WHERE idUporabnika = ".$userID." AND idProjekta = ".$projectID);
        return $query->getResultArray();
    }

    function getMyStoryTasks($userID, $projectID) {
        $query = $this->db-> query("SELECT * FROM uporabniskeZgodbe WHERE idProjekta = '".$projectID."' AND idZgodbe IN (SELECT zgodba_id FROM naloge WHERE clan_ekipe = ".$userID.")");
        return $query->getResultArray();
    }
    function sprejmiNalogo($idNaloge, $idUporabnika){
        $query=$this->db->query("SELECT * FROM naloge WHERE clan_ekipe=".$idUporabnika." AND id=".$idNaloge."AND potrjen='N'");
        if($query!=TRUE){
            $query=$this->db->query("UPDATE naloge SET potrjen='D', clan_ekipe=".$idUporabnika." WHERE id=".$idNaloge);
        }
        else{
            $query=$this->db->query("SELECT * FROM naloge WHERE clan_ekipe=NULL AND id=".$idNaloge."AND potrjen='N'");
            if($query!=TRUE){
                $query=$this->db->query("UPDATE naloge SET potrjen='D', clan_ekipe=".$idUporabnika." WHERE id=".$idNaloge);
            }
        }
    }
    function zavrniNalogo($idNaloge, $idUporabnika){
        $query=$this->db->query("SELECT * FROM naloge WHERE clan_ekipe=".$idUporabnika." AND id=".$idNaloge);
        $rezultat=$query->getResultArray();
        if($rezultat!=NULL){
            $query=$this->db->query("UPDATE naloge SET clan_ekipe=NULL, potrjen='N' WHERE id=".$idNaloge);
        }     
    }
    function soVseNalogeKoncane($idUporabniskeZgodbe){
        $query=$this->db->query("SELECT * FROM naloge WHERE zgodba_id=".$idUporabniskeZgodbe);
        $stNalog=count($query->getResultArray());
        $query=$this->db->query("SELECT * FROM naloge WHERE zgodba_id=".$idUporabniskeZgodbe." AND dokoncan='D'");
        $stKoncanihNalog=count($query->getResultArray());
        if($stNalog==$stKoncanihNalog){
            return true;
        }
        return false;
    }
    function jeProduktniVodja($idUporabnika, $idProjekta){
        $query=$this->db->query("SELECT * FROM project_members WHERE project_id=".$idProjekta." AND user_id=".$idUporabnika." AND role='V'");
        $rezultat=$query->getResultArray();
        if($rezultat!=NULL){
            return true;
        }
        return false;
    }
    function potrdiZgodboModel($idZgodbe){
        $query=$this->db->query("UPDATE uporabniskeZgodbe SET potrjen='D', statusZgodbe='zakljucen' WHERE idZgodbe=".$idZgodbe);
        var_dump($query);
    }
}