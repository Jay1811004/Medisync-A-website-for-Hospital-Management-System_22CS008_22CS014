<?php
include("include/connection.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['apply'])) {
    // Sanitize inputs
    $firstname = mysqli_real_escape_string($connect, $_POST['fname']);
    $surname = mysqli_real_escape_string($connect, $_POST['sname']);
    $username = mysqli_real_escape_string($connect, $_POST['uname']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['number']);
    $gender = mysqli_real_escape_string($connect, $_POST['gender']);
    $city = mysqli_real_escape_string($connect, $_POST['country']);  // Corrected variable
    $role = mysqli_real_escape_string($connect, $_POST['role']);     // Corrected variable
    $qualification = mysqli_real_escape_string($connect, $_POST['qualification']);
    $experience = mysqli_real_escape_string($connect, $_POST['exprience']);  // Typo corrected
    $password = mysqli_real_escape_string($connect, $_POST['pass']);
    $confirm_password = mysqli_real_escape_string($connect, $_POST['con_pass']);
    
    $error = array();
    if (empty($firstname)) {
        $error['apply'] = "Enter Firstname";
    } else if (empty($surname)) {
        $error['apply'] = "Enter Surname";
    } else if (empty($username)) {
        $error['apply'] = "Enter Username";
    } else if (empty($phone)) {
        $error['apply'] = "Enter Phone No";
    } else if (empty($gender)) {
        $error['apply'] = "Select Gender";
    } else if (empty($city)) {
        $error['apply'] = "Select City name";
    } else if (empty($role)) {
        $error['apply'] = "Select job role/position";
    } else if (empty($qualification)) {
        $error['apply'] = "Enter your qualification";
    } else if (empty($experience)) {  // Typo corrected
        $error['apply'] = "Enter your experience";
    } else if ($confirm_password != $password) {
        $error['apply'] = "Both Passwords do not match";
    }

    if (count($error) == 0) {
        $query = "INSERT INTO `staff`(`firstname`, `surname`, `username`, `email`, `gender`, `phone`, `city`, `qualification`, `role`, `experience`, `password`, `salary`, `date_reg`, `status`)
                  VALUES ('$firstname','$surname','$username','$email','$gender','$phone','$city','$qualification','$role','$experience','$password','0',NOW(),'pending')";

        // Debug query
        echo $query;

        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "<script>alert('You have Successfully applied')</script>";
            echo "<script>window.location.href='index.php';</script>"; // Redirect with JS
            exit(); // Stop script execution after redirection
        } else {
            echo "<script>alert('Failed: " . mysqli_error($connect) . "')</script>";
        }
    }
}

if (isset($error['apply'])) {
    $s = $error['apply'];
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Now!!!</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        .image {
            background-image: url('img/staff_img.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 100%;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            max-height: 90vh; /* Adjust to fit the image */
            overflow-y: auto;
            margin-right:1000px;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .danger {
            color: red;
            font-weight: bolder;
        }
        .image .login-container h5{
            color: Blue;
        }
    </style>
    <script>
        function validateForm() {
            var firstname = document.forms["applyForm"]["fname"].value;
            var surname = document.forms["applyForm"]["sname"].value;
            var username = document.forms["applyForm"]["uname"].value;
            var email = document.forms["applyForm"]["email"].value;
            var gender = document.forms["applyForm"]["gender"].value;
            var phone = document.forms["applyForm"]["number"].value;
            var city = document.forms["applyForm"]["country"].value;
            var qualification = document.forms["applyForm"]["qualification"].value;
            var role = document.forms["applyForm"]["role"].value;
            var exprience = document.forms["applyForm"]["exprience"].value;
            var password = document.forms["applyForm"]["pass"].value;
            var confirm_password = document.forms["applyForm"]["con_pass"].value;

            if (firstname == "") {
                alert("Enter Firstname");
                return false;
            }
            if (surname == "") {
                alert("Enter Surname");
                return false;
            }
            if (username == "") {
                alert("Enter Username");
                return false;
            }
            if (gender == "") {
                alert("Select Gender");
                return false;
            }
            if (phone == "") {
                alert("Enter Phone Number");
                return false;
            }
            if (city == "") {
                alert("Select City");
                return false;
            }
            if (qualification == "") {
                alert("Enter your qualification");
                return false;
            }
            if (role == "") {
                alert("Enter your job role/position");
                return false;
            }
            if (exprience == "") {
                alert("Enter your exprience");
                return false;
            }
            if (password == "") {
                alert("Enter Password");
                return false;
            }
            if (confirm_password != password) {
                alert("Both Passwords do not match");
                return false;
            }
            return true; // Form is valid
        }
    </script>
</head>
<body>
    <?php include("include/header.php"); ?>
    <div class="image">
        <div class="login-container">
            <center>
                <h5>Apply Now!!!</h5>
            </center>
            <form name="applyForm" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>FirstName</label>
                    <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter FirstName" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                </div>
                <div class="form-group">
                    <label>SurName</label>
                    <input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter SurName" value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
                </div>
                <div class="form-group">
                    <label>UserName</label>
                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter UserName" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter email address" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
                <div class="form-group">
                    <label>Select Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="number" class="form-control" autocomplete="off" placeholder="Enter Phone Number"  value="<?php if(isset($_POST['number'])) echo $_POST['number']; ?>">
                </div>

                
                <div class="form-group">
                    <label>Select City</label>
                    <select name="country" class="form-control">
                        <option value="">Select City</option>
                        <option value="Ankleshwar">Ankleshwar</option>
                        <option value="Bharuch">Bharuch</option>
                        <option value="Navsari">Navsari</option>
                        <option value="Surat">Surat</option>
                        <option value="Vadodra">Vadodra</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label>Qualification</label>
                    <input type="text" name="qualification" class="form-control" autocomplete="off" placeholder="Enter your Qualification" value="<?php if(isset($_POST['qualification'])) echo $_POST['qualification']; ?>">
                </div>

                <div class="form-group">
                    <label>Applied For</label>
                    <select name="role" class="form-control">
                        <option value="">Select job role</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="nurse">Nurses</option>  
                    </select>
                    </div>

                <div class="form-group">
                    <label>Exprience</label>
                    <input type="text" name="exprience" class="form-control" autocomplete="off" placeholder="Enter how many years of exprience" value="<?php if(isset($_POST['exprience'])) echo $_POST['exprience']; ?>">
                </div>

              
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
                </div>
                <input type="submit" name="apply" value="Apply Now" class="btn-submit">
                <br>
                <!-- <p>I already have an account <a href="doctorlogin.php">Click here</a></p> -->
            </form>
        </div>
    </div>
</body>
</html>