<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container content-box">
<br>
<div class="container d-flex flex-row">
    <h4 class="me-4">Moji projekti</h4>
    <?php if (session()->get('permissions') == 0) { ?>
    <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href="/dodajanjeProjekta">Dodaj projekt</a>
    <?php } ?>
</div>
<br>
<?php
    foreach ($projekti as $projekt) {

     echo view("partials/projectCard", ['project_name' => $projekt['ime'], "project_desc" => $projekt['opis'],"project_id" => $projekt['id']]);

    }
?>

</div>

<?= $this->endSection() ?>


