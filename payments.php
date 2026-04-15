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

	<title>Payments</title>
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
						<h1 class="display-4">Payments</h1>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Current Balance
					</div>
					<div class="card-body">
						<p class="card-text text-right">Invoice #0054</p>
						<p class="card-text">
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Session Cost</th>
													<th>Session Date</th>
													<th>Service</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>$200.00</td>
													<td>03/20/2026</td>
													<td>Counseling</td>
												</tr>
												<tr>
													<td>$250.00</td>
													<td>03/23/2026</td>
													<td>Counseling</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-4">
										<label for="inputState">Payment Total</label>
										<input class="form-control" type="text" placeholder="$450.00" readonly>
									</div>
									<div class="col-8">
										<label for="inputState">Payment Method</label>
										<select id="inputState" class="form-control">
											<option selected>Choose...</option>
											<option>PayPal</option>
											<option>Insurance</option>
										</select>
									</div>
								</div>

								<button type="submit" class="btn btn-primary">Submit Payment</button>

							</form>
						</p>
					</div>
				</div>
				<p></p>
				<div class="card">
					<div class="card-header">
						Previous Payments
					</div>
					<div class="card-body">
						<p class="card-text">
							February
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Session Cost</th>
													<th>Session Date</th>
													<th>Service</th>
													<th>Payment Type</th>
													<th>Invoice #</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>$200.00</td>
													<td>03/20/2026</td>
													<td>Counseling</td>
													<td>PayPal</td>
													<td>#0012</td>
												</tr>
												<tr>
													<td>$250.00</td>
													<td>03/23/2026</td>
													<td>Counseling</td>
													<td>Insurance</td>
													<td>#0010</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-4">
										<label for="inputState">Payment Total</label>
										<input class="form-control" type="text" placeholder="$450.00" readonly>
									</div>
								</div>

							</form>
						</p>
						<hr>
						<p class="card-text">
							January
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Session Cost</th>
													<th>Session Date</th>
													<th>Service</th>
													<th>Payment Type</th>
													<th>Invoice #</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>$200.00</td>
													<td>03/20/2026</td>
													<td>Counseling</td>
													<td>PayPal</td>
													<td>#0012</td>
												</tr>
												<tr>
													<td>$250.00</td>
													<td>03/23/2026</td>
													<td>Counseling</td>
													<td>Insurance</td>
													<td>#0010</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-4">
										<label for="inputState">Payment Total</label>
										<input class="form-control" type="text" placeholder="$450.00" readonly>
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