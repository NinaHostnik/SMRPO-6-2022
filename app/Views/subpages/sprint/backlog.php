<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container project-box">

    <div class="row text-center">
        <div class="col-lg-12 card card-header">
            <h4>Sprint: <?php echo $sprint['zacetniDatum'].' - '.$sprint['koncniDatum'].'('.$sprint['trenutniStatus'].')' ?></h4>
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
            <?php foreach ($zgodbe as $zgodba): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodba['naslov'], 'statusZgodbe'=>$zgodba['statusZgodbe'], 'prioriteta'=>$zgodba['prioriteta'], 'poslovnaVrednost'=>$zgodba['poslovnaVrednost'], 'idZgodbe'=>$zgodba['idZgodbe'],
                        'besedilo'=>$zgodba['besedilo'], 'sprejemniTesti'=>$zgodba['sprejemniTesti'],
                        'casovnaZahtevnost'=>$zgodba['casovnaZahtevnost'],'naloge'=>$zgodba['naloge'] ]) ?>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-6 card card-body">
            <!-- TODO: Show stories that are in the sprint and have all tasks complete -->
        </div>
    </div>
</div>





<?= $this->endSection() ?>


