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
    <nav class="navbar navbar-expand-md shadow-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="main.php">Főoldal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    <a class="nav-link" href="progress.php">Fejlődés</a>
                    <a class="nav-link" href="newmeal.php">Új étel</a>
                    <a class="nav-link" href="shop.php">Bolt</a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="main.php">Főoldal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Fejlődés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Új étel</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Új étkezés
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="newmeal.php?=reggeli">Reggeli</a></li>
            <li><a class="dropdown-item" href="newmeal.php?=ebed">Ebéd</a></li>
            <li><a class="dropdown-item" href="newmeal.php?=vacsora">Vacsora</a></li>
            <li><a class="dropdown-item" href="newmeal.php?=nasi">Nasi</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Böngészés????</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-flex">
        <button class="btn btn-link" href="#" type="submit">Log out</button>
      </div>
    </div>
  </div>
</nav>
    <div>
        <!---->
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>



