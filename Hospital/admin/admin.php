<?php
session_start();
include("../include/connection.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $uname = $_POST['uname'];
    $password = $_POST['pass'];
    $image = $_FILES['img']['name'];
    $target_dir = "img/";
    $target_file = $target_dir . basename($image);

    if(empty($uname)) {
        $error = "Enter Admin Username";
    } else if(empty($password)){
        $error = "Enter Admin Password";
    } else if(empty($image)){
        $error = "Add Admin Picture";
    } else {
        $q = "INSERT INTO admin (username, password, profile) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connect, $q);
        mysqli_stmt_bind_param($stmt, "sss", $uname, $password, $image);
        
        if (mysqli_stmt_execute($stmt)) {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            if(move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                $success = "Admin added successfully!";
                header("Location: ".$_SERVER['PHP_SELF']); // Redirect to avoid form resubmission
                exit();
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "Error: " . mysqli_error($connect);
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM admin WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $success = "Admin deleted successfully!";
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to avoid reloading issues
        exit();
    } else {
        $error = "Error deleting admin: " . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Link to your CSS file -->
    <script>
        function showAlert(message) {
            alert(message);
        }
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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center">All Admin</h5>
                                <?php
                                    $ad= $_SESSION['admin'];
                                    $query = "SELECT * FROM admin where username !='$ad'";
                                    $res = mysqli_query($connect, $query);
                                    $admin_data = mysqli_fetch_all($res, MYSQLI_ASSOC);

                                    $output = "
                                    <table class='table table-bordered'>
                                    <tr>
                                    <th>Sr. No</th>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th style='width: 10%;'>Action</th>
                                    </tr>";

                                    if(mysqli_num_rows($res) < 1){
                                        $output .= "<tr><td colspan='4' class='text-center'>No New Admin</td></tr>";
                                    } else {
                                        $sr_no = 1;
                                        foreach ($admin_data as $row) {
                                            $id = $row['id'];
                                            $username = $row['username'];

                                            $output .= "
                                            <tr>
                                            <td>$sr_no</td>
                                            <td>$id</td>
                                            <td>$username</td>
                                            <td>
                                                <a href='admin.php?delete=$id' onclick='return confirm(\"Are you sure you want to delete this admin?\")'><button name='$id' class='btn btn-danger remove'>Remove</button></a>
                                            </td>
                                            </tr>";
                                            $sr_no++;
                                        }
                                    }
                                    $output .= "</table>";

                                    echo $output;
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if ($error) {
                                    echo "<script>showAlert('$error');</script>";
                                }
                                if ($success) {
                                    echo "<script>showAlert('$success');</script>";
                                }
                                ?>
                                <h5 class="text-center">Add Admin</h5>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Add Admin Picture</label>
                                        <input type="file" name="img" class="form-control">
                                    </div><br>
                                    <input type="submit" name="add" value="Add new admin" class="btn btn-success">
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
