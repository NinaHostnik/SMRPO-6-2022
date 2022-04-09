<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container content-box">

<?php foreach ($zgodbe as $zgodba): ?>

<div>
    <h2><?php echo $zgodba['naslov']?></h2>
    <p><?php echo $zgodba['besedilo'] ?></p>
    <p><?php echo $zgodba['prioriteta'] ?></p>
    <p><?php echo $zgodba['poslovnaVrednost'] ?></p>
    <p><?php echo $zgodba['statusZgodbe'] ?></p>
    <p><?php echo $zgodba['casovnaZahtevnost'] ?></p>
    <p><?php echo $zgodba['sprejemniTesti'] ?></p>
    <hr>
    <form action="/sprint/dodajzgodbo" method="post">
        <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => $zgodba['idZgodbe'], 'value'=>'', 'label'=>''])?>
        <?php echo view('partials/formButton', ['name'=>'Dodaj v sprint'])?>
    </form>


</div>

<?php endforeach; ?>
</div>





<?= $this->endSection() ?>


