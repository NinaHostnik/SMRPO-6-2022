<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
<div class="container project-box">

    <div class="row">
        <div class="col-lg-6 card card-header">
            <h4>Sprejete naloge</h4>
        </div>
        <div class="col-lg-6 card card-header">
            <h4>Dodeljene naloge</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 card card-body">
            <!-- TODO: Write out cards that have been assigned to user and accepted -->
            <?php foreach ($zgodbe as $zgodba):
                echo view('partials/taskCard', ['zgodba' => $zgodba, 'naloge' => $zgodba['naloge'], 'odgovorni' => $zgodba['odgovorni']]);
            endforeach; ?>


        </div>
        <div class="col-lg-6 card card-body">
            <!-- TODO: Write out cards that have been assigned to user and are pending response -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>