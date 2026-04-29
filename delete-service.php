<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

if(isset($_GET['serviceID'])) {
	$serviceID = $_GET['serviceID'];

	$query = "DELETE FROM ServiceDetails WHERE service_id = '{$serviceID}'";
	runQuery($query);
}

header("Location: manage-service.php");
exit();
?>
