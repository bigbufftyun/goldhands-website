<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

	<!-- Custom External CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Admin Analytics</title>
</head>

<?php
	require_once("dbhelper.php");
	session_start();

	if(!isset($_SESSION['aID'])) {
		header("Location: index.php");
	}

	// COUNTS
	$totalPatients = getOneRow("SELECT COUNT(*) AS total FROM Patients");
	$totalTherapists = getOneRow("SELECT COUNT(*) AS total FROM Therapists");
	$totalAppointments = getOneRow("SELECT COUNT(*) AS total FROM AppointmentDetails");
	$totalServices = getOneRow("SELECT COUNT(*) AS total FROM ServiceDetails");

	// RECENT APPOINTMENTS
	$query = "
	SELECT 
		AppointmentDetails.appointment_id,
		AppointmentDetails.appointment_date,
		AppointmentDetails.app_start,
		AppointmentDetails.app_end,
		AppointmentDetails.status,
		Patients.patient_fname,
		Patients.patient_lname,
		Therapists.therapist_fname,
		Therapists.therapist_lname,
		ServiceDetails.service_name
	FROM AppointmentDetails
	LEFT JOIN Patients ON AppointmentDetails.patient_id = Patients.patient_id
	LEFT JOIN Therapists ON AppointmentDetails.therapist_id = Therapists.therapist_id
	LEFT JOIN ServiceDetails ON AppointmentDetails.service_id = ServiceDetails.service_id
	WHERE status = 'Completed' ORDER BY AppointmentDetails.appointment_date DESC
	LIMIT 5
	";

	$appointments = getRows($query);

	// APPOINTMENT STATUS BREAKDOWN
	$statusQuery = "
	SELECT status, COUNT(*) AS total
	FROM AppointmentDetails
	GROUP BY status
	";

	$statuses = getRows($statusQuery);

	// MOST POPULAR SERVICES
	$serviceQuery = "
	SELECT ServiceDetails.service_name, COUNT(*) AS total
	FROM AppointmentDetails
	LEFT JOIN ServiceDetails ON AppointmentDetails.service_id = ServiceDetails.service_id
	GROUP BY ServiceDetails.service_name
	ORDER BY total DESC
	";

	$services = getRows($serviceQuery);
?>

<body>
	<?php require_once("navbar.php")?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>

			<div class="col-10">

				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Admin Analytics Dashboard</h1>
						<p class="lead">Overview of system activity and appointment data.</p>
					</div>
				</div>

				<!-- SUMMARY CARDS -->
				<div class="row">

					<div class="col-md-3 mb-4">
						<div class="card text-center">
							<div class="card-body">
								<h5 class="card-title">Patients</h5>
								<h2><?php echo $totalPatients['total']; ?></h2>
								<p class="card-text">Registered patients</p>
							</div>
						</div>
					</div>

					<div class="col-md-3 mb-4">
						<div class="card text-center">
							<div class="card-body">
								<h5 class="card-title">Therapists</h5>
								<h2><?php echo $totalTherapists['total']; ?></h2>
								<p class="card-text">Therapists in system</p>
							</div>
						</div>
					</div>

					<div class="col-md-3 mb-4">
						<div class="card text-center">
							<div class="card-body">
								<h5 class="card-title">Appointments</h5>
								<h2><?php echo $totalAppointments['total']; ?></h2>
								<p class="card-text">Total appointments</p>
							</div>
						</div>
					</div>

					<div class="col-md-3 mb-4">
						<div class="card text-center">
							<div class="card-body">
								<h5 class="card-title">Services</h5>
								<h2><?php echo $totalServices['total']; ?></h2>
								<p class="card-text">Services offered</p>
							</div>
						</div>
					</div>

				</div>


				<!-- APPOINTMENT STATUS BREAKDOWN -->
				<div class="card-header">
					Appointment Status Breakdown
				</div>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Status</th>
							<th scope="col">Total</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if($statuses) {
							foreach($statuses as $status) {
								echo "<tr>";
								echo "<td>{$status['status']}</td>";
								echo "<td>{$status['total']}</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='2' class='text-center'>No status data found.</td></tr>";
						}
						?>
					</tbody>
				</table>

				<!-- MOST POPULAR SERVICES -->
				<div class="card-header">
					Most Popular Services
				</div>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Service</th>
							<th scope="col">Total Bookings</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if($services) {
							foreach($services as $service) {
								echo "<tr>";
								echo "<td>{$service['service_name']}</td>";
								echo "<td>{$service['total']}</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='2' class='text-center'>No service data found.</td></tr>";
						}
						?>
					</tbody>
				</table>

				<!-- RECENT APPOINTMENTS -->
				<div class="card-header">
					Recent Appointments
				</div>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Date</th>
							<th scope="col">Time</th>
							<th scope="col">Patient</th>
							<th scope="col">Therapist</th>
							<th scope="col">Service</th>
							<th scope="col">Status</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if($appointments) {
							foreach($appointments as $appointment) {
								$app_date = $appointment['appointment_date'];
								$start_time = $appointment['app_start'];
								$end_time = $appointment['app_end'];

								echo "<tr>";
								echo"<td>".date('F j, Y', strtotime($app_date))."</td>";
								echo"<td>".date('g:i A', strtotime($start_time))." - ".date('g:i A', strtotime($end_time))."</td>";
								echo "<td>{$appointment['patient_fname']} {$appointment['patient_lname']}</td>";
								echo "<td>{$appointment['therapist_fname']} {$appointment['therapist_lname']}</td>";
								echo "<td>{$appointment['service_name']}</td>";
								echo "<td>{$appointment['status']}</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='8' class='text-center'>No appointments found.</td></tr>";
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle includes Popper -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>