<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<!-- Custom External CSS -->
	<link rel="stylesheet" type="text/css" href=style.css>

	<title>Schedule Management</title>
</head>
<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['tID'])) {
	header("Location: index.php");
}
$tID = $_SESSION['tID'];

$query = "SELECT * FROM AppointmentDetails LEFT JOIN Patients ON AppointmentDetails.patient_id=Patients.patient_id LEFT JOIN Therapists ON AppointmentDetails.therapist_id=Therapists.therapist_id LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id WHERE appointment_date >= CURDATE() and Therapists.therapist_id = {$tID} and status != 'Unbooked' ORDER BY appointment_date, app_start ASC";
$records = getRows($query);

$query1 = "SELECT * FROM AppointmentDetails LEFT JOIN Patients ON AppointmentDetails.patient_id=Patients.patient_id LEFT JOIN Therapists ON AppointmentDetails.therapist_id=Therapists.therapist_id LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id WHERE appointment_date >= CURDATE() and Therapists.therapist_id = {$tID} and status = 'Unbooked' ORDER BY appointment_date, app_start ASC";
$records1 = getRows($query1);


$query3 = "SELECT * FROM Therapists WHERE therapist_id = {$tID}";
$records3 = getOneRow($query3);


?>
<body>
	<?php require_once('navbar.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Schedule Management</h1>
					</div>
				</div>
				<div class="card-header">
					Create Appointment Slot
				</div>
				<div class="card card-body">
					<form action="t-schedule-mgmt.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="timeInput" class="form-label">Start Time</label>
								<input type="time" class="form-control" id="timeInput" name="schStart">
							</div>
							<div class="form-group col-md-4">
								<label for="timeInput" class="form-label">End Time</label>
								<input type="time" class="form-control" id="timeInput" name="schEnd">
							</div>
							<div class="form-group col-md-4">
								<label for="dateInput" class="form-label">Date</label>
								<input type="date" class="form-control" id="dateInput" min="2026-04-26" name="schDate">
							</div>
						</div>


						<button type="submit" name='add-app' class="btn btn-primary btn-sm">Submit</button>

					</form>

					<?php
					if(isset($_POST['add-app'])) {

						$scStart = $_POST['schStart'];
						$scEnd = $_POST['schEnd'];
						$scDate = $_POST['schDate'];
						$scSpec = $records3['service_id'];
						$scStat = 'Unbooked';
						$pay = 'Unpaid';


						$queryform = "INSERT INTO AppointmentDetails (app_start, app_end, appointment_date, therapist_id, service_id, status, paid) VALUES ('{$scStart}','{$scEnd}','{$scDate}','{$tID}','{$scSpec}','{$scStat}', '{$pay}');";

						runQuery($queryform);

						header("Location: t-schedule-mgmt.php");

						echo "<p>Successfully added new appointment.</p>";
					}
					?>

				</div>



				<div class="card-body">
					<p class="card-text">
						<form>
							<div class="form-group row">
								<div class="col">
									<div class="card-header">
										Booked Appointments
									</div>
									<table class="table table-bordered table-sm">
										<thead>
											<tr>
												<th>Date</th>
												<th>Time</th>
												<th>Patient Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if ($records) {
												foreach($records as $record) {
													$app_date = $record['appointment_date'];
													$start_time = $record['app_start'];
													$end_time = $record['app_end'];

													echo"<tr>";
													echo"<td>".date('F j, Y', strtotime($app_date))."</td>";
													echo"<td>".date('g:i A', strtotime($start_time))." - ".date('g:i A', strtotime($end_time))."</td>";
													echo"<td>{$record['patient_fname']} {$record['patient_lname']}</td>";
													echo"<td><button type='button' class='btn btn-primary btn-sm'>Delete</button></td>";
													echo"</tr>";

												}
											} else {
												echo"<tr>";
												echo "<td colspan='6'>No scheduled appointments found.</td>";
												echo"</tr>";
											}
											?>
										</tbody>	
									</table>
								</div>
							</div>
						</form>
					</p>
				</div>


				<div class="card-body">
					<p class="card-text">
						<form>
							<div class="form-group row">
								<div class="col">
									<div class="card-header">
										Unbooked Appointments
									</div>
									<table class="table table-bordered table-sm">
										<thead>
											<tr>
												<th>Date</th>
												<th>Time</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if ($records1) {
												foreach($records1 as $record1) {
													$app_date1 = $record1['appointment_date'];
													$start_time1 = $record1['app_start'];
													$end_time1 = $record1['app_end'];

													echo"<tr>";
													echo"<td>".date('F j, Y', strtotime($app_date1))."</td>";
													echo"<td>".date('g:i A', strtotime($start_time1))." - ".date('g:i A', strtotime($end_time1))."</td>";
													echo"<td><button type='button' class='btn btn-primary btn-sm'>Edit</button><button type='button' class='btn btn-primary btn-sm'>Delete</button></td>";
													echo"</tr>";

												}
											} else {
												echo"<tr>";
												echo "<td colspan='6'>No scheduled appointments found.</td>";
												echo"</tr>";
											}
											?>
										</tbody>	
									</table>
								</div>
							</div>
						</form>
					</p>
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