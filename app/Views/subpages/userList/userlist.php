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
                            <button class="btn btn-danger" onclick="odstrani(<?php echo $user['id'] ?>)">Odstrani uporabnika</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <script>
            function odstrani(id) {
                window.location.href = "<?php echo site_url('deleteUser/');?>" + id;
            }
        </script>
    </div>

<?= $this->endSection() ?>