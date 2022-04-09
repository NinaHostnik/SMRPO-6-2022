<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container content-box">

<?php foreach ($naloge as $naloga): ?>

<div>
    <h2><?php echo $naloga['naslov']?></h2>
    <p><?php echo $naloga['besedilo'] ?></p>
    <p><?php echo $naloga['prioriteta'] ?></p>
    <p><?php echo $naloga['poslovnaVrednost'] ?></p>
    <p><?php echo $naloga['statusZgodbe'] ?></p>
    <p><?php echo $naloga['casovnaZahtevnost'] ?></p>
    <p><?php echo $naloga['sprejemniTesti'] ?></p>
    <hr>


</div>

<?php endforeach; ?>
</div>





<?= $this->endSection() ?>


