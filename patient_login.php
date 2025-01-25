<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link rel="stylesheet" href="icon_login.css">
</head>
<body>
    <h2>Login to the Patient Page</h2>
    <div class="loginPatient">
        <form action="patient_login_validation.php" method="post">
            <label for="p_uname">Patient Username</label>
            <input type="text" id="p_uname" placeholder="Enter username" name="p_uname" required>
            <label for="p_pass">Patient Password</label>
            <input type="password" id="p_pass" placeholder="Enter password" name="p_pass" required>
            <input type="submit" value="Log in" name="submit">
        </form>
    </div>
    <div class="signin">
        <form action="Patient_signup.php" method="post">
            <label>Don't have an account? Create one now!</label>
            <input type="submit" value="Sign up" name="submit">
        </form>
        
    </div>
    <a href="index.html"><button>Back to Home</button></a>
</body>
</html>
