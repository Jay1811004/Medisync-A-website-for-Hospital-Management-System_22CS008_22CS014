<?php
session_start();
include("include/connection.php");

if(isset($_POST['login'])){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if(empty($uname)){
        echo "<script>alert('Enter Username')</script>";
    }
    else if(empty($pass)){
        echo "<script>alert('Enter Password')</script>";
    }
    else{
        $query = "select * from patient where username = '$uname' and password = '$pass'";
        $res = mysqli_query($connect,$query);

        if(mysqli_num_rows($res)==1){
            header("Location:patient/index.php");

            $_SESSION['patient']=$uname;
        }
        else{
            echo "<script>alert('Invalid Account')</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login Page</title>
    <style>
        .image {
            background-image: url('img/patientlogin.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 92vh;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 450px;
            height: 400px;
            margin-left: 990px;
        }
        .login-container img {
            width: 200px;
            height: 150px;
            margin-bottom: 10px;
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

        .login-container h3{
            color:   blue;
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
               <h3>Patient Login Portal</h3>
               <br>
            <!-- <img src="img/p_login.png" alt="Doctor Login Icon"> -->
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
                    <p>I don't have an account <a href="account.php">Create Account!!!</a></p>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
