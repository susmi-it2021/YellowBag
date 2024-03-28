<?php
if (
    isset($_POST['employee_name']) &&
    isset($_POST['date']) &&
    isset($_POST['overtime']) &&
    isset($_POST['per_day_salary']) &&
    isset($_POST['late_hours'])
) {
    $employeeName = $_POST['employee_name'];
    $date = $_POST['date'];
    $overtime = $_POST['overtime'];
    $perDaySalary = $_POST['per_day_salary'];
    $late = $_POST['late_hours'];

    // Connect to your database
    $host = 'localhost';
    $username = 'root'; // Your database username
    $password = ''; // Your database password
    $database = 'yellowbag'; // Your database name
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the record already exists
    $sql_select = "SELECT * FROM dayworker_salary WHERE employee_name = ? AND date = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("ss", $employeeName, $date);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($result->num_rows > 0) {
        // Update the existing record
        $stmt_update = $conn->prepare("UPDATE dayworker_salary SET overtime = ?, late_hours = ?, per_day_salary = ? WHERE employee_name = ? AND date = ?");
        $stmt_update->bind_param("dsdss", $overtime, $late, $perDaySalary, $employeeName, $date);

        // Execute prepared statement for update
        if ($stmt_update->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt_update->error;
        }

        // Close update statement
        $stmt_update->close();
    } else {
        // Insert a new record
        $stmt_insert = $conn->prepare("INSERT INTO dayworker_salary (employee_name, date, overtime, late_hours, per_day_salary) VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("ssdds", $employeeName, $date, $overtime, $late, $perDaySalary);

        // Execute prepared statement for insert
        if ($stmt_insert->execute()) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record: " . $stmt_insert->error;
        }

        // Close insert statement
        $stmt_insert->close();
    }

    // Close select statement and connection
    $stmt_select->close();
    $conn->close();
} else {
    echo "Error: Parameters not set";
}
?>
