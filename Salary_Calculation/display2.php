<?php
if(isset($_POST['month']) && isset($_POST['year']) && isset($_POST['employee_name'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $employeeName = $_POST['employee_name'];
    $monthNumber = date('m', strtotime($month));
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
    $sql = "SELECT date, late, break_late, time_in, time_out FROM $table_name WHERE user = '$employeeName'";
    $result = $conn->query($sql);

    // Display the attendance records
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<div class='table-container'>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr><th colspan='3' style='text-align:center;'>Salary Details</th></tr>";
        echo "<tr><th style='text-align:center;'>Month: $month</th>";
        echo "<th style='text-align:center;'>Year: $year</th>";
        echo "<th style='text-align:center;'>Employee Name: $employeeName</th></tr>";
        echo "</thead>";
        echo "</table>";
        echo "<table class='table'>";
        echo "<tr><th>Date</th><th>Overtime salary</th><th>Number of bags <br> stitched</th><th>Cloth type value</th><th>Sunday <br> salary</th><th>Action</th><th>Per day salary</th></tr>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            // Check if the date is Sunday
            $date = strtotime($row['date']);
            $isSunday = date('D', $date) === 'Sun';
            
            // Calculate overtime amount
            $time_in = strtotime((string)$row['time_in']);
            $time_out = strtotime((string)$row['time_out']);
            $amount = 0;
            if ($time_out >= strtotime("19:00:00") && $time_out <= strtotime("23:00:00")) {
                $diff = $time_out - strtotime("19:00:00");
                if ($diff <= 600) {
                    $amount += 0;
                } elseif ($diff <= 1800) {
                    $amount += 10;
                } else {
                    $amount += 20;
                }
            }
            
if ($time_out >= strtotime("20:00:00") && $time_out <= strtotime("23:00:00")) {
    $diff = $time_out - strtotime("20:00:00");
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 10;
    } else {
        $amount += 20;
    }
}

if ($time_out >= strtotime("21:00:00") && $time_out <= strtotime("23:00:00")) {
    $diff = $time_out - strtotime("21:00:00");
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 20;
    } else {
        $amount += 40;
    }
}

if ($time_out >= strtotime("22:00:00") && $time_out <= strtotime("23:00:00")) {
    $diff = $time_out - strtotime("22:00:00");
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 40;
    } else {
        $amount += 80;
    }
}
if ($time_in <= strtotime("10:00:00") && $time_in >= strtotime("6:00:00")) {
    $diff =strtotime("10:00:00")-$time_in;
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 10;
    } else {
        $amount += 20;
    }
}

if ($time_in <= strtotime("9:00:00") && $time_in >= strtotime("6:00:00")) {
    $diff =strtotime("9:00:00")-$time_in;
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 10;
    } else {
        $amount += 20;
    }
}

if ($time_in <= strtotime("8:00:00") && $time_in >= strtotime("6:00:00")) {
    $diff =strtotime("8:00:00")-$time_in;
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 20;
    } else {
        $amount += 40;
    }
}
if ($time_in <= strtotime("7:00:00") && $time_in >= strtotime("6:00:00")) {
   $diff =strtotime("7:00:00")-$time_in;
    if ($diff <= 600) {
        $amount += 0;
    } elseif ($diff <= 1800) {
        $amount += 40;
    } else {
        $amount += 80;
    }
}
if ($isSunday) {
                $timeIn = strtotime($row['time_in']);
                $timeOut = strtotime($row['time_out']);
                $workingSeconds = $timeOut - $timeIn; // Total seconds worked

                // Convert break late hours from hh:mm:ss format to seconds
                $breakLate = $row['break_late']; // Assuming break late is in the format of hh:mm:ss
                list($breakLateHours, $breakLateMinutes, $breakLateSeconds) = explode(':', $breakLate);
                $breakLateTotalSeconds = ($breakLateHours * 3600) + ($breakLateMinutes * 60) + $breakLateSeconds;

                // Subtract break late seconds from the working seconds
                if ($breakLateTotalSeconds > 0) {
                    $workingSeconds -= $breakLateTotalSeconds;
                }

                // Convert working seconds to hours
                $workingHours = $workingSeconds / 3600;

                // Calculate Sunday salary
                $sundaySalary = 300 + ($workingHours * (15 / 3600) * 3600); // Assuming 1 hour = Rs. 15

                // Round off the Sunday salary to the nearest integer value
                $sundaySalary = round($sundaySalary);
            } else {
                $sundaySalary = 0; // If not Sunday, Sunday salary is 0
            }
echo "<tr>";
echo "<td>{$row['date']}</td>";
echo "<td class='overtime-salary'>$amount</td>"; // Display calculated overtime amount
echo "<td><input type='text' class='form-control bags-stitched' style='border: 1px solid black; width: 100px;'></td>"; // Input text box for number of bags stitched
echo "<td><input type='text' class='form-control cloth-type' style='border: 1px solid black; width: 100px;'></td>"; // Input text box for cloth type
echo "<td class='sunday-salary'>$sundaySalary</td>"; // Display Sunday salary
echo "<td><button type='button' class='btn btn-success calculate-btn'>Calculate</button></td>"; // Calculate button
echo "<td class='per-day-salary'></td>"; // Placeholder for per day salary
echo "</tr>";


        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No records found for the specified month, year, and employee name.</p>";
    }

    // Close the database connection
    $conn->close();
	$host = 'localhost';
$username = 'root'; // Your database username
$password = ''; // Your database password
$database = 'yellowbag'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query to calculate the total salary
$sql = "SELECT SUM(per_day_salary) AS total_salary 
        FROM piecerate_salary
        WHERE employee_name = '$employeeName' 
        AND MONTH(date) = '$monthNumber '
        AND YEAR(date) = '$year'";

// Execute the query
$result = $conn->query($sql);

if ($result) {
    // Fetch the total salary from the result
    $row = $result->fetch_assoc();
    $totalSalary = $row['total_salary'];

    // Display the monthly salary box with the total salary
    echo "<div class='monthly-salary-box'>";
    echo "<h3>Monthly Salary</h3>";
    echo "<p>Total Salary for $month $year: $totalSalary</p>";
    echo "</div>";

    // Free result set
    $result->free();
} else {
    // If the query fails, display an error message
    echo "Error: " . $sql . "<br>" . $conn->error;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
    .text-danger {
        color: red; /* Text color */
    }

    .bg-danger {
        background-color: #ffc0cb; /* Background color */
    }
    .table-container {
        max-width: 100%; /* Adjust the width as needed */
    }
    .table th, .table td {
        white-space: nowrap;
    }
    .table th:nth-child(3), .table td:nth-child(3) {
        width: 200px; /* Increase width of the third column for employee name */
    }
    .table th:nth-child(5), .table td:nth-child(5) {
        width: 120px; /* Increase width of the fifth column for Sunday salary */
    }
    .table th:nth-child(7), .table td:nth-child(7) {
        width: 120px; /* Increase width of the seventh column for per day salary */
    }
    </style>
<script>
$(document).ready(function() {
    // Add event listener to calculate button
    $('.calculate-btn').click(function() {
        var row = $(this).closest('tr');
        var bagsStitched = parseInt(row.find('.bags-stitched').val()) || 0;
        var clothTypeValue = parseFloat(row.find('.cloth-type').val()) || 0;
        var overtimeSalary = parseFloat(row.find('.overtime-salary').text()) || 0;
        var sundaySalary = parseInt(row.find('.sunday-salary').text()) || 0;
        var perDaySalary = parseFloat(row.find('.per-day-salary').text()) || 0; // Assuming per day salary is already calculated and displayed

        // Calculate per day salary if it's not already calculated and displayed
            if (sundaySalary > 0) {
                perDaySalary = (bagsStitched * clothTypeValue) + sundaySalary;
            } else {
                perDaySalary = overtimeSalary + (bagsStitched * clothTypeValue);
            }
            // Display per day salary in the last column
            row.find('.per-day-salary').text(perDaySalary);

        // Get the date of the record
        var date = row.find('td:first').text();

        // Send an AJAX request to insert the record into the 'piecerate_salary' table
        $.ajax({
            url: 'insert_pieceratesalary.php', // PHP file to handle insertion
            type: 'POST',
            data: {
                employee_name: '<?php echo $employeeName; ?>',
                date: date,
                overtime: overtimeSalary,
                bags_stitched: bagsStitched,
                bag_value: clothTypeValue,
                per_day_salary: perDaySalary
            },
            success: function(response) {
                // Display success message or handle response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
</head>
</html>
