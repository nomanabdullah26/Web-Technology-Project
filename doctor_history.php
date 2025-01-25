<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "hms1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctor profiles
$sql = "SELECT D_ID, D_name, D_uname, D_email, D_phone, D_specialist FROM doctor_signup";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profiles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Doctor Profiles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Specialist</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['D_ID']}</td>
                        <td>{$row['D_name']}</td>
                        <td>{$row['D_uname']}</td>
                        <td>{$row['D_email']}</td>
                        <td>{$row['D_phone']}</td>
                        <td>{$row['D_specialist']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="welcome.php" class="back-button">Back to Admin Panel</a>
</body>
</html>

<?php $conn->close(); ?>
