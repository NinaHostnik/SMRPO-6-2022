<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container content-box">
    <div class="row">
        <div class="col-4">
            <a href="/admin/createUser/" class="btn btn-info" role="button">Ustvari uporabnika</a>
        </div>
        <div class="col-4">
            <a href="/profile" class="btn btn-info" role="button">Profil</a>
        </div>
    </div>
    <div class="col-4">
        <a href="/projekti" class="btn btn-info" role="button">Tvoji projekti</a>
    </div>
</div>
<?= $this->endSection() ?>