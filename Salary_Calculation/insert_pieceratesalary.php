<?php
if (
    isset($_POST['employee_name']) &&
    isset($_POST['date']) &&
    isset($_POST['overtime']) &&
    isset($_POST['bags_stitched']) &&
    isset($_POST['bag_value']) &&
    isset($_POST['per_day_salary'])
) {
    $employeeName = $_POST['employee_name'];
    $date = $_POST['date'];
    $overtime = $_POST['overtime'];
    $bagsStitched = $_POST['bags_stitched'];
    $bagValue = $_POST['bag_value'];
    $perDaySalary = $_POST['per_day_salary'];

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
    $sql_select = "SELECT * FROM piecerate_salary WHERE employee_name = ? AND date = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("ss", $employeeName, $date);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($result->num_rows > 0) {
        $stmt_update = $conn->prepare("UPDATE piecerate_salary SET overtime = ?, no_of_bags_stitched = ?, bag_value=?,per_day_salary = ? WHERE employee_name = ? AND date = ?");
        $stmt_update->bind_param("diddss", $overtime,$bagsStitched, $bagValue, $perDaySalary, $employeeName, $date);

        // Execute prepared statement for update
        if ($stmt_update->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt_update->error;
        }

        // Close update statement
        $stmt_update->close();
    } else {
        // Prepare and bind SQL statement with parameters
        $stmt_insert = $conn->prepare("INSERT INTO piecerate_salary (employee_name, date, overtime, no_of_bags_stitched, bag_value, per_day_salary) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("ssdidd", $employeeName, $date, $overtime, $bagsStitched, $bagValue, $perDaySalary);

        // Execute prepared statement
        if ($stmt_insert->execute()) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        // Close statement
        $stmt_insert->close();
    }

    // Close select statement and connection
    $stmt_select->close();
    $conn->close();
} else {
    echo "Error: Parameters not set";
}
?>
