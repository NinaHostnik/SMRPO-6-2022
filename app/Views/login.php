<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>


<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
            <div class="container">
                <h3>Login</h3>
                <hr>
                <form class="" action="/" method="post">

                    <div class="form-group">
                        <?php echo view("formInput",["label"=>"username"])?>

                    </div>
                    <div class="form-group">
                        <?php echo view("formInput",["label"=>"password"])?>

                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Login</button>
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