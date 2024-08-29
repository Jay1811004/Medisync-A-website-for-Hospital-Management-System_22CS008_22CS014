<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-form {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .booking-form input[type="date"],
        .booking-form input[type="text"],
        .booking-form input[type="submit"] {
            margin-bottom: 15px;
        }

        .booking-form input[type="submit"] {
            background-color: #17a2b8;
            color: white;
            transition: background-color 0.3s ease;
        }

        .booking-form input[type="submit"]:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                    include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-4">Book Appointment</h5>

                    <?php
                    $pat = $_SESSION['patient'];
                    $sel = mysqli_query($connect, "SELECT * FROM patient WHERE username='$pat'");

                    $row = mysqli_fetch_array($sel);
                    $firstname = $row['firstname'];
                    $surname = $row['surname'];
                    $gender = $row['gender'];
                    $phone = $row['phone'];

                    if(isset($_POST['book'])) {
                        $date = $_POST['date'];
                        $sym = $_POST['sym'];

                        if(empty($sym)) {

                        } else {
                            $query = "INSERT INTO appointment(firstname,surname,gender,phone,appointment_date,symptoms,status,date_booked) VALUES('$firstname','$surname','$gender','$phone','$date','$sym','pending',NOW())";
                            $res = mysqli_query($connect, $query);

                            if ($res) {
                                echo "<script>alert('You have successfully booked an appointment.')</script>";
                            }
                        }
                    }
                    ?>

                    <div class="d-flex justify-content-center">
                        <div class="col-md-6 booking-form">
                            <form method="post">
                                <label for="date">Appointment Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                                
                                <label for="sym">Symptoms</label>
                                <input type="text" name="sym" id="sym" class="form-control" autocomplete="off" placeholder="Enter Symptoms">
                                
                                <input type="submit" name="book" class="btn btn-info w-100 my-2" value="Book Appointment">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
