<?php session_start();
if (isset($_SERVER) and isset($_SESSION['usr']) and $_SESSION['usr']!="speti") { $_SESSION['error']='notadmin'; header("Location: main.php");}
if (isset($_POST) and isset($_POST['table'])) $_SESSION['table'] = $_POST['table'];
?>
<!DOCTYPE html>
<html>

<head>
    <link href="bootstrap.css" rel="stylesheet" type="text/css" />

<body class="bg-primary text-light">
    <?php include 'navbar.php'    ?>

    <?php
    include 'db.php';
    $link = open_db();


    if (isset($_REQUEST) and isset($_REQUEST['del']) and $_REQUEST['del'] == 'profil') {
        mysqli_query($link, "DELETE FROM profil_has_meal h WHERE profil_id =" . mysqli_real_escape_string($link, $_REQUEST['id']) . ";");
        mysqli_query($link, "DELETE FROM profil WHERE id = " . mysqli_real_escape_string($link, $_REQUEST['id']) . ";");
    } else if (isset($_REQUEST) and isset($_REQUEST['del']) and $_REQUEST['del'] == 'meal') {

        mysqli_query($link, "DELETE FROM profil_has_meal WHERE meal_id = " . mysqli_real_escape_string($link, $_REQUEST['id']) . ";");
        mysqli_query($link, "DELETE FROM meal WHERE id = " . mysqli_real_escape_string($link, $_REQUEST['id']) . ";");
    } else if (isset($_POST) and isset($_POST['psw'])) {
        $query =  "UPDATE profil SET 
    usr = '" . mysqli_real_escape_string($link, $_POST['usr']) . "',
    psw = '" . mysqli_real_escape_string($link, $_POST['psw']) . "',
    age = '" . mysqli_real_escape_string($link, $_POST['age']) . "',
    wtg = '" . mysqli_real_escape_string($link, $_POST['wtg']) . "',
    wt = '" . mysqli_real_escape_string($link, $_POST['wt']) . "',
    ht = '" . mysqli_real_escape_string($link, $_POST['ht']) . "',
    g = '" . mysqli_real_escape_string($link, $_POST['g']) . "'
    WHERE id =" . mysqli_real_escape_string($link, $_POST['id']) . ";";
        mysqli_query($link, $query);
    } else if (isset($_POST) and isset($_POST['date'])) {
        $query =  "UPDATE meal SET 
                    name = '" . mysqli_real_escape_string($link, $_POST['name']) . "',
                    prot = '" . mysqli_real_escape_string($link, $_POST['prot']) . "',
                    carb = '" . mysqli_real_escape_string($link, $_POST['carb']) . "',
                    fat = '" . mysqli_real_escape_string($link, $_POST['fat']) . "'
                    WHERE id =" . mysqli_real_escape_string($link, $_POST['id']) . ";";

        mysqli_query($link, $query);

        $query =  "UPDATE profil_has_meal SET 
                    gr = '" . mysqli_real_escape_string($link, $_POST['gr']) . "',
                    date = '" . date('Y-m-d', strtotime(mysqli_real_escape_string($link, $_POST['date']))) . "',
                    blds_id = '" . mysqli_real_escape_string($link, $_POST['blds_id']) . "'
                    WHERE hid =" . mysqli_real_escape_string($link, $_POST['hid']) . ";";

        mysqli_query($link, $query);
    } else if (isset($_POST) and isset($_POST['prot'])) {
        $query =  "UPDATE meal SET 
                    name = '" . mysqli_real_escape_string($link, $_POST['name']) . "',
                    prot = '" . mysqli_real_escape_string($link, $_POST['prot']) . "',
                    carb = '" . mysqli_real_escape_string($link, $_POST['carb']) . "',
                    fat = '" . mysqli_real_escape_string($link, $_POST['fat']) . "'
                    WHERE id =" . mysqli_real_escape_string($link, $_POST['id']) . ";";

        mysqli_query($link, $query);
    }
    ?>


    <div class="container d-flex">
        <div class="flex-fill mt-4">
            <div class="col-5 mb-4">
                <form action="db_printer.php" method="post">
                    <select name="table" class="form-select col-3" aria-label="Default select example">
                        <option value="0">Csak profilok</option>
                        <option value="1">Csak ételek</option>
                        <option selected value="2">Fogyasztás</option>
                    </select>
                    <input type="submit" class="btn btn-dark" value="Submit">
                </form>
            </div>

            <div>
            <?php
            if (isset($_SESSION) and isset($_SESSION['table']) and $_SESSION['table'] == 0) include 'profprint.php';
            if (isset($_SESSION) and isset($_SESSION['table']) and $_SESSION['table'] == 1) include 'mealprint.php';
            if (isset($_SESSION) and isset($_SESSION['table']) and $_SESSION['table'] == 2) include 'fullprint.php';

            ?>
</div>

        </div>
    </div>

    <?php mysqli_close($link) ?>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>

</body>

</html>