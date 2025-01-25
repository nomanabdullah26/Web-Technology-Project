<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p_name = sanitize_input($_POST['p_name'] ?? '');
    $p_uname = sanitize_input($_POST['p_uname'] ?? '');
    $p_email = sanitize_input($_POST['p_email'] ?? '');
    $p_phone = sanitize_input($_POST['p_phone'] ?? '');
    $p_address = sanitize_input($_POST['p_address'] ?? '');
    $p_pass = sanitize_input($_POST['p_pass'] ?? '');
    $p_cpass = sanitize_input($_POST['p_cpass'] ?? '');

    $error_message = '';

    if (empty($p_name)) $error_message .= "Patient name is required.<br>";
    if (empty($p_uname)) $error_message .= "Patient username is required.<br>";
    if (empty($p_email) || !filter_var($p_email, FILTER_VALIDATE_EMAIL)) $error_message .= "Valid email is required.<br>";
    if (empty($p_phone) || !preg_match("/^[0-9]{10,15}$/", $p_phone)) $error_message .= "Phone number must be 10-15 digits.<br>";
    if (empty($p_address)) $error_message .= "Patient address is required.<br>";
    if (empty($p_pass)) $error_message .= "Password is required.<br>";
    if ($p_pass !== $p_cpass) $error_message .= "Passwords do not match.<br>";

    if (empty($error_message)) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "hms1";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

        $hashedPass = password_hash($p_pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO patient_signup (P_name, P_uname, P_email, P_phone, P_address, P_pass) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $p_name, $p_uname, $p_email, $p_phone, $p_address, $hashedPass);

        if ($stmt->execute()) {
            echo "Signup successful! Redirecting to login...";
            echo "<meta http-equiv='refresh' content='3;url=patient_login.php'>";
        } else {
            echo "SQL Execution Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "<div style='color: red;'>" . $error_message . "</div>";
        echo "<meta http-equiv='refresh' content='5;url=Patient.php'>";
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
