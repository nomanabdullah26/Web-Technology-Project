<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the patient name is available from the session
if (isset($_SESSION['P_name'])) {
    $p_name = $_SESSION['P_name'];
} else {
    echo "Patient name is not available.";
    exit;
}

// Fetch patient details from the `patient_signup` table
$patient_query = "SELECT P_ID, P_name, P_uname, P_email, P_phone, P_address FROM patient_signup WHERE P_name = '$p_name'";
$result = $conn->query($patient_query);

if ($result->num_rows > 0) {
    $patient_data = $result->fetch_assoc();
    $p_id = $patient_data['P_ID'];  // Store P_ID for later use
} else {
    echo "Patient not found.";
    exit;
}

// Fetch medical history from the `medical_records` table
$medical_query = "SELECT medical_history FROM medical_records WHERE P_ID = '$p_id'";
$medical_result = $conn->query($medical_query);

if ($medical_result->num_rows > 0) {
    $medical_data = $medical_result->fetch_assoc();
    $medical_history = $medical_data['medical_history'];
} else {
    echo "Medical records not found.";
    exit;
}

// Handle the profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch updated values from the form
    $updated_pname = $_POST['pname'] ?? $patient_data['P_name'];
    $updated_pemail = $_POST['pemail'] ?? $patient_data['P_email'];
    $updated_pphone = $_POST['pphone'] ?? $patient_data['P_phone'];
    $updated_paddress = $_POST['paddress'] ?? $patient_data['P_address'];
    $updated_pmedicalHistory = $_POST['pmedicalHistory'] ?? $medical_history;

    // Update patient information in the `patient_signup` table
    $update_query = "UPDATE patient_signup 
                     SET P_name = '$updated_pname', P_email = '$updated_pemail', P_phone = '$updated_pphone', 
                         P_address = '$updated_paddress'
                     WHERE P_ID = '$p_id'";

    if ($conn->query($update_query) === TRUE) {
        // Update medical history in the `medical_records` table
        $update_history_query = "UPDATE medical_records 
                                 SET medical_history = '$updated_pmedicalHistory'
                                 WHERE P_ID = '$p_id'";

        if ($conn->query($update_history_query) === TRUE) {
            // Update the session with the new patient name
            $_SESSION['P_name'] = $updated_pname;

            // Redirect back to the form
            header("Location: patient_profile.php");
            exit;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="icon_profile.css">
</head>
<body>
    <h2>Patient Profile</h2>

    <div class="profile-container">
        <!-- Displaying Patient Information -->
        <form method="POST" action="patient_profile.php">
            <div class="profile-details">
                <label for="pname">Name:</label>
                <input type="text" id="pname" name="pname" value="<?php echo htmlspecialchars($patient_data['P_name']); ?>" required><br><br>

                <label for="pusername">Username:</label>
                <input type="text" id="pusername" name="pusername" value="<?php echo htmlspecialchars($patient_data['P_uname']); ?>" readonly><br><br>

                <label for="pemail">Email:</label>
                <input type="email" id="pemail" name="pemail" value="<?php echo htmlspecialchars($patient_data['P_email']); ?>" required><br><br>

                <label for="pphone">Phone Number:</label>
                <input type="text" id="pphone" name="pphone" value="<?php echo htmlspecialchars($patient_data['P_phone']); ?>" required><br><br>

                <label for="paddress">Address:</label>
                <input type="text" id="paddress" name="paddress" value="<?php echo htmlspecialchars($patient_data['P_address']); ?>" required><br><br>
            </div>

            <div class="medical-history">
                <h3>Medical History</h3>
                <label for="pmedicalHistory">History:</label><br>
                <textarea id="pmedicalHistory" name="pmedicalHistory" rows="6" required><?php echo htmlspecialchars($medical_history); ?></textarea><br><br>
            </div>

            <!-- Submit Button -->
            <button type="submit">Update Profile</button>
        </form>

        <!-- Back to Home Button -->
        <br><br>
        <a href="Patient.php"><button>Back to Home</button></a>
    </div>
</body>
</html>
