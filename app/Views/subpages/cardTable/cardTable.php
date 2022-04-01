<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>



<div class="container content-box" style="width: 100%">

    <br>
    <div class="container d-flex flex-row mb-2">
        <h4 class="me-4">Ime projekta</h4>
        <?php if (strpos(session()->get('roles')[$id], 'V') > -1 || strpos(session()->get('roles')[$id], 'S') > -1) { ?>
            <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href=<?php echo "/dodajanjeSprintov/".$id; ?>>Dodaj sprint</a>
        <?php } ?>
            <a class="btn btn-outline-light gradient-custom-2 me-4" role="button" href=<?php echo "/dodajanjeUporabniskihZgodb/".$id; ?>>Dodaj zgodbo</a>
    </div>

    <div class="table-responsive" style="overflow: scroll; position: absolute; left: 2%">
        <table class="table table-bordered h-100 w-100">
            <thead class="text-center" style="vertical-align: middle">
            <tr>
                <th id="backlog" colspan="1" style="top: 43px; background-color: #5BC0DE"></th>
                <th id="requested" colspan="2" style="top: 43px; background-color: #0092db"></th>
                <th id="progress" colspan="5" style="top: 43px; background-color: #0066ff"></th>
                <th id="done" colspan="3" style="top: 43px; background-color: blue"></th>
                <th id="archive" colspan="1" style="top: 43px; background-color: darkblue"></th>
            </tr>
            <tr>
                <th id="backlog-head" rowspan="2" data-cards-per-row="3" style="top: 51px;">
                    <div>Backlog</div>
                </th>
                <th id="requested-head-product" rowspan="2" style="top: 51px;">
                    <div>Product backlog</div>
                </th>
                <th id="requested-head-sprint" rowspan="2" style="top: 51px;">
                    <div>Sprint backlog</div>
                </th>
                <th id="progress-head" colspan="5" style="top: 51px;">
                    <div>In progress</div>
                </th>
                <th id="done-head-acc-ready" rowspan="2" style="top: 51px;">
                    <div>Acceptance ready</div>
                </th>
                <th id="done-head-acc" rowspan="2" style="top: 51px;">
                    <div>Acceptance</div>
                </th>
                <th id="done-head-done" rowspan="2" style="top: 51px;">
                    <div>Done</div>
                </th>
                <th id="archive-head" rowspan="2" style="top: 51px;">
                    <div>Archive</div>
                </th>
            </tr>
            <tr>
                <th style="top: 87px;">
                    <div>Analysis & design</div>
                </th>
                <th style="top: 87px;">
                    <div>Coding</div>
                </th>
                <th style="top: 87px;">
                    <div>Testing</div>
                </th>
                <th style="top: 87px;">
                    <div>Integration</div>
                </th>
                <th style="top: 87px;">
                    <div>Documentation</div>
                </th>
            </tr>
            </thead>
            <tbody style="background-color: #eee">
            <tr>
                <td id="backlog-body">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45'])?>
                    </ul>
                </td>
                <td id="requested-body-product">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="requested-body-sprint">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="progress-body-analysis&design">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="progress-body-coding">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="progress-body-testing">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="progress-body-integration">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="progress-body-documentation">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="done-body-acceptance-ready">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="done-body-acceptance">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="done-body-done">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
                <td id="archive-body">
                    <ul class="list-group">
                        <?php echo view('partials/storyCardMini', ['storyTitle'=>'Zgodba', 'storyPriority'=>'45']) ?>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
