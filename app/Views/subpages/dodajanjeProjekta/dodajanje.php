<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container content-box">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
            <div class="container">
                <h3>Dodajanje projekta</h3>
                <hr>
                <form class="form-control" action="/dodajanjeProjekta" method="post">
                    <input hidden type="text" id="userList" name="userList">
                    <div class="form-group">
                        <?php echo view("partials/formInput",["label"=>"Ime projekta", 'id'=>'projectName', 'type'=>'text',  'value'=>''])?>
                    </div>
                    <div class="form-group">
                        <?php echo view("partials/formTextarea",["label"=>"Opis projekta", 'id'=>'projectDescription', 'rows'=>'5', 'maxlength'=>'3000'])?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-5">
                            <select class="form-select" id="uporabnikiSelect">
                                <option value="" hidden selected disabled>Izberite uporabnika</option>
                                <?php foreach ($data as $option): ?>
                                    <option value=<?php  echo $option["id"] ?>><?php  echo $option["username"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-5">
                            <select class="form-select" id="vlogeSelect">
                                <option value="" hidden selected disabled>Izberite vlogo</option>
                                <?php foreach ($roleList as $option): ?>
                                    <option value=<?php  echo $option["id"] ?>><?php  echo $option["vloga"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-2">
                            <?php echo view('partials/normalButton', ["name"=>'Dodaj', "onclick" => 'dodajUporabnika()']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Uporabnik</th>
                                    <th scope="col">Vloga</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="seznamUporabnikov">
                            </tbody>
                        </table>
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

<script>
    var addedUsers = {};
    var hiddenList = document.getElementById('userList');

    document.getElementById('projectName').defaultValue = "<?php echo $projectName ?>";

    function dodajUporabnika() {
        var uporabnikiSelect = document.querySelector('#uporabnikiSelect');
        var vlogeSelect = document.querySelector('#vlogeSelect');
        if (uporabnikiSelect.selectedIndex === 0 || vlogeSelect.selectedIndex === 0) {
            alert("Izbrani uporabnik ali vloga nista pravilna.")
        } else {
            var izbraniUporabnik = uporabnikiSelect.selectedOptions[0].outerText;
            var izbranaVloga = vlogeSelect.selectedOptions[0].outerText;
            var vlogaId = vlogeSelect.value;
            var izbraniId = vlogaId === 'V' ? uporabnikiSelect.value : uporabnikiSelect.value + '/' + vlogaId;
            if (!check(vlogaId, uporabnikiSelect.value, izbraniId)) {
                alert("Izbrani uporabnik je že bil dodan.");
            } else if (izbranaVloga.includes('produktni vodja') && exists(addedUsers, 'produktni vodja')) {
                alert("V projektu lahko obstaja le en produktni vodja.");
            } else if (izbranaVloga.includes('skrbnik metodologije') && exists(addedUsers, 'skrbnik metodologije')) {
                alert("V projektu lahko obstaja le en skrbnik metodologije.");
            } else {
                addedUsers[izbraniId] = {izbraniUporabnik, izbranaVloga, vlogaId};
                hiddenList.value = JSON.stringify(addedUsers);
                document.getElementById('seznamUporabnikov').innerHTML += '<tr id=' + izbraniId + '><td>' + izbraniUporabnik + '</td>' +
                    '<td>' + izbranaVloga + '</td>' +
                    '<td><button type="button" class="btn btn-primary" onclick="odstraniUporabnika(' + izbraniId + ')">Odstrani</button></td></tr>';
                uporabnikiSelect.selectedIndex = 0;
                vlogeSelect.selectedIndex = 0;
            }
        }
    }

    function odstraniUporabnika(id) {
        let vrstica = document.getElementById(id);
        vrstica.parentNode.removeChild(vrstica);
        delete addedUsers[id];
        hiddenList.value = JSON.stringify(addedUsers);
    }

    function exists(arr, search) {
        let value = false;
        Object.keys(arr).forEach((key) => {
            if (Object.values(arr[key]).includes(search)) {
                value = true;
            }
        });
        return value;
    }

    function check(vloga, id, key) {
        var keys = Object.keys(addedUsers);
        if (vloga !== 'V') {
            if (keys.includes(id) || keys.includes(key)) {
                return false;
            }
        } else if (vloga === 'V') {
            if (keys.includes(id + '/C') || keys.includes('/M') || keys.includes(id)) {
                return false;
            }
        }
        return true;
    }
</script>

<?= $this->endSection() ?>