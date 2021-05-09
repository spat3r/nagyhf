<?php 
session_start();
var_dump($_SESSION);
include 'db.php';
$link = open_db();

if (isset($_SESSION) and ($_SESSION['id']) and isset($_POST) and isset($_POST['age'])) {
    if ( isset($_POST['age']) && isset($_POST['wt']) && isset($_POST['wtg']) && isset($_POST['ht']) && $_POST['age']>0 && $_POST['wt']>0 && $_POST['wtg']>0 && $_POST['ht']>0 )  {
    $query = "UPDATE profil SET
    age = ".mysqli_real_escape_string($link, $_POST['age']).",
    wt = ".mysqli_real_escape_string($link, $_POST['wt']).",
    wtg = ".mysqli_real_escape_string($link, $_POST['wtg']).",
    ht = ".mysqli_real_escape_string($link, $_POST['ht'])." 
    WHERE id =" . mysqli_real_escape_string($link, $_SESSION['id']) . ";";
    echo $query;
    mysqli_query($link, $query);
    header("Location: main.php");
    }
    else {$_SESSION['error'] = "wrong input"; header("Location: main.php");}
}



?> 