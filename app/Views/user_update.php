<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>


    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
                <div class="container">
                    <h3><?php echo session()->get("username") ?></h3>
                    <hr>
                    <form class="" action="/profile" method="post">
                        <?php echo view("partials/formInput",['label'=>'', "id"=>"username", 'type'=>'hidden', 'value'=>session()->get("username")])?>

                        <?php echo view("partials/formInput",['label'=>'New Username', "id"=>"newusername", 'type'=>'text', 'value'=>''])?>

                        <?php echo view("partials/formInput",['label'=>'Password', "id"=>"password", 'type'=>'password','value'=>''])?>

                        <?php echo view("partials/formInput",['label'=>'New Password', "id"=>"newpass", 'type'=>'password','value'=>''])?>

                        <?php echo view("partials/formInput",['label'=>'Repeat Password', "id"=>"repass", 'type'=>'password','value'=>''])?>



                        <?php
                        if(uri_string() == "admin/createUser"){

                        }
                        ?>

                        <div class="row">
                            <?php echo view('partials/formButton', ["name"=>'Submit']) ?>
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