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

	<title>Manage Schedules</title>
</head>
<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['aEmail']) OR !isset($_GET['adminID'])) {
	header("Location: index.php");
	exit();
}

$aID = $_GET['adminID'];

$query = "SELECT * FROM AppointmentDetails 
LEFT JOIN Patients ON AppointmentDetails.patient_id=Patients.patient_id 
LEFT JOIN Therapists ON AppointmentDetails.therapist_id=Therapists.therapist_id 
LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id";

$records = getRows($query);

$query1 = "SELECT * FROM ServiceDetails";
$records1 = getRows($query1);

$query2 = "SELECT * FROM Patients";
$records2 = getRows($query2);

$query3 = "SELECT * FROM Therapists";
$records3 = getRows($query3);
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
					<div class="card-header">
						Current Schedule
					</div>

					<div class="card-body">
						<p class="card-text">
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Time Start</th>
													<th>Time End</th>
													<th>Date</th>
													<th>Patient Name</th>
													<th>Therapist Name</th>
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

														// Dynamic action buttons
														echo "<td>
															<a href='edit-schedule.php?appointmentID={$record['appointment_id']}' class='btn btn-primary btn-sm'>EDIT</a>

															<a href='delete-schedule.php?appointmentID={$record['appointment_id']}'
															   class='btn btn-warning btn-sm'
															   onclick=\"return confirm('Are you sure you want to cancel this appointment?');\">
															   CANCEL
															</a>
														</td>";

														echo "</tr>";
													}
												} else {
													echo "<tr><td colspan='8'>No scheduled appointments found.</td></tr>";
												}
												?>
											</tbody>	
										</table>
									</div>
								</div>

								<p>
									<button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
										Add Service
									</button>
								</p>
							</form>
						</p>
					</div>
				</div>

				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form action="manage-schedule.php?adminID=<?php echo $aID; ?>" method="POST">
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="timeInput" class="form-label">Select Start Time</label>
									<input type="time" class="form-control" id="timeInput" name="schStart">
								</div>

								<div class="form-group col-md-3">
									<label for="timeInput" class="form-label">Select End Time</label>
									<input type="time" class="form-control" id="timeInput" name="schEnd">
								</div>

								<div class="form-group col-md-3">
									<label for="dateInput" class="form-label">Select Date</label>
									<input type="date" class="form-control" id="dateInput" min="2026-04-26" name="schDate">
								</div>

								<div class="form-group col-md-3">
									<label for="inputState">Status</label>
									<select id="inputState" class="form-control" name="schStatus">
										<option selected value="Scheduled">Scheduled</option>
									</select>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="inputState">Patient Name</label>
									
									<?php 
									echo "<select id='inputState' class='form-control' name='schPName'>";
									foreach($records2 as $record2) {
										$pID = $record2['patient_id'];
										$pFName = $record2['patient_fname'];
										$pLName = $record2['patient_lname'];

										echo "<option value='".$pID."'>".$pFName." ".$pLName."</option>";
									}
									echo "</select>";
									?>
								</div>

								<div class="form-group col-md-4">
									<label for="inputState">Therapist Name</label>

									<?php 
									echo "<select id='inputState' class='form-control' name='schTName'>";
									foreach($records3 as $record3) {
										$tID = $record3['therapist_id'];
										$tFName = $record3['therapist_fname'];
										$tLName = $record3['therapist_lname'];

										echo "<option value='".$tID."'>".$tFName." ".$tLName."</option>";
									}
									echo "</select>";
									?>
								</div>

								<div class="form-group col-md-4">
									<label for="inputState">Specialty</label>

									<?php 
									echo "<select id='inputState' class='form-control' name='schTSpecial'>";
									foreach($records1 as $record1) {
										$sSpecial = $record1['service_name'];
										$sID = $record1['service_id'];

										echo "<option value='".$sID."'>".$sSpecial."</option>";
									}
									echo "</select>";
									?>
								</div>
							</div>

							<button type="submit" name="add-app" class="btn btn-primary btn-sm">Submit</button>
						</form>

						<?php
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
							VALUES ('{$scStart}','{$scEnd}','{$scDate}','{$scP}','{$scT}','{$scSpec}','{$scStat}');";

							runQuery($queryform);

							header("Location: manage-schedule.php?adminID={$aID}");
							exit();
						}
						?>
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
