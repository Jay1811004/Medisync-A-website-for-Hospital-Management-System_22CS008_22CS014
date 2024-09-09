<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Salary</title>
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
                            $query = "SELECT * FROM staff WHERE id='$id'";
                            $res = mysqli_query($connect,$query);
                            $row = mysqli_fetch_array($res);
                        }
                    ?>

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center" colspan="2"><h5>Staff Details</h5></th>
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
                                    <td>Post</td>
                                    <td><?php echo $row['role']; ?></td>
                                </tr>
                                <tr>
                                    <td>Exprience</td>
                                    <td><?php echo $row['experience']; ?></td>
                                </tr>
                                 
                               
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
                               
                                $q = "UPDATE staff SET salary='$salary' WHERE id='$id'";
                                mysqli_query($connect, $q);
                            }

                            ?>
                            <form method="post">
                                <label>Enter Salary</label>
                                <input type="number" name="salary" class="form-control" autocomplete="off" placeholder="Enter Salary" value="<?php echo $row['salary'] ?>">
                                <br>
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