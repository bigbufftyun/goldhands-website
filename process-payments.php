<?php
require_once("dbhelper.php");
session_start();

if(isset($_POST['paytotal'])) {

	$total = $_POST['totalPrice'];
	$pID = $_SESSION['pID'];
	$app_id = $_POST['appID'];


	$query = "UPDATE AppointmentDetails SET patient_id='{$pID}', status='Booked', paid='Paid' WHERE appointment_id='{$app_id}'";

	runQuery($query);

	header("Location: https://www.paypal.me/bmgt407/{$total}");

} else {
	header("Location: payments.php");
	echo "<p>did not update profile info</p>";
}
?>