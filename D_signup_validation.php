<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Signup</title>
</head>
<body>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dname = sanitize_input($_POST['dname'] ?? '');
    $duname = sanitize_input($_POST['duname'] ?? '');
    $demail = sanitize_input($_POST['demail'] ?? '');
    $dphone = sanitize_input($_POST['dphone'] ?? '');
    $daddress = sanitize_input($_POST['daddress'] ?? '');
    $category = sanitize_input($_POST['category'] ?? '');
    $dpass = sanitize_input($_POST['dpass'] ?? '');
    $dcpass = sanitize_input($_POST['dcpass'] ?? '');

    $error_message = '';

    if (empty($dname)) {
        $error_message .= "Doctor name is required.<br>";
    }

    if (empty($duname)) {
        $error_message .= "Doctor username is required.<br>";
    }

    if (empty($demail) || !filter_var($demail, FILTER_VALIDATE_EMAIL)) {
        $error_message .= "Valid email is required.<br>";
    }

    if (empty($dphone) || !preg_match("/^01[0-9]{9}$/", $dphone)) {
        $error_message .= "Phone number must be 11 digits and start with '01'.<br>";
    }

    if (empty($daddress)) {
        $error_message .= "Doctor address is required.<br>";
    }

    if (empty($category)) {
        $error_message .= "Doctor specialty is required.<br>";
    }

    if (empty($dpass)) {
        $error_message .= "Password is required.<br>";
    } elseif ($dpass !== $dcpass) {
        $error_message .= "Passwords do not match.<br>";
    }

    if (empty($error_message)) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "hms1";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hashedPass = password_hash($dpass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO doctor_signup (D_name, D_uname, D_email, D_phone, D_address, D_specialist, D_pass)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssss', $dname, $duname, $demail, $dphone, $daddress, $category, $hashedPass);

        if ($stmt->execute()) {
            echo "Signup successful! Redirecting to login...";
            echo "<meta http-equiv='refresh' content='3;url=Doctor_login.php'>"; 
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<div style='color: red;'>" . $error_message . "</div>";
        echo "<meta http-equiv='refresh' content='5;url=Doctor_signup.php'>"; 
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
</body>
</html>
