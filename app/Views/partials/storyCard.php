
<card class="card mb-1">
    <div class="card-header d-flex justify-content-between align-items-center" style="background: lightskyblue">
        <div>
            <div class="card-title"><b><?php echo $naslov?> (<?php echo $statusZgodbe ?>)</b></div>
            <div class="card-subtitle text-muted"><b>Odgovorna oseba: <?php echo session()->get('username') ?></b></div>
            <div class="card-subtitle text-muted"><b>Vloga osebe: <?php echo session()->get('roles')[session()->get('projectId')] ?></b></div>
            <div class="card-subtitle text-muted"><b>Prioriteta: <?php echo $prioriteta ?> | Poslovna vrednost: <?php echo $poslovnaVrednost ?></b></div>
        </div>
        <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => $idZgodbe, 'value'=>'', 'label'=>''])?>
        <div>
            <button class="btn btn-sm btn-outline-dark"><b>Uredi</b></button>
            <form action="/sprint/dodajzgodbo" method="post">
                <button class="btn btn-sm btn-outline-dark" ><b>Dodaj v sprint</b></button>
            </form>
        </div>

    </div>
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist" id="navtab">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-main" type="button" role="tab">Splošno</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-tasks" type="button" role="tab">Naloge</a>
            </li>
        </ul>
    </div>
    <div class="card-body tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="nav-main" role="tabpanel">
            <p><?php echo $besedilo ?></p>
            <ul style="list-style-type:none;">
            <!-- Sprejemni testi -->
                <li style="color: mediumblue"># <?php echo $sprejemniTesti?></li>
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-tasks" role="tabpanel">
            <ul class="list-group">
                <li class="list-group-item">Task 1</li>
                <li class="list-group-item">Task 2</li>
                <li class="list-group-item"><b>Dodaj nalogo</b></li>
            </ul>
        </div>
    </div>
    <div class="card-footer">
        <div class="card-subtitle"><b>Sprint: </b></div>
        <div class="card-subtitle"><b>Časovna zahtevnost: </b> <?php echo $casovnaZahtevnost ?> </div>
        <div class="card-subtitle"><b>Ure</b> (opravljene/ostale): <b>0h / 18h</b></div>
    </div>
</card>