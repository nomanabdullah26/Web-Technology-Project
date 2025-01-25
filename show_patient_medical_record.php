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

$sql = "
    SELECT 
        mr.P_name, mr.age, mr.gender, mr.date_of_birth, 
        mr.blood_group, mr.medical_history, mr.prescriptions, 
        mr.test_results, mr.ongoing_treatments
    FROM 
        medical_records AS mr
    INNER JOIN 
        doctor_signup AS d 
    ON 
        D_ID = d.D_ID
    WHERE 
        d.D_uname = ?;
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $duname);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Records</title>
    <link rel="stylesheet" href="style_mrecord.css">
</head>
<body>
    <h2>Patient Medical Records</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Blood Group</th>
                    <th>Medical History</th>
                    <th>Prescriptions</th>
                    <th>Test Results</th>
                    <th>Ongoing Treatments</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['P_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['medical_history'])); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['prescriptions'])); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['test_results'])); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['ongoing_treatments'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No medical records found for your patients.</p>
    <?php endif; ?>

    <a href="Doctor.php">Back to Home</a>
</body>
</html>

