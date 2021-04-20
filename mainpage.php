<?php
session_start();
?>


<?php
// Set your timezone
date_default_timezone_set('Europe/Budapest');

// Get prev & next month
if (isset($_GET['ym'])) {
	$ym = $_GET['ym'];
} else {
	// This month
	$ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
	$ym = date('Y-m');
	$timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ($day = 1; $day <= $day_count; $day++, $str++) {

	$date = $ym . '-' . $day;

	if ($today == $date) {
		$week .= '<td class="today">' . $day;
	} else {
		$week .= '<td>' . $day;
	}
	$week .= '</td>';

	// End of the week OR End of the month
	if ($str % 7 == 6 || $day == $day_count) {

		if ($day == $day_count) {
			// Add empty cell
			$week .= str_repeat('<td></td>', 6 - ($str % 7));
		}

		$weeks[] = '<tr>' . $week . '</tr>';

		// Prepare for new week
		$week = '';
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="1000000000000">
	<link href="bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="speti.css" rel="stylesheet" type="text/css" />
	<title>Speti edzos oldala xd</title>
</head>

<body class="bg-primary text-light">
	<h1 style=" text-align: center;">Später kurvamenő gym oldal</h1>
	<nav class="navbar navbar-expand-md shadow-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="mainpage.html">Főoldal</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ">
					<a class="nav-link" href="progress.html">Fejlődés</a>
					<a class="nav-link" href="newmeal.html">Új étel</a>
					<a class="nav-link" href="shop.html">Bolt</a>
				</div>
			</div>
		</div>
	</nav>
	<div class="container mt-4">
		<div class="row justify-content-around">
			<div class="col-lg-8 order-2 order-lg-1 mt-4" style="text-align: center; ">
				<div class="row">
					<div class="container bg-dark bg-gradient text-light rounded-3">
						<div class="row my-2">
							<div class="col-12">
								Mai Napod
							</div>
						</div>
						<div class="row my-4" style="height: auto;">
							<div class="col-4 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Elfogyasztott

							</div>
							<div class="col-4 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Hátralévő

							</div>
							<div class="col-4 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Elégetett

							</div>

						</div>
						<div class="row my-4" style="height: auto;">
							<div class="col-4 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Szénhidrát

							</div>
							<div class="col-4 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Protein

							</div>
							<div class="col-4 mt-4">
								<div class="progress" style="height: 7px;">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								Zsír

							</div>
						</div>
					</div>



				</div>
				<div class="row">
					<div class="container bg-dark bg-gradient text-light rounded-3 mt-4">
						<div class="col-12 ">
							<div class="row justify-content-around ">
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute end-5 mt-2 badge bg-primary ">Reggeli</span> </div>
									<br>
									<a href="newmeal.html" class=" bg-dark stretched-link mb-2"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute end-5 mt-2 badge bg-primary ">Ebéd</span> </div>
									<br>
									<a href="newmeal.html" class=" bg-dark stretched-link mb-2"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute end-5 mt-2 badge bg-primary ">Vacsora</span> </div>
									<br>
									<a href="newmeal.html" class=" bg-dark stretched-link mb-2"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>
								<div class="col-5 col-sm-2 bg-dark rounded-5 position-relative  my-4">
									<div class="position-relative"> <span class="position-absolute end-5 mt-2 badge bg-primary ">Nasi</span> </div>
									<br>
									<a href="newmeal.html" class=" bg-dark stretched-link mb-2"><i class="fas fa-plus-circle"></i>
										<br>Add</a>
								</div>


							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 order-1 order-lg-2 mt-4 bg-dark bg-gradient text-light rounded-3">
				<h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
				<table class="table table-dark table-bordered text-center">
					<tr>
						<th>H</th>
						<th>K</th>
						<th>Sz</th>
						<th>Cs</th>
						<th>P</th>
						<th>Sz</th>
						<th>V</th>
					</tr>
					<?php foreach ($weeks as $week) {
						echo $week;
					} ?>
				</table>
			</div>
		</div>

	</div>







	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/1e7de2572e.js" crossorigin="anonymous"></script>
</body>

</html>