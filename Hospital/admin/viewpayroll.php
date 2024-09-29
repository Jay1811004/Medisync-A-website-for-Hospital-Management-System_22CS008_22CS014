<?php
// Include necessary files and start session
session_start();
include("../include/connection.php");
include("../include/header.php");

// Fetch the staff ID from the URL
if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    // Query to fetch staff details and basic salary
    $query = "SELECT * FROM staff WHERE id='$staff_id'";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);

    $firstname = $row['firstname'];
    $role = $row['role'];
    $basic_salary = $row['salary']; // Fetch the salary from staff table

    // Define allowances and deductions
    $allowance = 0.2 * $basic_salary; // Example: 20% of basic salary
    $deduction = 0.1 * $basic_salary; // Example: 10% of basic salary

    // Final salary calculation
    $final_salary = $basic_salary + $allowance - $deduction;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Details</title>
    <style>
        .container-fluid {
            padding: 20px;
        }
        .table {
            width: 70%;
            margin: auto;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .col-md-2{
            margin-top: -19px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h2 class="text-center my-3">Payroll Details for <?php echo $firstname; ?></h2>

                    <table class="table table-bordered">
                        <tr>
                            <th>Role</th>
                            <td><?php echo $role; ?></td>
                        </tr>
                        <tr>
                            <th>Basic Salary</th>
                            <td><?php echo "₹" . number_format($basic_salary, 2); ?></td>
                        </tr>
                        <tr>
                            <th>Allowance</th>
                            <td><?php echo "₹" . number_format($allowance, 2); ?></td>
                        </tr>
                        <tr>
                            <th>Deduction</th>
                            <td><?php echo "₹" . number_format($deduction, 2); ?></td>
                        </tr>
                        <tr>
                            <th>Final Salary</th>
                            <td><b><?php echo "₹" . number_format($final_salary, 2); ?></b></td>
                        </tr>
                    </table>

                    <div class="text-center mt-3">
                        <a href="payroll.php"><button class="btn btn-danger">Back to Payroll</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
