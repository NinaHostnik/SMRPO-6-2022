<div class="modal fade" id="addTask-<?php echo $idZgodbe?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: lightskyblue">
                <h5 class="modal-title">Dodaj nalogo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/Pbacklog/dodajzgodbo" method="post">
                    <?php echo view('partials/formInput', ['type'=>'hidden', 'id'=>'idZgodbe', 'value'=>$idZgodbe, 'label'=>'Naloga']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskName', 'value'=>'', 'label'=>'Naloga']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskTime', 'value'=>'', 'label'=>'Časovna zahtevnost']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskMember', 'value'=>'', 'label'=>'Zadolženi član']) ?>
                    <!-- TODO: Add select to assign a team member -->
                    <?php echo view('partials/formButton', ['name'=>'Dodaj nalogo']) ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStory-<?php echo $idZgodbe?>">
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

<card class="card mb-1">
    <!-- TODO: Stroies that have been added to an active sprint have a blue header -->
    <div class="card-header d-flex justify-content-between align-items-center" style="background: lightskyblue">
        <div>
            <div class="card-title"><b><?php echo $naslov?> (<?php echo $statusZgodbe ?>)</b></div>
            <div class="card-subtitle text-muted"><b>Odgovorna oseba: <?php echo session()->get('username') ?></b></div>
            <div class="card-subtitle text-muted"><b>Prioriteta: <?php echo $prioriteta ?> | Poslovna vrednost: <?php echo $poslovnaVrednost ?></b></div>
        </div>
        <!-- Hidden form to get story ID -->
        <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => $idZgodbe, 'value'=>'', 'label'=>''])?>
        <div>
            <!-- TODO: Hide 'Uredi' if story is marked as complete -->
            <button class="btn btn-sm btn-outline-dark mb-1 float-end"><b>Uredi</b></button>
            <?php if (strpos(session()->get('roles')[session()->get('projectId')], 'S') > -1) { ?>
            <form action="/sprint/dodajzgodbo" method="post">
                <button class="btn btn-sm btn-outline-dark" ><b>Dodaj v sprint</b></button>
            </form>
            <?php } ?>
        </div>

    </div>
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist" id="navtab-<?php echo $idZgodbe?>">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-main-<?php echo $idZgodbe?>" type="button" role="tab">Splošno</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-tasks-<?php echo $idZgodbe?>" type="button" role="tab">Naloge</a>
            </li>
        </ul>
    </div>
    <div class="card-body tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="nav-main-<?php echo $idZgodbe?>" role="tabpanel">
            <p><?php echo $besedilo ?></p>
            <ul style="list-style-type:none;">
            <!-- Sprejemni testi -->
                <!-- TODO: Write them out as an array (Waiting on Beni) -->
                <li style="color: mediumblue"># <?php echo $sprejemniTesti?></li>
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-tasks-<?php echo $idZgodbe?>" role="tabpanel">
            <ul class="list-group">
                <!-- TODO: Write out current tasks. -->
                <!-- TODO: Add modal with task information onclick. -->
                <!-- TODO: Write designated member. -->
                <!-- TODO: Add edit task button. (includes delete and assign) -->
                <!-- TODO: Add an accept/reject task button. -->
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-text">Task 1</h6>
                            <p class="card-text text-primary">Some name</p>
                        </div>
                        <button class="btn btn-sm btn-outline-dark float-end">Uredi</button>
                    </div>
                </li>
                <!-- TODO: 'Dodaj nalogo' opens a modal form for adding a task when clicked on -->
                <li id="addTask" class="list-group-item" data-bs-toggle="modal" data-bs-target="#addTask-<?php echo $idZgodbe ?>">
                    <b>(+) Dodaj nalogo</b>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-footer">
        <div class="card-subtitle"><b>Sprint: </b></div>
        <div class="card-subtitle"><b>Časovna zahtevnost: </b> <?php echo $casovnaZahtevnost ?> </div>
        <div class="card-subtitle"><b>Ure</b> (opravljene/ostale): <b>0h / 18h</b></div>

        <!-- TODO: Reject and accept buttons that can only be seen in 'My tasks' when the story has been assigned but not accepted/rejected -->
    </div>
</card>


