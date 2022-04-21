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
                            <button class="btn btn-danger">Odstrani uporabnika</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?= $this->endSection() ?>