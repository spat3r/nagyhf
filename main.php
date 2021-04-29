<?php
session_start();
if(isset($_POST) AND isset($_POST['logout']) AND $_POST['logout']=='1'){
  session_unset();
  session_write_close();
}
if (isset($_SESSION['ymd'])) {
	$ymd = $_SESSION['ymd'];
} else {
	// This month
	$ymd = date('Y-m-j');
}

if (!isset($_SESSION['usr'])) header("Location: login.php");
include 'db.php';
$link = open_db();

$profile_query = " where p.usr LIKE '" . $_SESSION['usr'];
$date_query = "' AND h.date='" . $ymd . "';";
$sql_join = "FROM profil p inner join profil_has_meal h on p.id = h.profil_id inner join meal m on m.id = h.meal_id";

$eredmeny = mysqli_query($link, "SELECT p.age as age, p.wt as wt, p.wtg as wtg, p.ht as ht, p.g as g  FROM profil p inner join profil_has_meal h on p.id = h.profil_id WHERE p.usr LIKE '" . $_SESSION['usr'] . "' GROUP BY p.id;");
$profil = mysqli_fetch_array($eredmeny);
if ($profil['g']) {
	$cal_goal = round(13.397 * $profil['wtg']  + 4.799 * $profil['ht']  - 5.677 * $profil['age']  + 88.362);
	$cal_stag = round(13.397 * $profil['wt']  + 4.799 * $profil['ht']  - 5.677 * $profil['age']  + 88.362);
	if (($cal_goal - $cal_stag) > 200) $cal_daily = $cal_stag + 200;
	else if (($cal_stag - $cal_goal) > 200) $cal_daily = $cal_stag - 200;
	else $cal_daily = $cal_goal;
} else {
	$cal_goal = round(9.247 * $profil['wtg']  +  3.098 * $profil['ht']  - 4.330 * $profil['age']  + 447.593);
	$cal_stag = round(9.247 * $profil['wt']  +  3.098 * $profil['ht']  - 4.330 * $profil['age']  + 447.593);
	if (($cal_goal - $cal_stag) > 200) $cal_daily = $cal_stag + 200;
	else if (($cal_stag - $cal_goal) > 200) $cal_daily = $cal_stag - 200;
	else $cal_daily = $cal_goal;
}

$eredmeny = mysqli_query($link, "SELECT floor(sum(m.prot/1000*h.gr)*4+sum(m.carb/1000*h.gr)*4+sum(m.fat/1000*h.gr)*7) as cal " . $sql_join . $profile_query . $date_query);
$consumed_cal = mysqli_fetch_array($eredmeny)['cal'];
$consumed_bar = floor($consumed_cal / $cal_daily * 100);
$left_bar = 100 - $consumed_bar;

$_SESSION['prot_goal'] = $prot_goal = $cal_daily * 0.075;
$_SESSION['carb_goal'] = $carb_goal = $cal_daily * 0.125;
$_SESSION['fat_goal'] = $fat_goal = $cal_daily * 0.05;

$eredmeny = mysqli_query($link, "SELECT sum(m.prot/1000*h.gr) as prot, sum(m.carb/1000*h.gr) as carb, sum(m.fat/1000*h.gr) as fat " . $sql_join . $profile_query . $date_query);
$macros = mysqli_fetch_array($eredmeny);
$_SESSION['consumed_prot'] = $consumed_prot = round($macros['prot'] / $prot_goal * 100);
$_SESSION['consumed_carb'] = $consumed_carb = round($macros['carb'] / $carb_goal * 100);
$_SESSION['consumed_fat'] = $consumed_fat = round($macros['fat'] / $fat_goal * 100);



//		CALENDAR
// Set your timezone!!
date_default_timezone_set('Europe/Budapest');

// Check format
$timestamp = strtotime($ymd);  // selected or shifted day of the month
if ($timestamp === false) {
	$ymd = date('Y-m-j');
	$timestamp = strtotime($ymd);
}

//Generating a year-month var for the table loop
$ym = date('Y-m',  $timestamp);

// Title (Format:2021 May)
$title = date('Y F', $timestamp);

// Create prev & next month link
$prev = date('Y-m-j', strtotime('-1 month', $timestamp));
$next = date('Y-m-j', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);

// Getting de numeral representation of the day ( 1:MON ... 7:SUN)
// on the forst day of the month
$str = date('N', strtotime(date('Y-m',  $timestamp) . "-01"));

// Array for calendar
$weeks = [];
$week = '';

// Add empty cell(s)
$week .= str_repeat('<td></td>', $str - 1);


for ($day = 1; $day <= $day_count; $day++, $str++) {

	$date = $ym . '-' . $day;

	if ($ymd == $date) {
		$week .= '<td style="background: #173055">';
	} else {
		$week .= '<td>';
	}
	$week .= "<a href=\"calendar.php?ymd=" . $date  . "\" class=\" p-0 m-0 link-nodecor bg-transparent text-light\" style=\"text-decoration: none\">" . $day . "</a>" . '</td>';

	// Sunday OR last day of the month
	if ($str % 7 == 0 || $day == $day_count) {

		// last day of the month
		if ($day == $day_count && $str % 7 != 0) {
			// Add empty cell(s)
			$week .= str_repeat('<td></td>', 7 - $str % 7);
		}

		$weeks[] = '<tr>' . $week . '</tr>';

		$week = '';
	}
}

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="100000000000">
	<link href="bootstrap.css" rel="stylesheet" type="text/css" />
	<title>Speti edzos oldala xd</title>

</head>

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
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Étkezések
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=reggeli">Reggeli</a></li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=ebed">Ebéd</a></li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=vacsora">Vacsora</a></li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newmeal.php?=nasi">Nasi</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item dropdown-item-dark text-dimlight" href="newfood.php">Új fogás</a></li>
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
	<div class="container mt-4">
		<div class="row justify-content-around">
			<div class="col-lg-7 col-xl-8 order-2 order-lg-1 mt-4" style="text-align: center; ">
				<div class="row">
					<div class="container bg-dark bg-gradient text-light rounded-3">
						<div class="row my-2">
							<div class="col-12">
								Mai Napod
							</div>
						</div>
						<div class="row my-4" style="height: auto;">
							<div class="col-3 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: <?= $consumed_bar ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Elfogyasztott

							</div>
							<div class="col-9 mt-4">
								<span class="m-1 badge bg-primary "> <?= round($consumed_cal) ?> kcla /<?= round($cal_daily) ?> kcal</span>

								<div class="progress" style="height: 12px;">
									<div class="progress-bar" role="progressbar" style="width: <?= $left_bar ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Hátralévő
							</div>
						</div>
						<div class="row my-4" style="height: auto;">
							<div class="col-4 mt-4">
								<div class="progress" style="height: 10px;">
									<div class="progress-bar" role="progressbar" style="width: <?= $consumed_carb ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Szénhidrát <br>
								<span class="m-1 badge bg-primary"> <?= round($macros['carb']) ?>g /<?= round($carb_goal) ?>g</span>
							</div>
							<div class="col-4 mt-4 ">
								<div class="progress" style="height: 10px;">
									<div class="progress-bar" role="progressbar" style="width: <?= $consumed_prot ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Protein <br>
								<span class="m-1 badge bg-primary "> <?= round($macros['prot']) ?>g /<?= round($prot_goal) ?>g</span>
							</div>
							<div class="col-4 mt-4">
								<div class="progress" style="height: 10px;">
									<div class="progress-bar" role="progressbar" style="width: <?= $consumed_fat ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Zsír <br>
								<span class="m-1 badge bg-primary "> <?= round($macros['carb']) ?>g /<?= round($carb_goal) ?>g</span>
							</div>
						</div>
					</div>



				</div>
				<div class="row">
					<div class="container bg-dark bg-gradient text-light rounded-3 mt-4">
						<div class="col-12 ">
							<div class="row justify-content-around ">
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute top-0 start-100 translate-middle  badge bg-primary ">Reggeli</span> </div>
									<br>
									<a href="newmeal.php?=reggeli" class=" bg-dark text-light stretched-link mb-2" style="text-decoration: none;"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute top-0 start-100 translate-middle badge bg-primary ">Ebéd</span> </div>
									<br>
									<a href="newmeal.php?=ebed" class=" bg-dark text-light stretched-link mb-2" style="text-decoration: none;"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative my-4">
									<div class="position-relative"> <span class="position-absolute top-0 start-100 translate-middle badge bg-primary ">Vacsora</span> </div>
									<br>
									<a href="newmeal.php?=vacsora" class=" bg-dark text-light stretched-link " style="text-decoration: none;"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute top-0 start-100 translate-middle badge bg-primary ">Nasi</span> </div>
									<br>
									<a href="newmeal.php?=nasi" class=" bg-dark text-light stretched-link mb-2" style="text-decoration: none;"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>


							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-xl-3 order-1 order-lg-2 mt-4">
				<div class="row">
					<div class="bg-dark bg-gradient justify-content-around text-light rounded-3">
						<h3 class="text-center"><a href="calendar.php?ymd=<?php echo $prev; ?>" class="btn btn-link bg-transparent ">&lt;</a> <?php echo $title; ?> <a href="calendar.php?ymd=<?php echo $next; ?>" class="btn btn-link bg-transparent">&gt;</a></h3>
						<table class="table table-dark table-bordered text-center ">
							<tr>
								<th scope="col">H</th>
								<th scope="col">K</th>
								<th scope="col">Sz</th>
								<th scope="col">Cs</th>
								<th scope="col">P</th>
								<th scope="col">Sz</th>
								<th scope="col">V</th>
							</tr>
							<?php foreach ($weeks as $week) {
								echo $week;
							} ?>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>






	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>
</body>

</html>