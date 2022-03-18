<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container">
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
                    <div class="row">
                        <div class="col-12 col-sm-5">
                            <select class="form-select" id="uporabnikiSelect">
                                <option value="" hidden selected disabled>Izberite uporabnika</option>
                                <?php foreach ($data as $option): ?>
                                    <option value=<?php  $option["id"] ?>><?php  echo $option["username"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-5">
                            <select class="form-select" id="vlogeSelect">
                                <option value="" hidden selected disabled>Izberite vlogo</option>
                                <?php foreach ($roleList as $option): ?>
                                    <option value=<?php  $option["id"] ?>><?php  echo $option["vloga"] ?></option>
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
    var addedUsers = new Object();
    var counter = 1;
    var hiddenList = document.getElementById('userList');

    function dodajUporabnika() {
        var uporabnikiSelect = document.querySelector('#uporabnikiSelect');
        var vlogeSelect = document.querySelector('#vlogeSelect');
        if (uporabnikiSelect.selectedIndex === 0 || vlogeSelect.selectedIndex === 0) {
            alert("Izbrani uporabnik ali vloga nista pravilna.")
        } else {
            var izbraniUporabnik = uporabnikiSelect.selectedOptions[0].outerText;
            var izbranaVloga = vlogeSelect.selectedOptions[0].outerText;
            addedUsers[counter] = {izbraniUporabnik, izbranaVloga};
            hiddenList.value = JSON.stringify(addedUsers);
            document.getElementById('seznamUporabnikov').innerHTML += '<tr id=' + counter + '><td>' + izbraniUporabnik + '</td>' +
                '<td>' + izbranaVloga + '</td>' +
                '<td><button type="button" class="btn btn-primary" onclick="odstraniUporabnika(' + counter + ')">Odstrani</button></td></tr>';
            uporabnikiSelect.selectedIndex = 0;
            vlogeSelect.selectedIndex = 0;
            counter++;
        }
    }

    function odstraniUporabnika(id) {
        var vrstica = document.getElementById(id);
        vrstica.parentNode.removeChild(vrstica);
        delete addedUsers[id];
        hiddenList.value = JSON.stringify(addedUsers);
    }
</script>

<?= $this->endSection() ?>