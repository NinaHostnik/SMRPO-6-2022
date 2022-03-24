
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/projekti"><b>SMRPO</b></a>
        <ul class="nav nav-pills nav-justify-content-end">
            <li class="nav-item px-2">
                <form class="d-flex float-end" action="UsersController::createUser">
                    <a href="/admin/createUser" class="btn btn-outline-light" role="button">Ustvari novega uporabnika</a>
                </form>
            </li>
            <li class="nav-item px-2">
                <form class="d-flex float-end" action="UserController::update_user">
                    <a href="/profile" class="btn btn-outline-light" role="button"><?php echo session()->get('username')?></a>
                </form>
            </li>
        </ul>
    </div>
</nav>
