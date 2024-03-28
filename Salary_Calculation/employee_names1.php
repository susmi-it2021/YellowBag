<?php
$host = 'localhost';
$username = 'root'; // Your database username
$password = ''; // Your database password
$database = 'attendance'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming this file handles the AJAX request to fetch attendance records

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve month and year from the POST data
    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? '';

    if ($month === '' || $year === '') {
        echo "<p class='text-danger'>Month and year must be provided.</p>";
    } else {
        // Check if the table exists in the database
        $table_name = strtolower($month) . $year;
        $check_table_query = "SHOW TABLES LIKE '$table_name'";
        $check_table_result = $conn->query($check_table_query);

        if ($check_table_result->num_rows > 0) {
            // Fetch employee names
            $sql = "SELECT DISTINCT user FROM $table_name ORDER BY user";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<div id='dayworkers-searchButton'>";
                echo "<ul id='dayworkers-employeeList' class='list-group mt-3'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='list-group-item'>" . $row['user'] . "</li>";
                }
                echo "</ul>";
                echo "</div>";
                echo "<div class='text-center mt-4'>";
                echo "<button id='dayworkers-displayButton' class='btn btn-primary'>Display Salary</button>";
                echo "</div>";
                // JavaScript to handle display button
                echo "<script>
                        document.getElementById('dayworkers-displayButton').addEventListener('click', function() {
                            document.getElementById('dayworkers-employeeList').style.display = 'none';
                            this.style.display = 'none';
                            // Call function to display salary details here
                            // For now, just logging a message
                            console.log('Display salary button clicked');
                        });
                      </script>";
            } else {
                echo "<p class='text-danger'>No records found for the selected month and year.</p>";
            }
        } else {
            echo "<p class='text-danger'>The specified month and year do not exist. Please choose an appropriate month and year.</p>";
        }
    }
    $conn->close();
}
?>
