<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h5 {
            margin-left: 40px;
            margin-top: 5px;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-item a {
            margin-right: 20px;
            font-size: 18px;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease-in-out;
        }

        .nav-item a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 2px;
            background-color: #ffcc00;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease-in-out;
        }

        .nav-item a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .text-white {
            color: #ffffff !important;
        }

        .navbar-info {
            background: linear-gradient(90deg, #17a2b8, #117a8b);
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .navbar-collapse {
            justify-content: flex-end;
        }

        .ms-auto {
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <h5 class="text-white">Medisync - A Hospital Management System</h5>

        <div class="ms-auto"></div>

        <ul class="navbar-nav">

        <?php 
if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
    echo '<li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>';
    echo '<li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>';
}
else if(isset($_SESSION['doctor'])){
   
    $user = $_SESSION['doctor'];
    echo '<li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>';
    echo '<li class="nav-item"><a href="../doctor/logout.php" class="nav-link text-white">Logout</a></li>';
}

else if(isset($_SESSION['patient'])){
   
    $user = $_SESSION['patient'];
    echo '<li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>';
    echo '<li class="nav-item"><a href="../patient/logout.php" class="nav-link text-white">Logout</a></li>';
}

else{
    echo '<li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>';
    echo '<li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>';
    echo '<li class="nav-item"><a href="patientlogin.php" class="nav-link text-white">Patient</a></li>';
    echo '<li class="nav-item"><a href="index.php" class="nav-link text-white">Home Page</a></li>';
}
?>

           
        </ul>
    </nav>
</body>
</html>
