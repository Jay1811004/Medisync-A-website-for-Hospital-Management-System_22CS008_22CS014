<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <!--Sidenav-->
                <?php
                include("sidenav.php");
                ?>  
            </div>
            <div class="col-md-10 ">
                <h4 class="my-2">Admin Dashboard</h4>
                <div class="col-md-12 my-1">
                    <div class="row">
                        <div class="col-md-3 bg-success mx-2" style="height: 130px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php
                                          $ad = mysqli_query($connect,"SELECT * FROM admin");
                                          $num = mysqli_num_rows($ad);
                                        ?>
                                        <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num;?></h5>
                                        <h5 class="text-white">Total</h5>
                                        <h5 class="text-white">Admin</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="admin.php"><i class="fa fa-users-cog fa-3x my-4" style="color:white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 bg-info mx-2" style="height: 130px;">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php
                                         $doctor = mysqli_query($connect, "SELECT * FROM doctors WHERE status='Approved'");
                                         $num2 = mysqli_num_rows($doctor)   

                                        ?>
                                        <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num2; ?></h5>
                                        <h5 class="text-white">Total</h5>
                                        <h5 class="text-white">Doctors</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="doctor.php"><i class="fa fa-user-md fa-3x my-4" style="color:white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 bg-warning mx-2" style="height: 130px;">
                        <div class="col-md-12">
                            <div class="row">
                                 <div class="col-md-8">
                                    <?php
                                        $p = mysqli_query($connect,"select * from patient");
                                        $pp = mysqli_num_rows($p);
                                    ?>
                                        <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $pp;?></h5>
                                        <h5 class="text-white">Total</h5>
                                        <h5 class="text-white">Patients</h5>
                                 </div>
                                <div class="col-md-4">
                                        <a href="patient.php"><i class="fa fa-procedures fa-3x my-4" style="color:white;"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-3 bg-danger mx-2 my-2" style="height: 130px;">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                    <?php
                                        $r = mysqli_query($connect,"select * from report");
                                        $re = mysqli_num_rows($r);
                                    ?>
                                        <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $re;?></h5>
                                        <h5 class="text-white">Total</h5>
                                        <h5 class="text-white">Report</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="report.php"><i class="fa fa-flag fa-3x my-4" style="color:white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 bg-warning mx-2 my-2" style="height: 130px;">
                        <div class="col-md-12">
                            <div class="row">
                                 <div class="col-md-8">
                                       <?php

                                        $job = mysqli_query($connect, "SELECT * FROM doctors WHERE status='pending'");
                                        $num1 = mysqli_num_rows($job);

                                       ?>
                                        <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num1; ?></h5>
                                        <h5 class="text-white">Total</h5>
                                        <h5 class="text-white">Job Request</h5>
                                 </div>
                                <div class="col-md-4">
                                        <a href="job_request.php"><i class="fa fa-book-open fa-3x my-4" style="color:white;"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-3 bg-success mx-2 my-2" style="height: 130px;">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                    <?php
                                        $i = mysqli_query($connect,"select sum(amount_paid) as profit from income");
                                        $row = mysqli_fetch_array($i);
                                        $in = $row['profit'];

                                    ?>
                                        <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo "$$in";?></h5>
                                        <h5 class="text-white">Total</h5>
                                        <h5 class="text-white">Income</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="income.php"><i class="fa fa-money-check-alt fa-3x my-4" style="color:white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
