<?php 
session_start();
if(isset($_POST) AND isset($_POST['logout']) AND $_POST['logout']=='1'){
  session_unset();
  session_write_close();
}
include 'db.php';
$link = open_db();

if (isset($_POST) AND isset($_POST['usr'])) {
    $result = mysqli_query($link, "SELECT psw FROM profil p WHERE p.usr LIKE '".$_POST['usr']."';");
    if(!mysqli_num_rows($result)) { $_SESSION['error']="user404";}
    else { 
        $psw = mysqli_fetch_array($result);
        if( $psw['psw'] != md5($_POST['psw']) ) { $_SESSION['error']="wrongpsw";}
        else {
            $_SESSION['usr'] = $_POST['usr'];
            header("Location: main.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="1000000000000000000000000">
	<link href="bootstrap.css" rel="stylesheet" type="text/css" />
	<title>Speti edzos oldala xd</title>
</head>
<body class="bg-primary text-light">
<h1 style=" text-align: center; filter: blur(1px);" >Später kurvamenő gym oldal</h1>
<div class="col-xs-10 col-md-8 col-xl-4 offset-xs-1 offset-md-2 offset-xl-4 mt-4 p-4 bg-light text-dark rounded-3 shadow-lg">
<form action="login.php" method="post">
  <?php 
  ?>
    <h1 class="h3 mb-3">Please sign in</h1>
    <div class="form-floating mb-3">
      <input value="<?php if(isset($_POST['usr'])) echo $_POST['usr'];?>" type="text" name="usr" class="form-control" placeholder="name@example.com">
      <label for="floatingInput">Felhasználónév</label>
      <div style="width: min-content !important; white-space: nowrap;" class="alert alert-danger px-2 mt-1 p-0 <?php if(!isset($_SESSION) OR !isset($_SESSION['error']) OR $_SESSION['error']!="user404") echo "invisible";?>" role="alert">A megadott felhasználónévhez nem tartozik fiók. <a href="#" class="alert-link">Itt tudsz fiókot regisztrálni.</a></div>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="psw" class="form-control" placeholder="Password">
      <label for="floatingPassword">Jelszó</label>
      <div style="width: min-content !important; white-space: nowrap;" class="alert alert-danger px-2 mt-1 p-0 <?php if(!isset($_SESSION) OR !isset($_SESSION['error']) OR $_SESSION['error']!="wrongpsw") echo "invisible";?>" role="alert">A megadott jelszó helytelen.</div>
    </div>

    
    <button class="w-100 btn btn-lg btn-primary " type="submit">Sign in</button>
</form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>
</body>
</html>


