<?php 
echo '
<h1 style=" text-align: center;">Später kurvamenő gym oldal</h1>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="main.php">Főoldal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Fejlődés</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Étkezések
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?meal=reggeli">Reggeli</a></li>
                        <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?meal=ebed">Ebéd</a></li>
                        <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?meal=vacsora">Vacsora</a></li>
                        <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?meal=nasi">Nasi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newfood.php">Új fogás</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="db_printer.php">DB table</a>
                </li>                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">random</a>
                </li>                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">fóus</a>
                </li>
            </ul>
            <form class="d-flex" action="login.php" method="post" >	
                <input type="text" value="1" name="logout" class="invisible">				
                <button class="btn btn-link text-dimlight" type="submit" >Log out</button>
            </form>
        </div>
    </div>
</nav>
';
?>