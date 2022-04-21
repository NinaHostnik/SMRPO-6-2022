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

            if($sprintend>=$date_now && $sprintstart<=$date_now){
                $trenutnisprint=$sprint;
                break;
            }
        endforeach;
        $zgodbemodel = new UporabniskeZgodbeModel();

        if ($trenutnisprint == null && $nezakjucensprint== null){
            session()->setFlashdata(['popup'=>'sprint trenutno ni aktiven']);
            return redirect()->to('/Pbacklog');
        }

        if($nezakjucensprint == null){
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($trenutnisprint['idSprinta']);
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
                'sprint'=>$trenutnisprint,
                'nezakjucen'=>false,
                'zgodbeAccReady' => $accReady,
                'zgodbeInProgress' => $inProgress,
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
            var_dump($inProgress);
            $data = [
                'sprint' => $nezakjucensprint,
                'nezakjucen' => true,
                'zgodbeAccReady' => $accReady,
                'zgodbeInProgress' => $inProgress,
                'uporabniki' => $this->pridobiUporabnike(),
            ];
            $popupdata = ['popup' => 'Zakjučite sprint preden začete novega'];
            session()->setFlashdata($popupdata);
            echo view('subpages/sprint/backlog', $data);
        }
    }

    public function dodajZgodbo(){
        $idZgodbe = $this->request->getVar('idZgodbe');
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

        if ($trenutnisprint == null && $nezakjucensprint== null){
            session()->setFlashdata(['popup'=>'sprint trenutno ni aktiven']);
            return redirect()->to('/Pbacklog');
        }

        $zgodbemodel = new UporabniskeZgodbeModel();
        if($nezakjucensprint == null){
            $zgodbe = $zgodbemodel->pridobiZgodbeSprinta($trenutnisprint['idSprinta']);
            $prabljencas = 0;
            if (!empty($zgodbe)){
                foreach ($zgodbe as $zgodba):
                    $prabljencas=$prabljencas+$zgodba['casovnaZahtevnost'];
                endforeach;
            }
            var_dump($idZgodbe);
            $dodanazgodba = $zgodbemodel->pridobiZgodbo($idZgodbe);
            var_dump($dodanazgodba);
            if($prabljencas+$dodanazgodba[0]['casovnaZahtevnost'] <= $trenutnisprint['hitrost']){
                var_dump($trenutnisprint['idSprinta']);
                $zgodbemodel->updateSprint($idZgodbe,$trenutnisprint['idSprinta']);
                session()->setFlashdata(['popup'=>'uspešno']);
                return redirect()->to('/Sbacklog');
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