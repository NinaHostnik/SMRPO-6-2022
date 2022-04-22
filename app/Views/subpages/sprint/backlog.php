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
        <div class="col-lg-12 card card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Sprint: <?php echo $sprint['zacetniDatum'].' - '.$sprint['koncniDatum'].'('.$sprint['trenutniStatus'].')' ?></h4>
                <?php if (strpos(session()->get('roles')[session()->get('projectId')], 'S') > -1) { ?>
                    <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href="/dodajanjeSprintov">Nov sprint</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 card card-header">
            <h4>V teku</h4>
        </div>
        <div class="col-lg-6 card card-header">
            <h4>Pripravljeni na sprejem</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 card card-body">
            <?php foreach ($zgodbeInProgress as $zgodbaP): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodbaP['naslov'], 'statusZgodbe'=>$zgodbaP['statusZgodbe'], 'prioriteta'=>$zgodbaP['prioriteta'], 'poslovnaVrednost'=>$zgodbaP['poslovnaVrednost'], 'idZgodbe'=>$zgodbaP['idZgodbe'],
                        'besedilo'=>$zgodbaP['besedilo'], 'sprejemniTesti'=>$zgodbaP['sprejemniTesti'], 'odgovorni' => $zgodbaP['odgovorni'],
                        'casovnaZahtevnost'=>$zgodbaP['casovnaZahtevnost'],'naloge'=>$zgodbaP['naloge'],'uporabniki'=>$uporabniki ]) ?>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-6 card card-body">
            <?php foreach ($zgodbeAccReady as $zgodbaA): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodbaA['naslov'], 'statusZgodbe'=>$zgodbaA['statusZgodbe'], 'prioriteta'=>$zgodbaA['prioriteta'], 'poslovnaVrednost'=>$zgodbaA['poslovnaVrednost'], 'idZgodbe'=>$zgodbaA['idZgodbe'],
                        'besedilo'=>$zgodbaA['besedilo'], 'sprejemniTesti'=>$zgodbaA['sprejemniTesti'], 'odgovorni' => $zgodbaA['odgovorni'],
                        'casovnaZahtevnost'=>$zgodbaA['casovnaZahtevnost'],'naloge'=>$zgodbaA['naloge'],'uporabniki'=>$uporabniki ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>





<?= $this->endSection() ?>


