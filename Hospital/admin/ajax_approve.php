
<?php
include("../include/connection.php");

$id = $_POST['id'];  // The ID of the doctor or staff member
$type = $_POST['type'];  // The type, 'doctor' or 'staff'

// Check if the type is 'doctor' or 'staff' and update the status accordingly
if ($type == 'doctor') {
    $query = "UPDATE doctors SET status='Approved' WHERE id='$id'";
} elseif ($type == 'staff') {
    $query = "UPDATE staff SET status='Approved' WHERE id='$id'";
}

mysqli_query($connect, $query);
?>
