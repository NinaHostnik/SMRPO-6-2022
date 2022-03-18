<?= $this->extend('layouts/frame') ?>

<?= $this->section('content') ?>

<div class="container">
    <form class="form-control" action="/admin/dodajanjeUporabniskihZgodb" method="post">
        <h5>Dodaj uporabniških zgodb</h5>
        <hr>
        <!-- Name input -->
        <?php echo view("partials/formInput",['label'=>'Ime zgodbe', "id"=>"zgodbaIme", 'type'=>'text', 'value'=>''])?>
        <!-- Besedilo input -->
        <?php echo view("partials/formTextarea",['name'=>'Besedilo', "id"=>"zgodbaBesedilo", 'rows'=>'10', 'maxlength'=>'5000'])?>
        <!-- Sprejemni testi input -->
        <?php echo view("partials/formInput",['label'=>'Sprejemni Testi', "id"=>"sprejemniTesti", 'type'=>'text','value'=>''])?>
        <!-- Prioriteta input -->
        <select id="prioriteta" name="prioriteta">
            <option value="" selected hidden>Prioriteta</option>
            <option value="MustHave">Must have</option>
            <option value="ShouldHave">Should have</option>
            <option value="CouldHave">Could have</option>
            <option value="WontHave">Won't have this time</option>
        </select>
        <!-- Poslovna Vrednost input -->
        <?php echo view("partials/formInput",['label'=>'Poslovna vrednost', "id"=>"poslovnaVrednost", 'type'=>'number','value'=>''])?>
        <!-- Submit button -->
        <?php echo view('partials/formButton', ['name'=>'Dodaj Zgodbo']) ?>
    </form>
</div>
<?= $this->endSection() ?>