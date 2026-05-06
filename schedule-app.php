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

	<title>Schedule Appointment</title>
</head>
<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['pID'])) {
	header("Location: index.php");
}

$pID = $_SESSION['pID'];


$query1 = "SELECT * FROM ServiceDetails";
$services = getRows($query1);



?>
<body>
	<?php require_once("navbar.php")?>
	
	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Book an Appointment</h1>
					</div>
				</div>
				<form action="schedule-app.php" method="POST">
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="inputState">Select a Service</label>
							<select id="inputState" class="form-control" name="service">
								<?php
								foreach($services as $service) {
									$selected = "";
									if($appointments['service_id'] == $service['service_id']) {
										$selected = "selected";
									}
									echo "<option value='{$service['service_id']}' {$selected}>{$service['service_name']}</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" name="find-app" class="btn btn-primary btn-sm" style="height: 30px; position: relative; top: 25px;">Find Appointments</button>
					</div>

				</form>
				<?php
				if(isset($_POST['find-app'])) {
					$service = $_POST['service'];

					$query = "SELECT *, ServiceDetails.service_name, ServiceDetails.service_id FROM AppointmentDetails LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id LEFT JOIN Therapists ON AppointmentDetails.therapist_id=Therapists.therapist_id WHERE status = 'Unbooked' and AppointmentDetails.service_id = {$service} ORDER BY appointment_date ASC";

					$appointments = getRows($query);

					if ($appointments) {
						echo"<div class='row'>";
						foreach ($appointments as $appointment) {
							$app_date = $appointment['appointment_date'];
							$start_time = $appointment['app_start'];
							$end_time = $appointment['app_end'];
							$app_id = $appointment['appointment_id'];


							echo"<div class='col-md-3 mb-4'>";
							echo"<div class='card text-center'>";
							echo"<div class='card-body'>";
							echo"<h5 class='card-title'>{$appointment['therapist_fname']} {$appointment['therapist_lname']}</h5>";
							echo"<h6>".date('F j, Y', strtotime($app_date))."</h6>";
							echo"<h6>".date('g:i A', strtotime($start_time))." - ".date('g:i A', strtotime($end_time))."</h6>";
							echo"<a href='process-schedule-app.php?appID={$appointment['appointment_id']}' class='btn btn-primary btn-sm' >Book Appointment</a>";
							echo"</div>";
							echo"</div>";
							echo"</div>";
						}
					}
					echo"</div>";
				} else {
					echo"<p>Currently no available appointments.</p>";
				}
				?>
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