<?php
require_once("dbhelper.php");
session_start();

if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] != 3) {
	header("Location: index.php");
	exit();
}

if(!isset($_GET['serviceID']) && !isset($_POST['serviceID'])) {
	header("Location: manage-service.php");
	exit();
}

$serviceID = isset($_GET['serviceID']) ? $_GET['serviceID'] : $_POST['serviceID'];

if(isset($_POST['submit'])) {
	$sName = $_POST['sName'];
	$sDescription = $_POST['sDescription'];
	$sDuration = $_POST['sDuration'];
	$sPrice = $_POST['sPrice'];
	$sStatus = $_POST['sStatus'];

	$query = "UPDATE ServiceDetails
			  SET service_name = '{$sName}',
				  description = '{$sDescription}',
				  duration_minutes = '{$sDuration}',
				  base_price = '{$sPrice}',
				  service_active = '{$sStatus}'
			  WHERE service_id = '{$serviceID}'";

	runQuery($query);

	header("Location: manage-service.php");
	exit();
}

$query = "SELECT * FROM ServiceDetails WHERE service_id = '{$serviceID}'";
$service = getOneRow($query);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Edit Service</title>
</head>

<body>
<?php require_once('navbar.php'); ?>

<div class="container-fluid">
	<div class="row">
		<?php require_once("patient_nav.php")?>

		<div class="col-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Edit Service</h1>
				</div>
			</div>

			<div class="card">
				<div class="card-header">Service Information</div>

				<div class="card-body">
					<?php if($service) { ?>
					<form action="edit-service.php" method="POST">

						<input type="hidden" name="serviceID" value="<?php echo $service['service_id']; ?>">

						<div class="form-group">
							<label>Service Name</label>
							<input class="form-control" type="text" name="sName" value="<?php echo $service['service_name']; ?>" required>
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="sDescription" rows="5" required><?php echo $service['description']; ?></textarea>
						</div>

						<div class="form-group row">
							<div class="col-4">
								<label>Duration</label>
								<input class="form-control" type="number" name="sDuration" value="<?php echo $service['duration_minutes']; ?>" required>
							</div>

							<div class="col-4">
								<label>Price</label>
								<input class="form-control" type="text" name="sPrice" value="<?php echo $service['base_price']; ?>" required>
							</div>

							<div class="col-4">
								<label>Status</label>
								<select class="form-control" name="sStatus">
									<option value="Active" <?php if($service['service_active'] == 'Active') echo 'selected'; ?>>Active</option>
									<option value="Inactive" <?php if($service['service_active'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>

						<button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
						<a href="manage-service.php" class="btn btn-secondary">Cancel</a>

					</form>
					<?php } else { ?>
						<p>Service not found.</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
