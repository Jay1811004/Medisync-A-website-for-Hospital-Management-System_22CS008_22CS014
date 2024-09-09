<?php
include("../include/connection.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Queries for doctors and staff
$query = "SELECT * from doctors where status='pending' order by date_reg ASC";
$query1 = "SELECT * from staff where status='pending' order by date_reg ASC";

// Execute queries
$res = mysqli_query($connect, $query);
$res1 = mysqli_query($connect, $query1);

// Check if queries were successful
if (!$res) { 
    die("Error executing query for doctors: " . mysqli_error($connect));
}
if (!$res1) {
    die("Error executing query for staff: " . mysqli_error($connect));
}
?>

<style>
    .role-header.doctor {
        background-color: #55a2b1; /* Light Red for Doctors */
        color: white;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        text-align: center;
    }
    .role-header.staff {
        background-color: #55a2b1; /* Light Teal for Staff */
        color: white;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        text-align: center;
    }
    .table thead {
        background-color: #f8f9fa;
    }
    .text-center {
        text-align: center;
    }
</style>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <?php
                // Generate output for doctors
                echo "<div class='role-header doctor'><b>For Doctors</b></div>";
                
                $output = "
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Surname</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Qualification</th>
                            <th>Experience</th>
                            <th>Date of Registration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ";

                if (mysqli_num_rows($res) < 1) {
                    $output .= "
                    <tr>
                        <td colspan='11' class='text-center'>No Job Request Yet.</td>
                    </tr>
                    ";
                } else {
                    while ($row = mysqli_fetch_array($res)) {
                        $output .= "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['firstname']}</td>
                            <td>{$row['surname']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['qualification']}</td>
                            <td>{$row['experience']}</td>
                            <td>{$row['date_reg']}</td>
                            <td>
                                <div class='col-md-12'>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <button id='{$row['id']}' class='btn btn-success approve' data-type='doctor'>Approve</button>
                                        </div>
                                        <div class='col-md-6'>
                                             <button id='{$row['id']}' class='btn btn-danger reject' data-type='doctor'>Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                }

                $output .= "</tbody></table>";
                echo $output;

                // Generate output for staff
                echo "<div class='role-header staff'><b>For Staff</b></div>";
                $output_staff = "
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Surname</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Qualification</th>
                            <th>Job Post</th>
                            <th>Experience</th>
                            <th>Date of Registration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ";

                if (mysqli_num_rows($res1) < 1) {
                    $output_staff .= "
                    <tr>
                        <td colspan='11' class='text-center'>No Job Request Yet.</td>
                    </tr>
                    ";
                } else {
                    while ($row1 = mysqli_fetch_array($res1)) {
                        $output_staff .= "
                        <tr>
                            <td>{$row1['id']}</td>
                            <td>{$row1['firstname']}</td>
                            <td>{$row1['surname']}</td>
                            <td>{$row1['username']}</td>
                            <td>{$row1['gender']}</td>
                            <td>{$row1['phone']}</td>
                            <td>{$row1['city']}</td>
                            <td>{$row1['qualification']}</td>
                            <td>{$row1['role']}</td>
                            <td>{$row1['experience']}</td>
                            <td>{$row1['date_reg']}</td>
                            <td>
                                <div class='col-md-12'>
                                    <div class='row'>
                                        <div class='col-md-6'>
                                            <button id='{$row1['id']}' class='btn btn-success approve' data-type='staff'>Approve</button>
                                        </div>
                                        <div class='col-md-6'>
                                             <button id='{$row1['id']}' class='btn btn-danger reject' data-type='staff'>Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                }

                $output_staff .= "</tbody></table>";
                echo $output_staff;
                ?>
            </div>
        </div>
    </div>
</div>
