<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container content-box">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
            <div class="container">
                <h3>Register</h3>
                <hr>
                <form class="" action="/admin/createUser" method="post">

                    <?php echo view("partials/formInput",['label'=>'username', "id"=>"username", 'type'=>'text', 'value'=>''])?>

                    <div class="form-group mb-3">
                        <label for="permissions">Dovoljenja</label>
                        <select class="form-control" name="permissions" id="permissions">
                            <option value="0">Adminisrator</option>
                            <option value="1">Uporabnik</option>
                        </select>
                    </div>

                    <?php echo view("partials/formInput",['label'=>'password', "id"=>"password", 'type'=>'text', 'value'=>''])?>

                    <?php
                    if (isset($validation)){
                        echo $validation->listErrors();
                    }
                    ?>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <?php echo view('partials/formButton', ["name"=>'Log in']) ?>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('name').outerHTML = <?php echo $text ?>
</script>

<?= $this->endSection() ?>