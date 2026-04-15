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
<?php 
$query = "SELECT patient_fname FROM Patients";

$record = getOneRow($query);

?>