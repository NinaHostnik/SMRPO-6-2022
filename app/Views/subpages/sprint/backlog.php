<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container project-box">

    <h1>Sprint: <?php echo $sprint['zacetniDatum'].' - '.$sprint['koncniDatum'].'('.$sprint['trenutniStatus'].')' ?></h1>
    <br>
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
            <?php foreach ($zgodbe as $zgodba): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodba['naslov'], 'statusZgodbe'=>$zgodba['statusZgodbe'], 'prioriteta'=>$zgodba['prioriteta'], 'poslovnaVrednost'=>$zgodba['poslovnaVrednost'], 'idZgodbe'=>$zgodba['idZgodbe'],
                        'besedilo'=>$zgodba['besedilo'], 'sprejemniTesti'=>$zgodba['sprejemniTesti'],
                        'casovnaZahtevnost'=>$zgodba['casovnaZahtevnost'],'naloge'=>$zgodba['naloge'] ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>





<?= $this->endSection() ?>


