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

	if(!isset($_SESSION['aEmail']) OR !isset($_GET['adminID'])) {
		header("Location: index.php");
	}

	$aID = $_GET['adminID'];


?>
<body>
	<?php require_once('navbar.php'); 

	$query="SELECT * FROM Therapists;";
	$records=getRows($query);

	$query1 = "SELECT * FROM ServiceDetails";
	$records1 = getRows($query1);




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
								<p>
									<button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
										Add Therapist Account
									</button>
								</p>
							</form>
						</p>
					</div>
				</div>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">	
						<form action="manage-therapist.php" method="POST">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail4">First Name</label>
									<input type="text" class="form-control" id="inputFirstName" name='tFName'>
								</div>
								<div class="form-group col-md-6">
									<label for="inputPassword4">Last Name</label>
									<input type="text" class="form-control" id="inputLastName" name='tLName'>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="inputEmail4">Email</label>
									<input type="email" class="form-control" id="inputFirstName" name='tEmail'>
								</div>
								<div class="form-group col-md-4">
									<label for="inputPassword4">Phone Number</label>
									<input type="number" max="9999999999" class="form-control" id="inputLastName" name='tPhone'>
								</div>
								<div class="form-group col-md-4">
									<label for="inputPassword4">Password</label>
									<input type="password" class="form-control" id="inputLastName" name='tPassword'>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputState">Specialty</label>
									<?php
									echo "<select id='inputState' class='form-control' name='tService'>";
									foreach($records1 as $record1) {
										$sID = $record1['service_id'];
										$sName = $record1['service_name'];

										echo "<option value='".$sID."'>".$sName."</option>";
									}
									echo "</select>";
									?>
								</div>
								<div class="form-group col-md-6">
									<label for="inputState">Status</label>
									<select id='inputState' class='form-control' name='tStatus'>
										<option value='Active'>Active</option>
										<option value='Inactive'>Inactive</option>
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

							$qlog = "INSERT INTO Therapists (therapist_fname, therapist_lname, t_email, t_phone, specialty, license_active, t_password) VALUES ('{$fname}','{$lname}','{$email}','{$phone}','{$service}','{$stat}', '{$hash}');";

							runQuery($qlog);

							echo "<p>Successfully added therapist.</p>";

							header("Location: manage-service.php?editService={$aID}");
						}
						?>


							
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