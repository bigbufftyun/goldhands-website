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

	<title>Health Records</title>
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

	$query = "SELECT * FROM Patients;";

	$records = getRows($query)

	?>
	<div class="container-fluid">
		<div class="row">
			<?php require_once("patient_nav.php")?>
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
					
					
					
					
					
					<?php
					if ($records) {
						foreach($records as $record) {
							echo"<div class='card'>";
							echo"<div class='card-body'>";
							echo"<table class='table table-bordered'>";
							echo"<thead>";
							echo"<tr>";
							echo"<th scope='col'>First</th>";
							echo"<th scope='col'>Last</th>";
							echo"<th scope='col'>Email</th>";
							echo"<th scope='col'>Phone</th>";
							echo"</tr>";
							echo"</thead>";
							echo"<tbody>";
							echo "<tr>";
							echo "<td>{$record['patient_fname']}</td>";
							echo "<td>{$record['patient_lname']}</td>";
							echo "<td>{$record['p_email']}</td>";
							echo "<td>{$record['p_phone']}</td>";
							echo"</tbody>";
							echo"</table>";

							echo"<table class='table table-bordered'>";
							echo"<thead>";
							echo"<tr>";
							echo"<th scope='col'>Street Address</th>";
							echo"<th scope='col'>City</th>";
							echo"<th scope='col'>State</th>";
							echo"<th scope='col'>Zipcode</th>";
							echo"</tr>";
							echo"</thead>";
							echo"<tbody>";
							echo "<tr>";
							echo "<td>{$record['p_street']}</td>";
							echo "<td>{$record['p_city']}</td>";
							echo "<td>{$record['p_state']}</td>";
							echo "<td>{$record['p_zipcode']}</td>";
							echo"</tbody>";
							echo"</table>";
							echo"</div>";
							echo"</div>";
						}
					} else {
						echo "<p>No patients.</p>";
					}
					?>
					
					



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