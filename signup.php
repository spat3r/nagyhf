<?php
session_start();
session_destroy();
session_start();
include 'db.php';
$link = open_db();

if (isset($_POST) and isset($_POST['usr'])) {
    $result = mysqli_query($link, "SELECT psw FROM profil p WHERE p.usr LIKE '" . $_POST['usr'] . "';");
    if (mysqli_num_rows($result)) {
        $_SESSION['error'] = "user404";
    } else {
        if ($_POST['psw'] == $_POST['psw_rep']) {
            if ( isset($_POST['age']) && isset($_POST['wt']) && isset($_POST['wtg']) && isset($_POST['ht']) &&  isset($_POST['g']) && $_POST['age']>0 && $_POST['wt']>0 && $_POST['wtg']>0 && $_POST['ht']>0 )  {
            $psw = md5($_POST['psw']);
            $query = "INSERT INTO profil (usr,psw,age,wt,wtg,ht,g) VALUES(
            '".mysqli_real_escape_string($link, $_POST['usr'])."',
            '".mysqli_real_escape_string($link, $psw)."',
            '".mysqli_real_escape_string($link, $_POST['age'])."',
            '".mysqli_real_escape_string($link, $_POST['wt'])."',
            '".mysqli_real_escape_string($link, $_POST['wtg'])."',
            '".mysqli_real_escape_string($link, $_POST['ht'])."',
            '".mysqli_real_escape_string($link, $_POST['g'])."');";
            mysqli_query($link, $query);
            $_SESSION['usr'] = $_POST['usr'];
            header("Location: main.php");
            exit();
            }
            else {$_SESSION['error'] = "unset";}

        }
        else {$_SESSION['error'] = "wrongpsw";}

    }

}

/**/ ?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'?>

<body class="bg-primary text-light">
    <h1 style=" text-align: center; filter: blur(1px);">Später's Watch Your Food</h1>
    <div class="col-xs-10 col-md-8 col-xl-4 offset-xs-1 offset-md-2 offset-xl-4 mt-4 p-4 bg-light text-dark rounded-3 shadow-lg">
        <form action="signup.php" method="post">
            <h1 class="h3 mb-3">Please sign in</h1>
            <?php if(isset($_SESSION) AND isset($_SESSION['error']) AND $_SESSION['error']=="user404") echo '<div style="width: min-content !important; white-space: nowrap;" class="alert alert-danger px-2 mt-1 p-0" role="alert">A megadott felhasználónévhez már tartozik fiók. <a href="login.php?usr='.$_REQUEST['usr'].'" class="alert-link">Itt tudsz belépni a fiókodba.</a></div>';?>
            <div class="form-floating mb-3">
                <input required value="<?php if(isset($_REQUEST) AND isset($_REQUEST['usr'])) echo $_REQUEST['usr'];?>" type="text" name="usr" class="form-control" placeholder="Username">
                <label>Felhasználónév</label>
            </div>
            <div class="form-floating mb-3">
                <input required type="password" name="psw" class="form-control" placeholder="Password">
                <label>Jelszó</label>
            </div>
            <?php if(isset($_SESSION) AND isset($_SESSION['error']) AND $_SESSION['error']=="wrongpsw") echo '<div style="width: min-content !important; white-space: nowrap;" class="alert alert-danger px-2 mt-1 p-0 " role="alert">A két jelszó nem egyezik.</div>';?>
            <div class="form-floating mb-3">
                <input required type="password" name="psw_rep" class="form-control" placeholder="Password">
                <label>Jelszó ismét</label>
            </div>
            <?php if(isset($_SESSION) AND isset($_SESSION['error']) AND $_SESSION['error']=="unset") echo '<div style="width: min-content !important; white-space: nowrap;" class="alert alert-danger px-2 mt-1 p-0" role="alert">Mindent töltsön ki kérem a megfelelő formátumú adattal</div>';?>
            <div class="form-check col-2 mb-3">
                <div>
                    <input class="form-check-input" type="radio" name="g" value="1" <?php if(isset($_REQUEST) AND isset($_REQUEST['g']) and $_REQUEST['g']== 1) echo 'checked';?>>
                    <label class="form-check-label">Férfi</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="g" value="0" <?php if(isset($_REQUEST) AND isset($_REQUEST['g']) and $_REQUEST['g']== 0) echo 'checked';?>>
                    <label class="form-check-label">Nő</label>
                </div>
            </div>
            <div class="row g-1 justify-content-around mb-3">
                <div class="col-5  form-floating ">
                    <input value="<?php if(isset($_REQUEST) AND isset($_REQUEST['wt'])) echo $_REQUEST['wt'];?>" placeholder="g" type="number" class="form-control" name="wt">
                    <label for="floatingInput">Tömege (kg)</label>
                </div>
                <div class="col-5  form-floating">
                    <input value="<?php if(isset($_REQUEST) AND isset($_REQUEST['wtg'])) echo $_REQUEST['wtg'];?>" placeholder="g" type="number" class="form-control" name="wtg">
                    <label for="floatingInput">Cél tömege (kg)</label>
                </div>
            </div>
            <div class="row g-1 justify-content-around mb-3">

                <div class="col-5  form-floating ">
                    <input value="<?php if(isset($_REQUEST) AND isset($_REQUEST['age'])) echo $_REQUEST['age'];?>" placeholder="g" type="number" class="form-control" name="age">
                    <label for="floatingInput">Életkor</label>
                </div>
                <div class="col-5  form-floating">
                    <input value="<?php if(isset($_REQUEST) AND isset($_REQUEST['ht'])) echo $_REQUEST['ht'];?>" placeholder="g" type="number" class="form-control" name="ht">
                    <label for="floatingInput">Testmagasság (cm)</label>
                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary " type="submit">Regisztráció</button>
        </form>
    </div>

<?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>
</body>

</html>



