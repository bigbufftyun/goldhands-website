<nav id = "main-nav" class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="index.php"><img src="https://goldenhandshomecareinc.com/wp-content/uploads/2024/02/main-logo.png" class="logo"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php#about-us">About Us</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php#services">Services</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="contact.php">Contact</a>
			</li>
		</ul>

		<?php if(isset($_SESSION['accessLevel']) AND $_SESSION['accessLevel'] == 1) { ?>
			<form class="form-inline my-2 my-lg-0" action="navbar.php" method="GET">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true" name="fullName">
				<?php
				echo $_SESSION['pEmail'];
				?>
				</a>
				<a class="btn btn-primary" href="dashboard.php" role="button">Patient Dashboard</a>
			</form>
		<?php } else if (isset($_SESSION['accessLevel']) AND $_SESSION['accessLevel'] == 2) { ?>
			<form class="form-inline my-2 my-lg-0">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Jose Pancham</a>
				<a class="btn btn-primary btn-md" href="therapist-dashboard.php" role="button">Therapist Dashboard</a>
			</form>

		<?php } else if (isset($_SESSION['accessLevel']) AND $_SESSION['accessLevel'] == 3) { ?>
			<form class="form-inline my-2 my-lg-0">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Beri Gold</a>
				<a class="btn btn-primary btn-md" href="admin-dashboard.php" role="button">Admin Dashboard</a>
			</form>
		<?php } else { ?>
			<form class="form-inline my-2 my-lg-0">
				<a class="btn btn-primary btn-md" href="login.php" role="button">Login</a>
			</form>
		<?php } ?>
		
	</div>
</nav>