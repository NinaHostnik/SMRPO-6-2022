<div class="row project_card" id="projectCard" onclick="location.href = '/cardTable/' + <?php echo $project_id ?>;">
    <h3><?php echo $project_name ?></h3>
    <p><?php echo $project_desc ?></p>
    <p><?php echo session()->get('roles')[$project_id]?></p>
</div>