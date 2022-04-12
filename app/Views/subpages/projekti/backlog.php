<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container project-box">

    <div class="row">
        <div class="col-lg-6 card card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Nerealizirane zgodbe</h4>
                <button class="btn btn-outline-light gradient-custom-2">Nova zgodba</button>
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
            <?php foreach ($zgodbe as $zgodba): ?>
            <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodba['naslov'], 'statusZgodbe'=>$zgodba['statusZgodbe'], 'prioriteta'=>$zgodba['prioriteta'], 'poslovnaVrednost'=>$zgodba['poslovnaVrednost'], 'idZgodbe'=>$zgodba['idZgodbe'],
                     'besedilo'=>$zgodba['besedilo'], 'sprejemniTesti'=>$zgodba['sprejemniTesti'],
                     'casovnaZahtevnost'=>$zgodba['casovnaZahtevnost']]) ?>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-6 card card-body">
            <?php foreach ($zgodbe as $zgodba): ?>
                <?php echo view('partials/storyCard',
                    ['naslov'=>$zgodba['naslov'], 'statusZgodbe'=>$zgodba['statusZgodbe'], 'prioriteta'=>$zgodba['prioriteta'], 'poslovnaVrednost'=>$zgodba['poslovnaVrednost'], 'idZgodbe'=>$zgodba['idZgodbe'],
                     'besedilo'=>$zgodba['besedilo'], 'sprejemniTesti'=>$zgodba['sprejemniTesti'],
                     'casovnaZahtevnost'=>$zgodba['casovnaZahtevnost']]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


