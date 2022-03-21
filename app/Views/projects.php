<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container">

<h1>Projekti</h1>
Projekti, ki se trenutno izvajajo:
<hr>
<?php
foreach ($projekti as $projekt) {

 echo view("partials/projectCard", ['project_name' => $projekt['ime'], "project_desc" => $projekt['opis'],"project_id" => $projekt['id']]);

}
?>
    <hr>
    <a href="/dodajanjeProjekta" class="btn btn-info" role="button">Dodaj projekt</a>
</div>





<?= $this->endSection() ?>


