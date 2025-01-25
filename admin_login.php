<?php
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = $_POST['username'];
    $admin_pass = $_POST['password'];

    // Hardcoded admin credentials
    $admins = [
        "admin1" => "1234",
        "admin2" => "4321"
    ];

    // Check credentials
    if (array_key_exists($admin_user, $admins) && $admins[$admin_user] === $admin_pass) {
        // Successful login
        $_SESSION['admin_user'] = $admin_user;
        header("Location: welcome.php");
        exit();
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid username or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .login-form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            display: block;
            margin: 10px auto;
            padding: 10px;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }
        .login-form input:focus {
            border-color: #333;
            box-shadow: 0 0 10px #333;
        }
        .password-wrapper {
            position: relative;
            width: 90%;
            margin: 10px auto;
        }
        .password-wrapper input {
            width: 100%;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #555;
        }
        .login-form input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: 0.3s ease-in-out;
        }
        .login-form input[type="submit"]:hover {
            background-color: #555;
        }
        .back-button {
            text-decoration: none;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            display: inline-block;
            margin-top: 20px;
            transition: 0.3s ease-in-out;
        }
        .back-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <form id="loginForm" method="POST" action="">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span id="togglePassword" class="toggle-password">👁️</span>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
    <a href="index.html" class="back-button">Back to Home</a>
    <script>
        // Toggle Password Visibility
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("togglePassword");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.textContent = "🙈"; // Change icon
            } else {
                passwordField.type = "password";
                toggleIcon.textContent = "👁️"; // Change icon
            }
        }

        // Attach Event Listeners
        document.addEventListener("DOMContentLoaded", () => {
            const passwordToggle = document.getElementById("togglePassword");
            passwordToggle.addEventListener("click", togglePasswordVisibility);
        });
    </script>
</body>
</html>
