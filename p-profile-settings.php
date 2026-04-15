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

	if(!isset($_SESSION['accessLevel']) OR $_SESSION['accessLevel'] > 1) {
		header("Location: index.php");
	}

?>
<body>
	<?php require_once("navbar.php")?>
	
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
							<form>
								<div class="form-group row">
									<div class="col-6">
										<label for="inputState">First Name</label>
										<input class="form-control" type="text" placeholder="Antonio" readonly>
									</div>
									<div class="col-6">
										<label for="inputState">Last Name</label>
										<input class="form-control" type="text" placeholder="Miitopia" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-6">
										<label for="inputState">Email</label>
										<input class="form-control" type="text" placeholder="amii9@gmail.com" readonly>
									</div>
									<div class="col-6">
										<label for="inputState">Phone Number</label>
										<input class="form-control" type="text" placeholder="(329) 354-5492" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-8">
										<label for="inputState">Street Address</label>
										<input class="form-control" type="text" placeholder="324 Bundt Ave" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-4">
										<label for="inputState">City</label>
										<input class="form-control" type="text" placeholder="Ginko City" readonly>
									</div>
									<div class="col-4">
										<label for="inputState">State</label>
										<input class="form-control" type="text" placeholder="Washington" readonly>
									</div>
									<div class="col-4">
										<label for="inputState">Zipcode</label>
										<input class="form-control" type="text" placeholder="32181" readonly>
									</div>
								</div>

							</form>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile-edit">
								Edit Profile Information
							</button>

							<!-- Modal -->
							<div class="modal fade" id="profile-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit Profile Information</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="inputEmail4">First Name</label>
														<input type="email" class="form-control" id="inputFirstName">
													</div>
													<div class="form-group col-md-6">
														<label for="inputPassword4">Last Name</label>
														<input type="password" class="form-control" id="inputLastName">
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="inputEmail4">Email</label>
														<input type="email" class="form-control" id="inputEmail4">
													</div>
													<div class="form-group col-md-6">
														<label for="inputPassword4">Password</label>
														<input type="password" class="form-control" id="inputPassword4">
													</div>
												</div>
												<div class="form-group">
													<label for="inputAddress">Address</label>
													<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="inputCity">City</label>
														<input type="text" class="form-control" id="inputCity">
													</div>
													<div class="form-group col-md-4">
														<label for="inputState">State</label>
														<select id="inputState" class="form-control">
															<option selected>Choose...</option>
															<option>...</option>
														</select>
													</div>
													<div class="form-group col-md-2">
														<label for="inputZip">Zip</label>
														<input type="text" class="form-control" id="inputZip">
													</div>
												</div>
											</form>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</div>

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