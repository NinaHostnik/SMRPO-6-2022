<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container content-box">

<h1>Projekti</h1>
Projekti, ki se trenutno izvajajo:
<hr>

<?php

foreach ($projekti as $projekt) {

 echo view("partials/projectCard", ['project_name' => $projekt['ime'], "project_desc" => $projekt['opis'],"project_id" => $projekt['id']]);

}
echo session()->get('roles')[14];
?>
    <hr>
    <a href="/dodajanjeProjekta" class="btn btn-info" role="button">Dodaj projekt</a>

</div>





<?= $this->endSection() ?>


