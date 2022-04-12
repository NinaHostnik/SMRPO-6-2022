<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
    <div class="container project-box">
        <?php echo view('partials/storyCard')?>
    </div>

<?= $this->endSection() ?>