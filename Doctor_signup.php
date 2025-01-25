<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor_signup</title>
    <link rel="stylesheet" href="style_signup.css">
</head>
<body>
    <div class="Signupdoc">
        <form action="D_signup_validation.php" method="post">
            <label for="dname">Doctor Name</label><br>
            <input type="text" id="dname" placeholder="Doctor full name" name="dname"><br><br>
            
            <label for="duname">Doctor Username</label><br>
            <input type="text" id="duname" placeholder="Doctor username" name="duname"><br><br>
            
            <label for="demail">Doctor Email</label><br>
            <input type="text" id="demail" placeholder="Doctor email" name="demail"><br><br>
            
            <label for="dphone">Doctor Phone No.</label><br>
            <input type="text" id="dphone_no" placeholder="Doctor phone_number" name="dphone"><br><br>
            
            <label for="daddress">Doctor Address</label><br>
            <input type="text" id="daddress" placeholder="Doctor address" name="daddress"><br><br>
            
            <label for="category">Choose a Doctor's Specialty: </label><br>
            <select id="category" name="category">
                <option value="General Practitioner">General Practitioner</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Neurology">Neurology</option>
                <option value="Orthopedic Surgery">Orthopedic Surgery</option>
                <option value="Dermatology">Dermatology</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Oncology">Oncology</option>
                <option value="Radiology">Radiology</option>
                <option value="Anesthesiology">Anesthesiology</option>
            </select><br><br>
            
            <label for="dpassword">Doctor Password</label><br>
            <input type="password" id="dpass" placeholder="Doctor password" name="dpass"><br><br>
            
            <label for="dcpassword">Confirm Password</label><br>
            <input type="password" id="dcpass" placeholder="Doctor confirm password" name="dcpass"><br><br>

            <input type="submit" value="Submit" name="submit"><br>
        </form>
    </div>

</body>
</html>
