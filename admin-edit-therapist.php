<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['aEmail'])) {
	header("Location: index.php");
	exit();
}

if(!isset($_GET['therapistID']) && !isset($_POST['therapistID'])) {
	header("Location: manage-therapist.php?adminID=1");
	exit();
}

$therapistID = isset($_GET['therapistID']) ? $_GET['therapistID'] : $_POST['therapistID'];

if(isset($_POST['submit'])) {
	$tFName = $_POST['tFName'];
	$tLName = $_POST['tLName'];
	$tEmail = $_POST['tEmail'];
	$tPhone = $_POST['tPhone'];
	$tSpecialty = $_POST['tSpecialty'];
	$tStatus = $_POST['tStatus'];

	$query = "UPDATE Therapists
			  SET therapist_fname = '{$tFName}',
				  therapist_lname = '{$tLName}',
				  t_email = '{$tEmail}',
				  t_phone = '{$tPhone}',
				  specialty = '{$tSpecialty}',
				  license_active = '{$tStatus}'
			  WHERE therapist_id = '{$therapistID}'";

	runQuery($query);

	header("Location: manage-therapist.php?adminID=1");
	exit();
}

$query = "SELECT * FROM Therapists WHERE therapist_id = '{$therapistID}'";
$therapist = getOneRow($query);

$serviceQuery = "SELECT * FROM ServiceDetails";
$services = getRows($serviceQuery);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Edit Therapist</title>
</head>

<body>
<?php require_once('navbar.php'); ?>

<div class="container-fluid">
	<div class="row">
		<?php require_once("patient_nav.php")?>

		<div class="col-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Edit Therapist</h1>
				</div>
			</div>

			<div class="card">
				<div class="card-header">Therapist Account Information</div>

				<div class="card-body">
					<?php if($therapist) { ?>
					<form action="edit-therapist.php" method="POST">

						<input type="hidden" name="therapistID" value="<?php echo $therapist['therapist_id']; ?>">

						<div class="form-group row">
							<div class="col-6">
								<label>First Name</label>
								<input class="form-control" type="text" name="tFName" value="<?php echo $therapist['therapist_fname']; ?>" required>
							</div>

							<div class="col-6">
								<label>Last Name</label>
								<input class="form-control" type="text" name="tLName" value="<?php echo $therapist['therapist_lname']; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-6">
								<label>Email</label>
								<input class="form-control" type="email" name="tEmail" value="<?php echo $therapist['t_email']; ?>" required>
							</div>

							<div class="col-6">
								<label>Phone Number</label>
								<input class="form-control" type="text" name="tPhone" value="<?php echo $therapist['t_phone']; ?>" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-6">
								<label>Specialty</label>
								<select class="form-control" name="tSpecialty">
									<?php
									foreach($services as $service) {
										$selected = "";
										if($therapist['specialty'] == $service['service_id']) {
											$selected = "selected";
										}
										echo "<option value='{$service['service_id']}' {$selected}>{$service['service_name']}</option>";
									}
									?>
								</select>
							</div>

							<div class="col-6">
								<label>Status</label>
								<select class="form-control" name="tStatus">
									<option value="Active" <?php if($therapist['license_active'] == 'Active') echo 'selected'; ?>>Active</option>
									<option value="Inactive" <?php if($therapist['license_active'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>

						<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
						<a href="manage-therapist.php?adminID=1" class="btn btn-secondary">Cancel</a>

					</form>
					<?php } else { ?>
						<p>Therapist not found.</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
