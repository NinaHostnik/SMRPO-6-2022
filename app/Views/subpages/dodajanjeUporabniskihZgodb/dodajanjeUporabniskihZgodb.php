<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="form-control" action="/dodajanjeUporabniskihZgodbController/dodajanjeZgodbe" method="post">
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
        <!-- Poslovna Vrednost input -->
        <?php echo view("partials/formInput",['label'=>'Poslovna vrednost', "id"=>"poslovnaVrednost", 'type'=>'number','value'=>$poslovnaVrednost])?>
        <!--hidden input field za id projekta -->
        <input type="hidden" id="idProjekta" name="idProjekta" value=<?php echo $idProjekta?>>
        <!--hidden input field za id osebe -->
        <input type="hidden" id="idOsebe" name="idOsebe" value=<?php echo $idOsebe?>>
        <!-- Submit button -->
        <?php echo view('partials/formButton', ['name'=>'Dodaj Zgodbo']) ?> 

    </form>
</div>
<?= $this->endSection() ?>