<?php
session_start();

if (!isset($_SESSION['P_ID'])) {
    header("Location: patient_login.php");
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

$doctors = [];
$sql = "SELECT D_ID, D_name FROM doctor_signup";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $P_ID = $_SESSION['P_ID'];
    $P_name = $_SESSION['P_name']; 
    $D_ID = $_POST['doctor_id'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $time = $_POST['time'] ?? '';

    if (empty($D_ID) || empty($appointment_date) || empty($time)) {
        $error_message = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (D_ID, P_ID, appointment_date, time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiss', $D_ID, $P_ID, $appointment_date, $time);

        if ($stmt->execute()) {
            $success_message = "Your appointment has been successfully booked.";
        } else {
            $error_message = "Error booking appointment: " . $conn->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="icon_appointment.css">
</head>
<body>
    <h2>Book an Appointment</h2>
    
    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php elseif (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="Patient_appointment.php" method="post">
        <label for="doctor_id">Select Doctor:</label><br>
        <select id="doctor_id" name="doctor_id" required>
            <option value="">-- Choose a Doctor --</option>
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?php echo $doctor['D_ID']; ?>">
                    <?php echo htmlspecialchars($doctor['D_name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="appointment_date">Appointment Date:</label><br>
        <input type="date" id="appointment_date" name="appointment_date" required><br><br>

        <label for="time">Time:</label><br>
        <input type="time" id="time" name="time" required><br><br>

        <button type="submit">Book Appointment</button>
    </form>

    <br>
    <a href="Patient.php">Back to Home</a>
</body>
</html>
