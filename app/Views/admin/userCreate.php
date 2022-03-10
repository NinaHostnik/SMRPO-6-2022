<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white border1 from-wrapper">
            <div class="container">
                <h3>Register</h3>
                <hr>
                <form class="" action="/admin/createUser" method="post">

                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" class="form-control" name="username" id="username" value="">
                    </div>

                    <div class="form-group">
                        <label for="permissions">permissions</label>
                        <input type="text" class="form-control" name="permissions" id="permissions" value="">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" id="password" value="">
                    </div>

                    <?php
                    if (isset($validation)){
                        echo $validation->listErrors();
                    }
                    ?>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>