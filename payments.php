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

if(!isset($_SESSION['pID'])) {
	header("Location: index.php");
}

$pID = $_SESSION['pID'];

$query = "SELECT *, ServiceDetails.base_price FROM AppointmentDetails LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id WHERE paid = 'Unpaid' AND patient_id = {$pID}";
$invoices = getRows($query);

$query2 = "SELECT *, ServiceDetails.base_price FROM AppointmentDetails LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id WHERE paid = 'Paid' AND patient_id = {$pID} ORDER BY appointment_date DESC";
$invoices2 = getRows($query2);

$query1 = "SELECT SUM(ServiceDetails.base_price) AS total_price FROM AppointmentDetails LEFT JOIN ServiceDetails ON AppointmentDetails.service_id=ServiceDetails.service_id WHERE paid = 'Unpaid' AND patient_id = {$pID}";
$totalprice = getOneRow($query1);

$total = $totalprice['total_price'];


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
						<p class="card-text">
							<form action="payments.php" method="POST">
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Invoice ID</th>
													<th>Appointment Date</th>
													<th>Service</th>
													<th>Appointment Cost</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($invoices) {
													foreach ($invoices as $invoice) {
														$app_date = $invoice['appointment_date'];
														

														echo"<tr>";
														echo "<td><input type='text' name='appID' value='{$invoice['appointment_id']}' readonly></td>";
														echo"<td>".date('F j, Y', strtotime($app_date))."</td>";
														echo"<td>{$invoice['service_name']}</td>";
														echo"<td>$".$invoice['base_price'].".00</td>";
														echo"</tr>";
													}
												}
												?>
											</tbody>
										</table>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-6">
									</div>
									<div class="col-3">
										<button type="submit" class="btn btn-primary float-right btn-sm" style="position: relative; top: 25px;" name='paytotal'>Make a Payment</button>
									</div>
									<div class="col-3">
										<label for="inputState">Payment Total</label>
										<input class="form-control" type="text" value="<?php echo $totalprice['total_price']?>" name="totalPrice" readonly>
									</div>

								</div>
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
							<form>
								<div class="form-group row">
									<div class="col">
										<table class="table table-bordered table-sm">
											<thead>
												<tr>
													<th>Session Date</th>
													<th>Service</th>
													<th>Session Cost</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($invoices2) {
													foreach ($invoices2 as $invoice2) {
														$past_date = $invoice2['appointment_date'];

														echo"<tr>";
														echo"<td>".date('F j, Y', strtotime($past_date))."</td>";
														echo"<td>{$invoice2['service_name']}</td>";
														echo"<td>$".$invoice2['base_price'].".00</td>";
														echo"</tr>";
													}
												}
												?>
												
											</tbody>
										</table>
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