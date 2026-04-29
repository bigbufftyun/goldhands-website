<?php
session_start();

require_once('dbhelper.php');
require_once('navbar.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$totalPatients = getOneRow("SELECT COUNT(*) AS total FROM Patients")['total'];
$totalTherapists = getOneRow("SELECT COUNT(*) AS total FROM Therapists")['total'];
$totalAppointments = getOneRow("SELECT COUNT(*) AS total FROM AppointmentDetails")['total'];
$totalServices = getOneRow("SELECT COUNT(*) AS total FROM ServiceDetails")['total'];
$totalNotes = getOneRow("SELECT COUNT(*) AS total FROM AppointmentNotes")['total'];

$sql = "
SELECT 
    a.appointment_id,
    a.appointment_date,
    a.app_start,
    a.app_end,
    a.status,
    p.patient_fname,
    p.patient_lname,
    t.therapist_fname,
    t.therapist_lname,
    s.service_name
FROM AppointmentDetails a
JOIN Patients p ON a.patient_id = p.patient_id
JOIN Therapists t ON a.therapist_id = t.therapist_id
JOIN ServiceDetails s ON a.service_id = s.service_id
ORDER BY a.appointment_id DESC
LIMIT 5
";

$appointments = getRows($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Analytics</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-2">Admin Analytics Dashboard</h2>
    <p class="text-muted mb-4">Overview of system activity and appointment data.</p>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Patients</h5>
                    <h2><?php echo $totalPatients; ?></h2>
                    <p class="text-muted">Registered patients</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Therapists</h5>
                    <h2><?php echo $totalTherapists; ?></h2>
                    <p class="text-muted">Therapists in system</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Appointments</h5>
                    <h2><?php echo $totalAppointments; ?></h2>
                    <p class="text-muted">Total appointments</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Services</h5>
                    <h2><?php echo $totalServices; ?></h2>
                    <p class="text-muted">Services offered</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Notes</h5>
                    <h2><?php echo $totalNotes; ?></h2>
                    <p class="text-muted">Appointment notes</p>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <h4 class="mt-4">Recent Appointments</h4>

    <table class="table table-bordered table-striped mt-3">
        <thead class="thead-dark">
            <tr>
                <th>Appointment ID</th>
                <th>Patient</th>
                <th>Therapist</th>
                <th>Service</th>
                <th>Date</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!empty($appointments)) {
                foreach ($appointments as $row) {
                    echo "<tr>";
                    echo "<td>{$row['appointment_id']}</td>";
                    echo "<td>{$row['patient_fname']} {$row['patient_lname']}</td>";
                    echo "<td>{$row['therapist_fname']} {$row['therapist_lname']}</td>";
                    echo "<td>{$row['service_name']}</td>";
                    echo "<td>{$row['appointment_date']}</td>";
                    echo "<td>{$row['app_start']}</td>";
                    echo "<td>{$row['app_end']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No appointments found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</div>

</body>
</html>
