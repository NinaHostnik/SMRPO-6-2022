<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\SprintiModel;
use App\Models\UporabniskeZgodbeModel;
use App\Models\UserModel;
use DateTime;

class SprintController extends BaseController
{

    public function backlog(){
        $idZgodbe = $this->request->getVar('surname');
        $model = new SprintiModel();
        $sprints = $model->getSprints(session()->get("projectId"));
        $trenutnisprint = null;
        $nezakjucensprint = null;

        $date_now = new DateTime();
        #var_dump($sprints);
        foreach ($sprints as $sprint):
            $sprintstart = new DateTime($sprint['zacetniDatum']);
            $sprintend = new DateTime($sprint['koncniDatum']);

            if($sprintend<$date_now && $sprint['trenutniStatus']!='zakjucen'){
                $nezakjucensprint = $sprint;
                break;
            }

            if($sprintend>$date_now && $sprintstart<=$date_now){
                $trenutnisprint=$sprint;
                break;
            }
        endforeach;
        $zgodbemodel = new UporabniskeZgodbeModel();
        if($nezakjucensprint == null){
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($trenutnisprint['idSprinta']);
            $zgodberework = $this->pridobizgodbe($zgodbe);
            $data = [
                'sprint'=>$trenutnisprint,
                'nezakjucen'=>false,
                'zgodbe'=>$zgodberework,
                'uporabniki'=>$this->pridobiUporabnike(),
            ];
            if(session()->has('popup')){
                $popupdata = ['popup' => session()->getFlashdata('popup')];
                echo view('partials/popup',$popupdata);
            }
            echo view('subpages/sprint/backlog', $data);        }
        else{
            # var_dump($nezakjucensprint['idSprinta']);
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($nezakjucensprint['idSprinta']);
            $zgodberework = $this->pridobizgodbe($zgodbe);

            # separate stories into inProgress and acceptanceReady
            $accReady = array();
            $inProgress = array();
            foreach($zgodberework as $zg):
                $stAll = count($zg['naloge']);
                $stDone = 0;
                foreach ($zg['naloge'] as $naloga):
                    if ($naloga['dokoncan'] === 'D') {
                        $stDone += 1;
                    }
                endforeach;
                if ($stAll === $stDone) {
                    $accReady[] = $zg;
                } else {
                    $inProgress[] = $zg;
                }
            endforeach;

            $data = [
                'sprint' => $nezakjucensprint,
                'nezakjucen' => true,
                'zgodbeAccReady' => $accReady,
                'zgodbeInProgress' => $inProgress,
                'uporabniki' => $this->pridobiUporabnike(),
            ];
            $popupdata = ['popup' => 'Zakjučite sprint preden začete novega'];
            echo view('partials/popup',$popupdata);
            echo view('subpages/sprint/backlog', $data);
        }
    }

    public function dodajZgodbo(){
        $idZgodbe = $this->request->getVar('surname');
        $model = new SprintiModel();
        $sprints = $model->getSprints(session()->get("projectId"));
        $trenutnisprint = null;
        $nezakjucensprint = null;

        $date_now = new DateTime();
        #var_dump($sprints);
        foreach ($sprints as $sprint):
            $sprintstart = new DateTime($sprint['zacetniDatum']);
            $sprintend = new DateTime($sprint['koncniDatum']);

            if($sprintend<$date_now && $sprint['trenutniStatus']!='zakjucen'){
                $nezakjucensprint = $sprint;
                break;
            }

            if($sprintend>$date_now && $sprintstart<=$date_now){
                $trenutnisprint=$sprint;
                break;
            }
        endforeach;
        $zgodbemodel = new UporabniskeZgodbeModel();
        if($nezakjucensprint == null){
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($trenutnisprint['idSprinta']);

            $prabljencas = 0;
            foreach ($zgodbe as $zgodba):
                $prabljencas=$prabljencas+$zgodba['casovnaZahtevnost'];
            endforeach;
            $dodanazgodba = $zgodbemodel->find($idZgodbe);
            if($prabljencas+$dodanazgodba['casovnaZahtevnost'] <= $trenutnisprint['hitrost']){
                $zgodbemodel->update(['sprint'=>$trenutnisprint['idSprinta']]);
                session()->setFlashdata(['popup'=>'uspešno']);
                return redirect()->to('/uspesno');

            }
            else{
                session()->setFlashdata(['popup'=>'hitrost sprinta premajhna']);
                return redirect()->to('/Sbacklog');

            }


        }
        else{
            return redirect()->to('/Sbacklog');
        }

    }
}