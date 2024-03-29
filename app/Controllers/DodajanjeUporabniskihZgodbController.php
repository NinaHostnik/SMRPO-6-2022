<?php
namespace App\Controllers;
use App\Models\UporabniskeZgodbeModel;

class DodajanjeUporabniskihZgodbController extends BaseController
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
    }
    public function login(){
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
    */
    public function preberiSprejemne($stTestov){
        $izhodniString=$this->request->getVar('sprejemniTest0');
        for ($i=1; $i<=$stTestov; $i++){
            $test=$this->request->getVar('sprejemniTest'.$i);
            if($test!=NULL){
                $izhodniString=$izhodniString.' ;'.$test;
            } 
        }
        return $izhodniString;
    } 
    public function dodajanjeZgodbe(){
        $uri = service('uri');
        $model=new UporabniskeZgodbeModel();
        if ($this->request->getMethod() == 'post') {
            $ime=$this->request->getVar('zgodbaIme');
            $besedilo=$this->request->getVar('zgodbaBesedilo');
            $prioriteta=$this->request->getVar('prioriteta');
            $stSprejemnihTestov=$this->request->getVar('stSprejemnihTestov');
            $sprejemniTesti=$this->preberiSprejemne($stSprejemnihTestov);
            $poslovnaVrednost=$this->request->getVar('poslovnaVrednost');
            $idProjekta=session()->get('projectId');
            $idOsebe=$this->request->getVar('idOsebe');
            $zeIme=$model->preveriCeJeZeIme($ime, $idProjekta);
            $zgodba=[
                'ime' => $ime,
                'besedilo' => $besedilo,
                'prioriteta' => $prioriteta,
                'sprejemniTesti' => $sprejemniTesti,
                'poslovnaVrednost' => $poslovnaVrednost,
                'projekt' => $idProjekta,
            ];
            if(empty($ime) || empty($besedilo) || empty($prioriteta) || empty($sprejemniTesti) || empty($poslovnaVrednost) || empty($idProjekta)){
                $data["ime"]=$ime;
                $data["besedilo"]=$zgodba['besedilo'];
                $data["sprejemniTesti"]=$sprejemniTesti;
                $data["poslovnaVrednost"]=$poslovnaVrednost;
                $data["idProjekta"]=$idProjekta;
                $data["idOsebe"]=$idOsebe;
                $data["opozorilo"]="Preverite če so vsa polja izpolnjena in poskusite ponovno";
                if(strcmp($prioriteta, "MustHave")==0){
                    $data["default"]=NULL;
                    $data["mustHave"]="selected";
                    $data["shouldHave"]=NULL;
                    $data["couldHave"]=NULL;
                    $data["wontHave"]=NULL;
                }
                else if(strcmp($prioriteta, "ShouldHave")==0){
                    $data["default"]=NULL;
                    $data["mustHave"]=NULL;
                    $data["shouldHave"]="selected";
                    $data["couldHave"]=NULL;
                    $data["wontHave"]=NULL;
                }
                else if(strcmp($prioriteta, "CouldHave")==0){
                    $data["default"]=NULL;
                    $data["mustHave"]=NULL;
                    $data["shouldHave"]=NULL;
                    $data["couldHave"]="selected";
                    $data["wontHave"]=NULL;
                }
                else if(strcmp($prioriteta, "WontHave")==0){
                    $data["default"]=NULL;
                    $data["mustHave"]=NULL;
                    $data["shouldHave"]=NULL;
                    $data["couldHave"]=NULL;
                    $data["wontHave"]="selected";
                }
                else{
                    $data["default"]="selected";
                    $data["mustHave"]=NULL;
                    $data["shouldHave"]=NULL;
                    $data["couldHave"]=NULL;
                    $data["wontHave"]=NULL;
                }
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
                    if(strcmp($prioriteta, "MustHave")==0){
                        $data["default"]=NULL;
                        $data["mustHave"]="selected";
                        $data["shouldHave"]=NULL;
                        $data["couldHave"]=NULL;
                        $data["wontHave"]=NULL;
                    }
                    if(strcmp($prioriteta, "ShouldHave")==0){
                        $data["default"]=NULL;
                        $data["mustHave"]=NULL;
                        $data["shouldHave"]="selected";
                        $data["couldHave"]=NULL;
                        $data["wontHave"]=NULL;
                    }
                    if(strcmp($prioriteta, "CouldHave")==0){
                        $data["default"]=NULL;
                        $data["mustHave"]=NULL;
                        $data["shouldHave"]=NULL;
                        $data["couldHave"]="selected";
                        $data["wontHave"]=NULL;
                    }
                    if(strcmp($prioriteta, "WontHave")==0){
                        $data["default"]=NULL;
                        $data["mustHave"]=NULL;
                        $data["shouldHave"]=NULL;
                        $data["couldHave"]=NULL;
                        $data["wontHave"]="selected";
                    }
                    else{
                        $data["default"]="selected";
                        $data["mustHave"]=NULL;
                        $data["shouldHave"]=NULL;
                        $data["couldHave"]=NULL;
                        $data["wontHave"]=NULL;
                    }
                    echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb', $data);
                }
                else{
                    $lahkoZapise=$model->preveriStatusUporabnika($idOsebe, $idProjekta);
                    if($lahkoZapise){
                        echo $model->zapisiVBazo($zgodba);
                        session()->setFlashdata(['feedback' => 'zgodba']);
                        return redirect()->to('/Pbacklog');
                    }
                    else{
                        echo("Nimate dostopa do zapisa, kontaktirajte projektnega vodjo/skrbnika metodologije");
                    }
                }
            }
        } else {
            #$data["ime"]= '#'.$model->pridobiZaporednoSt($uri->getSegment('2')).':';
            $data["ime"]=NULL;
            $data["besedilo"]=NULL;
            $data["sprejemniTesti"]=NULL;
            $data["poslovnaVrednost"]=NULL;
            $data["default"]="selected";
            $data["mustHave"]=NULL;
            $data["shouldHave"]=NULL;
            $data["couldHave"]=NULL;
            $data["wontHave"]=NULL;
            $data["idProjekta"] = session()->get('projectId');
            #$data["idProjekta"]=7;
            $data["idOsebe"]=session()->get('id');
            $data["opozorilo"]=NULL;
            echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb', $data);
        }
    }

    public function urediCas(){
        $model = new UporabniskeZgodbeModel();
        $cas = $this->request->getVar('time');
        $zgodbaId = $this->request->getVar('idZgodbe');
        $model->saveTime($zgodbaId, $cas);

        return redirect()->to('/Pbacklog');
    }
}