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
            <?php foreach ($zgodbeInProgress as $zgodbaP): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodbaP['naslov'], 'statusZgodbe'=>$zgodbaP['statusZgodbe'], 'prioriteta'=>$zgodbaP['prioriteta'], 'poslovnaVrednost'=>$zgodbaP['poslovnaVrednost'], 'idZgodbe'=>$zgodbaP['idZgodbe'],
                        'besedilo'=>$zgodbaP['besedilo'], 'sprejemniTesti'=>$zgodbaP['sprejemniTesti'],
                        'casovnaZahtevnost'=>$zgodbaP['casovnaZahtevnost'],'naloge'=>$zgodbaP['naloge'],'uporabniki'=>$uporabniki ]) ?>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-6 card card-body">
            <?php foreach ($zgodbeAccReady as $zgodbaA): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodbaA['naslov'], 'statusZgodbe'=>$zgodbaA['statusZgodbe'], 'prioriteta'=>$zgodbaA['prioriteta'], 'poslovnaVrednost'=>$zgodbaA['poslovnaVrednost'], 'idZgodbe'=>$zgodbaA['idZgodbe'],
                        'besedilo'=>$zgodbaA['besedilo'], 'sprejemniTesti'=>$zgodbaA['sprejemniTesti'],
                        'casovnaZahtevnost'=>$zgodbaA['casovnaZahtevnost'],'naloge'=>$zgodbaA['naloge'],'uporabniki'=>$uporabniki ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>





<?= $this->endSection() ?>


