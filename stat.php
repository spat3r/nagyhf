<?php 
$eredmeny = mysqli_query($link, "SELECT p.age as age, p.wt as wt, p.wtg as wtg, p.ht as ht, p.g as g  FROM profil p inner join profil_has_meal h on p.id = h.profil_id WHERE p.usr LIKE '" . $_SESSION['usr'] . "' GROUP BY p.id;");
$profil = mysqli_fetch_array($eredmeny);
print_r($_SESSION);

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
?>