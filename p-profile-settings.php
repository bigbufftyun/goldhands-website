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

	<title>Profile Settings</title>
</head>
<?php
	require_once("dbhelper.php");
	session_start();

	if(!isset($_SESSION['pEmail']) OR !isset($_GET['editPID'])) {
		header("Location: index.php");
	}

	$editPID = $_GET['editPID'];
	$query = "SELECT * FROM Patients WHERE patient_id = '{$editPID}'";
	$patient = getOneRow($query)


?>
<body>
	<?php require_once("navbar.php");?>
	
	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
			<div class="col-10">
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">Profile Settings</h1>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Patient Account Information
					</div>
					<div class="card-body">
						<p class="card-text">
						<?php 
							if($patient) {
						?>
							<form action='process-edit-patient.php' method='POST'>
								<div class="form-group row">
									<div class="col-6">
										<label for="inputState">First Name</label>
										<input class="form-control" type="text" name="pFName" value="<?php echo $patient['patient_fname']; ?>">
									</div>
									<div class="col-6">
										<label for="inputState">Last Name</label>
										<input class="form-control" type="text" name="pLName" value="<?php echo $patient['patient_lname']; ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-6">
										<label for="inputState">Email</label>
										<input class="form-control" type="text" name="pEmail" value="<?php echo $patient['p_email']; ?>">
									</div>
									<div class="col-6">
										<label for="inputState">Phone Number</label>
										<input class="form-control" type="number" max="999999999" name="pPhone" value="<?php echo $patient['p_phone']; ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-8">
										<label for="inputState">Street Address</label>
										<input class="form-control" type="text" name="pStreet" value="<?php echo $patient['p_street']; ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-4">
										<label for="inputState">City</label>
										<input class="form-control" type="text" name="pCity" value="<?php echo $patient['p_city']; ?>">
									</div>
									<div class="col-4">
										<label for="inputState">State</label>
										<input class="form-control" type="text" name="pState" value="<?php echo $patient['p_state']; ?>">
									</div>
									<div class="col-4">
										<label for="inputState">Zipcode</label>
										<input class="form-control" type="text" name="pZipcode" value="<?php echo $patient['p_zipcode']; ?>">
									</div>
								</div>
								<button class="btn btn-primary btn-sm" name="edit-pinfo" type="submit" value="<?php echo $editPID; ?>">Submit Profile Changes</button>
							</form>
							<?php
								} else {
									echo "<p>Invalid patient ID, please try again.</p>";
								}
							?>
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