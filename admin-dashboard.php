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

	<title>Dashboard</title>
</head>
<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['aID']) ) {
	header("Location: index.php");
}
$aID = $_SESSION['aID'];

$query = "SELECT * FROM AppointmentDetails LEFT JOIN Patients ON AppointmentDetails.patient_id=Patients.patient_id LEFT JOIN Therapists ON AppointmentDetails.therapist_id=Therapists.therapist_id LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id WHERE appointment_date = CURDATE() and status = 'Booked' ORDER BY app_start ASC";
$records = getRows($query);

$query1 = "SELECT * FROM Admin WHERE admin_id = {$aID}";
$admin = getOneRow($query1);


?>
<body>
	<?php require_once('navbar.php');?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4"><?php echo "Hello ".$admin['a_fname']." ".$admin['a_lname']?>.</h1>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Today's Appointment Schedule
					</div>
					<div class="card-body">
						<p class="card-text">
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">Time</th>
													<th scope="col">Patient Name</th>
													<th scope="col">Therapist Name</th>
													<th scope="col">Service</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($records) {
													foreach($records as $record) {
														$start_time = $record['app_start'];
														$end_time = $record['app_end'];

														echo"<tr>";
														echo"<td>".date('g:i A', strtotime($start_time))." - ".date('g:i A', strtotime($end_time))."</td>";
														echo"<td>{$record['patient_fname']} {$record['patient_lname']}</td>";
														echo"<td>{$record['therapist_fname']} {$record['therapist_lname']}</td>";
														echo"<td>{$record['service_name']}</td>";
														echo"<td>{$record['status']}</td>";
														echo"</tr>";

													}
												} else {
													echo"<tr>";
													echo "<td colspan='5'>No appointments today.</td>";
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