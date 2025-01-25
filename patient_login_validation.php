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

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_uname = $_POST['p_uname'] ?? '';
    $p_pass = $_POST['p_pass'] ?? '';

    if (!empty($p_uname) && !empty($p_pass)) {
        $stmt = $conn->prepare("SELECT P_ID, P_name, P_pass FROM patient_signup WHERE P_uname = ?");
        $stmt->bind_param("s", $p_uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($p_pass, $row['P_pass'])) {
                $_SESSION['P_ID'] = $row['P_ID'];
                $_SESSION['P_name'] = $row['P_name'];
                $_SESSION['P_uname'] = $p_uname;

                header("Location: Patient.php");
                exit();
            } else {
                $error = "Invalid username or password!";
            }
        } else {
            $error = "Invalid username or password!";
        }
        $stmt->close();
    } else {
        $error = "Please fill in all fields!";
    }
}

if (!empty($error)) {
    echo "<script>alert('$error'); window.location.href='patient_login.php';</script>";
}

$conn->close();
?>
