<?php
session_start();
    include("include/connection.php");

    if(isset($_POST['login']))
    {
        $username = $_POST['name'];
        $password = $_POST['pass'];
        $error = array();

        if(empty($username)){
            $error['admin'] = "Please Enter Username";
        }
        else if(empty($password))
{
    $error['admin'] = "Please Enter Password";
}

if(count($error)==0){
    $query = "Select * from admin where username='$username' and password='$password'";
    $result = mysqli_query($connect,$query);

    if(mysqli_num_rows($result) == 1){
        echo "<script>alert('You have login As an admin')</script>";
        $_SESSION['admin'] = $username;

        header("Location:admin/index.php");
        exit();
    }
    else{
        echo "<script>alert('Inavalid Username or Password')</script>";
    }
}}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <style>

        .image{
            background-image: url('img/login.webp');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 92.1vh;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin-top:40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 500px;
            height:400px;
   margin-left:800px;
        }
        .login-container img {
            width: 200px;
            height: 100px;
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
        .danger{
            color:red;
            font-weight:bolder;
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>
    <div class="image">
    <center>
    <div class="login-container">
        
        <img src="img/admin login.png" alt="Admin Login Icon">
        <!-- <h2>Admin Login</h2> -->
        <form method="post" >
            <div class="danger">
                <?php 
                if(isset($error['admin'])){
                    $sh = $error['admin'];
                    $show = "</h4 class='danger'>$sh</h4>";
                    echo $show;
                }

                else{
                    $show = "";
                }

                // echo $show;
                ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="name" id="username" class="form-control" autocomplete="off" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="pass" id="password" class="form-control" autocomplete="off" placeholder="Enter Password">
            </div>
            <input type="submit" name="login" class="btn-submit" value="login">
        </form>
        </center>
        </div>

</body>
</html>
