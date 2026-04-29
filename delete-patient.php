<?php
require_once("dbhelper.php");
session_start();

// Security check (only admin can delete)
if(!isset($_SESSION['accessLevel']) || $_SESSION['accessLevel'] != 3) {
    header("Location: index.php");
    exit();
}

// Check if patientID is passed
if(isset($_GET['patientID'])) {

    $patientID = $_GET['patientID'];

    // DELETE query
    $query = "DELETE FROM Patients WHERE patient_id = '{$patientID}'";

    runQuery($query);

    // Redirect back after delete
    header("Location: a-health-records.php");
    exit();

} else {
    // If no ID passed
    header("Location: a-health-records.php");
    exit();
}
?>
