<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Details</title>
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
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">View Patient Details</h5>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Fetch patient details
                        $patient_query = "SELECT * FROM patient WHERE id = '$id'";
                        $patient_res = mysqli_query($connect, $patient_query);
                        $patient = mysqli_fetch_array($patient_res);

                        // Fetch all appointments for this patient
                        $appointment_query = "SELECT * FROM appointment WHERE patient_id = '$id'";
                        $appointment_res = mysqli_query($connect, $appointment_query);
                    }
                    ?>
                    <div class="row">
                        <!-- Profile Section on the Left -->
                        <div class="col-md-4 text-center">
                            <h5 class="text-center my-3">Patient Profile</h5>
                            <?php
                            echo "<img src='../patient/img/".$patient['profile']."' class='img-fluid rounded my-2'  width='350px' height='350px'>";
                            ?>
                        </div>

                        <!-- Patient Details Table on the Right -->
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" colspan="2">Details</th>
                                </tr>
                                <tr>
                                    <td>Firstname</td>
                                    <td><?php echo $patient['firstname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Surname</td>
                                    <td><?php echo $patient['surname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $patient['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $patient['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $patient['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone No.</td>
                                    <td><?php echo $patient['phone']; ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?php echo $patient['city']; ?></td>
                                </tr>
                                <tr>
                                    <td>Date Registered</td>
                                    <td><?php echo $patient['date_reg']; ?></td>
                                </tr>
                            </table>

                            <!-- Display All Appointments for this Patient -->
                            <h5 class="text-center my-3">Appointment Details</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>Date</th>
                                    <th>Symptoms</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Amount_paid</th>
                                </tr>
                                <?php
                                if (mysqli_num_rows($appointment_res) > 0) {
                                    while ($appointment = mysqli_fetch_array($appointment_res)) {
                                        echo "<tr>";
                                        echo "<td>" . $appointment['id'] . "</td>";
                                        echo "<td>" . $appointment['appointment_date'] . "</td>";
                                        echo "<td>" . $appointment['symptoms'] . "</td>";
                                        echo "<td>" . $appointment['status'] . "</td>";
                                        echo "<td>" . $appointment['description'] . "</td>";
                                        echo "<td>" . $appointment['amount_paid'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No appointments found for this patient.</td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
