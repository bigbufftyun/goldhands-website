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

	<title>Schedule Appointment</title>
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
						<h1 class="display-4">Schedule Appointment</h1>
					</div>
				</div>
				<form>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputState">Step 1: Select Service</label>
							<select id="inputState" class="form-control">
								<option selected>Choose...</option>
								<option>Counseling</option>
								<option>Psychiatric Rehabilitation</option>
								<option>Group Therapy</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="inputState">Step 2: Select Therapist</label>
							<select id="inputState" class="form-control">
								<option selected>Choose...</option>
								<option>Dr. Min</option>
								<option>Dr. Kang</option>
								<option>Dr. Pancham</option>
							</select>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="exampleFormControlSelect2">Step 3: Select Date</label>
							<select multiple class="form-control" id="exampleFormControlSelect2">
								<option>April 9th, 2026</option>
								<option>April 10th, 2026</option>
								<option>April 13th, 2026</option>
								<option>April 15th, 2026</option>
								<option>April 16th, 2026</option>
							</select>
						</div>
						<div class="col-md-4">
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<th colspan="7">April 2026</th>
									</tr>
									<tr>
										<th scope="col">Sun</th>
										<th scope="col">Mon</th>
										<th scope="col">Tue</th>
										<th scope="col">Wed</th>
										<th scope="col">Thur</th>
										<th scope="col">Fri</th>
										<th scope="col">Sat</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>29</td>
										<td>30</td>
										<td>31</td>
										<td>1</td>
										<td>2</td>
										<td>3</td>
										<td>4</td>
									</tr>
									<tr>
										<td>5</td>
										<td>6</td>
										<td>7</td>
										<td>8</td>
										<td>9</td>
										<td>10</td>
										<td>11</td>
									</tr>
									<tr>
										<td>12</td>
										<td>13</td>
										<td>14</td>
										<td>15</td>
										<td>16</td>
										<td>17</td>
										<td>18</td>
									</tr>
									<tr>
										<td>19</td>
										<td>20</td>
										<td>21</td>
										<td>22</td>
										<td>23</td>
										<td>24</td>
										<td>25</td>
									</tr>
									<tr>
										<td>26</td>
										<td>27</td>
										<td>28</td>
										<td>29</td>
										<td>30</td>
										<td>1</td>
										<td>2</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-group">
						<label for="inputState">Step 4: Select Timeslot</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>10:30AM - 11:00AM</option>
							<option>12:00PM - 1:30PM</option>
							<option>2:30PM - 3:15PM</option>
							<option>4:15PM - 5PM</option>
						</select>
					</div>
					
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="submit" class="btn btn-primary">Cancel</button>
				</form>
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