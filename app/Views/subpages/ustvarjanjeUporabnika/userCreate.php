<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="form-control" action="/admin/createUser" method="post">
        <h5>Dodaj uporabnika</h5>
        <hr>
        <!-- Name input -->
        <?php echo view("partials/formInput",['label'=>'Uporabniško ime', "id"=>"username", 'type'=>'text', 'value'=>''])?>
        <!-- Permissions input -->
        <div class="form-group mb-3">
            <label for="permissions">Dovoljenja</label>
            <select class="form-control" name="permissions" id="permissions">
                <option value="0">Administrator</option>
                <option value="1">Uporabnik</option>
            </select>
        </div>        <!-- Password input -->
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