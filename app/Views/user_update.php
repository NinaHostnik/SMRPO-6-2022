<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>


    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
                <div class="container">
                    <h3><?php echo session()->get("username") ?></h3>
                    <hr>
                    <form class="" action="/profile" method="post">
                        <?php echo view("partials/formInput",['label'=>'Tvoje geslo', "id"=>"password", 'type'=>'password','value'=>''])?>
                        <span style="font-weight: lighter; font-size: small;">Za zaščito svojega računa vpiši trenutno geslo v zgornjo polje, da potrdiš svojo identiteto.</span>
                        <br><br>
                        <h5>Uporabniški podatki</h5>
                        <hr>

                        <?php echo view("partials/formInput",['label'=>'Novo uporabniško ime', "id"=>"newusername", 'type'=>'text', 'value'=>''])?>
                        <?php echo view("partials/formInput",['label'=>'', "id"=>"username", 'type'=>'hidden', 'value'=>session()->get("username")])?>

                        <h5>Spremembna gesla</h5>
                        <hr>
                        <?php echo view("partials/password",['label'=>'Novo geslo', "id"=>"newpass", 'type'=>'password','value'=>''])?>

                        <?php echo view("partials/formInput",['label'=>'Ponovi geslo', "id"=>"repass", 'type'=>'password','value'=>''])?>



                        <?php
                        if(uri_string() == "admin/createUser"){

                        }
                        ?>

                        <div class="row">
                            <?php echo view('partials/formButton', ["name"=>'Shrani nastavitve']) ?>
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