<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">

	<!-- Custom External CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Manage Schedules</title>
</head>

<?php
require_once("dbhelper.php");
session_start();

/* ✅ FIXED: match working pages */
if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

/* safe adminID */
$aID = 1;
if(isset($_GET['adminID'])) {
	$aID = $_GET['adminID'];
}

/* ADD APPOINTMENT */
if(isset($_POST['add-app'])) {

	$scStart = $_POST['schStart'];
	$scEnd = $_POST['schEnd'];
	$scDate = $_POST['schDate'];
	$scP = $_POST['schPName'];
	$scT = $_POST['schTName'];
	$scSpec = $_POST['schTSpecial'];
	$scStat = $_POST['schStatus'];

	$queryform = "INSERT INTO AppointmentDetails 
	(app_start, app_end, appointment_date, patient_id, therapist_id, service_id, status) 
	VALUES ('{$scStart}','{$scEnd}','{$scDate}','{$scP}','{$scT}','{$scSpec}','{$scStat}')";

	runQuery($queryform);

	header("Location: manage-schedule.php");
	exit();
}

/* GET DATA */
$query = "SELECT * FROM AppointmentDetails 
LEFT JOIN Patients ON AppointmentDetails.patient_id=Patients.patient_id 
LEFT JOIN Therapists ON AppointmentDetails.therapist_id=Therapists.therapist_id 
LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id";

$records = getRows($query);

$records1 = getRows("SELECT * FROM ServiceDetails");
$records2 = getRows("SELECT * FROM Patients");
$records3 = getRows("SELECT * FROM Therapists");
?>

<body>
<?php require_once('navbar.php'); ?>

<div class="container-fluid">
	<div class="row">
		<?php require_once("patient_nav.php")?>

		<div class="col-10">

			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Manage Schedules</h1>
				</div>
			</div>

			<div class="card">
				<div class="card-header">Current Schedule</div>

				<div class="card-body">
					<table class="table table-bordered table-sm">

						<thead>
							<tr>
								<th>Time Start</th>
								<th>Time End</th>
								<th>Date</th>
								<th>Patient</th>
								<th>Therapist</th>
								<th>Service</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
						<?php
						if ($records) {
							foreach($records as $record) {

								echo "<tr>";
								echo "<td>{$record['app_start']}</td>";
								echo "<td>{$record['app_end']}</td>";
								echo "<td>{$record['appointment_date']}</td>";
								echo "<td>{$record['patient_fname']}</td>";
								echo "<td>{$record['therapist_fname']}</td>";
								echo "<td>{$record['service_name']}</td>";
								echo "<td>{$record['status']}</td>";

								echo "<td>
									<a href='edit-schedule.php?appointmentID={$record['appointment_id']}' class='btn btn-primary btn-sm'>EDIT</a>

									<a href='delete-schedule.php?appointmentID={$record['appointment_id']}'
									   class='btn btn-warning btn-sm'
									   onclick=\"return confirm('Cancel this appointment?');\">
									   CANCEL
									</a>
								</td>";

								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='8'>No appointments found.</td></tr>";
						}
						?>
						</tbody>

					</table>

					<button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample">
						Add Appointment
					</button>
				</div>
			</div>

			<!-- ADD FORM -->
			<div class="collapse" id="collapseExample">
				<div class="card card-body">

					<form action="manage-schedule.php" method="POST">

						<div class="form-row">
							<div class="col-3">
								<label>Start</label>
								<input type="time" class="form-control" name="schStart" required>
							</div>

							<div class="col-3">
								<label>End</label>
								<input type="time" class="form-control" name="schEnd" required>
							</div>

							<div class="col-3">
								<label>Date</label>
								<input type="date" class="form-control" name="schDate" required>
							</div>

							<div class="col-3">
								<label>Status</label>
								<select class="form-control" name="schStatus">
									<option value="Scheduled">Scheduled</option>
								</select>
							</div>
						</div>

						<br>

						<div class="form-row">
							<div class="col-4">
								<label>Patient</label>
								<select class="form-control" name="schPName">
									<?php
									foreach($records2 as $p) {
										echo "<option value='{$p['patient_id']}'>{$p['patient_fname']} {$p['patient_lname']}</option>";
									}
									?>
								</select>
							</div>

							<div class="col-4">
								<label>Therapist</label>
								<select class="form-control" name="schTName">
									<?php
									foreach($records3 as $t) {
										echo "<option value='{$t['therapist_id']}'>{$t['therapist_fname']} {$t['therapist_lname']}</option>";
									}
									?>
								</select>
							</div>

							<div class="col-4">
								<label>Service</label>
								<select class="form-control" name="schTSpecial">
									<?php
									foreach($records1 as $s) {
										echo "<option value='{$s['service_id']}'>{$s['service_name']}</option>";
									}
									?>
								</select>
							</div>
						</div>

						<br>

						<button type="submit" name="add-app" class="btn btn-primary btn-sm">Submit</button>

					</form>

				</div>
			</div>

		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
