<?php
session_start();
include("../include/connection.php");

$successMessage = "";
$errorMessage = "";

// Handle profile update
if (isset($_POST['upload'])) {
    $img = $_FILES['img']['name'];
    if (empty($img)) {
        $errorMessage = "Please select an image to upload.";
    } else {
        $query = "UPDATE doctors SET profile='$img' WHERE username='{$_SESSION['doctor']}'";
        $res = mysqli_query($connect, $query);
        if ($res) {
            move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
            $successMessage = "Profile updated successfully.";
        } else {
            $errorMessage = "Error updating profile.";
        }
    }
}

// Handle username change
if (isset($_POST['change_uname'])) {
    $uname = $_POST['uname'];
    if (empty($uname)) {
        $errorMessage = "Username cannot be empty.";
    } else {
        $query = "UPDATE doctors SET username='$uname' WHERE username='{$_SESSION['doctor']}'";
        $res = mysqli_query($connect, $query);
        if ($res) {
            $_SESSION['doctor'] = $uname;
            $successMessage = "Username changed successfully.";
        } else {
            $errorMessage = "Error changing username.";
        }
    }
}

// Handle password change
if (isset($_POST['change_pass'])) {
    $old = $_POST['old_pass'];
    $new = $_POST['new_pass'];
    $con = $_POST['con_pass'];

    $ol = "SELECT password FROM doctors WHERE username='{$_SESSION['doctor']}'";
    $ols = mysqli_query($connect, $ol);
    $row = mysqli_fetch_array($ols);

    if ($old != $row['password']) {
        $errorMessage = "Old password is incorrect.";
    } elseif (empty($new)) {
        $errorMessage = "New password cannot be empty.";
    } elseif ($con != $new) {
        $errorMessage = "New password and confirm password do not match.";
    } else {
        $query = "UPDATE doctors SET password='$new' WHERE username='{$_SESSION['doctor']}'";
        mysqli_query($connect, $query);
        $successMessage = "Password changed successfully.";
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Profile</title>
    <script>
        function validateProfileUpdate(event) {
            var fileInput = document.getElementsByName("img")[0].value;
            if (fileInput === "") {
                alert("Please select an image to upload.");
                event.preventDefault();
                return false;
            }
            return true;
        }

        function validateUsernameChange(event) {
            var username = document.getElementsByName("uname")[0].value;
            if (username === "") {
                alert("Username cannot be empty.");
                event.preventDefault();
                return false;
            }
            return true;
        }

        function validatePasswordChange(event) {
            var oldPass = document.getElementsByName("old_pass")[0].value;
            var newPass = document.getElementsByName("new_pass")[0].value;
            var confirmPass = document.getElementsByName("con_pass")[0].value;

            if (oldPass === "" || newPass === "" || confirmPass === "") {
                alert("All fields are required!");
                event.preventDefault();
                return false;
            }

            if (newPass !== confirmPass) {
                alert("New password and confirm password do not match!");
                event.preventDefault();
                return false;
            }

            var correctOldPass = <?php echo json_encode($row['password']); ?>;
            if (oldPass !== correctOldPass) {
                alert("Old password is incorrect!");
                event.preventDefault();
                return false;
            }

            return true;
        }

        function showAlert() {
            var successMessage = "<?php echo $successMessage; ?>";
            var errorMessage = "<?php echo $errorMessage; ?>";

            if (successMessage) {
                alert(successMessage);
            } else if (errorMessage) {
                alert(errorMessage);
            }
        }

        window.onload = showAlert;
    </script>
</head>
<body>
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Doctor Profile</h4>
                                    <?php
                                    $doc = $_SESSION['doctor'];
                                    $query = "SELECT * FROM doctors WHERE username='$doc'";
                                    $res = mysqli_query($connect, $query);
                                    $row = mysqli_fetch_array($res);
                                    ?>
                                    <form method="post" enctype="multipart/form-data" onsubmit="return validateProfileUpdate(event)">
                                        <?php echo "<img src='img/".$row['profile']."' style='height: 250px;' class='col-md-4 my-3'>"; ?>
                                        <input type="file" name="img" class="form-control my-1">
                                        <input type="submit" name="upload" class="btn btn-success" value="Update Profile">
                                    </form>

                                    <div class="my-3">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th colspan="2" class="text-center">Details</th>
                                            </tr>
                                            <tr>
                                                <td>Firstname</td>
                                                <td><?php echo $row['firstname'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Surname</td>
                                                <td><?php echo $row['surname'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td><?php echo $row['username'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $row['email'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No.</td>
                                                <td><?php echo $row['phone'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td><?php echo $row['gender'];?></td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td><?php echo $row['city'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Qualification</td>
                                                <td><?php echo $row['qualification'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Experience</td>
                                                <td><?php echo $row['experience'];?></td>
                                            </tr>
                                            <tr>
                                        
                                                <td>Salary</td>
                                                <td><?php echo "₹".$row['salary']."";?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-center my-2">Change Username</h5>
                                    <form method="post" onsubmit="return validateUsernameChange(event)">
                                        <label>Change Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                                        <br>
                                        <input type="submit" name="change_uname" class="btn btn-success" value="Change Username">
                                    </form>
                                    <br></br>

                                    <h5 class="text-center my-2">Change Password</h5>
                                    <form method="post" onsubmit="return validatePasswordChange(event)">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
                                        </div>
                                        <br>
                                        <input type="submit" name="change_pass" class="btn btn-info" value="Change Password">
                                    </form>
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
