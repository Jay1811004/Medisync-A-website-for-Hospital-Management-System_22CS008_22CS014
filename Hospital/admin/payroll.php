<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Payroll</title>
    <style>
        .container-fluid {
            /* padding: 20px; */
        }
        .table thead {
            background-color: #f8f9fa;
        }
        .text-center {
            text-align: center;
        }
        .role-header {
            background-color: lightgreen;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .role-header.pharmacist {
            background-color: #55a2b1; /* Light Teal */
            color: white;
        }
        .role-header.receptionist {
            background-color: #55a2b1; /* Light Yellow */
            color: white;
        }
        .role-header.nurse {
            background-color: #55a2b1; /* Light Pink */
            color: white;
        }
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">Staff Payroll</h5>
                    
                    <?php
                        // Define roles to display
                        $roles = ['Pharmacist', 'Receptionist', 'Nurse'];

                        foreach ($roles as $role) {
                            // Query to fetch staff for each role
                            $query = "SELECT * FROM staff WHERE status='Approved' AND role='$role' ORDER BY date_reg ASC";
                            $res = mysqli_query($connect, $query);
                            $role_class = strtolower($role); // Convert role to lowercase to match the CSS class

                            // Debug: Check if query executed successfully
                            if (!$res) {
                                die("Error executing query for $role: " . mysqli_error($connect));
                            }

                            echo "<div class='role-header $role_class'><b>$role</b></div>";

                            if ($role == 'Nurse') {
                                // Query to fetch unique departments for nurses
                                $dept_query = "SELECT DISTINCT department FROM staff WHERE role='Nurse' AND status='Approved'";
                                $dept_res = mysqli_query($connect, $dept_query);
                                
                                echo "<table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                if (mysqli_num_rows($dept_res) < 1) {
                                    echo "
                                    <tr>
                                        <td colspan='2' class='text-center'>No Approved Nurses Yet.</td>
                                    </tr>";
                                } else {
                                    while ($dept_row = mysqli_fetch_array($dept_res)) {
                                        $department = $dept_row['department'];
                                        echo "
                                        <tr>
                                            <td>$department</td>
                                            <td>
                                                <a href='nurse_details.php?department=" . urlencode($department) . "'>
                                                    <button class='btn btn-info'>See Details</button>
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                }

                                echo "
                                    </tbody>
                                </table>";
                            } else {
                                // Start the table for other roles
                                $output = "
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Firstname</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>";

                                if (mysqli_num_rows($res) < 1) {
                                    $output .= "
                                    <tr>
                                        <td colspan='3' class='text-center'>No Approved $role Yet.</td>
                                    </tr>";
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $output .= "
                                        <tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['firstname']}</td>
                                            <td>
                                                <a href='viewpayroll.php?id={$row['id']}'>
                                                    <button class='btn btn-info'>View Payroll</button>
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                }

                                // End the table
                                $output .= "
                                    </tbody>
                                </table>";

                                echo $output;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
