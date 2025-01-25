<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

// Read the JSON file
$json_data = file_get_contents("patients.json");
$patients = json_decode($json_data, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .button-container {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Patient Medical Records</h1>
    <table>
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Medical History</th>
                <th>Prescriptions</th>
                <th>Ongoing Treatments</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($patients as $patient) {
                echo "<tr>
                    <td>{$patient['P_ID']}</td>
                    <td>{$patient['P_name']}</td>
                    <td>{$patient['blood_group']}</td>
                    <td>{$patient['age']}</td>
                    <td>{$patient['gender']}</td>
                    <td>{$patient['medical_history']}</td>
                    <td>{$patient['prescriptions']}</td>
                    <td>{$patient['ongoing_treatments']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="button-container">
        <button class="button" onclick="window.print()">Print Medical Records</button>
        <a href="welcome.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
