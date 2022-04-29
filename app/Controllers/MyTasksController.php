<?php

namespace App\Controllers;

use App\Models\NalogeModel;
use App\Models\UporabniskeZgodbeModel;
use App\Models\UserModel;
use App\Models\SprintiModel;

class MyTasksController extends BaseController
{
    public function myTasks() {
        $zgodbeModel = new UporabniskeZgodbeModel();
        $nalogeModel = new NalogeModel();
        $userModel = new UserModel();
        $userID = session()->get('id');
        $projectID = session()->get('projectId');

        $mojeZgodbe = $zgodbeModel->getMyStories($userID, $projectID);
        $zgodbeNalog = $zgodbeModel->getMyStoryTasks($userID, $projectID);
        $naloge = $nalogeModel->pridobiMojeNaloge($userID, $projectID);
        $zgodbe = $zgodbeModel->pridobiZgodbe(session()->get("projectId"));

        $stories1 = $this->addResponsibleAdults($zgodbeNalog, $userModel);
        $stories2 = $this->addTasksToStory($stories1, $naloge);



        $zgodberework = $this->pridobizgodbe($zgodbe);
        $data = [
            'zgodbe'=>$stories2,
        ];
        echo view('subpages/projekti/myTasks',$data);
    }

    function addTasksToStory($zgodbeNalog, $naloge) {
        $i = 0;
        foreach ($zgodbeNalog as $zgodba):
            $temp = [];
            $j = 0;
            foreach ($naloge as $naloga):
                if ($zgodba['idZgodbe'] === $naloga['zgodba_id']) $temp += array($j => $naloga);
                $j++;
            endforeach;
            $zgodbeNalog[$i] += array('naloge' => $temp);
            $i++;

        endforeach;
        return $zgodbeNalog;
    }

    function addResponsibleAdults($zgodbe, $usermodel) {
        $i = 0;
        foreach ($zgodbe as $zgodba):
            $user_id = $zgodba['idUporabnika'];
            if ($user_id === null) {
                $zgodbe[$i]['odgovorni'] = '/';
            } else {
                $username = $usermodel->getUserById($user_id);
                $zgodbe[$i]['odgovorni'] = $username[0]['username'];
            }
            $i++;
        endforeach;
        return $zgodbe;
    }

    public function changeStatus() {
        $uri = service('uri');

        $status = $uri->getSegment('2');
        $taskId = $uri->getSegment('3');

        $model = new NalogeModel();
        if ($status == 'N') {
            $model->activateWork($taskId);
        } else {
            $model->finishWork($taskId);
        }

        return redirect()->back();
    }
    public function sprejmiNalogo(){
        #TODO obvestila uporabniku za sprejeto/zavrnjeno/error
        $uri = service('uri');
        $model= new UporabniskeZgodbeModel();
        $uporabnik=session()->get('id');
        $naloga = $uri->getSegment('2');
        $model->sprejmiNalogo($naloga, $uporabnik);
        session()->setFlashdata(['popup'=>'Sprejeli ste nalogo']);
        return redirect()->back();
    }
    public function zavrniNalogo(){
        $uri = service('uri');
        $model= new UporabniskeZgodbeModel();
        $uporabnik=session()->get('id');
        $naloga = $uri->getSegment('2');
        $nalogeModel = new NalogeModel();
        $status=$nalogeModel->pridobiAktivnostNaloge($naloga);
        if($status){
            $nalogeModel->finishWork($naloga);
        }
        $model->zavrniNalogo($naloga, $uporabnik);
        session()->setFlashdata(['popup'=>'Zavrnili ste nalogo']);
        return redirect()->back();
    }
    public function potrdiZgodbo(){
        $zgodbeModel = new UporabniskeZgodbeModel();
        $model= new SprintiModel();
        $uri = service('uri');
        $zgodbaId=$uri->getSegment('2');
        $koncaneVseNaloge=$zgodbeModel->soVseNalogeKoncane($zgodbaId);
        $uporabnik=session()->get('id');
        $idProjekta=session()->get('projectId');
        $jeProduktniVodja=$zgodbeModel->jeProduktniVodja($uporabnik, $idProjekta);
        $jeSkrbnik=$model->preveriStatusUporabnika($uporabnik);
        if($jeProduktniVodja || $jeSkrbnik){
            $jeProduktniVodja=true;
        }
        if($koncaneVseNaloge && $jeProduktniVodja){
            $zgodbeModel->potrdiZgodboModel($zgodbaId);
            session()->setFlashdata(['popup'=>'Zgodba potrjena']);
        }
        return redirect()->back();
    }

    public function zavrniZgodbo(){
        $zgodbeModel = new UporabniskeZgodbeModel();
        $zgodbaId=$this->request->getVar('idZgodbe');
        $komentar=$this->request->getVar('komentar');
        $zgodbeModel->zavrniZgodboModel($zgodbaId, $komentar);
        session()->setFlashdata(['popup'=>'Zgodba zavrnjena.']);
        return redirect()->back();
    }

    function zakljuciNalogo(){
        $uri = service('uri');
        $idNaloge=$uri->getSegment('2');
        $nalogeModel = new NalogeModel();
        $status=$nalogeModel->pridobiAktivnostNaloge($idNaloge);
        $idUporabnika=session()->get('id');
        $jeNalogaMoja=$nalogeModel->preveriCeJeNalogaMoja($idNaloge, $idUporabnika);
        if($jeNalogaMoja){
            if($status){
                $nalogeModel->finishWork($idNaloge);
            }
            $nalogeModel->zakljuciNalogo($idNaloge);
            session()->setFlashdata(['popup'=>'Naloga zaključena']);
        }
        else{
            session()->setFlashdata(['popup'=>'Ne morete zaključiti naloge, ki ni vaša']);
        }
        return redirect()->back();
    }
}