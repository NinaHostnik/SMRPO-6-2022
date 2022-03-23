
<script>
function togglepass() {
    var x = document.getElementById("<?php echo $id ?>");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>


<div class="form-outline mb-4">
    <input type="<?php echo $type ?>" class="form-control" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $value ?>">
    <label for="<?php echo $id ?>"><?php echo $label ?></label>
    <!-- An element to toggle between password visibility -->
    <div class="float-end">
        <input type="checkbox" id="showpass" onclick="togglepass()">
        <label for="showpass">Pokaži geslo</label>
    </div>

</div>





