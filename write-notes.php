<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Edit Notes</title>
</head>

<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['tID'])) {
	header("Location: app-details.php");
}

if(!isset($_GET['appID']) && !isset($_POST['appID'])) {
	header("Location: app-details.php");
}

if(isset($_GET['appID'])) {
	$appID = $_GET['appID'];
} else {
	$appID = $_POST['appID'];
}

$tID = $_SESSION['tID'];

$query = "SELECT *, Patients.patient_fname, Patients.patient_lname, ServiceDetails.service_name FROM AppointmentDetails LEFT JOIN Patients ON AppointmentDetails.patient_id=Patients.patient_id LEFT JOIN ServiceDetails ON ServiceDetails.service_id=AppointmentDetails.service_id WHERE appointment_id = {$appID}";
$apps = getOneRow($query);

if ($apps['therapist_id'] != $_SESSION['tID']) {
	header("Location: app-details.php");
}

if(isset($_POST['submit'])) {
	$note = $_POST['patient-note'];

	$upquery = "UPDATE AppointmentDetails SET app_notes = '{$note}' WHERE appointment_id = '{$appID}'";
	runQuery($upquery);

	header("Location: app-details.php");

}
?>
<body>
	<?php require_once('navbar.php'); ?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>

			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Edit Notes</h1>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						Appointment Note
					</div>
					<div class="card-body">
						<?php if($apps) { ?>
							<form action="write-notes.php" method="POST">
								<input type="hidden" name="appID" value="<?php echo $apps['appointment_id']; ?>">
								<div class="form-group row">
									<div class="col-12">
										<label><?php echo $apps['service_name']; ?> on <?php echo date('F j, Y', strtotime($apps['appointment_date'])); ?></label>
										<p>Notes for <?php echo $apps['patient_fname']; ?> <?php echo $apps['patient_lname']; ?></p>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-12">
										<label>Notes</label>
										<textarea class="form-control" name="patient-note" rows="5" required><?php echo $apps['app_notes']; ?></textarea>
									</div>
								</div>


								<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
								<a href="app-details.php" class="btn btn-secondary">Cancel</a>

							</form>
						<?php } else { ?>
							<p>Patient notes not found.</p>
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>
		<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	-->
</body>
</html>