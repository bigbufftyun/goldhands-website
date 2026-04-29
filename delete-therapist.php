<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

if(isset($_GET['therapistID'])) {
	$therapistID = $_GET['therapistID'];

	$query = "DELETE FROM Therapists WHERE therapist_id = '{$therapistID}'";
	runQuery($query);
}

header("Location: manage-therapist.php");
exit();
?>
