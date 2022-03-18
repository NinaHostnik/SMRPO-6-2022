<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="form-control" action="/admin/createUser" method="post">
        <h5>Dodaj uporabnika</h5>
        <hr>
        <!-- Name input -->
        <?php echo view("partials/formInput",['label'=>'Uporabniško ime', "id"=>"username", 'type'=>'text', 'value'=>''])?>
        <!-- Permissions input -->
        <?php echo view("partials/formInput",['label'=>'Dovoljenja', "id"=>"permissions", 'type'=>'text', 'value'=>''])?>
        <!-- Password input -->
        <?php echo view("partials/password",['label'=>'Geslo', "id"=>"password", 'type'=>'password','value'=>''])?>
        <!-- Submit button -->
        <?php echo view('partials/formButton', ['name'=>'Dodaj Uporabnika']) ?>
    </form>

    <?php
    if (isset($validation)){
        echo $validation->listErrors();
    }
    ?>

</div>
<?= $this->endSection() ?>