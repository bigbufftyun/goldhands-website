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

	<title>Manage Therapists</title>
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

	$query="SELECT * FROM Therapists;";

	$records=getRows($query)


	?>
	
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
					<div class="card-header">
						Current Therapists
					</div>
					<div class="card-body">
						<p class="card-text">
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>ID</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Specialty</th>
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
													echo"<tr>";
													echo"<td>{$record['therapist_id']}</td>";
													echo"<td>{$record['therapist_fname']}</td>";
													echo"<td>{$record['therapist_lname']}</td>";
													echo"<td>{$record['specialty']}</td>";
													echo"<td>{$record['license_active']}";
													echo"<td>{$record['t_email']}</td>";
													echo"<td>{$record['t_phone']}</td>";
													echo"<td><button type='button' class='btn btn-primary btn-sm'>Edit</button><button type='button' class='btn btn-primary btn-sm'>Delete</button></td>";
													echo"</tr>";

													
												}
											} else {
												echo "<p>No therapist found.</p>";
											}
											?>
											
											</tbody>
										</table>
									</div>
								</div>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#profile-edit">
									+ Add Therapist
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
															<label for="inputState">Specialty</label>
															<select id="inputState" class="form-control">
																<option selected>Choose...</option>
																<option>Individual Counseling</option>
																<option>Individual Counseling</option>
																<option>Individual Counseling</option>
															</select>
														</div>
														<div class="form-group col-md-6">
															<label for="inputState">Status</label>
															<select id="inputState" class="form-control">
																<option selected>Choose...</option>
																<option>Senior Therapist</option>
																<option>Senior Psychiatrist</option>
																<option>Adolescent Psychiatrist</option>
															</select>
														</div>
													</div>
													<fieldset class="form-group">
														<div class="row">
															<legend class="col-form-label col-sm-4 pt-0">License</legend>
															<div class="col-md-8">
																<div class="form-check">
																	<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
																	<label class="form-check-label" for="gridRadios1">
																		Active
																	</label>
																</div>
																<div class="form-check">
																	<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
																	<label class="form-check-label" for="gridRadios2">
																		Inactive
																	</label>
																</div>
															</div>
														</div>
													</fieldset>
												</form>

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							</form>
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