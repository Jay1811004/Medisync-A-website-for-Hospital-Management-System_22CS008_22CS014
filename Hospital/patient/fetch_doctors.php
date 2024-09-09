<?php
include("../include/connection.php");

if (isset($_POST['department'])) {
    $department = $_POST['department'];

    // Initialize the $doctors array
    $doctors = [];

    // Fetch doctors from the database based on the selected department
    $query = "SELECT id, name FROM doctors WHERE department='$department'";
    $result = mysqli_query($connect, $query);

    if ($result) {
        // Populate the $doctors array
        while ($row = mysqli_fetch_array($result)) {
            $doctors[] = [
                'id' => htmlspecialchars($row['id']),
                'name' => htmlspecialchars($row['name'])
            ];
        }
    }

    // Generate options dynamically
    $output = "<option value=''>Select Doctor</option>";
    foreach ($doctors as $doctor) {
        $output .= "<option value='" . $doctor['id'] . "'>" . $doctor['name'] . "</option>";
    }

    echo $output;
} else {
    // Handle the case where department is not set
    echo "<option value=''>Select Doctor</option>";
}
?>
