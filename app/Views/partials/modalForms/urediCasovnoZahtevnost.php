<!-- Uredi časovno zahtevnost -->
<div class="modal fade" id="editTime-<?php echo $idZgodbe?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Uredi časovno zahtevnost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/Pbacklog/urediCas" method="post">
                    <!-- Hidden form to get story ID -->
                    <?php echo view('partials/formInput', ['type' => 'hidden', 'id' => 'idZgodbe', 'value'=>$idZgodbe, 'label'=>''])?>
                    <?php echo view('partials/formInput', ['type'=>'number', 'id'=>'time', 'value'=>'', 'label'=>''])?>
                </form>
            </div>
        </div>
    </div>
</div>
