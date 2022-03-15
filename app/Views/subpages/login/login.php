<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <form class="form-control text-blue" action="/" method="post">
                <h5><?php echo $heading ?></h5>
                <hr>
                <!-- Username input -->
                <?php echo view('partials/formInput', ['type'=>$usernameInput['type'], 'id'=>$usernameInput['id'], 'label'=>$usernameInput['label'], 'value'=>''])?>
                <!-- Password input -->
                <?php echo view('partials/formInput', ['type'=>$passwordInput['type'], 'id'=>$passwordInput['id'], 'label'=>$passwordInput['label'], 'value'=>''])?>
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
    </div>
</div>

<?= $this->endSection() ?>