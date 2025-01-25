<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="style_dprofile.css">
</head>
<body>
    <div class="form-container">
        <h2>Doctor Profile</h2>

        <?php
        session_start();
        if (!isset($_SESSION['duname'])) {
            header("Location: doctor_login.php");
            exit();
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "hms1";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $duname = $_SESSION['duname'];
        $sql = "SELECT * FROM doctor_signup WHERE D_uname = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $duname);
        $stmt->execute();
        $result = $stmt->get_result();
        $doctor = $result->fetch_assoc();

        if ($doctor):
        ?>

        <form action="update_doctor.php" method="post">
            <label for="dname">Doctor Name:</label>
            <input type="text" id="dname" name="dname" value="<?php echo htmlspecialchars($doctor['D_name']); ?>" required>

            <label for="demail">Doctor Email:</label>
            <input type="email" id="demail" name="demail" value="<?php echo htmlspecialchars($doctor['D_email']); ?>" required>

            <label for="dphone">Doctor Phone:</label>
            <input type="text" id="dphone" name="dphone" value="<?php echo htmlspecialchars($doctor['D_phone']); ?>" required>

            <label for="daddress">Doctor Address:</label>
            <input type="text" id="daddress" name="daddress" value="<?php echo htmlspecialchars($doctor['D_address']); ?>" required>

            <label for="category">Choose a Doctor's Specialty:</label>
            <select id="category" name="category">
                <option value="General Practitioner" <?php echo ($doctor['D_specialist'] === 'General Practitioner') ? 'selected' : ''; ?>>General Practitioner</option>
                <option value="Pediatrics" <?php echo ($doctor['D_specialist'] === 'Pediatrics') ? 'selected' : ''; ?>>Pediatrics</option>
                <option value="Cardiology" <?php echo ($doctor['D_specialist'] === 'Cardiology') ? 'selected' : ''; ?>>Cardiology</option>
                <option value="Neurology" <?php echo ($doctor['D_specialist'] === 'Neurology') ? 'selected' : ''; ?>>Neurology</option>
                <option value="Orthopedic Surgery" <?php echo ($doctor['D_specialist'] === 'Orthopedic Surgery') ? 'selected' : ''; ?>>Orthopedic Surgery</option>
                <option value="Dermatology" <?php echo ($doctor['D_specialist'] === 'Dermatology') ? 'selected' : ''; ?>>Dermatology</option>
                <option value="Psychiatry" <?php echo ($doctor['D_specialist'] === 'Psychiatry') ? 'selected' : ''; ?>>Psychiatry</option>
                <option value="Oncology" <?php echo ($doctor['D_specialist'] === 'Oncology') ? 'selected' : ''; ?>>Oncology</option>
                <option value="Radiology" <?php echo ($doctor['D_specialist'] === 'Radiology') ? 'selected' : ''; ?>>Radiology</option>
                <option value="Anesthesiology" <?php echo ($doctor['D_specialist'] === 'Anesthesiology') ? 'selected' : ''; ?>>Anesthesiology</option>
            </select><br><br>

            <input type="submit" name="update" value="Update Profile">
        </form>

        <form action="delete_doctor.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <input type="submit" name="delete" value="Delete Account">
        </form>

        <?php else: ?>
            <p>No doctor found with this username.</p>
        <?php endif; ?>

    </div>

    <br>
    <a href="Doctor.php">Back to Home</a>
</body>
</html>
