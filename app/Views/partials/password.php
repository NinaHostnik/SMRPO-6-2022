
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


<div class="form-group mb-3">

    <label for="<?php echo $id ?>"><?php echo $label ?></label>
    <input type="<?php echo $type ?>" class="form-control" name="<?php echo $id ?>" id="<?php echo $id ?>" value="<?php echo $value ?>">

</div>

<!-- An element to toggle between password visibility -->
<input type="checkbox" onclick="togglepass()">Pokaži geslo

<br><br>