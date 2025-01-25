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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dname = $_POST['dname'];
    $demail = $_POST['demail'];
    $dphone = $_POST['dphone'];
    $daddress = $_POST['daddress'];
    $category = $_POST['category'];

    $update_sql = "UPDATE doctor_signup SET D_name = ?, D_email = ?, D_phone = ?, D_address = ?, D_specialist = ? WHERE D_uname = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssss", $dname, $demail, $dphone, $daddress, $category, $duname);

    if ($update_stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='Doctor.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
