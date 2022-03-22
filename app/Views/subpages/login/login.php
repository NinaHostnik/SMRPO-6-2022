<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <form class="form-control text-blue" action="/" method="post">
                <h5>Prijava</h5>
                <hr>
                <!-- Username input -->
                <?php echo view("partials/formInput",['label'=>'Uporabniško ime', "id"=>"username", 'type'=>'text', 'value'=>''])?>
                <!-- Password input -->
                <?php echo view("partials/password",['label'=>'Geslo', "id"=>"password", 'type'=>'password','value'=>''])?>
                <!-- Submit button -->
                <?php echo view('partials/formButton', ['name'=>'Prijava']) ?>

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