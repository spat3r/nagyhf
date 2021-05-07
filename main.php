<?php
session_start();

if (!isset($_SESSION) OR !isset($_SESSION['usr']))  var_dump($_SESSION);//header("Location: login.php");


if (isset($_SESSION['ymd'])) {
	$ymd = date('Y-m-j', strtotime($_SESSION['ymd']));
} else {
	// This month
	$ymd = date('Y-m-j');
	$_SESSION['ymd'] = date('Y-m-d');
}

include 'db.php';
$link = open_db();

$profile_query = " where p.usr LIKE '" . $_SESSION['usr'];
$date_query = "' AND h.date='" . $ymd . "';";
$sql_join = "FROM profil p inner join profil_has_meal h on p.id = h.profil_id inner join meal m on m.id = h.meal_id";



include 'stat.php';
include 'calendar.php';

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

<?php include 'navbar.php'	?>

	<div class="container mt-4">
		<div class="row justify-content-around">
			<div class="col-lg-7 col-xl-8 order-2 order-lg-1 mt-4" style="text-align: center; ">
				<div class="row">
					<div class="container bg-dark bg-gradient text-light rounded-3">
						<div class="row my-2">
							<div class="col-12">
								Mai Napod <br>
								<span class="m-1 badge bg-primary "> <?= round($consumed_cal) ?> kcla /<?= round($cal_daily) ?> kcal</span>

							</div>
						</div>
						<div class="row my-4" style="height: auto;">

							<div class="col-3 mt-1">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: <?= $consumed_bar ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Elfogyasztott
							</div>
							<div class="col-9  ">
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
						<h3 class="text-center"><a href="main.php?ymd=<?php echo $prev; ?>" class="btn btn-link bg-transparent ">&lt;</a> <?php echo $title; ?> <a href="main.php?ymd=<?php echo $next; ?>" class="btn btn-link bg-transparent">&gt;</a></h3>
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




