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

	<title>Registration</title>
</head>
<?php
require_once('dbhelper.php');
session_start();

if(isset($_SESSION['pEmail'])) {
	header('Location: index.php');
}
?>


<body>
	<?php require_once 'navbar.php'; ?>

	<div class="container">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Registration</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<form action="registration.php" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputFirstName">First Name</label>
							<input type="first-name" class="form-control" id="inputFirstName" name="pFirstName">
						</div>
						<div class="form-group col-md-6">
							<label for="inputLastName">Last Name</label>
							<input type="last-name" class="form-control" id="inputLastName" name="pLastName">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail">Email</label>
							<input type="email" class="form-control" id="inputEmail" name="pEmail">
						</div>
						<div class="form-group col-md-6">
							<label for="inputPhone">Phone Number</label>
							<input type="phone-number" class="form-control" id="inputPhone" name="pPhone">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword">Password</label>
						<input type="text" class="form-control" id="inputPassword" name="pPassword">
					</div>
					<div class="form-group">
						<label for="inputAddress">Address</label>
						<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="pAddress">
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputCity">City</label>
							<input type="text" class="form-control" id="inputCity" name="pCity">
						</div>
						<div class="form-group col-md-4">
							<label for="inputState">State</label>
							<select id="inputState" class="form-control" name="pState">
								<option selected value="MD">MD</option>
								<option value="DC">DC</option>
								<option value="VA">VA</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="inputZip">Zip</label>
							<input type="text" class="form-control" id="inputZip" name="pZipcode">
						</div>
					</div>
					
					<button type="submit" name='submit' class="btn btn-primary">Submit</button>
				</form>
				<?php
					if(isset($_POST['submit'])) {

						$fname = $_POST['pFirstName'];
						$lname = $_POST['pLastName'];
						$password = $_POST['pPassword'];
						$email = $_POST['pEmail'];
						$phone = $_POST['pPhone'];
						$address = $_POST['pAddress'];
						$city = $_POST['pCity'];
						$state = $_POST['pState'];
						$zipcode = $_POST['pZipcode'];

						$query = "INSERT INTO Patients (patient_fname, patient_lname, p_password, p_email, p_phone, p_street, p_city, p_state, p_zipcode) VALUES ('{$fname}','{$lname}','{$password}','{$email}','{$phone}','{$address}','{$city}','{$state}','{$zipcode}');";

						runQuery($query);

						echo "<p>Added query</p>";
					}
				?>
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