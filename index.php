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

	<title>Homepage</title>
</head>
<?php
	require_once('dbhelper.php');
	session_start();

	$query = "SELECT * FROM ServiceDetails";
	$services = getRows($query);


?>

<body>

	<?php require_once 'navbar.php'; ?>

	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Welcome to Golden Hands Homecare</h1>
			<p class="lead">Improving the Quality of Life for People with Mental Illness.</p>
			<?php
			if(isset($_SESSION['pID'])) { ?>
				<a class="btn btn-primary btn-lg" href="schedule-app.php" role="button">Book Appointment</a>

			<?php } else if(isset($_SESSION['tID'])) { ?>
				<a class="btn btn-primary btn-lg" href="t-schedule-mgmt.php" role="button">Create Appointment</a>

			<?php } else if(isset($_SESSION['aID'])) { ?>
				<a class="btn btn-primary btn-lg" href="manage-schedule.php" role="button">Manage Appointments</a>

			<?php } else { ?>
				<a class="btn btn-primary btn-lg" href="login.php" role="button">Book Appointment</a>
				<a class="btn btn-primary btn-lg" href="registration.php" role="button">Registration</a>
			<?php }?>

		</div>
	</div>

<!-- About and Services sectioned by scrollspy -->
	<div class="container">
		<div class="row">
			<div class="col-6" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
				<h4 id="about-us">About Us</h4>
				<p>When you are struggling with mental health or substance abuse disorders, it is wise to seek professional support. Whether you are an adult, there is hope for betterment and restoration through rehabilitation programs and mental health services that use effective techniques and advanced technology. With the collaborative efforts of our team, you can trust us to help you improve your overall well-being.</p>
			</div>
			<div class="col-6">
				<img src="https://bouve.northeastern.edu/wp-content/uploads/2023/05/psychiatrist-vs-psychologist-which-one-is-right-northeastern-graduate.webp" class="card-img-top">
			</div>
		</div>
		<div class="row">
				<h4 id="services">Services</h4>
				<div class="row row-cols-1 row-cols-md-2">
					<?php
					if($services) {
						foreach ($services as $service) {
							echo "<div class='col mb-4'>";
							echo "<div class='card'>";
							echo "<div class='card-body'>";
							echo "<h5 class='card-title'>{$service['service_name']}</h5>";
							echo "<p class='card-text'>{$service['description']}</p>";
							echo "<ul class='list-group list-group-flush'>";
    						echo "<li class='list-group-item'>Duration: {$service['duration_minutes']} minutes</li>";
    						echo "<li class='list-group-item'>Price: \${$service['base_price']}.00</li>";
  							echo "</ul>";
							echo "</div>";
							echo "</div>";
							echo "</div>";


						}
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