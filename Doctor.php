<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: doctor_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Home Page</title>
    <link rel="stylesheet" href="style_dhome.css">
</head>
<body>
    <h2>Welcome, Dr. <?php echo htmlspecialchars($_SESSION['duname'] ?? 'User'); ?></h2>
    <div class="button-container">
        <form action="Doctor_profile.php" method="post">
            <label for="profile">Doctor Profile</label><br>
            <input type="submit" value="Profile">
        </form>

        <form action="Doctor_appointment.php" method="post">
            <label for="appointment">Doctor Appointment</label><br>
            <input type="submit" value="Appointment">
        </form>

        <form action="show_patient_medical_record.php" method="GET">
            <label for="medical_record">Patient Medical Record</label><br>
            <input type="submit" value="Show">
        </form>

        <form action="Doctor_schedual.php" method="GET">
            <label for="schedual">Your appoinment schedual</label><br>
            <input type="submit" value="Schedual">
        </form>

        <form action="" method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>
</body>
</html>
