<?php
session_start();
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms1";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
if (isset($_SESSION['P_name'])) {
    $p_name = $_SESSION['P_name'];
} else {
    echo "Patient name is not available.";
    exit;  
}
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $pgender = isset($_POST['pgender']) ? $_POST['pgender'] : '';
    $pdob = isset($_POST['pdob']) ? $_POST['pdob'] : '';
    $pblood = isset($_POST['pblood']) ? $_POST['pblood'] : '';
    $pcontact = isset($_POST['pcontact']) ? $_POST['pcontact'] : '';
    $phistory = isset($_POST['phistory']) ? $_POST['phistory'] : '';
    $pprescriptions = isset($_POST['pprescriptions']) ? $_POST['pprescriptions'] : '';
    $ptestresults = isset($_POST['ptestresults']) ? $_POST['ptestresults'] : '';
    $ptreatments = isset($_POST['ptreatments']) ? $_POST['ptreatments'] : '';
 
    $patient_query = "SELECT P_ID FROM patient_signup WHERE P_name = '$p_name'";
    $result = $conn->query($patient_query);
 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $p_id = $row['P_ID'];
 
        $insert_query = "INSERT INTO medical_records (P_ID, P_name, blood_group, age, gender, date_of_birth, medical_history, prescriptions, test_results, ongoing_treatments)
                         VALUES ('$p_id', '$p_name', '$pblood', '$page', '$pgender', '$pdob', '$phistory', '$pprescriptions', '$ptestresults', '$ptreatments')";
 
        if (!$conn->query($insert_query)) {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "Patient not found.";
    }
}
 
$conn->close();
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Record</title>
    <link rel="stylesheet" href="icon_medicalRecords.css">
</head>
<body>
    <div>
    <form action="Patient_medicalRecords.php" method="POST">
        <label for="pname">Patient Name</label><br>
        <input type="text" id="pname" name="pname" value="<?php echo $p_name; ?>" readonly required><br><br>
 
        <label for="page">Patient Age</label><br>
        <input type="number" id="page" name="page" required><br><br>
 
        <label for="pgender">Patient Gender</label><br>
        <select id="pgender" name="pgender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>
 
        <label for="pdob">Date of Birth</label><br>
        <input type="date" id="pdob" name="pdob" required><br><br>
 
        <label for="pblood">Blood Group</label><br>
        <select id="pblood" name="pblood" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select><br><br>
 
        <label for="pcontact">Patient Contact Number</label><br>
        <input type="text" id="pcontact" name="pcontact" required><br><br>
 
        <label for="phistory">Medical History</label><br>
        <textarea id="phistory" name="phistory" rows="4" required></textarea><br><br>
 
        <label for="pprescriptions">Prescriptions</label><br>
        <textarea id="pprescriptions" name="pprescriptions" rows="4" required></textarea><br><br>
 
        <label for="ptestresults">Test Results</label><br>
        <textarea id="ptestresults" name="ptestresults" rows="4" required></textarea><br><br>
 
        <label for="ptreatments">Ongoing Treatments</label><br>
        <textarea id="ptreatments" name="ptreatments" rows="4" required></textarea><br><br>
 
        <input type="submit" value="Save Record" name="submit"><br><br>
    </form>
     <br><br>
        <a href="Patient.php"><button>Back to Home</button></a>
       
</div>
</body>
</html>