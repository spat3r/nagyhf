<?php
session_start();
include 'db.php';
$link = open_db();
$meals = mysqli_query($link, "SELECT id,name, prot, carb, fat  FROM meal m;");
print_r($_GET);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Speti edzos oldala xd</title>
</head>

<body class="bg-primary text-light">
    <?php include 'navbar.php'    ?>

    <div class="container mt-4 <?php if ($error != 1) echo "visually-hidden"; ?> ">
        <div class="row justify-content-center">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Sikertelen hozzáadás, a formátum nem megfelelő
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="col-xs-10 col-md-8 col-xl-6 offset-xs-1 offset-md-2 offset-xl-3 mt-4 p-4 bg-light text-dark rounded-3 shadow-lg">
        <form action="newmeal.php" method="get">

            <div class="h3 mb-3 ">Új fogás hozzáadása </div>
            <div class="form-floating mb-3">
                <select name="meal" class="form-select" aria-label="Default select example">
                    <option <?php if (isset($_GET) and isset($_GET['meal']) and $_GET['meal'] == "reggeli") echo "selected"; ?> value="0">Reggeli</option>
                    <option <?php if (isset($_GET) and isset($_GET['meal']) and $_GET['meal'] == "ebed") echo "selected"; ?> value="1">Ebéd</option>
                    <option <?php if (isset($_GET) and isset($_GET['meal']) and $_GET['meal'] == "vacsora") echo "selected"; ?> value="2">Vacsora</option>
                    <option <?php if (isset($_GET) and isset($_GET['meal']) and $_GET['meal'] == "nasi") echo "selected"; ?> value="3">Nasi</option>
                </select>
                <label for="floatingInput">Étkezés</label>
            </div>
            <div class="row g-1 justify-content-around mb-3">
                <div class=" col-8">
                    <input class="form-control" name="date" type="date" value="<?= $_SESSION['ymd'] ?>">
                </div>
                <div class="col-3  form-floating">
                    <input value="<?php if (isset($_POST) and isset($_POST['gr'])) echo $_POST['gr']; ?>" type="text" class="form-control" name="gr" placeholder="g">
                    <label for="floatingInput">Tömeg</label>
                </div>
            </div>
            <div class="mb-3">
                <input class="form-control mb-2" id="myInput" type="text" placeholder="Search..">
                <div class="p-2 mt-1  overflow-auto" style="max-height: 300px;">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Protein</th>
                                <th>Szénhudrát</th>
                                <th>Zsírok</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">

                            <?php
                            foreach ($meals as $meal) {
                                $prot = $meal['prot'] / 10;
                                $fat = $meal['fat'] / 10;
                                $carb = $meal['carb'] / 10;
                                echo "<tr>
                                <td><input class=\"form-chack-input\" type=\"radio\" name=\"id\" value=\"{$meal['id']}\" id=\"flexCheckDefault\"></td>
                                <td>{$meal['name']}</td>
                                <td>{$prot}g</td>
                                <td>{$carb}g</td>
                                <td>{$fat}g</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

            </div>




            <button class="w-25 btn btn-lg btn-primary " type="submit">Hozzáad</button>

        </form>
    </div>

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