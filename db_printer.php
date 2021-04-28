<?php session_start()?>
<!DOCTYPE html>
<html>
    <head>
        <title>Telefonkönyv</title>
        <link href="bootstrap.css" rel="stylesheet" type="text/css" />
    <body>
<?php
include 'db.php';
$link=open_db();
$query = "SELECT *  FROM profil p ";
$query .=" inner join profil_has_meal h on p.id = h.profil_id";
$query .=" inner join meal m on m.id = h.meal_id";
$eredmeny = mysqli_query($link, $query);
?>
        
<div class="container d-flex justify-content-start">
    <div class="flex-fill">
<!--       $no_rows = mysqli_num_rows($eredmeny);
        for ($i=0; $i < $no_rows; $i++) { 
            $row = mysqli_fetch_array($eredmeny);
            if ( $last_id != $row['id']){
                echo "</table><table class=\"table table-hover table-bordered\" >";

            }
        }

    -->
<form action="db_printer.php" method="post">
    <input type="text" name="" id=""></input>
</form>
<?php 
$profils = mysqli_query($link, "SELECT *  FROM profil p ");
foreach ($profils as $profil) {
    $meals = mysqli_query($link, "SELECT *  FROM profil p  inner join profil_has_meal h on p.id = h.profil_id  inner join meal m on m.id = h.meal_id");
    echo "<table class=\"table  table-bordered\"><tr>";
    echo "  <thead>
    <th scope=\"col\">ID</th>
    <th scope=\"col\">username</th>
    <th scope=\"col\">password</th>
    <th scope=\"col\">age</th>
    <th scope=\"col\">weight(kg)</th>
    <th scope=\"col\">weightgoal(kg)</th>
    <th scope=\"col\">height</th>
    <th scope=\"col\">male/female</th></thead>";
    echo "<tbody>
    <tr>
    <td>{$profil['id']}</td>
    <td>{$profil['usr']}</td>
    <td>{$profil['psw']}</td>
    <td>{$profil['age']}</td>
    <td>{$profil['wt']}</td>
    <td>{$profil['wtg']}</td>
    <td>{$profil['ht']}</td>
    <td>{$profil['g']}</td>
    </tr><tr><td  colspan=\"8\">";
    echo "<table class=\"table table-hover table-bordered  mb-0\"><tr>";
    echo "<thead>
    <th scope=\"col\">fogás</th>
    <th scope=\"col\">tömeg</th>
    <th scope=\"col\">dátum</th>
    <th scope=\"col\">étkezés</th>
    <th scope=\"col\">protein</th>
    <th scope=\"col\">szénhidrát</th>
    <th scope=\"col\">zsír</th>
    <th scope=\"col\">alter</th></thead><tbody>";
    foreach ($meals as $meal) {
    echo "
    <tr>
    <form action=\"db_printer.php\" method=\"get\">
    <td><textarea class=\"form-control\" name=\"name\" id=\"exampleFormControlTextarea1\" rows=\"1\">{$meal['name']}</textarea></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['gr']}\"name=\"gr\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['date']}\"name=\"date\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['blds_id']}\"name=\"blds_id\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['prot']}\"name=\"prot\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['carb']}\"name=\"carb\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['fat']}\"name=\"fat\" id=\"\"></input></td>
    <td style=\"width: 100px; white-space: nowrap \"><button type=\"submit\" class=\"btn btn-primary\">Submit</button>  <a href=\"db_printer.php?id={$meal['id']}&cmd=del\" class=\"btn btn-danger\">Delete</a></td>
    </form>
    </tr><tr>";
    }
    echo "</td></tr></tbody></table>   ";
    echo "</tr></tbody></table>   ";
}

/*
all profil row
for each profil row
all meal row 

formokkal

*/
?>

  
        </div>
</div>

<?php mysqli_close($link)?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>

    </body>
</html>

