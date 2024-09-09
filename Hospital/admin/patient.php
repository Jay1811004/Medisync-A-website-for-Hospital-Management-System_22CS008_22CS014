<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Patients</title>
    <!-- Add Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <h5 class="text-center my-3">Total Patients</h5>

                    <?php
                        // $doctorId = $_SESSION['doctor_id'];

                        // Modify the query to fetch patient details along with the current status
                        $query = "SELECT * FROM patient";
                                  


                        $res = mysqli_query($connect, $query);
                        $output ="";
                        $output .= "
                            <table class='table table-bordered'>
                            <tr>
                                <td>ID</td>
                                <td>Firstname</td>
                                <td>Action</td>
                            </tr>
                        ";

                        if(mysqli_num_rows($res) < 1){
                            $output .= "
                                <tr>
                                    <td class='text-center' colspan='11'>No Patients Yet</td>
                                </tr>
                            ";
                        }

                        while($row = mysqli_fetch_array($res)){
                            $output .= "
                                <tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['firstname']."</td>
                                    <td>
                                        <a href='view.php?id=".$row['id']."'>
                                            <button class='btn btn-info'>View</button>
                                        </a>
                                    </td>
                                </tr>
                            ";
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
