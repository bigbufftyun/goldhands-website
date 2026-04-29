<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

if(isset($_GET['appointmentID'])) {
	$appointmentID = $_GET['appointmentID'];

	$query = "DELETE FROM AppointmentDetails WHERE appointment_id = '{$appointmentID}'";
	runQuery($query);
}

header("Location: manage-schedule.php");
exit();
?>
