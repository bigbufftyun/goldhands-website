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

	<title>Appointment Details</title>
</head>
<?php
	require_once("dbhelper.php");
	session_start();

	if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 2) {
		header("Location: index.php");
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
						<h1 class="display-4">Appointment History</h1>
					</div>
				</div>
				<div class="card-header">
					Past Appointment History
				</div>
				<div class="accordion" id="accordionExample">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
									February 18th, 2026 - June Kim
								</button>
							</h2>
						</div>

						<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-8">
									</div>

									<div class="form-group col-md-4">
										<label for="inputState">Appointment Status</label>
										<select id="inputState" class="form-control">
											<option selected>Status select..</option>
											<option>Completed</option>
											<option>Rescheduled</option>
											<option>Cancelled</option>
											<option>No-show</option>
										</select>
									</div>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">First</th>
											<th scope="col">Last</th>
											<th scope="col">Email</th>
											<th scope="col">Phone</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>June</td>
											<td>Kim</td>
											<td>jkim94@outlook.com</td>
											<td>(613) 912-1994</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Service Type</th>
											<th scope="col">Date</th>
											<th scope="col">Time</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Counseling</td>
											<td>February 18th, 2026</td>
											<td>12:30pm</td>
										</tr>
									</tbody>
								</table>

								<div class="input-group mb-3 input-group-prepend">
									<textarea class="form-control" placeholder="Patient Notes" aria-label="Patient Notes"></textarea>
									<div class="input-group-append">
										<input class="btn btn-primary" type="submit" value="Submit">
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									February 18th, 2026 - June Kim
									
								</button>
							</h2>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-8">
									</div>

									<div class="form-group col-md-4">
										<label for="inputState">Appointment Status</label>
										<select id="inputState" class="form-control">
											<option selected>Status select..</option>
											<option>Completed</option>
											<option>Rescheduled</option>
											<option>Cancelled</option>
											<option>No-show</option>
										</select>
									</div>
								</div>

								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">First</th>
											<th scope="col">Last</th>
											<th scope="col">Email</th>
											<th scope="col">Phone</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>June</td>
											<td>Kim</td>
											<td>jkim94@outlook.com</td>
											<td>(613) 912-1994</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Service Type</th>
											<th scope="col">Date</th>
											<th scope="col">Time</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Counseling</td>
											<td>February 18th, 2026</td>
											<td>12:30pm</td>
										</tr>
									</tbody>
								</table>

								<div class="input-group mb-3 input-group-prepend">
									<textarea class="form-control" placeholder="Patient Notes" aria-label="Patient Notes"></textarea>
									<div class="input-group-append">
										<input class="btn btn-primary" type="submit" value="Submit">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree">
							<h2 class="mb-0">
								<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									February 18th, 2026 - June Kim
								</button>
							</h2>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-8">
									</div>

									<div class="form-group col-md-4">
										<label for="inputState">Appointment Status</label>
										<select id="inputState" class="form-control">
											<option selected>Status select..</option>
											<option>Completed</option>
											<option>Rescheduled</option>
											<option>Cancelled</option>
											<option>No-show</option>
										</select>
									</div>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">First</th>
											<th scope="col">Last</th>
											<th scope="col">Email</th>
											<th scope="col">Phone</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>June</td>
											<td>Kim</td>
											<td>jkim94@outlook.com</td>
											<td>(613) 912-1994</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Service Type</th>
											<th scope="col">Date</th>
											<th scope="col">Time</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Counseling</td>
											<td>February 18th, 2026</td>
											<td>12:30pm</td>
										</tr>
									</tbody>
								</table>

								<div class="input-group mb-3 input-group-prepend">
									<textarea class="form-control" placeholder="Patient Notes" aria-label="Patient Notes"></textarea>
									<div class="input-group-append">
										<input class="btn btn-primary" type="submit" value="Submit">
									</div>
								</div>
							</div>
						</div>
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