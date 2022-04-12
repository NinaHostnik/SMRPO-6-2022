<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container content-box" style="width: 100%">
    <br>
    <br>
    <br>
    <div class="container d-flex flex-row mb-2">
        <h4 class="me-4">Ime projekta</h4>
        <?php if (session()->get('permissions') == 0) { ?>
            <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href=<?php echo "/dodajanjeSprintov/".$id; ?>>Dodaj sprint</a>
        <?php } ?>
            <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href=<?php echo "/dodajanjeUporabniskihZgodb/".$id; ?>>Dodaj zgodbo</a>
    </div>

<?= $this->endSection() ?>
