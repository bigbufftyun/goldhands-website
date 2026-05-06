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

	<title>Manage Therapists</title>
</head>

<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['aID'])) {
	header("Location: index.php");
}


/* Get therapists */
$query = "SELECT *, ServiceDetails.service_id, ServiceDetails.service_name FROM Therapists LEFT JOIN ServiceDetails ON ServiceDetails.service_id=Therapists.service_id;";
$records = getRows($query);

/* Get services for dropdown */
$query1 = "SELECT * FROM ServiceDetails";
$records1 = getRows($query1);
?>

<body>
<?php require_once('navbar.php'); ?>

<div class="container-fluid">
	<div class="row">
		<?php require_once("patient_nav.php")?>

		<div class="col-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Manage Therapists</h1>
				</div>
			</div>

			<div class="card">
				<div class="card-header">Current Therapists</div>

				<div class="card-body">
					<table class="table table-bordered table-sm">
						<thead>
							<tr>
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Service</th>
								<th>License</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
						<?php
						if ($records) {
							foreach($records as $record) {

								echo "<tr>";
								echo "<td>{$record['therapist_id']}</td>";
								echo "<td>{$record['therapist_fname']}</td>";
								echo "<td>{$record['therapist_lname']}</td>";
								echo "<td>{$record['service_name']}</td>";
								echo "<td>{$record['license_active']}</td>";
								echo "<td>{$record['t_email']}</td>";
								echo "<td>{$record['t_phone']}</td>";

								echo "<td>
									<a href='admin-edit-therapist.php?therapistID={$record['therapist_id']}' class='btn btn-primary btn-sm'>EDIT</a>

									

									<a href='delete-therapist.php?therapistID={$record['therapist_id']}'
									   class='btn btn-primary btn-sm'
									   onclick=\"return confirm('Are you sure you want to delete this therapist?');\">
									   DELETE
									</a>
								</td>";

								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='8'>No therapists found.</td></tr>";
						}
						?>
						</tbody>
					</table>


					<button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample">
						Add Therapist Account
					</button>
				</div>
			</div>

			<div class="collapse" id="collapseExample">
				<div class="card card-body">	
					<form action="manage-therapist.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>First Name</label>
								<input type="text" class="form-control" name="tFName" required>
							</div>

							<div class="form-group col-md-6">
								<label>Last Name</label>
								<input type="text" class="form-control" name="tLName" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Email</label>
								<input type="email" class="form-control" name="tEmail" required>
							</div>

							<div class="form-group col-md-4">
								<label>Phone</label>
								<input type="number" class="form-control" name="tPhone" required>
							</div>

							<div class="form-group col-md-4">
								<label>Password</label>
								<input type="password" class="form-control" name="tPassword" required>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Specialty</label>
								<select class="form-control" name="tService">
									<?php
									foreach($records1 as $record1) {
										echo "<option value='{$record1['service_id']}'>{$record1['service_name']}</option>";
									}
									?>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label>Status</label>
								<select class="form-control" name="tStatus">
									<option value="Active">Active</option>
									<option value="Inactive">Inactive</option>
								</select>
							</div>
						</div>

						<button type="submit" name='add-thera' class="btn btn-primary btn-sm float-right">Submit</button>
					</form>

					<?php
					if(isset($_POST['add-thera'])) {

						$fName = $_POST['tFName'];
						$lName = $_POST['tLName'];
						$email = $_POST['tEmail'];
						$phone = $_POST['tPhone'];
						$service = $_POST['tService'];
						$stat = $_POST['tStatus'];
						$tPass = $_POST['tPassword'];

						$hash = password_hash($tPass, PASSWORD_DEFAULT);

						$qlog = "INSERT INTO Therapists (therapist_fname, therapist_lname, t_email, t_phone, service_id, license_active, t_password) VALUES ('{$fName}','{$lName}','{$email}','{$phone}','{$service}','{$stat}','{$hash}')";

						runQuery($qlog);

						header("Location: manage-service.php");
					}
					?>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>