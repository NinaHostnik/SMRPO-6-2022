<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<?php if (session()->has('errordata')):?>
    <script>
        $(document).ready(function(){
            $("#addTask-<?php echo session()->getFlashdata('idZgodbe')?>").modal('show');
        });
    </script>
<?php endif; ?>

<div class="container project-box">
    <div class="row">
        <div class="col-lg-6 card card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Nerealizirane zgodbe</h4>
                <?php if (strpos(session()->get('roles')[session()->get('projectId')], 'V') > -1 || strpos(session()->get('roles')[session()->get('projectId')], 'S') > -1) { ?>
                    <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href="/dodajanjeUporabniskihZgodb">Nova zgodba</a>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6 card card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Realizirane zgodbe</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 card card-body">
            <!-- TODO: Write only stories that are not marked as 'done' -->
            <?php foreach ($zgodbe as $zgodba): ?>
            <?php if ($zgodba['statusZgodbe'] != 'zakljucen') { ?>
            <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodba['naslov'], 'statusZgodbe'=>$zgodba['statusZgodbe'], 'prioriteta'=>$zgodba['prioriteta'], 'poslovnaVrednost'=>$zgodba['poslovnaVrednost'], 'idZgodbe'=>$zgodba['idZgodbe'],
                     'besedilo'=>$zgodba['besedilo'], 'sprejemniTesti'=>$zgodba['sprejemniTesti'], 'odgovorni' => '/',
                     'casovnaZahtevnost'=>$zgodba['casovnaZahtevnost'], 'naloge'=>$zgodba['naloge'], 'uporabniki'=>$uporabniki]) ?>
            <?php } ?>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-6 card card-body">
            <?php foreach ($zgodbe as $zgodba): ?>
                <?php if ($zgodba['statusZgodbe'] == 'zakljucen') { ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodba['naslov'], 'statusZgodbe'=>$zgodba['statusZgodbe'], 'prioriteta'=>$zgodba['prioriteta'], 'poslovnaVrednost'=>$zgodba['poslovnaVrednost'], 'idZgodbe'=>$zgodba['idZgodbe'],
                     'besedilo'=>$zgodba['besedilo'], 'sprejemniTesti'=>$zgodba['sprejemniTesti'], 'odgovorni' => '/',
                     'casovnaZahtevnost'=>$zgodba['casovnaZahtevnost'], 'naloge'=>$zgodba['naloge'],'uporabniki'=>$uporabniki ]) ?>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>



<?= $this->endSection() ?>




