<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container content-box">
    <form class="form-control" method="post">
        <?php echo $opozorilo?>
        <h5>Dodaj uporabniško zgodbo</h5>
        <hr>
        <!-- Name input -->
        <?php echo view("partials/formInput",['label'=>'Ime zgodbe', "id"=>"zgodbaIme", 'type'=>'text', 'value'=>$ime])?>
        <!-- Besedilo input -->
        <div class="form-group mb-3">
        <label>Besedilo zgodbe</label>
        <textarea class="form-control" name="zgodbaBesedilo" id="zgodbaBesedilo" rows="10" maxlength="8000"><?php echo $besedilo?></textarea>
        </div>
        <!-- Sprejemni testi input -->
        <?php echo view("partials/formInput",['label'=>'Sprejemni Testi', "id"=>"sprejemniTesti", 'type'=>'text','value'=>$sprejemniTesti])?>
        <!-- Prioriteta input -->
        <select id="prioriteta" name="prioriteta">
            <option value="" <?php echo $default?> hidden>Prioriteta</option>
            <option value="MustHave" <?php echo $mustHave?>>Must have</option>
            <option value="ShouldHave" <?php echo $shouldHave?>>Should have</option>
            <option value="CouldHave" <?php echo $couldHave?>>Could have</option>
            <option value="WontHave" <?php echo $wontHave?>>Won't have this time</option>
        </select>
        <br>
        <br>
        <!-- Poslovna Vrednost input -->
        <input type="number" class="form-control" name="poslovnaVrednost" id="poslovnaVrednost" value="<?php echo $poslovnaVrednost?>" min="1" max="10" required>
        <label for="poslovnaVrednost">Poslovna vrednost</label>
        <!--hidden input field za id projekta -->
        <input type="hidden" id="idProjekta" name="idProjekta" value=<?php echo $idProjekta?>>
        <!--hidden input field za id osebe -->
        <input type="hidden" id="idOsebe" name="idOsebe" value=<?php echo $idOsebe?>>
        <!-- Submit button -->
        <?php echo view('partials/formButton', ['name'=>'Dodaj Zgodbo']) ?> 

    </form>
</div>
<?= $this->endSection() ?>

<script>
    var addedTests = {};

    function dodajTest() {
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
</script>