<?php
require_once("dbhelper.php");

if(isset($_POST['edit-pinfo'])) {

	$editPID = $_POST['edit-pinfo'];
	$pFirst = $_POST['pFName'];
	$pLast = $_POST['pLName'];
	$pEmail = $_POST['pEmail'];
	$pPhone = $_POST['pPhone'];
	$pStreet = $_POST['pStreet'];
	$pCity = $_POST['pCity'];
	$pState = $_POST['pState'];
	$pZip = $_POST['pZipcode'];

	$query = "UPDATE Patients SET patient_fname='{$pFirst}', patient_lname='{$pLast}', p_email ='{$pEmail}', p_phone='{$pPhone}', p_street='{$pStreet}', p_city='{$pCity}', p_state='{$pState}', p_zipcode='{$pZip}' WHERE patient_id='{$editPID}'";

	runQuery($query);

	header("Location: p-profile-settings.php?patient_id={$pID}");

} else {
	header("Location: index.php");
	echo "<p>did not update profile info</p>";
}
?>