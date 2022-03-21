<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="form-control" action="/dodajanjeSprintovController/dodajanjeSprinta" method="post">
        <?php echo $opozorilo?>
        <h5>Dodaj sprint</h5>
        <hr>
        <!-- Hitrost sprinta -->
        <?php echo view("partials/formInput",['label'=>'Hitrost Sprinta', "id"=>"speed", 'type'=>'number','value'=>$hitrostSprinta])?>
        <!-- Zacetni datum -->
        <label for="start">Začetni datum:</label>
        <input type="date" id="start" name="start"
        value=<?php echo $datum?>
        min=<?php echo $datum?> max="2030-12-31">
        <!-- KoncniDatum datum -->
        <label for="end">Začetni datum:</label>
        <input type="date" id="end" name="end"
        value=<?php echo $datum?>
        min=<?php echo $datum?> max="2030-12-31">
        <!--hidden input field za id projekta -->
        <input type="hidden" id="idProjekta" name="idProjekta" value=<?php echo $idProjekta?>>
        <!--hidden input field za id osebe -->
        <input type="hidden" id="idOsebe" name="idOsebe" value=<?php echo $idOsebe?>>
        <!-- Submit button -->
        <br>
        <?php echo view('partials/formButton', ['name'=>'Dodaj Zgodbo']) ?> 

    </form>
</div>
<?= $this->endSection() ?>