<div class="modal fade" id="storyInfo-<?php echo $zgodba['idZgodbe']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $zgodba['naslov']?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6><b>Odgovorna oseba: </b> <?php echo $zgodba['odgovorni'] ?></h6>
                <h6><b>Status zgodbe: </b> <?php echo $zgodba['statusZgodbe']?></h6>
                <h6><b>Prioriteta: </b><?php echo $zgodba['prioriteta']?> <b> | Poslovna vrednost: </b> <?php echo $zgodba['poslovnaVrednost'] ?></h6>
                <hr>
                <p><?php echo $zgodba['besedilo'] ?></p>
                <p>
                    <?php $tests = explode(';', $zgodba['sprejemniTesti']);
                    foreach ($tests as $test):
                        echo '<li style="color: mediumblue; list-style-type: none;"> # ' .$test . '</li>';
                    endforeach; ?>
                </p>
                <hr>
                <h6><b>Časovna zahtevnost: </b> <?php if ($zgodba['casovnaZahtevnost']) echo $zgodba['casovnaZahtevnost']; else echo '/' ?> </h6>
                <h6><b>Ure</b> (opravljene/ostale): <b>0h / 18h</b></h6>
            </div>
        </div>
    </div>
</div>

<card class="card mb-1">
    <!-- Card header: Story title and status, Designated developer, Priority, Business value -->
    <div class="card-header d-flex justify-content-between align-items-center" <?php if ($zgodba['statusZgodbe'] == 'sprint') { echo 'style="background: lightskyblue;"';} ?>>
        <div>
            <h5 class="card-title" style="overflow-wrap: break-word"><b><?php echo $zgodba['naslov']?> (<?php echo $zgodba['statusZgodbe'] ?>)</b></h5>
            <div class="card-subtitle"><b>Odgovorna oseba: </b><?php echo $zgodba['odgovorni']?></div>
            <a class="card-subtitle text-muted" data-bs-toggle="modal" data-bs-target="#storyInfo-<?php echo $zgodba['idZgodbe']?>">Poglej podrobnosti</a>
        </div>
    </div>
    <!-- Card body: Base description and acceptance tests -->
    <div class="card-body">
    <?php $stevilka=1?>
        <?php foreach ($naloge as $naloga): ?>
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title"><b><?php echo($stevilka)?>. <?php echo $naloga['opis_naloge'] ?></b></div>
                        <?php $stevilka++?>
                        <!-- TODO: Beni's problem TODO: da se gumbi pojavjo sam ce je zgodba nesprejeta pa da se lah zavrne ce je to uporabnik kermu je dodeljena-->
                        <div class="card-subtitle"><?php echo session()->get('username') ?></div>
                    </div>
                    <?php if($naloga['dokoncan']!="D"): ?>
                    <div>
                        <?php if($naloga['potrjen']== 'N') :?> 
                            <button class="btn btn-sm btn-success" onclick="sprejmiNalogo(<?php echo $naloga['id'] ?>)">Sprejmi Nalogo</button>
                            <button class="btn btn-sm btn-danger" onclick="zavrniNalogo(<?php echo $naloga['id'] ?>)">Zavrni Nalogo</button>
                        <?php else : ?>
                            <button class="btn btn-sm btn-success" onclick="zakljuciNalogo(<?php echo $naloga['id'] ?>)">Zaključi Nalogo</button>
                            <button class="btn btn-sm btn-danger" onclick="zavrniNalogo(<?php echo $naloga['id'] ?>)">Zavrni Nalogo</button>
                        <?php endif; ?>
                    <!-- end of Beni's problem -->
                    <?php if ($zgodba['idUporabnika'] && $zgodba['statusZgodbe'] != 'zakljucen') : ?>
                            <?php if ($naloga['aktiven'] == 'N') : ?>
                                <button class="btn btn-sm btn-success" onclick="spremeniStatus('<?php echo $naloga['aktiven'] ?>', <?php echo $naloga['id'] ?>)">Začni z delom</button>
                            <?php else : ?>
                                <button class="btn btn-sm btn-danger" onclick="spremeniStatus('<?php echo $naloga['aktiven'] ?>', <?php echo $naloga['id'] ?>)">Končaj z delom</button>
                            <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <script>
        function spremeniStatus(status, taskId) {
            window.location.href = "<?php echo site_url('SpremeniStatus/');?>" + status + '/' + taskId;
        }

        function sprejmiNalogo(idNaloge) {
            window.location.href = "<?php echo site_url('SprejmiNalogo/');?>" + idNaloge ;
        }

        function zavrniNalogo(idNaloge) {
            window.location.href = "<?php echo site_url('ZavrniNalogo/');?>" + idNaloge;
        }
        function zakljuciNalogo(idNaloge) {
            window.location.href = "<?php echo site_url('zakljuciNalogo/');?>" + idNaloge;
        }
    </script>
</card>