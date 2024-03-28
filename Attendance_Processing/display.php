<?php
if(isset($_POST['month']) && isset($_POST['year']) && isset($_POST['employee_name'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $employeeName = $_POST['employee_name'];

    // Connect to your database
    $host = 'localhost';
    $username = 'root'; // Your database username
    $password = ''; // Your database password
    $database = 'attendance'; // Your database name
    $conn = new mysqli($host, $username, $password, $database);
    $table_name = strtolower($month) . $year;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch attendance records based on the provided parameters
    $sql = "SELECT date, late, break_late FROM $table_name WHERE user = '$employeeName'";
    $result = $conn->query($sql);

    // Display the attendance records
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<div class='table-container'>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th colspan='3' style='text-align:center;'>Attendance Details</th></tr>";
        echo "<tr><th style='text-align:center;'>Month: $month</th>";
        echo "<th style='text-align:center;'>Year: $year</th>";
        echo "<th style='text-align:center;'>Employee Name: $employeeName</th></tr>";
        echo "</thead>";
        echo "</table>";
        echo "<table class='table'>";
        echo "<tr><th>Date</th><th>Late</th><th>Break Late</th></tr>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            $late = $row["late"];
            $lateClass = '';
            // Extract hours and minutes from the late field
            $lateParts = explode('hr', $late);
            if (count($lateParts) == 2) {
                $hours = intval($lateParts[0]);
                $minutes = intval(substr($lateParts[1], 0, -3)); // Remove "min" suffix
                // Calculate total minutes
                $totalMinutes = $hours * 60 + $minutes;
                // Check if total minutes is greater than 30
                $lateClass = ($totalMinutes > 30) ? 'bg-danger' : '';
            }
            
            $breakLate = $row["break_late"];
            list($hours, $minutes, $seconds) = explode(':', $breakLate);
            // Convert hours, minutes, and seconds into total minutes
            $totalMinutes = $hours * 60 + $minutes + round($seconds / 60);
            // Check if total minutes is greater than 15
            $breakLateClass = ($totalMinutes > 15) ? 'bg-danger' : '';
            
            // Display table rows with appropriate classes
            echo "<tr>";
            echo "<td>{$row['date']}</td>";
            echo "<td class='$lateClass'>$late</td>";
            echo "<td class='$breakLateClass'>$breakLate</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No attendance records found for the specified month, year, and employee name.</p>";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the parameters are not set, display an error message
    echo "<h2>Error: Parameters not set</h2>";
    echo "<p>Month, year, and employee name must be provided.</p>";
}
?>

<html>
    <head>
    <style>
    .text-danger {
        color: red; /* Text color */
    }

    .bg-danger {
        background-color: #ffc0cb; /* Background color */
    }
    .table-container {
            overflow-x: auto;
            width: 100%; /* Adjust the width as needed */
    }

    /* Adjust table style for better readability on small screens */
    @media only screen and (max-width: 768px) {
            table {
                width: 100%;
                border-collapse: collapse;
            }
    }
</style>

</head>
    </html>
