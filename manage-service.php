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

	<title>Manage Services</title>
</head>
<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
}


?>
<body>
	<?php require_once('navbar.php'); 

	$query = "SELECT * FROM ServiceDetails;";

	$records = getRows($query)


	?>
	
	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Manage Services</h1>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Current Services
					</div>

					<div class="card-body">
						<p class="card-text">
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Service Name</th>
													<th>Description</th>
													<th>Duration</th>
													<th>Price</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											if ($records) {
												foreach($records as $record) {
													echo"<tr>";
													echo"<td>{$record['service_name']}</td>";
													echo"<td>{$record['description']}</td>";
													echo"<td>{$record['duration_minutes']}</td>";
													echo"<td>{$record['base_price']}</td>";
													echo"<td>{$record['service_active']}";
													echo"<td><button type='button' class='btn btn-primary btn-sm'>Edit</button><button type='button' class='btn btn-primary btn-sm'>Delete</button></td>";
													echo"</tr>";

													
												}
											} else {
												echo "<p>No services found.</p>";
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
						<form action="manage-service.php" method="POST">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputEmail4">Service Name</label>
									<input type="text" class="form-control" id="inputFirstName" name='sName'>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="exampleFormControlTextarea1">Service Description</label>
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name='sDescription'></textarea>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="inputEmail4">Price</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">$</span>
										</div>
										<input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="00.00" name='sPrice'>
									</div>
								</div>
								<div class="form-group col-md-5">
									<label for="inputState">Duration (minutes)</label>
									<select id="inputState" class="form-control" name='sDuration'>
										<option selected value="30">30</option>
										<option value="45">45</option>
										<option value="60">60</option>
										<option value="90">90</option>
										<option value="120">120</option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="inputPassword4">Status</label>
									<select id="inputState" class="form-control" name='sStatus'>
										<option selected value="Active">Active</option>
									</select>
								</div>
							</div>
					
							<button type="submit" name='add-service' class="btn btn-primary btn-sm">Submit</button>
							
						</form>
						<?php
							if(isset($_POST['add-service'])) {

								$sName = $_POST['sName'];
								$sDesc = $_POST['sDescription'];
								$sPrice = $_POST['sPrice'];
								$sDur = $_POST['sDuration'];
								$sStat = $_POST['sStatus'];


								$queryform = "INSERT INTO ServiceDetails (service_name, description, duration_minutes, base_price, service_active) VALUES ('{$sName}','{$sDesc}','{$sDur}','{$sPrice}','{$sStat}');";

								runQuery($queryform);

								echo "<p>Successfully added new service.</p>";
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