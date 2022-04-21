<div class="modal fade" id="storyInfo-<?php echo $zgodba['idZgodbe']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $zgodba['naslov']?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6><b>Odgovorna oseba: </b> <?php echo $odgovorni ?></h6>
                <h6><b>Prioriteta: </b><?php echo $zgodba['prioriteta']?> <b> | Poslovna vrednost: </b> <?php echo $zgodba['poslovnaVrednost'] ?></h6>
            </div>
        </div>
    </div>
</div>

<card class="card mb-1">
    <!-- Card header: Story title and status, Designated developer, Priority, Business value -->
    <div class="card-header d-flex justify-content-between align-items-center" <?php if ($zgodba['statusZgodbe'] == 'sprint') { echo 'style="background: lightskyblue;"';} ?>>
        <div>
            <h5 class="card-title" style="overflow-wrap: break-word"><b><?php echo $zgodba['naslov']?> (<?php echo $zgodba['statusZgodbe'] ?>)</b></h5>
            <div class="card-subtitle"><b>Odgovorna oseba: </b><?php echo $odgovorni?></div>
            <a class="card-subtitle text-muted" data-bs-toggle="modal" data-bs-target="#storyInfo-<?php echo $zgodba['idZgodbe']?>">Poglej podrobnosti</a>
        </div>
    </div>
    <!-- Card body: Base description and acceptance tests -->
    <div class="card-body">
        <?php foreach ($naloge as $naloga): ?>
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title"><b><?php echo $naloga['opis_naloge'] ?></b></div>
                        <!-- TODO: Beni's problem -->
                        <div class="card-subtitle"><?php echo session()->get('username') ?> <a class="card-title">(Sprosti nalogo)</a></div>
                    </div>
                    <div>
                        <!-- TODO: if the subtask is marked 'active' show currently commented button -->
                        <button class="btn btn-sm btn-success">Začni z delom</button>
                        <!--<button class="btn btn-sm btn-danger">Končaj z delom</button>-->
                    </div>
                </div>
                <!-- TODO: only show when subtask is 'active' -->
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-text"><b>Vpisovanje ur</b></div>
                    <div>
                        <input type="number" min="1" id="vpisiUre">
                        <button class="btn btn-sm btn-outline-dark">Vpiši ure</button>
                    </div>
                </div>
                <!-- END TODO -->
            </div>
        <?php endforeach; ?>

    </div>
</card>