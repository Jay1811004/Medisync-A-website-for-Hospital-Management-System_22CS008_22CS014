<?php
session_start();
include("../include/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Appointments</title>
    <!-- Add Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    include("../include/header.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-2">Total Appointments</h5>

                    <?php
                    // Fetch the doctor's ID from the session
                    $doctorId = $_SESSION['doctor_id'];
                   
                    // echo "$doctorId";

                    // Modify the query to filter appointments by the logged-in doctor's ID
                    $query = "SELECT * FROM appointment WHERE status='pending' AND doctor_id='$doctorId'";
                    $res = mysqli_query($connect, $query);

                    $output = "";
                    $output .= "
                        <table class='table table-bordered'>
                        <tr>
                            <td>ID</td>
                            <td>Firstname</td>
                            
                            <td>Action</td>
                        </tr>
                    ";

                    if(mysqli_num_rows($res) < 1) {
                        $output .= "
                        <tr>
                            <td class='text-center' colspan='9'>No Appointments Yet.</td>
                        </tr>
                        ";
                    } else {
                        while($row = mysqli_fetch_array($res)) {
                            $output .= "
                                <tr>
                                    <td>".$row['id']."</td>
                                    <td>".htmlspecialchars($row['firstname'])."</td>
                                   
                                    <td>
                                        <a href='discharge.php?id=".$row['id']."'>
                                          <button class='btn btn-info'>Check</button>
                                        </a>
                                    </td>
                                </tr>
                            ";
                        }
                    }
                    $output .= "</table>";
                    echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
