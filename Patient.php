<?php
session_start();

if (!isset($_SESSION['P_ID'])) {
    header("Location: patient_login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: patient_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Home Page</title>
    <link rel="stylesheet" href="icon_patientHome.css">

</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['P_name']); ?></h2>

    <div class="Profile">
        <form action="Patient_profile.php" method="post">
            <label for="Patient full name">Patient Profile</label><br>
            <input type="submit" value="Profile">
        </form>
    </div>
    <div class="medicalRecords">
        <form action="Patient_medicalRecords.php" method="post">
            <label for="Patient full name">Patient Medical Record</label><br>
            <input type="submit" value="Medical Records">
        </form>
    </div>
    <div class="appointment">
        <form action="Patient_appointment.php" method="post">
            <label for="Patient full name">Patient Appointment</label><br>
            <input type="submit" value="Appointment">
        </form>
    </div>
    <div class="logout">
        <a href="patient_login.php?logout=true">Logout</a>
    </div>
</body>
</html>
