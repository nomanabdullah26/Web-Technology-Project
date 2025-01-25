<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .button-container {
            margin-top: 20px;
        }
        .button {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px;
            display: inline-block;
        }
        .button:hover {
            background-color: #555;
        }
        .logout-button {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 20px;
        }
        .logout-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['admin_user']; ?>!</h1>
    <p>You have successfully logged in to the Admin Panel.</p>

    <div class="button-container">
        <a href="doctor_history.php" class="button">Doctor History</a>
        <a href="patient_history.php" class="button">Patient History</a>
    </div>

    <a href="Admin_loguot.php" class="logout-button">Logout</a>
</body>
</html>
