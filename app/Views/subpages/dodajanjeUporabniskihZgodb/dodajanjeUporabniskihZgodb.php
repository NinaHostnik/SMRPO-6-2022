<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    var i=1;
    function dodajVrstico(){
        document.getElementById("stSprejemnihTestov").value = i;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="sprejemniTest'+i+'" placeholder="Vnesite sprejemni test" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        i++;
    }
    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
 </script>
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
        <!-- <#?php echo view("partials/formInput",['label'=>'Sprejemni Testi', "id"=>"sprejemniTesti", 'type'=>'text','value'=>$sprejemniTesti])?> -->
        <div class="table-responsive">  
            <table class="table table-bordered" id="dynamic_field">  
                <tr>  
                    <td><input type="text" name="sprejemniTest0" placeholder="Vnesite sprejemni test" class="form-control name_list" /></td>  
                    <td><button type="button" name="add" id="add" class="btn btn-success" onclick="dodajVrstico()">Add More</button></td>  
                </tr>  
            </table>
        </div>  
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
        <input type="hidden" id="stSprejemnihTestov" name="stSprejemnihTestov" value="0">
        <!--hidden input field za id osebe -->
        <input type="hidden" id="idOsebe" name="idOsebe" value=<?php echo $idOsebe?>>
        <!-- Submit button -->
        <?php echo view('partials/formButton', ['name'=>'Dodaj Zgodbo']) ?> 

    </form>
</div>
<?= $this->endSection() ?>