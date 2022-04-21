<div class="modal fade" id="<?php echo $modalID?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: lightskyblue">
                <h5 class="modal-title"><?php echo $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action ?>" method="post">
                    <?php echo view('partials/formInput', ['type'=>'hidden', 'id'=>'idZgodbe', 'value'=>$idZgodbe, 'label'=>'']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskName', 'value'=> $taskNameValue, 'label'=>'Naloga']) ?>
                    <?php echo view('partials/formInput', ['type'=>'text', 'id'=>'taskTime', 'value'=> $taskTimeValue, 'label'=>'Časovna zahtevnost']) ?>
                    <!-- TODO: Add select to assign a team member -->
                    <div class="form-outline mb-4">
                        <select class="form-control" name="taskMember" id="taskMember">
                            <?php foreach ($uporabniki as $uporabnik): ?>
                                <!-- TODO: autofill assigned member if applicable  -->
                                <option value=<?php echo $uporabnik['id'] ?>><?php echo $uporabnik['username'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="taskMember">Zadolžen član</label>
                    </div>
                    <!-- TODO: add a checkbox for complete/not complete -->
                    <?php echo view('partials/formButton', ['name'=>$buttonName]) ?>
                </form>
            </div>
        </div>
    </div>
</div>