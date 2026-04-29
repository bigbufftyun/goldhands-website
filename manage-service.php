<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<!-- Custom External CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Manage Services</title>
</head>

<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

if(isset($_POST['add-service'])) {
	$sName = $_POST['sName'];
	$sDesc = $_POST['sDescription'];
	$sPrice = $_POST['sPrice'];
	$sDur = $_POST['sDuration'];
	$sStat = $_POST['sStatus'];

	$queryform = "INSERT INTO ServiceDetails 
	(service_name, description, duration_minutes, base_price, service_active) 
	VALUES ('{$sName}','{$sDesc}','{$sDur}','{$sPrice}','{$sStat}')";

	runQuery($queryform);

	header("Location: manage-service.php");
	exit();
}

$query = "SELECT * FROM ServiceDetails;";
$records = getRows($query);
?>

<body>
	<?php require_once('navbar.php'); ?>
	
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
									echo "<tr>";
									echo "<td>{$record['service_name']}</td>";
									echo "<td>{$record['description']}</td>";
									echo "<td>{$record['duration_minutes']}</td>";
									echo "<td>{$record['base_price']}</td>";
									echo "<td>{$record['service_active']}</td>";

									echo "<td>
										<a href='edit-service.php?serviceID={$record['service_id']}' class='btn btn-primary btn-sm'>EDIT</a>

										<a href='delete-service.php?serviceID={$record['service_id']}'
										   class='btn btn-warning btn-sm'
										   onclick=\"return confirm('Are you sure you want to delete this service?');\">
										   DELETE
										</a>
									</td>";

									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='6'>No services found.</td></tr>";
							}
							?>
							</tbody>
						</table>

						<button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample">
							Add Service
						</button>
					</div>
				</div>

				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form action="manage-service.php" method="POST">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Service Name</label>
									<input type="text" class="form-control" name="sName" required>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Service Description</label>
									<textarea class="form-control" rows="5" name="sDescription" required></textarea>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Price</label>
									<input type="text" class="form-control" placeholder="00.00" name="sPrice" required>
								</div>

								<div class="form-group col-md-5">
									<label>Duration (minutes)</label>
									<select class="form-control" name="sDuration">
										<option value="30">30</option>
										<option value="45">45</option>
										<option value="60">60</option>
										<option value="90">90</option>
										<option value="120">120</option>
									</select>
								</div>

								<div class="form-group col-md-3">
									<label>Status</label>
									<select class="form-control" name="sStatus">
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
								</div>
							</div>
					
							<button type="submit" name="add-service" class="btn btn-primary btn-sm">Submit</button>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
