<div class="modal fade" id="addTask-<?php echo $zgodba['idZgodbe']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: lightskyblue">
                <h5 class="modal-title">Dodaj nalogo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/Pbacklog/dodajzgodbo" method="post">
                    <?php echo view('partials/formInput', ['type'=>'hidden', 'id'=>'idZgodbe', 'value'=>$zgodba['idZgodbe'], 'label'=>'']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskName', 'value'=>'', 'label'=>'Naloga']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskTime', 'value'=>'', 'label'=>'Časovna zahtevnost']) ?>
                    <!-- TODO: Add select to assign a team member -->
                    <div class="form-outline mb-4">
                        <select class="form-control" name="taskMember" id="taskMember">
                            <option value="brez" default>Zaenkrat brez zadolženega uporabnika</option>
                            <?php foreach ($uporabniki as $uporabnik): ?>
                                <option value=<?php echo $uporabnik['id'] ?>><?php echo $uporabnik['username'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="taskMember">Zadolžen član</label>
                    </div>
                    <?php echo view('partials/formButton', ['name'=>'Dodaj nalogo']) ?>
                </form>
                <?php
                if(session()->has('errordata')){
                    $validation = session()->getFlashdata('errordata');
                    echo $validation->listErrors();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Zavrni zgodbo -->
<div class="modal fade" id="zavrniModal-<?php echo $zgodba['idZgodbe']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Zavrni zgodbo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/Sbacklog/zavrniZgodbo" method="post">
                    <?php echo view('partials/formTextarea', ["label"=>"Razlog za zavrnitev", 'id'=>'komentar', 'rows'=>'5', 'maxlength'=>'3000'])?>
                    <!-- Hidden form to get story ID -->
                    <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => 'idZgodbe', 'value'=>$zgodba['idZgodbe'], 'label'=>''])?>
                    <?php echo view('partials/formButton', ['name'=>'Zavrni zgodbo']) ?>
                </form>
                <?php
                if(session()->has('errordata')){
                    $validation = session()->getFlashdata('errordata');
                    echo $validation->listErrors();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editStory-<?php echo $zgodba['idZgodbe']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Uredi zgodbo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Uredi časovno zahtevnost -->
<?php echo view('partials/modalForms/urediCasovnoZahtevnost', ['idZgodbe' => $zgodba['idZgodbe']]) ?>

<!-- Story card if the user is a Product Owner ('V') -->
<?php if (strpos(session()->get('roles')[session()->get('projectId')], 'V') > -1) { ?>
    <card class="card mb-1">
        <!-- Card header: Story title and status, Designated developer, Priority, Business value -->
        <div class="card-header d-flex justify-content-between align-items-center" <?php if ($zgodba['statusZgodbe'] == 'sprint') { echo 'style="background: lightskyblue;"';} ?>>
            <div>
                <div class="card-title" style="overflow-wrap: break-word"><b><?php echo $zgodba['naslov']?> (<?php echo $zgodba['statusZgodbe'] ?>)</b></div>
                <div class="card-subtitle text-muted"><b>Odgovorna oseba: <?php echo $zgodba['odgovorni'] ?></b></div>
                <div class="card-subtitle text-muted"><b>Prioriteta: <?php echo $zgodba['prioriteta'] ?> | Poslovna vrednost: <?php echo $zgodba['poslovnaVrednost'] ?></b></div>
            </div>
            <!-- Hidden form to get story ID -->
            <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => $zgodba['idZgodbe'], 'value'=>'', 'label'=>''])?>
            <div>
                <!-- TODO: Hide 'Uredi' if story is marked as complete (to be tested) -->
                <?php if ($zgodba['statusZgodbe'] != 'zakljucen') { ?>
                    <button class="btn btn-sm btn-outline-dark mb-1 float-end"><b>Uredi</b></button>
                <?php } ?>
            </div>
        </div>
        <!-- Card body: Base description and acceptance tests -->
        <div class="card-body">
            <p style="white-space: pre-line"><?php echo $zgodba['besedilo'] ?></p>
            <!-- Sprejemni testi -->
            <ul style="list-style-type:none;">
                <?php $tests = explode(';', $zgodba['sprejemniTesti']);
                foreach ($tests as $test):
                    echo '<li style="color: mediumblue"> # ' .$test . '</li>';
                endforeach;
                ?>
            </ul>
        </div>
        <!-- Card footer: Sprint (if applicable), Time estimate, Time spent -->
        <div class="card-footer">
            <?php if ($zgodba['statusZgodbe'] != 'backlog') { ?>
                <div class="card-subtitle"><b>Sprint:</b> <?php echo $zgodba['sprint'] ?></div>
            <?php } ?>
            <div class="card-subtitle"><b>Časovna zahtevnost: </b> <?php if ($zgodba['casovnaZahtevnost']) echo $zgodba['casovnaZahtevnost'].'h'; else echo '/' ?> </div>
            <div class="card-subtitle"><b>Ure</b> (opravljene/ostale): <b>0h / 18h</b></div>
        </div>
    </card>
<?php } else { ?>

    <!-- Other -->
    <card class="card mb-1">
        <div class="card-header d-flex justify-content-between align-items-center" <?php if ($zgodba['statusZgodbe'] == 'sprint') { echo 'style="background: lightskyblue;"';} ?>>
            <div>
                <div class="card-title" style="overflow-wrap: break-word"><b><?php echo $zgodba['naslov']?> (<?php echo $zgodba['statusZgodbe'] ?>)</b></div>
                <div class="card-subtitle text-muted"><b>Odgovorna oseba: <?php echo $zgodba['odgovorni'] ?></b></div>
                <div class="card-subtitle text-muted"><b>Prioriteta: <?php echo $zgodba['prioriteta'] ?> | Poslovna vrednost: <?php echo $zgodba['poslovnaVrednost'] ?></b></div>
            </div>
            <!-- Hidden form to get story ID -->
            <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => $zgodba['idZgodbe'], 'value'=>'', 'label'=>''])?>
            <div>
                <!-- TODO: Hide 'Uredi' if story is marked as complete (to be tested)-->
                <?php if ($zgodba['statusZgodbe'] != 'zakljucen') { ?>
                    <button class="btn btn-sm btn-outline-dark mb-1 float-end"><b>Uredi</b></button>
                <?php } ?>
                <?php if (strpos(session()->get('roles')[session()->get('projectId')], 'S') > -1 && $zgodba['statusZgodbe'] != 'sprint') { ?>
                    <form action="/sprint/dodajzgodbo" method="post">
                        <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => 'idZgodbe', 'value'=>$zgodba['idZgodbe'], 'label'=>''])?>
                        <button class="btn btn-sm btn-outline-dark" ><b>Dodaj v sprint</b></button>
                    </form>
                <?php } ?>
            </div>

        </div>
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist" id="navtab-<?php echo $zgodba['idZgodbe']?>">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-main-<?php echo $zgodba['idZgodbe']?>" type="button" role="tab">Splošno</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-tasks-<?php echo $zgodba['idZgodbe']?>" type="button" role="tab">Naloge</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content" id="tabContent">
            <div class="tab-pane fade show active" id="nav-main-<?php echo $zgodba['idZgodbe']?>" role="tabpanel">
                <p style="white-space: pre-line"><?php echo $zgodba['besedilo'] ?></p>
                <!-- Sprejemni testi -->
                <ul style="list-style-type:none;">
                    <?php $tests = explode(';', $zgodba['sprejemniTesti']);
                    foreach ($tests as $test):
                        echo '<li style="color: mediumblue"> # ' .$test . '</li>';
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="nav-tasks-<?php echo $zgodba['idZgodbe']?>" role="tabpanel">
                <ul class="list-group">
                    <?php $stevilka=1?>
                    <?php foreach ($zgodba['naloge'] as $naloga):?>
                        <li class="list-group-item" <?php if ($naloga['dokoncan'] == 'D') echo 'style="background-color: rgba(50, 205, 50, 0.5)"' ?> >
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-text"><?php echo $stevilka?>. <?php echo $naloga['opis_naloge'] ?> (<span class="card-text text-primary"><?php echo $naloga['clan_ekipe_name'] ?></span>)</h6>
                                    <span><?php echo 'ocena: '.$naloga['ocena_casa'].'h' ?></span>
                                    <span><?php echo 'delo: '. round($naloga['cas_dela']/ 3600).'h '.round(round($naloga['cas_dela']/60) % 60).'min' ?></span>
                                    <?php if($naloga['clan_ekipe_name']=="Ni dodeljena"): ?>
                                        <button class="btn btn-sm btn-success" onclick="sprejmiNalogo(<?php echo $naloga['id'] ?>)">Sprejmi Nalogo</button>
                                    <?php endif?>
                                </div>
                                <?php $stevilka++?>
                                <!-- TODO: make this work -->
                                <button type="button" class="btn btn-sm btn-outline-dark float-end" data-bs-toggle="modal" data-bs-target="#editTask-<?php echo $naloga['id']?>">Uredi</button>
                            </div>
                        </li>
                    <?php endforeach;?>

                    <!-- TODO: Add modal with task information onclick. -->
                    <!-- TODO: Add edit task button. (includes delete and assign) -->
                    <!-- TODO: Add an accept/reject task button. -->
                    <?php if ($zgodba['statusZgodbe'] != 'zakljucen' && $zgodba['statusZgodbe'] === 'sprint') { ?>
                        <!-- hide if the story is marked complete -->
                        <li id="addTask" class="list-group-item" data-bs-toggle="modal" data-bs-target="#addTask-<?php echo $zgodba['idZgodbe'] ?>">
                            <b>(+) Dodaj nalogo</b>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="card-footer">
            <?php if ($zgodba['statusZgodbe'] != 'backlog') { ?>
                <div class="card-subtitle"><b>Sprint:</b> <?php echo $zgodba['sprint'] ?></div>
            <?php } ?>
            <?php if(strpos(session()->get('roles')[session()->get('projectId')], 'S') > -1) { ?>
                <b>Časovna zahtevnost: </b> <?php if ($zgodba['casovnaZahtevnost']) echo $zgodba['casovnaZahtevnost'].'h'; else echo '/' ?>
                <a class="card-subtitle" data-bs-toggle="modal" data-bs-target="#editTime-<?php echo $zgodba['idZgodbe']?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>
            <?php } else {?>
                <div class="card-subtitle"><b>Časovna zahtevnost: </b> <?php if ($zgodba['casovnaZahtevnost']) echo $zgodba['casovnaZahtevnost'].'h'; else echo '/' ?> </div>
            <?php } ?>
            <div class="card-subtitle"><b>Ure</b> (opravljene/ostale): <b><?php echo $zgodba['deloSkupaj'] ?> / <?php echo $zgodba['ocenaSkupaj'].'h' ?></b></div>
            <?php if ($kraj=="sprint"):?>
            <?php if ($jeVodja):?>
            <?php if ($zgodba['prpravlenNaSprejetje']):?>
                <button class="btn btn-sm btn-success" onclick="sprejmiZgodbo(<?php echo $zgodba['idZgodbe']?>)">Sprejmi Zgodbo</button>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#zavrniModal-<?php echo $zgodba['idZgodbe']?>">Zavrni Zgodbo</button>
            <?php endif ?>
            <?php endif ?>
            <?php endif ?>
            <!-- TODO: Reject and accept buttons that can only be seen in 'My tasks' when the story has been assigned but not accepted/rejected -->
        </div>
        <!-- TODO: only show the two buttons if we're in 'My tasks', the story has been assigned to the user and has not yet been accepted -->
        <?php if (strpos(current_url(), 'MyTasks') > -1) { ?>
            <div class="card-footer">
                <div class="float-end">
                    <a role="button" class="btn btn-sm btn-success" href="#">Sprejmi</a>
                    <a role="button" class="btn btn-sm btn-danger" href="#">Zavrni</a>
                </div>
            </div>
        <?php } ?>
    </card>
<?php } ?>

<script>
        var i=1;
        function sprejmiNalogo(idNaloge) {
            window.location.href = "<?php echo site_url('SprejmiNalogo/');?>" + idNaloge ;
        }

        function sprejmiZgodbo(idZgodbe) {
            window.location.href = "<?php echo site_url('SprejmiZgodbo/');?>" + idZgodbe ;
        }
</script>