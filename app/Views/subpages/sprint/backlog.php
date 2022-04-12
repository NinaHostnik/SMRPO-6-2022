<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container project-box">

    <h1>Sprint: <?php echo $sprint['zacetniDatum'].' - '.$sprint['koncniDatum'].'('.$sprint['trenutniStatus'].')' ?></h1>
    <br>
    <?php foreach ($zgodbe as $zgodba): ?>

        <div>
            <h2><?php echo $zgodba['naslov'] ?></h2>
            <p><?php echo $zgodba['besedilo'] ?></p>
            <p><?php echo $zgodba['prioriteta'] ?></p>
            <p><?php echo $zgodba['poslovnaVrednost'] ?></p>
            <p><?php echo $zgodba['statusZgodbe'] ?></p>
            <p><?php echo $zgodba['casovnaZahtevnost'] ?></p>
            <p><?php echo $zgodba['sprejemniTesti'] ?></p>
            <hr>

        </div>

    <?php endforeach ?>
</div>





<?= $this->endSection() ?>


