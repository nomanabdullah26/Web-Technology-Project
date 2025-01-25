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
    $duname = $_POST['duname'] ?? '';
    $dpass = $_POST['dpass'] ?? '';

    if (!empty($duname) && !empty($dpass)) {
        $stmt = $conn->prepare("SELECT D_pass FROM doctor_signup WHERE D_uname = ?");
        $stmt->bind_param("s", $duname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($dpass, $row['D_pass'])) {
                $_SESSION['duname'] = $duname; 
                header("Location: Doctor.php"); 
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <link rel="stylesheet" href="style1.css"> 
</head>
<body>
    <h2>Login to the Doctor Page</h2>
    <div class="logindoc">
        <form action="" method="post">
            <label for="duname">Doctor Login</label><br>
            <input type="text" id="duname" placeholder="Doctor username" name="duname" 
                   value="<?php echo htmlspecialchars($duname ?? ''); ?>" required><br>
            <input type="password" id="dpass" placeholder="Doctor password" name="dpass" required><br>
            <?php if ($error): ?>
                <span><?php echo $error; ?></span><br>
            <?php endif; ?>
            <input type="submit" value="Log in" name="submit"><br>
        </form>
    </div>
    <div class="signin">
        <form action="Doctor_signup.php" method="post">
            <label for="duname">Don't have an account? Create one now!</label>
            <input type="submit" value="Sign up" name="submit"><br>
        </form>
    </div>
    <div class="button-container">
        <a href="index.html" class="button-link">Back to Home</a>
    </div>
</body>
</html>

