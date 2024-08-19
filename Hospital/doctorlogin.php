<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } else if (empty($password)) {
        $error['login'] = "Enter Password";
    } else {
        $q = "SELECT * FROM doctors WHERE username = '$uname' AND password = '$password'";
        $qq = mysqli_query($connect, $q);

        if ($qq) {
            $row = mysqli_fetch_array($qq);

            if ($row) {
                if ($row['status'] == "pending") {
                    $error['login'] = "Please Wait for the admin to confirm";
                } else if ($row['status'] == "Rejected") {
                    $error['login'] = "Try again Later";
                } else {
                    // Store session and prepare for redirection
                    $_SESSION['doctor'] = $uname;
                    header("Location:doctor/index.php");
                    exit(); // Ensure no further code is executed
                }
            } else {
                $error['login'] = "Invalid Account";
            }
        } else {
            echo "<script>alert('Error querying database');</script>";
        }
    }

    // Show errors if any
    if (count($error) > 0) {
        foreach ($error as $err) {
            echo "<script>alert('$err');</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login Page</title>
    <style>
        .image {
            background-image: url('img/h_background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 500px;
            height: 470px;
            margin-left: 800px;
        }
        .login-container img {
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
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
        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    </style>
    <script>
        function validateForm() {
            var uname = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            
            if (uname === "") {
                alert("Enter Username");
                return false;
            }
            if (password === "") {
                alert("Enter Password");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include("include/header.php"); ?>
    <div class="image">
        <center>
            <div class="login-container">
                <img src="img/d_login_icon.png" alt="Doctor Login Icon">
                <form method="POST" action="" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="uname" id="username" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="pass" id="password" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div>
                    <input type="submit" name="login" class="btn-submit" value="Login">
                    <br>
                    <p>I don't have an account <a href="apply.php">Apply Now!!!</a></p>
                </form>
            </div>
        </center>
    </div>
</body>
</html>

