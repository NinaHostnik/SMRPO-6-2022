<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>
<div class="container">
    <form class="form-control" action="UserController::createUser" method="post">
        <h5><?php echo $header ?></h5>
        <hr>
        <!-- Name input -->
        <?php echo view('partials/formInput', ['type'=>$usernameInput['type'], 'id'=>$usernameInput['id'], 'label'=>$usernameInput['label']])?>
        <!-- Permissions input -->
        <?php echo view('partials/formInput', ['type'=>$permissionsInput['type'], 'id'=>$permissionsInput['id'], 'label'=>$permissionsInput['label']])?>
        <!-- Password input -->
        <?php echo view('partials/formInput', ['type'=>$passwordInput['type'], 'id'=>$passwordInput['id'], 'label'=>$passwordInput['label']]) ?>
        <!-- Submit button -->
        <?php view('partials/formButton', ['name'=> $name]) ?>
    </form>

    <?php
    if (isset($validation)){
        echo $validation->listErrors();
    }
    ?>

</div>
<?= $this->endSection() ?>