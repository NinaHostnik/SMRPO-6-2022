<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
            <div class="container">
                <h3>Dodajanje projekta</h3>
                <hr>
                <form class="" action="/" method="post">

                    <div class="form-group">
                        <?php echo view("partials/formInput",["label"=>"Ime projekta", 'id'=>'projectName', 'type'=>'text'])?>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <select class="form-select">
                                <option value="" hidden selected disabled>Izberite uporabnika</option>
                                <?php foreach ($data as $option): ?>
                                    <option value=<?php  $option["id"] ?>><?php  echo $option["username"] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select class="form-select">
                                <option value="" hidden selected disabled>Izberite vlogo</option>
                                <?php foreach ($roleList as $option): ?>
                                    <option value=<?php  $option["id"] ?>><?php  echo $option["vloga"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <?php echo view('partials/formButton', ["name"=>'Dodaj projekt']) ?>
                        </div>
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

<?= $this->endSection() ?>