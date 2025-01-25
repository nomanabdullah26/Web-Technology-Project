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
    $delete_sql = "DELETE FROM doctor_signup WHERE D_uname = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("s", $duname);

    if ($delete_stmt->execute()) {
        if ($delete_stmt->affected_rows > 0) {
            session_destroy(); // Destroy the session
            echo "<script>alert('Account deleted successfully!'); window.location.href='doctor_login.php';</script>";
        } else {
            echo "<script>alert('Error: Account not found or already deleted.');</script>";
        }
    } else {
        echo "<script>alert('Error deleting account: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
