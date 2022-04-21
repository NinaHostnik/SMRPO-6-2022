<div class="modal fade" id="storyInfo-<?php echo $idZgodbe?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Naslov zgodbe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h1>Hi!</h1>
            </div>
        </div>
    </div>
</div>

<card class="card mb-1">
    <!-- Card header: Story title and status, Designated developer, Priority, Business value -->
    <div class="card-header d-flex justify-content-between align-items-center" <?php if ($statusZgodbe == 'sprint') { echo 'style="background: lightskyblue;"';} ?>>
        <div>
            <h5 class="card-title" style="overflow-wrap: break-word"><b><?php echo $naslovZgodbe?> (<?php echo $statusZgodbe ?>)</b></h5>
            <div class="card-subtitle"><b>Odgovorna oseba: </b><?php echo $odgovorniZgodba?></div>
            <a class="card-subtitle text-muted" data-bs-toggle="modal" data-bs-target="#storyInfo-<?php echo $idZgodbe?>">Poglej podrobnosti</a>
        </div>
    </div>
    <!-- Card body: Base description and acceptance tests -->
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="card-title"><b><?php echo $opis ?></b></div>
                <div class="card-subtitle"><?php echo $odgovorni ?></div>
            </div>
            <div>
                <button class="btn btn-outline-dark">Začni z delom</button>
                <button class="btn btn-danger">Sprosti nalogo</button>
            </div>
        </div>
        <div></div>
    </div>

    <div class="card-footer">

    </div>
</card>