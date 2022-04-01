<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container content-box">
    <form class="form-control" method="post">
        <?php echo $opozorilo?>
        <h5>Dodaj sprint</h5>
        <hr>
        <!-- Hitrost sprinta -->
        <input type="number" class="form-control" name="speed" id="speed" value="<?php echo $speed?>" min="0" required>
        <label for="speed">Hitrost sprinta (v točkah)</label>
        <br>
        <br>
        <!-- Zacetni datum -->
        <label for="start">Začetni datum:</label>
        <input type="date" id="start" name="start"
        min=<?php echo $datum?> max="2030-12-31">
        <!-- KoncniDatum datum -->
        <label for="end">Končni datum:</label>
        <input type="date" id="end" name="end"
        min=<?php echo $datum?> max="2030-12-31">
        <!--hidden input field za id projekta -->
        <input type="hidden" id="idProjekta" name="idProjekta" value=<?php echo $idProjekta?>>
        <!--hidden input field za id osebe -->
        <input type="hidden" id="idOsebe" name="idOsebe" value=<?php echo $idOsebe?>>
        <!-- Submit button -->
        <br>
        <?php echo view('partials/formButton', ['name'=>'Dodaj sprint']) ?>

    </form>
</div>
<?= $this->endSection() ?>