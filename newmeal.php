<?php
session_start()
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bootstrap.css" rel="stylesheet" type="text/css" />


    <title>Speti edzos oldala xd</title>
</head>

<body class="bg-primary text-light">
    <h1 style=" text-align: center;">Später kurvamenő gym oldal</h1>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
                            Új étkezés
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-dimlight" href="newmeal.php?=reggeli">Reggeli</a></li>
                            <li><a class="dropdown-item text-dimlight" href="newmeal.php?=ebed">Ebéd</a></li>
                            <li><a class="dropdown-item text-dimlight" href="newmeal.php?=vacsora">Vacsora</a></li>
                            <li><a class="dropdown-item text-dimlight" href="newmeal.php?=nasi">Nasi</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-dimlight" href="#">Új fogás</a></li>
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
    <div>
        <!---->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>