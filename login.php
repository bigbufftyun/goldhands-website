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

	<title>Login</title>
</head>
<?php
	require_once("dbhelper.php");
	session_start();

	if(isset($_SESSION['pEmail'])) {
		header("Location: index.php");
	}

	if(isset($_POST['psubmit'])) {
		$patientEmail = $_POST['pEmail'];
		$patientPassword = $_POST['pPassword'];


		$query = "SELECT * FROM Patients WHERE p_email = '{$patientEmail}'";

		$record = getOneRow($query);

		if($record['p_email'] == $patientEmail AND password_verify($patientPassword, $record['p_password'])) {

			$_SESSION['pEmail'] = $patientEmail;
			$_SESSION['accessLevel'] = 1;
			$_SESSION['pID'] = $record['patient_id'];

			header('Location: dashboard.php');

		} else if($record['p_email'] !== $patientEmail OR !password_verify($patientPassword, $record['p_password'])) {
	
			echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
			echo "<strong>Holy guacamole!</strong> You should check in on some of those fields below.";
			echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
			echo "<span aria-hidden='true'>&times;</span>";
			echo "</button>";
			echo "</div>";




		} else {

			echo "<p>did not log in</p>";
		}
	}

	else if(isset($_POST['tsubmit'])) {
		$therapistEmail = $_POST['tEmail'];
		$therapistPassword = $_POST['tPassword'];

		$query = "SELECT * FROM Therapists WHERE t_email = '{$therapistEmail}'";

		$record = getOneRow($query);

		if($record['t_email'] == $therapistEmail AND password_verify($therapistPassword, $record['t_password'])) {

			$_SESSION['tEmail'] = $therapistEmail;
			$_SESSION['accessLevel'] = 2;
			$_SESSION['tID'] = $record['therapist_id'];


			header('Location: therapist-dashboard.php?therapistID='.$_SESSION['tID']);
		} else {

			echo "<p>did not log in</p>";
		}
	}

	else if(isset($_POST['asubmit'])) {
		$adminEmail = $_POST['aEmail'];
		$adminPassword = $_POST['aPassword'];

		$query = "SELECT * FROM Admin WHERE a_email = '{$adminEmail}'";

		$record = getOneRow($query);

		if($record['a_email'] == $adminEmail AND password_verify($adminPassword, $record['a_password'])) {

			$_SESSION['aEmail'] = $adminEmail;
			$_SESSION['accessLevel'] = 3;
			$_SESSION['aID'] = $record['admin_id'];


			header('Location: admin-dashboard.php?adminID='.$_SESSION['aID']);
		} else {

			echo "<p>did not log in</p>";
		}
	}

?>

<body>
	<?php require_once 'navbar.php'; ?>

<!-- Container for user to choose patient, therapist or administrator login -->
	<div class="container">
		<div class="card text">
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Patient Login</a>
							<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Therapist Login</a>
							<a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Admin Login</a>
						</div>
					</div>

					<!-- Collecting user email and password through a form -->
					<div class="col-8">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
								<form action="login.php" method="POST">
									
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" class="form-control" id="inputEmailP" name='pEmail'>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" id="inputPasswordP" name='pPassword'>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-10">
											<button type="submit" name='psubmit' class="btn btn-primary">Sign In</button>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
								<form action="login.php" method="POST">
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" class="form-control" id="inputEmailT" name="tEmail">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" id="inputPasswordT" name="tPassword">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-10">
											<button type="submit" name='tsubmit' class="btn btn-primary">Sign In</button>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
								<form action="login.php" method="POST">
									<div class="form-group row">
										<label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" class="form-control" id="inputEmailA" name="aEmail">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" id="inputPasswordA" name="aPassword">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-10">
											<button type="submit" name='asubmit' class="btn btn-primary" name="asubmit">Sign In</button>
										</div>
									</div>
								</form>
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