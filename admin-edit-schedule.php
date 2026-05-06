<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['aEmail'])) {
	header("Location: index.php");
	exit();
}

if(!isset($_GET['appointmentID']) && !isset($_POST['appointmentID'])) {
	header("Location: index.php");
	exit();
}

$appointmentID = isset($_GET['appointmentID']) ? $_GET['appointmentID'] : $_POST['appointmentID'];

if(isset($_POST['submit'])) {
	$appStart = $_POST['appStart'];
	$appEnd = $_POST['appEnd'];
	$appDate = $_POST['appDate'];
	$patientID = $_POST['patientID'];
	$therapistID = $_POST['therapistID'];
	$serviceID = $_POST['serviceID'];
	$status = $_POST['status'];

	$query = "UPDATE AppointmentDetails
			  SET app_start = '{$appStart}',
				  app_end = '{$appEnd}',
				  appointment_date = '{$appDate}',
				  patient_id = '{$patientID}',
				  therapist_id = '{$therapistID}',
				  service_id = '{$serviceID}',
				  status = '{$status}'
			  WHERE appointment_id = '{$appointmentID}'";

	runQuery($query);

	header("Location: manage-schedule.php?adminID=1");
	exit();
}

$query = "SELECT * FROM AppointmentDetails WHERE appointment_id = '{$appointmentID}'";
$appointment = getOneRow($query);

$patients = getRows("SELECT * FROM Patients");
$therapists = getRows("SELECT * FROM Therapists");
$services = getRows("SELECT * FROM ServiceDetails");
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Edit Schedule</title>
</head>

<body>
<?php require_once('navbar.php'); ?>

<div class="container-fluid">
	<div class="row">
		<?php require_once("patient_nav.php")?>

		<div class="col-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Edit Appointment</h1>
				</div>
			</div>

			<div class="card">
				<div class="card-header">Appointment Information</div>

				<div class="card-body">
					<?php if($appointment) { ?>
					<form action="edit-schedule.php" method="POST">

						<input type="hidden" name="appointmentID" value="<?php echo $appointment['appointment_id']; ?>">

						<div class="form-group row">
							<div class="col-4">
								<label>Start Time</label>
								<input class="form-control" type="time" name="appStart" value="<?php echo $appointment['app_start']; ?>" required>
							</div>

							<div class="col-4">
								<label>End Time</label>
								<input class="form-control" type="time" name="appEnd" value="<?php echo $appointment['app_end']; ?>" required>
							</div>

							<div class="col-4">
								<label>Date</label>
								<input class="form-control" type="date" name="appDate" value="<?php echo $appointment['appointment_date']; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-4">
								<label>Patient</label>
								<select class="form-control" name="patientID">
									<?php
									foreach($patients as $patient) {
										$selected = "";
										if($appointment['patient_id'] == $patient['patient_id']) {
											$selected = "selected";
										}
										echo "<option value='{$patient['patient_id']}' {$selected}>{$patient['patient_fname']} {$patient['patient_lname']}</option>";
									}
									?>
								</select>
							</div>

							<div class="col-4">
								<label>Therapist</label>
								<select class="form-control" name="therapistID">
									<?php
									foreach($therapists as $therapist) {
										$selected = "";
										if($appointment['therapist_id'] == $therapist['therapist_id']) {
											$selected = "selected";
										}
										echo "<option value='{$therapist['therapist_id']}' {$selected}>{$therapist['therapist_fname']} {$therapist['therapist_lname']}</option>";
									}
									?>
								</select>
							</div>

							<div class="col-4">
								<label>Service</label>
								<select class="form-control" name="serviceID">
									<?php
									foreach($services as $service) {
										$selected = "";
										if($appointment['service_id'] == $service['service_id']) {
											$selected = "selected";
										}
										echo "<option value='{$service['service_id']}' {$selected}>{$service['service_name']}</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-4">
								<label>Status</label>
								<select class="form-control" name="status">
									<option value="Scheduled" <?php if($appointment['status'] == 'Scheduled') echo 'selected'; ?>>Scheduled</option>
									<option value="Completed" <?php if($appointment['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
									<option value="Cancelled" <?php if($appointment['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
									<option value="No-show" <?php if($appointment['status'] == 'No-show') echo 'selected'; ?>>No-show</option>
								</select>
							</div>
						</div>

						<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
						<a href="manage-schedule.php?adminID=1" class="btn btn-secondary">Cancel</a>

					</form>
					<?php } else { ?>
						<p>Appointment not found.</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
