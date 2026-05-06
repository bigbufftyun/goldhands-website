<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Edit Patient</title>
</head>

<?php
require_once("dbhelper.php");
session_start();

/* Admin security check */
if(!isset($_SESSION['aEmail'])) {
	header("Location: index.php");
	exit();
}

/* Get patient ID from GET or POST */
if(!isset($_GET['patientID']) && !isset($_POST['patientID'])) {
	header("Location: a-health-records.php");
	exit();
}

if(isset($_GET['patientID'])) {
	$patientID = $_GET['patientID'];
} else {
	$patientID = $_POST['patientID'];
}

/* Save changes */
if(isset($_POST['submit'])) {
	$pFName = $_POST['pFName'];
	$pLName = $_POST['pLName'];
	$pEmail = $_POST['pEmail'];
	$pPhone = $_POST['pPhone'];
	$pStreet = $_POST['pStreet'];
	$pCity = $_POST['pCity'];
	$pState = $_POST['pState'];
	$pZipcode = $_POST['pZipcode'];

	$query = "UPDATE Patients
			  SET patient_fname = '{$pFName}',
				  patient_lname = '{$pLName}',
				  p_email = '{$pEmail}',
				  p_phone = '{$pPhone}',
				  p_street = '{$pStreet}',
				  p_city = '{$pCity}',
				  p_state = '{$pState}',
				  p_zipcode = '{$pZipcode}'
			  WHERE patient_id = '{$patientID}'";

	runQuery($query);

	header("Location: a-health-records.php");
	exit();
}

/* Pull patient info */
$query = "SELECT * FROM Patients WHERE patient_id = '{$patientID}'";
$patient = getOneRow($query);
?>

<body>
	<?php require_once('navbar.php'); ?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>

			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Edit Patient</h1>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						Patient Account Information
					</div>

					<div class="card-body">
						<?php if($patient) { ?>
							<form action="admin-edit-patient.php" method="POST">

								<input type="hidden" name="patientID" value="<?php echo $patient['patient_id']; ?>">

								<div class="form-group row">
									<div class="col-6">
										<label>First Name</label>
										<input class="form-control" type="text" name="pFName" value="<?php echo $patient['patient_fname']; ?>" required>
									</div>

									<div class="col-6">
										<label>Last Name</label>
										<input class="form-control" type="text" name="pLName" value="<?php echo $patient['patient_lname']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-6">
										<label>Email</label>
										<input class="form-control" type="email" name="pEmail" value="<?php echo $patient['p_email']; ?>" required>
									</div>

									<div class="col-6">
										<label>Phone Number</label>
										<input class="form-control" type="text" name="pPhone" value="<?php echo $patient['p_phone']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-8">
										<label>Street Address</label>
										<input class="form-control" type="text" name="pStreet" value="<?php echo $patient['p_street']; ?>" required>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-4">
										<label>City</label>
										<input class="form-control" type="text" name="pCity" value="<?php echo $patient['p_city']; ?>" required>
									</div>

									<div class="col-4">
										<label>State</label>
										<input class="form-control" type="text" name="pState" value="<?php echo $patient['p_state']; ?>" required>
									</div>

									<div class="col-4">
										<label>Zipcode</label>
										<input class="form-control" type="text" name="pZipcode" value="<?php echo $patient['p_zipcode']; ?>" required>
									</div>
								</div>

								<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
								<a href="a-health-records.php" class="btn btn-secondary">Cancel</a>

							</form>
						<?php } else { ?>
							<p>Patient not found.</p>
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/3oU9A1qF6pczW2Z4NfEXwkZjy7I9OyaMvB4ZqQp" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>