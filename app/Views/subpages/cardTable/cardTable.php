<?= $this->extend('layouts/frame'); ?>

<?= $this->section('content') ?>

<div class="container content-box">
    <table class="table table-bordered">
        <thead class="text-center">
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
        <tbody>
            <tr>
                <td id="backlog-body" data-cards-per-row="3">
                    <ul data-cards-per-row="3">
                        <!-- Cards go in here -->
                    </ul>
                </td>
                <td id="requested-body-product">
                    <ul></ul>
                </td>
                <td id="requested-body-sprint">
                    <ul></ul>
                </td>
                <td id="progress-body-analysis&design">
                    <ul></ul>
                </td>
                <td id="progress-body-coding">
                    <ul></ul>
                </td>
                <td id="progress-body-testing">
                    <ul></ul>
                </td>
                <td id="progress-body-integration">
                    <ul></ul>
                </td>
                <td id="progress-body-documentation">
                    <ul></ul>
                </td>
                <td id="done-body-acceptance-ready">
                    <ul></ul>
                </td>
                <td id="done-body-acceptance">
                    <ul></ul>
                </td>
                <td id="done-body-done">
                    <ul></ul>
                </td>
                <td id="archive-body">
                    <ul></ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
