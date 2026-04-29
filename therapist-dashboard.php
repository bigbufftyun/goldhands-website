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

	if(!isset($_SESSION['tEmail']) OR !isset($_GET['therapistID'])) {
		header("Location: index.php");
	}

	$tID = $_GET['therapistID'];
	$query = "SELECT * FROM Therapists WHERE therapist_id = '{$tID}'";
	$therapist = getOneRow($query)


?>
<body>
<?php require_once('navbar.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4"><?php echo "Hello ".$therapist['therapist_fname']." ".$therapist['therapist_lname']?></h1>
					</div>
				</div>
				<div class="card-header">
						Today's Appointment Schedule
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Time</th>
							<th scope="col">Patient Name</th>
							<th scope="col">Service</th>
							<th scope="col">Status</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>10:45AM</th>
							<td>Mark Caps</td>
							<td>Follow-Up</td>
							<td>Scheduled</td>
							<td>Open</td>
						</tr>
						<tr>
							<td>2:30PM</th>
							<td>Jacob Thornton</td>
							<td>Thornton</td>
							<td>Scheduled</td>
							<td>Open</td>
						</tr>
						<tr>
							<td>3:15PM</th>
							<td>Tyler Waters</td>
							<td>Follow-Up</td>
							<td>Scheduled</td>
							<td>Open</td>
						</tr>
					</tbody>
				</table>


			</div>
		</div>
		<div class="row">
			<div class="col-2">
			</div>
			<div class="col-10">
				
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