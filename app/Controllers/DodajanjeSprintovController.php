<?php
namespace App\Controllers;
use App\Models\UporabniskeZgodbeModel;

class DodajanjeSprintovController extends BaseController
{
    /*
    public function index(){
        $data["ime"]=NULL;
        $data["besedilo"]=NULL;
        $data["sprejemniTesti"]=NULL;
        $data["poslovnaVrednost"]=NULL;
        $data["default"]="selected";
        $data["mustHave"]=NULL;
        $data["shouldHave"]=NULL;
        $data["couldHave"]=NULL;
        $data["wontHave"]=NULL;
        $data["idProjekta"]=7;
        $data["idOsebe"]=69;
        $data["opozorilo"]=NULL;
        echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb', $data);
    }*/
    public function login(){
        $data["datum"]=date("Y-m-d");
        $data["besedilo"]=NULL;
        $data["sprejemniTesti"]=NULL;
        $data["poslovnaVrednost"]=NULL;
        $data["default"]="selected";
        $data["mustHave"]=NULL;
        $data["shouldHave"]=NULL;
        $data["couldHave"]=NULL;
        $data["idOsebe"]=NULL;
        $data["idProjekta"]=7;
        $data["hitrostSprinta"]=69;
        $data["opozorilo"]=NULL;
        echo view('subpages/dodajanjeSprinta/dodajanjeSprinta', $data);
    }
    
    public function dodajanjeSprinta(){

        if ($this->request->getMethod() == 'post') {
            $speed=$this->request->getVar('speed');
            $start=$this->request->getVar('start');
            $end=$this->request->getVar('end');
            $idProjekta=$this->request->getVar('idProjekta');
            $idOsebe=$this->request->getVar('idOsebe');
            $model=new SprintiModel();
            $idSprinta=$model->pridobiMaxIdSprinta()+1;
            #$zeIme=$model->preveriCeJeZeIme($ime);
            $sprint=[
                'speed' => $speed,
                'start' => $start,
                'end' => $end,
                'projekt' => $idProjekta,
                'idSprinta'=> $idSprinta,
            ];
            if(empty($speed) || empty($start) || empty($end) || empty($idProjekta)){
                $data["ime"]=$ime;
                $data["besedilo"]=$zgodba['besedilo'];
                $data["sprejemniTesti"]=$sprejemniTesti;
                $data["poslovnaVrednost"]=$poslovnaVrednost;
                $data["idProjekta"]=$idProjekta;
                $data["idOsebe"]=$idOsebe;
                $data["opozorilo"]="Preverite če so vsa polja izpolnjena in poskusite ponovno";
                echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb', $data);
            }
            else{
                if($zeIme){
                    $data["ime"]=$ime;
                    $data["besedilo"]=$besedilo;
                    $data["sprejemniTesti"]=$sprejemniTesti;
                    $data["poslovnaVrednost"]=$poslovnaVrednost;
                    $data["idProjekta"]=$idProjekta;
                    $data["idOsebe"]=$idOsebe;
                    $data["opozorilo"]="Ime uporabniške zgodbe že obstaja, prosimo, da ga spremenite";
                    echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb', $data);
                }
                else{
                    $lahkoZapise=$model->preveriStatusUporabnika($idOsebe, $idProjekta);
                    if($lahkoZapise){
                        #echo $model->zapisiVBazo($zgodba);
                        echo("Dela");
                    }
                    else{
                        echo("Nimate dostopa do zapisa, kontaktirajte projektnega vodjo/skrbnika metodologije");
                    }
                }
            }
        } else {
            $data["ime"]=NULL;
            $data["besedilo"]=NULL;
            $data["sprejemniTesti"]=NULL;
            $data["poslovnaVrednost"]=NULL;
            $data["default"]="selected";
            $data["mustHave"]=NULL;
            $data["shouldHave"]=NULL;
            $data["couldHave"]=NULL;
            $data["wontHave"]=NULL;
            $data["idProjekta"]=7;
            $data["idOsebe"]=69;
            $data["opozorilo"]=NULL;
            echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb', $data);
        }
    }       
}