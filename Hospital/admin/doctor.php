<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Doctors</title>
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
                    <h5 class="text-center my-3">Total Doctors</h5>

                    <?php
                    // Fetch distinct departments from the doctors table
                    $dept_query = "SELECT DISTINCT department FROM doctors WHERE status='Approved'";
                    $dept_res = mysqli_query($connect, $dept_query);

                    if (mysqli_num_rows($dept_res) < 1) {
                        echo "<p class='text-center'>No Approved Doctors Yet.</p>";
                    } else {
                        while ($dept_row = mysqli_fetch_array($dept_res)) {
                            $department = $dept_row['department'];

                            // Display department name as section header
                            echo "<div class='role-header'>$department</div>";

                            // Fetch doctors from this department
                            $doc_query = "SELECT * FROM doctors WHERE status='Approved' AND department='$department' ORDER BY date_reg ASC";
                            $doc_res = mysqli_query($connect, $doc_query);

                            if (mysqli_num_rows($doc_res) < 1) {
                                echo "<p class='text-center'>No Doctors in $department Yet.</p>";
                            } else {
                                echo "<table class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";

                                while ($doc_row = mysqli_fetch_array($doc_res)) {
                                    echo "
                                    <tr>
                                        <td>{$doc_row['id']}</td>
                                        <td>{$doc_row['firstname']}</td>
                                        <td>
                                            <a href='edit.php?id={$doc_row['id']}'>
                                                <button class='btn btn-info'>See Details</button>
                                            </a>
                                        </td>
                                    </tr>";
                                }

                                echo "</tbody></table>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
