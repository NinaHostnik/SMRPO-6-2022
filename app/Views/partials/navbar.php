
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/projekti"><b>SMRPO</b></a>
        <span class="navbar-text">Zadnja prijava: 30.3.2022 ob 13:25</span>
        <ul class="nav nav-justify-content-end">
            <li class="nav-item px-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo session()->get('username')?>
                    <?php if (session()->get('permissions') == 0) {
                        echo '(admin)';
                    } ?>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/profile">Profil</a>
                    </li>
                    <?php if (session()->get('permissions') == 0) { ?>
                        <li>
                            <a class="dropdown-item" href="/admin/createUser">Dodaj uporabnika</a>
                        </li>
                    <?php } ?>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item" href="/odjava">Odjava</a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
</nav>
