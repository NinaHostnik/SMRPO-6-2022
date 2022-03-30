<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
    <div class="container content-box">
        <div class="container py-3 h-100">
            <div class="card rounded-3 text-black">
                <div class="card-header">
                    <h4><?php echo session()->get('username')?></h4>
                    <h5><?php if (session()->get('permissions') == 0) {
                            echo 'admin';
                    } else {
                            echo 'uporabnik';
                    }?>
                    </h5>
                </div>
                <div class="card-body p-md-5 mx-md-4">
                    <form action="/profile" method="post">
                        <!-- Security check -->
                        <span style="font-weight: lighter; font-size: small;">Za zaščito svojega računa vpiši trenutno geslo v spodnje polje, da potrdiš svojo identiteto.</span>
                        <?php echo view("partials/formInput",['label'=>'Trenutno geslo', "id"=>"password", 'type'=>'password','value'=>''])?>
                        <hr>
                        <h5>Uporabniški podatki</h5>
                        <!-- First and last name -->
                        <?php echo view('partials/formInput', ['type' => 'text', 'id' => 'firstName', 'value'=>'', 'label'=>'Ime'])?>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <?php echo view('partials/formInput', ['type' => 'text', 'id' => 'firstName', 'value'=>'', 'label'=>'Ime'])?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <?php echo view('partials/formInput', ['type' => 'text', 'id' => 'lastName', 'value'=>'', 'label'=>'Priimek'])?>
                                </div>
                            </div>
                        </div>
                        <!-- Username -->
                        <?php echo view("partials/formInput",['label'=>'Novo uporabniško ime', "id"=>"newusername", 'type'=>'text', 'value'=>''])?>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <?php echo view('partials/formInput', ['type' => 'email', 'id' => 'email', 'value'=>'', 'label'=>'Email'])?>
                        </div>
                        <hr>
                        <h5>Spremeba gesla</h5>
                        <span style="font-weight: lighter; font-size: small;">Geslo mora biti dolgo vsaj 12 znakov.</span>
                        <!-- New password input -->
                        <div class="form-outline mb-4">
                            <?php echo view('partials/passwordInput', ['type' => 'password', 'id'=>'passwordNew', 'value'=>'', 'label'=>'Novo geslo'])?>
                        </div>
                        <!-- Check password input -->
                        <div class="form-outline mb-4">
                            <?php echo view('partials/passwordInput', ['type' => 'password', 'id'=>'passwordCheck', 'value'=>'', 'label'=>'Ponovi geslo'])?>
                        </div>

                        <?php
                            if(uri_string() == "admin/createUser"){

                            }
                        ?>
                        <!-- Submit button -->
                        <?php echo view('partials/formButton', ['name'=>'Shrani nastavitve'])?>

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

<?= $this->endSection() ?>