<?php
session_start();
include("../include/connection.php");

$patientId = $_SESSION['patient_id'];

// Initialize variables
$doctors = [];
$selectedDepartment = '';
$selectedDoctor = '';

// Fetch departments
$departments = [];
$dept_query = mysqli_query($connect, "SELECT DISTINCT department FROM doctors");
while ($dept_row = mysqli_fetch_array($dept_query)) {
    $departments[] = $dept_row['department'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['department'])) {
        $selectedDepartment = $_POST['department'];

        if ($selectedDepartment) {
            // Fetch doctors based on selected department
            $query = "SELECT id, firstname FROM doctors WHERE department='$selectedDepartment'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $doctors[] = [
                        'id' => htmlspecialchars($row['id']),
                        'name' => htmlspecialchars($row['firstname'])
                    ];
                }
            }
        }
    }

    if (isset($_POST['book'])) {
        $date = $_POST['date'];
        $sym = $_POST['sym'];
        $selectedDoctor = $_POST['doctor'];

        if (empty($selectedDoctor)) {
            echo "<script>alert('Please select a doctor.')</script>";
        } else {
            $pat = $_SESSION['patient'];
            $sel = mysqli_query($connect, "SELECT * FROM patient WHERE username='$pat'");
            $row = mysqli_fetch_array($sel);
            $firstname = $row['firstname'];
            $surname = $row['surname'];
            $gender = $row['gender'];
            $phone = $row['phone'];

            if (!empty($sym)) {
                // Ensure the selected doctor is valid
            
                $doctor_query = mysqli_query($connect, "SELECT * FROM doctors WHERE id='$selectedDoctor'");
                if (mysqli_num_rows($doctor_query) > 0) {
                    $query = "INSERT INTO appointment(firstname, surname, gender, phone, appointment_date, symptoms, doctor_id, status, date_booked, patient_id) 
                              VALUES('$firstname', '$surname', '$gender', '$phone', '$date', '$sym', '$selectedDoctor', 'pending', NOW(), '$patientId')";
                    $res = mysqli_query($connect, $query);

                    if ($res) {
                        echo "<script>alert('You have successfully booked an appointment.')</script>";
                    } else {
                        echo "Error booking appointment: " . mysqli_error($connect) . "<br>";
                    }
                } else {
                    echo "<script>alert('Invalid doctor selected.')</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-form {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .booking-form input[type="date"],
        .booking-form input[type="text"],
        .booking-form input[type="submit"] {
            margin-bottom: 15px;
        }

        .booking-form input[type="submit"] {
            background-color: #17a2b8;
            color: white;
            transition: background-color 0.3s ease;
        }

        .booking-form input[type="submit"]:hover {
            background-color: #138496;
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
                    <h5 class="text-center my-4">Book Appointment</h5>

                    <div class="d-flex justify-content-center">
                        <div class="col-md-6 booking-form">
                            <form method="post" id="appointmentForm">
                                <!-- Department Selection -->
                                <label>Select Department</label>
                                <select name="department" id="department" class="form-control" onchange="this.form.submit()">
                                    <option value="">Select Department</option>
                                    <?php
                                    foreach ($departments as $dept) {
                                        $selected = ($dept == $selectedDepartment) ? 'selected' : '';
                                        echo "<option value='$dept' $selected>$dept</option>";
                                    }
                                    ?>
                                </select>

                                <!-- Doctor Selection -->
                                <label>Select Doctor</label>
                                <select name="doctor" id="doctor" class="form-control">
                                    <option value="">Select Doctor</option>
                                    <?php
                                    foreach ($doctors as $doctor) {
                                        echo "<option value='" . $doctor['id'] . "'>" . $doctor['name'] . "</option>";
                                    }
                                    ?>
                                </select>

                                <!-- Other fields -->
                                <label for="date">Appointment Date</label>
                                <input type="date" name="date" id="date" class="form-control">

                                <label for="sym">Symptoms</label>
                                <input type="text" name="sym" id="sym" class="form-control" placeholder="Enter Symptoms">

                                <input type="submit" name="book" class="btn btn-info w-100 my-2" value="Book Appointment">
                                <!-- <?php echo "$patientId";?> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
