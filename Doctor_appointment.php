<?php
session_start();

if (!isset($_SESSION['duname'])) {
    header("Location: doctor_login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$duname = $_SESSION['duname'];

$doctor_sql = "SELECT D_ID FROM doctor_signup WHERE D_uname = ?";
$doctor_stmt = $conn->prepare($doctor_sql);
$doctor_stmt->bind_param('s', $duname);
$doctor_stmt->execute();
$doctor_result = $doctor_stmt->get_result();
$doctor = $doctor_result->fetch_assoc();

if (!$doctor) {
    die("Doctor not found.");
}

$D_ID = $doctor['D_ID'];

$appointments = [];
$appointment_sql = "SELECT appointments.*, patient_signup.P_name 
                    FROM appointments 
                    JOIN patient_signup ON appointments.P_ID = patient_signup.P_ID 
                    WHERE appointments.D_ID = ?";
$appointment_stmt = $conn->prepare($appointment_sql);
$appointment_stmt->bind_param('i', $D_ID);
$appointment_stmt->execute();
$appointment_result = $appointment_stmt->get_result();

if ($appointment_result->num_rows > 0) {
    while ($row = $appointment_result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link rel="stylesheet" href="style_appointments.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Your Appointments</h2>

    <?php if (!empty($appointments)): ?>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo $appointment['SL_no']; ?></td>
                        <td><?php echo htmlspecialchars($appointment['P_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>

    <br>
    <a href="Doctor.php">Back to Home</a>
</body>
</html>
