<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
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
                  


                    <?php

                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $query = "SELECT * FROM doctors WHERE id='$id'";
                            $res = mysqli_query($connect,$query);
                            $row = mysqli_fetch_array($res);
                        }
                    ?>

                    <div class="row">
                        <div class="col-md-8">
                            

                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" colspan="2"><h5>Doctor Details</h5></th>
                                </tr>
                                <tr>
                                    <td>Profile</td>
                                    <td><?php
                            echo "<img src='../doctor/img/".$row['profile']."' class='img-fluid rounded my-2'  width='250px' height='250px'>";
                            ?></td>
                                </tr>
                                <tr>

                                    <td>ID</td>
                                    <td><?php echo $row['id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Firstname</td>
                                    <td><?php echo $row['firstname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Surname</td>
                                    <td><?php echo $row['surname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $row['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $row['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone No.</td>
                                    <td><?php echo $row['phone']; ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?php echo $row['city']; ?></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Qualification</td>
                                    <td><?php echo $row['qualification']; ?></td>
                                </tr>
                                <tr>
                                    <td>Exprience</td>
                                    <td><?php echo $row['experience'];echo " years"; ?></td>
                                </tr>
                                <tr>
                                   
                                <tr>
                                    <td>Department</td>
                                    <td><?php echo $row['department']; ?></td>
                                </tr>
                                <tr>
                                    <td>Date Registered</td>
                                    <td><?php echo $row['date_reg']; ?></td>
                                </tr>
                                <tr>
                                    <td>Salary</td>
                                    <td><?php echo"₹";echo $row['salary']; ?></td>
                                </tr>
                            </table>
                          

                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center">Update Salary</h5>
                            <?php 
                            
                            if(isset($_POST['update'])) {
                                $salary = $_POST['salary'];
                                $dept = $_POST['dept'];
                                $q = "UPDATE doctors SET salary='$salary',department = '$dept' WHERE id='$id'";
                                mysqli_query($connect, $q);
                            }

                            ?>
                            <form method="post">
                                <label>Enter Doctor's Salary</label>
                                <input type="number" name="salary" class="form-control" autocomplete="off" placeholder="Enter Salary" value="<?php echo $row['salary'] ?>">
                                <br>
                                <label>Enter Department Name</label>
                                <input type="text" name="dept" class="form-control" autocomplete="off" placeholder="Enter Department name" value="<?php echo $row['department'] ?>">
                                <input type="submit" name="update" class="btn btn-info my-3" value="Update">
                            </form>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>