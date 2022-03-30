<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>


    <div class="container content-box">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
                <div class="container">
                    <h3><?php echo session()->get("username") ?></h3>
                    <hr>
                    <form class="" action="/ponastavitevGesa" method="post">

                        <h5>Ponastavitev geslo</h5>
                        <p>Administrator je zahteval ponastavitev gesla. Prosimo nastavite si novo geslo:</p>
                        <hr>
                        <?php echo view("partials/passwordInput",['label'=>'Novo geslo', "id"=>"newpass", 'type'=>'password','value'=>''])?>

                        <?php echo view("partials/formInput",['label'=>'Ponovi geslo', "id"=>"repass", 'type'=>'password','value'=>''])?>


                        <div class="row">
                            <?php echo view('partials/formButton', ["name"=>'Shrani geslo']) ?>
                        </div>

                    </form>
                </div>

                <?php
                if (isset($validation)){
                    echo $validation->listErrors();
                }
                ?>

            </div>
        </div>
    </div>
    </div>

<?= $this->endSection() ?>