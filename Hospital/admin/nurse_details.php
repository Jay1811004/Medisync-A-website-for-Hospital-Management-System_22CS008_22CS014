<?php
session_start();
include("../include/connection.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Staff - Nurse Details</title>
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
            background-color: #55a2b1;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center;
        }
        
        .department-table {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    // Get the department from the query parameter
    $department = isset($_GET['department']) ? mysqli_real_escape_string($connect, $_GET['department']) : '';

    if (empty($department)) {
        die("Department parameter is missing.");
    }
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">Nurses in <?php echo htmlspecialchars($department); ?></h5>

                    <?php
                        // Query to fetch nurses for the specified department
                        $query = "SELECT * FROM staff WHERE status='Approved' AND role='Nurse' AND department='$department' ORDER BY date_reg ASC";
                        $res = mysqli_query($connect, $query);

                        // Debug: Check if query executed successfully
                        if (!$res) {
                            die("Error executing query: " . mysqli_error($connect));
                        }

                        // Department heading
                        $department_class = strtolower(str_replace(' ', '_', $department));
                        // echo "<div class='role-header $department_class'><b>$department</b></div>";

                        // Start the department table
                        $output = "
                        <table class='table table-bordered department-table'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Firstname</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";

                        if (mysqli_num_rows($res) < 1) {
                            $output .= "
                            <tr>
                                <td colspan='11' class='text-center'>No Approved Nurses in $department.</td>
                            </tr>
                            ";
                        } else {
                            while ($row = mysqli_fetch_array($res)) {
                                $output .= "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['firstname']}</td>
                                   
                                    <td>
                                        <a href='edit_staff.php?id={$row['id']}'>
                                            <button class='btn btn-info'>Edit</button>
                                        </a>
                                    </td>
                                </tr>
                                ";
                            }
                        }

                        // End the department table
                        $output .= "
                            </tbody>
                        </table>
                        ";

                        echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
