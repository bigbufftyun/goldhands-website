<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Health Records</title>
</head>

<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

$query = "SELECT * FROM Patients;";
$records = getRows($query);
?>

<body>
	<?php require_once('navbar.php'); ?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php"); ?>

			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Health Records</h1>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						Current Patient Records
					</div>

					<div class="card-body">
						<table class="table table-bordered table-sm">
							<thead>
								<tr>
									<th>First</th>
									<th>Last</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Street Address</th>
									<th>City</th>
									<th>State</th>
									<th>Zipcode</th>
									<th>Actions</th>
								</tr>
							</thead>

							<tbody>
								<?php
								if ($records) {
									foreach($records as $record) {
										echo "<tr>";
										echo "<td>{$record['patient_fname']}</td>";
										echo "<td>{$record['patient_lname']}</td>";
										echo "<td>{$record['p_email']}</td>";
										echo "<td>{$record['p_phone']}</td>";
										echo "<td>{$record['p_street']}</td>";
										echo "<td>{$record['p_city']}</td>";
										echo "<td>{$record['p_state']}</td>";
										echo "<td>{$record['p_zipcode']}</td>";

										echo "<td>
											<a href='p-profile-settings.php?editPID={$record['patient_id']}' class='btn btn-primary btn-sm'>EDIT</a>

											<a href='delete-patient.php?patientID={$record['patient_id']}' 
											   class='btn btn-warning btn-sm'
											   onclick=\"return confirm('Are you sure you want to delete this patient?');\">
											   DELETE
											</a>
										</td>";

										echo "</tr>";
									}
								} else {
									echo "<tr><td colspan='9'>No patients found.</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
