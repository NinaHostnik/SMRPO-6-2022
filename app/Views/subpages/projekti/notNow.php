<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<?php if (session()->has('errordata')):?>
    <script>
        $(document).ready(function(){
            $("#addTask-<?php echo session()->getFlashdata('idZgodbe')?>").modal('show');
        });
    </script>
<?php endif; ?>

<div class="container project-box">
    <div class="row card card-header">
        <h4>Prihodnje funkcionalnosti</h4>
    </div>


    <div class="row card card-body">
        <?php foreach ($zgodbe as $zgodba): ?>
            <?php echo view('partials/storyCard', ['zgodba'=>$zgodba, 'uporabniki'=>$uporabniki]) ?>
        <?php endforeach; ?>
    </div>
</div>



<?= $this->endSection() ?>
