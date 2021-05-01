<?php
session_start();

include 'db.php';
$link = open_db();
$error = 0;
$name="";$prot=0;$carb=0;$fat=0;
if (isset($_POST) AND isset($_POST['name'])) {
  $name = mysqli_real_escape_string($link, $_POST['name']);
}
if (isset($_POST) AND isset($_POST['prot'])) {
  $prot = floor(mysqli_real_escape_string($link, $_POST['prot'])*10);
  if (!preg_match("/^[0-9]+$/", $prot)) $error = 1;
}
if (isset($_POST) AND isset($_POST['carb'])) {
  $carb = floor(mysqli_real_escape_string($link, $_POST['carb'])*10);
  if (!preg_match("/^[0-9]+$/", $carb)) $error = 1;
}
if (isset($_POST) AND isset($_POST['fat'])) {
  $fat = floor(mysqli_real_escape_string($link, $_POST['fat'])*10);
  if (!preg_match("/^[0-9]+$/", $fat)) $error = 1;
}

if (isset($_POST) AND $error != 1){
  mysqli_query($link, "INSERT INTO meal (name, prot, carb, fat) VALUES ('{$name}',{$prot},{$carb},{$fat});");
}?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap.css" rel="stylesheet" type="text/css" />

  <title>Speti edzos oldala xd</title>
</head>

<body class="bg-primary text-light">
  <?php include 'navbar.php'  ?>

  <div class="container mt-4 <?php if ($error != 1) echo "visually-hidden"; ?> ">
    <div class="row justify-content-center">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Sikertelen hozzáadás, a formátum nem megfelelő
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>
  
  <div class="col-xs-10 col-md-8 col-xl-6 offset-xs-1 offset-md-2 offset-xl-4 mt-4 p-4 bg-light text-dark rounded-3 shadow-lg">
    <form action="newfood.php" method="post">

      <div class="h3 mb-3 ">Új fogás hozzáadása </div>
      <div class="form-floating mb-3">
        <input value="<?php if (isset($_POST) AND isset($_POST['name'])) echo $_POST['name'];?>" type="text" name="name" class="form-control">
        <label for="floatingInput">Név</label>
      </div>
      <label class="mb-2" for="floatingInput">Makrók (100g-ban)</label>
      <div class="row g-1 justify-content-around mb-3">
        <div class="col-3  form-floating">
          <input placeholder="g" value="<?php if (isset($_POST) AND isset($_POST['prot'])) echo $_POST['prot'];?>"type="text" class="form-control" name="prot">
          <label for="floatingInput">Protein</label>
        </div>
        <div class="col-3  form-floating">
          <input placeholder="g" value="<?php if (isset($_POST) AND isset($_POST['carb'])) echo $_POST['carb'];?>" type="text" class="form-control" name="carb">
          <label for="floatingInput">Szénhidrát</label>
        </div>
        <div class="col-3  form-floating">
          <input placeholder="g" value="<?php if (isset($_POST) AND isset($_POST['fat'])) echo $_POST['fat'];?>" type="text" class="form-control" name="fat">
          <label for="floatingInput">Zsír</label>
        </div>
      </div>
      <button class="w-25 btn btn-lg btn-primary " type="submit">Hozzáad</button>

    </form>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>
</body>

</html>