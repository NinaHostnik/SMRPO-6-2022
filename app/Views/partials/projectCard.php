<div class="row project_card">
    <h3><?php echo $project_name ?></h3>
    <p><?php echo $project_desc ?></p>

    <form class="" action="/dodajanjeUporabniskihZgodb" method="get">
        <input type="hidden" class="form-control" name="idProjekta" id="idProjekta" value="<?php echo $project_id ?>">
        <?php echo view('partials/formButton', ["name"=>'Dodaj zgodbo']) ?>
    </form>
</div>