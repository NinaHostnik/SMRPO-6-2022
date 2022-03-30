<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>
    <div class="container content-box">
        <div class="container py-5 h-100">
            <div class="card rounded-3 text-black">
                <div class="card-body p-md-5 mx-md-4">
                    <form action="/profile" method="post">
                        <h5>Uporabniški podatki</h5>
                        <!-- Username -->
                        <div class="form-outline mb-4">
                            <?php echo view('partials/formInput', ['type' => 'text', 'id' => 'username', 'value'=>'', 'label'=>'Uporabniško ime'])?>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <?php echo view('partials/passwordInput', ['type' => 'password', 'id'=>'password', 'value'=>'', 'label'=>'Trenutno geslo'])?>
                        </div>
                        <!-- First and last name -->
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
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <?php echo view('partials/formInput', ['type' => 'email', 'id' => 'email', 'value'=>'', 'label'=>'Email'])?>
                        </div>
                        <hr>
                        <h5>Spremeba gesla</h5>
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