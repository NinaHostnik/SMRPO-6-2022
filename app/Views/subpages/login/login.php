<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="form-control" action="/" method="post">
        <h5><?php echo $heading ?></h5>
        <hr>
        <!-- Username input -->
        <?php echo view('partials/formInput', ['type'=>$usernameInput['type'], 'id'=>$usernameInput['id'], 'label'=>$usernameInput['label']]) ?>
        <!-- Password input -->
        <?php echo view('partials/formInput', ['type'=>$usernameInput['type'], 'id'=>$usernameInput['id'], 'label'=>$usernameInput['label']]) ?>
        <!-- Submit button -->
        <?php echo view('partials/formButton', ['name'=>$name]) ?>

        <?php
        if(uri_string() == "subpages/ustvarjanjeUporabnika/userCreate"){

        }
        ?>
    </form>

    <?php
    if (isset($validation)){
        echo $validation->listErrors();
    }
    ?>
</div>

<?= $this->endSection() ?>