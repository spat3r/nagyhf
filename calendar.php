<?php 
if( isset($_GET) AND isset($_GET['ymd']))
{
$_SESSION['ymd']=$_GET['ymd'];
header("Location: main.php");
}
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
	$week .= "<a href=\"main.php?ymd=" . $date  . "\" class=\" p-0 m-0 link-nodecor bg-transparent text-light\" style=\"text-decoration: none\">" . $day . "</a>" . '</td>';

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