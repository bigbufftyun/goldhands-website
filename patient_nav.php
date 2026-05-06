
<?php if(isset($_SESSION['accessLevel']) AND $_SESSION['accessLevel'] == 1) { ?>
	<div class="col-2">
		<div class="card">
			<h5 class="card-header">Patient Dashboard</h5>
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link active" href="dashboard.php">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="schedule-app.php">Schedule Appointment</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="appointment-history.php">Appointment History</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="payments.php">Payments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="p-profile-settings.php">Profile Settings</a>
				</li>
				<li>
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</div>

<?php } if(isset($_SESSION['accessLevel']) AND $_SESSION['accessLevel'] == 2) { ?>
	<div class="col-2">
				<div class="card">
					<h5 class="card-header">Therapist Dashboard</h5>
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="therapist-dashboard.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="app-details.php">Appointment Details</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="health-records.php">Health Records</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="t-schedule-mgmt.php">Schedule Management</a>
						</li>
						<li>
							<a class="nav-link" href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
<?php } if(isset($_SESSION['accessLevel']) AND $_SESSION['accessLevel'] == 3) { ?>
	<div class="col-2">
				<div class="card">
					<h5 class="card-header">Admin Dashboard</h5>
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="admin-dashboard.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="a-health-records.php">Health Records</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="manage-therapist.php">Manage Therapists</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="manage-schedule.php">Manage Schedules</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="manage-service.php">Manage Services</a>
						</li>
						<li>
						<li class="nav-item">
							<a class="nav-link" href="admin-analytics.php">Analytics</a>
						</li>
						<li>
							<a class="nav-link" href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
<?php } ?>