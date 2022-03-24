<?php
namespace App\Controllers;
use App\Models\SprintiModel;

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
            $prekrivanje=$model->preveriZaPrekrivanje($start, $idProjekta);
            $sprint=[
                'speed' => $speed,
                'start' => $start,
                'end' => $end,
                'projekt' => $idProjekta,
            ];
            if(empty($speed) || empty($start) || empty($end) || empty($idProjekta)){
                $data["speed"]=$speed;
                $data["start"]=$start;
                $data["end"]=$end;
                $data["idProjekta"]=$idProjekta;
                $data["idOsebe"]=$idOsebe;
                $data["datum"]=date("Y-m-d");
                $data["opozorilo"]="Preverite če so vsa polja izpolnjena in poskusite ponovno";
                echo view('subpages/dodajanjeSprinta/dodajanjeSprinta', $data);
            }
            else{
                if($prekrivanje){
                    $data["speed"]=$speed;
                    $data["start"]=$start;
                    $data["end"]=$end;
                    $data["idProjekta"]=$idProjekta;
                    $data["idOsebe"]=$idOsebe;
                    $data["datum"]=date("Y-m-d");
                    $data["opozorilo"]="Začetek sprinta, ki ste ga vnesli se prikriva z drugim sprintom";
                    echo view('subpages/dodajanjeSprinta/dodajanjeSprinta', $data);
                }
                else{
                    if($start<$end){
                        if($speed>0){
                            $lahkoZapise=$model->preveriStatusUporabnika($idOsebe);
                            if($lahkoZapise){
                                echo $model->zapisiVBazo($sprint);
                                echo("Dela");
                            }
                            else{
                                echo("Nimate dostopa do zapisa, kontaktirajte projektnega vodjo/skrbnika metodologije");
                            }
                        }
                        else{
                            $data["speed"]=$speed;
                            $data["start"]=$start;
                            $data["end"]=$end;
                            $data["idProjekta"]=$idProjekta;
                            $data["idOsebe"]=$idOsebe;
                            $data["datum"]=date("Y-m-d");
                            $data["opozorilo"]="Vrednost hitrosti sprinta more biti večja od 0";
                            echo view('subpages/dodajanjeSprinta/dodajanjeSprinta', $data);
                        }
                    }
                    else{
                        $data["speed"]=$speed;
                        $data["start"]=$start;
                        $data["end"]=$end;
                        $data["idProjekta"]=$idProjekta;
                        $data["idOsebe"]=$idOsebe;
                        $data["datum"]=date("Y-m-d");
                        $data["opozorilo"]="Konec sprinta je pred začetkom";
                        echo view('subpages/dodajanjeSprinta/dodajanjeSprinta', $data);
                    }
                    
                }
            }
        } else {
            $data["speed"]=NULL;
            $data["start"]=NULL;
            $data["end"]=NULL;
            $data["idProjekta"]=6;
            $data["idOsebe"]=6;
            $data["opozorilo"]=NULL;
            $data["datum"]=date("Y-m-d");
            echo view('subpages/dodajanjeSprinta/dodajanjeSprinta', $data);
        }
    }       
}