<?php
namespace App\Controllers;
use App\Models\UporabniskeZgodbeModel;

class DodajanjeUporabniskihZgodbController extends BaseController
{
    public function index(){
        echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb');
    }
    public function login(){
        echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb');
    }
    public function dodajanjeZgodbe(){

        if ($this->request->getMethod() == 'post') {
            $ime=$this->request->getVar('zgodbaIme');
            $besedilo=$this->request->getVar('zgodbaBesedilo');
            $prioriteta=$this->request->getVar('prioriteta');
            $sprejemniTesti=$this->request->getVar('sprejemniTesti');
            $poslovnaVrednost=$this->request->getVar('poslovnaVrednost');
            $url = $_SERVER['HTTP_REFERER'];
            $components = parse_url($url);
            parse_str($components['query'], $results);
            $model=new UporabniskeZgodbeModel();
            $idZgodbe=$model->pridobiMaxIdZgodbe()+1;
            $zeIme=$model->preveriCeJeZeIme($ime);
            $zgodba=[
                'ime' => $ime,
                'besedilo' => $besedilo,
                'prioriteta' => $prioriteta,
                'sprejemniTesti' => $sprejemniTesti,
                'poslovnaVrednost' => $poslovnaVrednost,
                'projekt' => $results['id'],
                'idZgodbe'=> $idZgodbe,
            ];
            if($zeIme){

            }
            else{
                echo $model->zapisiVBazo($zgodba);
            }
        } else {
            echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb');
        }
    }       
}