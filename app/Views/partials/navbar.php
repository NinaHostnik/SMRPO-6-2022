<?php
if(session()->get('lastLogin')!=null) {
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('Europe/Ljubljana'));
    $date->setTimestamp(session()->get('lastLogin'));
}
?>

<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/projekti"><b>SMRPO</b></a>
        <span class="navbar-text"><?php if (session()->get('lastLogin') != null) echo $date->format('d.m.Y H:i:s') ;
                                        else echo "To je vaša prva prijava";     ?></span>
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
