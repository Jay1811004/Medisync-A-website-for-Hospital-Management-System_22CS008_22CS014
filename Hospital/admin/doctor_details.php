<?php
session_start();
include("../include/connection.php");

// Check if 'department' is set in the URL, if not, provide a fallback value
// Get the department from the query parameter
$department = isset($_GET['department']) ? mysqli_real_escape_string($connect, $_GET['department']) : '';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors in <?php echo htmlspecialchars($department); ?></title>
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
    </style>
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
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">Doctors in <?php echo htmlspecialchars($department); ?></h5>

                    <?php
                        // Query to fetch doctors in the selected department
                        $query = "SELECT * FROM doctors WHERE status='Approved' AND department='$department' ORDER BY date_reg ASC";
                        $res = mysqli_query($connect, $query);

                        echo "<table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Firstname</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        if (mysqli_num_rows($res) < 1) {
                            echo "
                            <tr>
                                <td colspan='3' class='text-center'>No Approved Doctors in $department Yet.</td>
                            </tr>";
                        } else {
                            while ($row = mysqli_fetch_array($res)) {
                                echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['firstname']}</td>
                                    <td>
                                        <a href='edit.php?id={$row['id']}'>
                                            <button class='btn btn-info'>Edit</button>
                                        </a>
                                    </td>
                                </tr>";
                            }
                        }

                        echo "</tbody></table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
