<?php
require_once("dbhelper.php");
session_start();

if(isset($_GET['appID'])) {

	$app_id = $_GET['appID'];
	$pID = $_SESSION['pID'];

	$query = "UPDATE AppointmentDetails SET patient_id='{$pID}', status='Booked' WHERE appointment_id='{$app_id}'";

	runQuery($query);

	header("Location: payments.php");

} else {
	header("Location: schedule-app.php");
	echo "<p>Did not book appointment.</p>";
}
?>