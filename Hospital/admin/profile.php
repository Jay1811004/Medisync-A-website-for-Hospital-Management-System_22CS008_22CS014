<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    $ad = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE username='$ad'";
    $res = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($res)) {
        $username = $row['username'];
        $profile = $row['profile'];
    }

    if (isset($_POST['update'])) {
        $profile = $_FILES['profile']['name'];
        if (!empty($profile)) {
            $query = "UPDATE admin SET profile='$profile' WHERE username='$ad'";
            $result = mysqli_query($connect, $query);
            if ($result) {
                move_uploaded_file($_FILES['profile']['tmp_name'], "img/$profile");
            }
        }
    }

    if (isset($_POST['change'])) {
        $uname = $_POST['uname'];
        if (!empty($uname)) {
            $query = "UPDATE admin SET username='$uname' WHERE username='$ad'";
            $res = mysqli_query($connect, $query);
            if ($res) {
                $_SESSION['admin'] = $uname;
                $ad = $uname;  // update the $ad variable to new username
            }
        }
    }

    $successMessage = "";
    $errorMessage = "";

    if (isset($_POST['update_pass'])) {
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $con_pass = $_POST['con_pass'];

        $error = array();
        $old = mysqli_query($connect, "SELECT * FROM admin WHERE username='$ad'");
        $row = mysqli_fetch_array($old);
        $pass = $row['password'];

        if (empty($old_pass)) {
            $error['p'] = "Enter old password";
        } else if (empty($new_pass)) {
            $error['p'] = "Enter new password";
        } else if (empty($con_pass)) {
            $error['p'] = "Enter confirm password";
        } else if ($old_pass != $pass) {
            $error['p'] = "Invalid old password";
        } else if ($new_pass != $con_pass) {
            $error['p'] = "Passwords do not match";
        }

        if (count($error) == 0) {
            $query = "UPDATE admin SET password='$new_pass' WHERE username='$ad'";
            mysqli_query($connect, $query);
            $successMessage = "Password updated successfully";
        } else {
            $errorMessage = $error['p'];
        }
    }
    ?>

    <script>
        // Define JavaScript variables for messages
        var successMessage = "<?php echo $successMessage; ?>";
        var errorMessage = "<?php echo $errorMessage; ?>";

        // Function to show alerts
        function showAlert() {
            if (successMessage) {
                alert(successMessage);
            } else if (errorMessage) {
                alert(errorMessage);
            }
        }

        // Call showAlert function when the page loads
        window.onload = showAlert;
    </script>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo $username; ?> Profile</h4>
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    echo "<img src='img/$profile' class='col-md-12' style='width:300px;height:300px;'>";
                                    ?>
                                    <br><br>
                                    <div class="form-group">
                                        <label>UPDATE PROFILE</label>
                                        <input type="file" name="profile" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="update" value="UPDATE" class="btn btn-success">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <form method="post">
                                    <label>Change Username</label>
                                    <input type="text" name="uname" class="form-control" autocomplete="off"><br>
                                    <input type="submit" name="change" value="Change" class="btn btn-success">
                                </form>
                                <br><br><br>
                                <form method="post">
                                    <h5 class="text-center my-4">Change Password</h5>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old_pass" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_pass" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="con_pass" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="update_pass" value="Update Password" class="btn btn-info">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



<script>
    // Define JavaScript variables for messages
    var successMessage = "<?php echo isset($_POST['update_pass']) && count($error) == 0 ? 'Password updated successfully' : ''; ?>";
    var errorMessage = "<?php echo isset($_POST['update_pass']) && count($error) > 0 ? $error['p'] : ''; ?>";

    // Function to show alerts
    function showAlert() {
        if (successMessage) {
            alert(successMessage);
        } else if (errorMessage) {
            alert(errorMessage);
        }
    }

    // Call showAlert function when the page loads
    window.onload = showAlert;
</script>
