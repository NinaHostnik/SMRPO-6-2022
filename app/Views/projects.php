<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container">

<h1>Projekti</h1>
Projekti, ki se trenutno izvajajo:

<?php
foreach ($projekti as $projekt) {

 echo view("partials/projectCard", ['project_name' => $projekt['ime'], "project_desc" => $projekt['opis']]);

}
?>

</div>


<?= $this->endSection() ?>


