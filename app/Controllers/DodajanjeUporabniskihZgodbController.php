<?php
namespace App\Controllers;

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
            $zgodba=[
                'ime' => $ime,
                'besedilo' => $besedilo,
                'prioriteta' => $prioriteta,
                'sprejemniTesti' => $sprejemniTesti,
                'poslovnaVrednost' => $poslovnaVrednost,
                'projekt' => $results['id'],
            ];

            echo(json_encode($zgodba));
        } else {
            $data = [];

            echo view('subpages/dodajanjeUporabniskihZgodb/dodajanjeUporabniskihZgodb');

        }
    }       
}