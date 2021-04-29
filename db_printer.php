<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
    <title>Telefonkönyv</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css" />
    <body class="bg-primary text-light">
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
					<li class="nav-item">
						<a class="nav-link" href="#">Új étel</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Új étkezés
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=reggeli">Reggeli</a></li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=ebed">Ebéd</a></li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=vacsora">Vacsora</a></li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=nasi">Nasi</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="#">Új fogás</a></li>
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
<?php
include 'db.php';
$link=open_db();


if(isset($_REQUEST) AND isset($_REQUEST['del']) AND $_REQUEST['del']=='profil'){
    mysqli_query($link, "DELETE FROM profil_has_meal h WHERE profil_id =".mysqli_real_escape_string($link, $_REQUEST['id']).";");
    mysqli_query($link, "DELETE FROM profil WHERE id = ".mysqli_real_escape_string($link, $_REQUEST['id']).";");
    header("Location: db_printer.php");
}
else if(isset($_REQUEST) AND isset($_REQUEST['del']) AND $_REQUEST['del']=='meal'){

    mysqli_query($link, "DELETE FROM profil_has_meal WHERE meal_id = ".mysqli_real_escape_string($link, $_REQUEST['id']).";");
    mysqli_query($link, "DELETE FROM meal WHERE id = ".mysqli_real_escape_string($link, $_REQUEST['id']).";");
    header("Location: db_printer.php");    
}
else if(isset($_POST) AND isset($_POST['psw'])){
    $query=  "UPDATE profil SET 
    usr = '".mysqli_real_escape_string($link, $_POST['usr'])."',
    psw = '".mysqli_real_escape_string($link, $_POST['psw'])."',
    age = '".mysqli_real_escape_string($link, $_POST['age'])."',
    wtg = '".mysqli_real_escape_string($link, $_POST['wtg'])."',
    wt = '".mysqli_real_escape_string($link, $_POST['wt'])."',
    ht = '".mysqli_real_escape_string($link, $_POST['ht'])."',
    g = '".mysqli_real_escape_string($link, $_POST['g'])."'
    WHERE id =".mysqli_real_escape_string($link, $_POST['id']).";";
    mysqli_query($link, $query);
}
else if(isset($_POST) AND isset($_POST['date'])){
    $query=  "UPDATE meal SET 
    name = '".mysqli_real_escape_string($link, $_POST['name'])."',
    prot = '".mysqli_real_escape_string($link, $_POST['prot'])."',
    carb = '".mysqli_real_escape_string($link, $_POST['carb'])."',
    fat = '".mysqli_real_escape_string($link, $_POST['fat'])."'
    WHERE id =".mysqli_real_escape_string($link, $_POST['id']).";";
    mysqli_query($link, $query);
    $query=  "UPDATE profil_has_meal SET 
    gr = '".mysqli_real_escape_string($link, $_POST['gr'])."',
    date = '".date('Y-m-d', strtotime(mysqli_real_escape_string($link, $_POST['date'])))."',
    blds_id = '".mysqli_real_escape_string($link, $_POST['blds_id'])."'
    WHERE hid =".mysqli_real_escape_string($link, $_POST['hid']).";";
    mysqli_query($link, $query);
    header("Location: db_printer.php");    
}
?>

<div class="container d-flex">
<div class="flex-fill mt-4">

<?php 
$profils = mysqli_query($link, "SELECT *  FROM profil p");
foreach ($profils as $profil) {
    $meals = mysqli_query($link, "SELECT *  FROM profil p  inner join profil_has_meal h on p.id = h.profil_id  inner join meal m on m.id = h.meal_id WHERE p.id = {$profil['id']};");
    echo "<table class=\"table table-dark table-bordered\"><tr>";
    echo "  <thead>
    <th scope=\"col\">ID</th>
    <th scope=\"col\">username</th>
    <th scope=\"col\">password</th>
    <th scope=\"col\">age</th>
    <th scope=\"col\">weight(kg)</th>
    <th scope=\"col\">weightgoal(kg)</th>
    <th scope=\"col\">height</th>
    <th scope=\"col\">male/female</th>
    <th scope=\"col\">alter</th></thead>";
    echo "<tbody>
    <tr>
    <form action=\"db_printer.php\" method=\"post\">
    <td>{$profil['id']}</td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['usr']}\" name=\"usr\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['psw']}\" name=\"psw\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['age']}\" name=\"age\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['wt']}\" name=\"wt\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['wtg']}\" name=\"wtg\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['ht']}\" name=\"ht\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$profil['g']}\" name=\"g\"></input></td>
    <td style=\"width: 100px; white-space: nowrap \">
    <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$profil['id']}\" name=\"id\" ></input>
    <a href=\"db_printer.php?id={$profil['id']}&del=profil\" class=\"btn btn-danger\">Delete</a></td>
    </form>
    </tr><tr><td  colspan=\"9\">";
    echo "<table class=\"table table-dark table-bordered  mb-0\"><tr>";
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
    <form action=\"db_printer.php\" method=\"post\">
    <td><textarea class=\"form-control\" name=\"name\" id=\"exampleFormControlTextarea1\" rows=\"1\">{$meal['name']}</textarea></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['gr']}\"name=\"gr\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['date']}\"name=\"date\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['blds_id']}\"name=\"blds_id\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['prot']}\"name=\"prot\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['carb']}\"name=\"carb\" id=\"\"></input></td>
    <td><input style=\"width: 100px\" type=\"text\" value=\"{$meal['fat']}\"name=\"fat\" id=\"\"></input></td>
    <td style=\"width: 100px; white-space: nowrap \">
    <button type=\"submit\" class=\"btn btn-primary\">Submit</button>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$meal['id']}\" name=\"id\" ></input>
    <input type=\"text\" style=\"height: 0px; width: 0px;\"class=\"invisible p-0 m-0\" value=\"{$meal['hid']}\" name=\"hid\" ></input>
    <a href=\"db_printer.php?id={$meal['id']}&del=meal\" class=\"btn btn-danger\">Delete</a>
    </td>
    </form>
    </tr><tr>";
    }
    echo "</td></tr></tbody></table>   ";
    echo "</tr></tbody></table>   ";
}
?>
</div>
</div>

<?php mysqli_close($link)?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>

    </body>
</html>

