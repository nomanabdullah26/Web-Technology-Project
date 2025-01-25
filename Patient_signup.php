<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient_signup</title>
    <link rel="stylesheet" href="icon_signup.css">
</head>
   <body>
       <div class="SignupPatient">
          <form action="Patient_validation.php" method="post">
            <label for="pname">Patient Name</label><br>
            <input type="text" id="p_name" placeholder="Patient full name" name="p_name" required><br><br>
            <label for="puname">Patient Username</label><br>
            <input type="text" id="p_uname" placeholder="Patient username" name="p_uname" required><br><br>
            <label for="p_email">Patient Email</label><br>
            <input type="text" id="p_email" placeholder="Patient email" name="p_email" required><br><br>
            <label for="p_phone">Patient Phone No.</label><br>
            <input type="text" id="p_phone_no" placeholder="Patient phone_number" name="p_phone" required><br><br>
            <label for="p_address">Patient Address</label><br>
            <input type="text" id="p_address" placeholder="Patient address" name="p_address" required><br><br>
            <label for="p_password">Patient Password</label><br>
            <input type="password" id="p_pass" placeholder="Patient password" name="p_pass" required><br><br>
            <label for="p_cpassword">Confirm Password</label><br>
            <input type="password" id="p_cpass" placeholder="Patient confirm password" name="p_cpass" required><br><br>
 
            <input type="submit" value="Submit" name="submit"><br>
           </form>
        </div>

    </body>
</html>
 
