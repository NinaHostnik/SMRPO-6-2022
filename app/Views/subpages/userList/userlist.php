<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

    <div class="content-box">
        <div class="card-body">
            <ul class="list-group">
                <?php foreach ($users as $user): ?>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5><b>Uporabnik: </b><?php echo $user['username'] ?></h5>
                                <h6>
                                    <b>Dovoljenja: </b>
                                    <?php if($user['permissions'] === '0') {
                                        echo 'Admin';
                                    } elseif ($user['permissions'] === '1') {
                                        echo 'Navadni uporabnik';
                                    } else {
                                        echo 'Stranka';
                                    } ?>
                                </h6>
                            </div>
                            <div>
                                <button class="btn btn-success" onclick="edit(<?php echo $user['id'] ?>)">UredI uporabnika</button>
                                <button class="btn btn-success" onclick="ascension(<?php echo $user['id'] ?>)">Povišaj uporabnika</button>
                                <button class="btn btn-danger" onclick="odstrani(<?php echo $user['id'] ?>)">Odstrani uporabnika</button>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <script>
            function odstrani(id) {
                window.location.href = "<?php echo site_url('deleteUser/');?>" + id;
            }
            function ascension(id) {
                window.location.href = "<?php echo site_url('ascendUser/');?>" + id;
            }
            function edit(id){
                window.location.href = "<?php echo site_url('editUser/');?>" + id;
            }
        </script>
    </div>

<?= $this->endSection() ?>