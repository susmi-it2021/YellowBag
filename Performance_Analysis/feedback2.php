<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>YellowBag</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
#chart-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* Adjust column width */
    gap: 20px;
    padding: 20px;
	max-width: 200%;
	max-height: 150%;
}

.chart-item {
	background-color: #fefee3;
    border-radius: 10px;
    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
	width: 100%; /* Make canvas responsive */
    height: 100%;
}

.canvas {
    width: 100%; /* Make canvas responsive */
    height: 100%; /* Make canvas responsive */
}
.container {
    overflow-x: auto; /* Enable horizontal scrolling */
}
</style>
</head>
<body>

    <!-- Chart elements here -->
    <?php
    // Step 1: Retrieve data from the database (replace with your database connection code)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yellowbag";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Modify the SQL query to fetch data between the specified dates
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Prevent SQL injection
        $start_date = mysqli_real_escape_string($conn, $start_date);
        $end_date = mysqli_real_escape_string($conn, $end_date);

            // Modify the SQL query to fetch data between the specified dates
        $sql = "SELECT printrev FROM feedback 
                WHERE feedback_date >= '$start_date' AND feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY)";
        $result = $conn->query($sql);

    // Initialize an array to store the count of "values" attributes in each field
    $data = [0, 0, 0, 0, 0];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Loop through each row and update the count of "Very Good" attributes in each field
            $data[0] += ($row['printrev'] === 'Needs Improvement') ? 1 : 0;
            $data[1] += ($row['printrev'] === 'Okay') ? 1 : 0;
            $data[2] += ($row['printrev'] === 'Good') ? 1 : 0;
            $data[3] += ($row['printrev'] === 'Satisfied') ? 1 : 0;
            $data[4] += ($row['printrev'] === 'Very Good') ? 1 : 0;
        }
    }
	$data1 = [0, 0, 0, 0, 0];

    // Execute a separate query to fetch rows for stitching review
    $sql_stitching_review = "SELECT stitchrev FROM feedback 
                WHERE feedback_date >= '$start_date' AND feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY)";
    $result_stitching_review = $conn->query($sql_stitching_review);
    if ($result_stitching_review->num_rows > 0) {
        while($row = $result_stitching_review->fetch_assoc()) {
            // Loop through each row and update the count of "Very Good" attributes in each field
            $data1[0] += ($row['stitchrev'] === 'Needs Improvement') ? 1 : 0;
            $data1[1] += ($row['stitchrev'] === 'Okay') ? 1 : 0;
            $data1[2] += ($row['stitchrev'] === 'Good') ? 1 : 0;
            $data1[3] += ($row['stitchrev'] === 'Satisfied') ? 1 : 0;
            $data1[4] += ($row['stitchrev'] === 'Very Good') ? 1 : 0;
        }
    }
	$sql_cloths_review = "SELECT clothrev FROM feedback 
                      WHERE feedback_date >= '$start_date' AND feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY)";
$result_cloths_review = $conn->query($sql_cloths_review);

// Initialize an array to store the count of "values" attributes in each field
$data3 = [0, 0, 0, 0, 0];

if ($result_cloths_review->num_rows > 0) {
    while($row = $result_cloths_review->fetch_assoc()) {
        // Loop through each row and update the count of attributes in each field
        $data3[0] += ($row['clothrev'] === 'Needs Improvement') ? 1 : 0;
        $data3[1] += ($row['clothrev'] === 'Okay') ? 1 : 0;
        $data3[2] += ($row['clothrev'] === 'Good') ? 1 : 0;
        $data3[3] += ($row['clothrev'] === 'Satisfied') ? 1 : 0;
        $data3[4] += ($row['clothrev'] === 'Very Good') ? 1 : 0;
    }
} 
// Retrieve data for Customer Service
$sql_customer_service = "SELECT custservice FROM feedback 
                         WHERE feedback_date >= '$start_date' AND feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY)";
$result_customer_service = $conn->query($sql_customer_service);

// Initialize an array to store the count of "values" attributes in each field
$data4 = [0, 0, 0, 0, 0];

if ($result_customer_service->num_rows > 0) {
    while($row = $result_customer_service->fetch_assoc()) {
        // Loop through each row and update the count of attributes in each field
        $data4[0] += ($row['custservice'] === 'Needs Improvement') ? 1 : 0;
        $data4[1] += ($row['custservice'] === 'Okay') ? 1 : 0;
        $data4[2] += ($row['custservice'] === 'Good') ? 1 : 0;
        $data4[3] += ($row['custservice'] === 'Satisfied') ? 1 : 0;
        $data4[4] += ($row['custservice'] === 'Very Good') ? 1 : 0;
    }
}
$sql_on_time_delivery = "SELECT otd FROM feedback 
                         WHERE feedback_date >= '$start_date' AND feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY)";
$result_on_time_delivery = $conn->query($sql_on_time_delivery);

// Initialize an array to store the count of "values" attributes in each field
$data5 = [0, 0, 0, 0, 0];

if ($result_on_time_delivery->num_rows > 0) {
    while($row = $result_on_time_delivery->fetch_assoc()) {
        // Loop through each row and update the count of attributes in each field
        $data5[0] += ($row['otd'] === 'Needs Improvement') ? 1 : 0;
        $data5[1] += ($row['otd'] === 'Okay') ? 1 : 0;
        $data5[2] += ($row['otd'] === 'Good') ? 1 : 0;
        $data5[3] += ($row['otd'] === 'Satisfied') ? 1 : 0;
        $data5[4] += ($row['otd'] === 'Very Good') ? 1 : 0;
    }
}
// Retrieve data for Customer Service
$sql_overall_satisfy = "SELECT osatisfy FROM feedback 
                         WHERE feedback_date >= '$start_date' AND feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY)";
$result_overall_satisfy = $conn->query($sql_overall_satisfy);

// Initialize an array to store the count of "values" attributes in each field
$data6 = [0, 0, 0, 0, 0];

if ($result_overall_satisfy->num_rows > 0) {
    while($row = $result_overall_satisfy->fetch_assoc()) {
        // Loop through each row and update the count of attributes in each field
        $data6[0] += ($row['osatisfy'] === 'Needs Improvement') ? 1 : 0;
        $data6[1] += ($row['osatisfy'] === 'Okay') ? 1 : 0;
        $data6[2] += ($row['osatisfy'] === 'Good') ? 1 : 0;
        $data6[3] += ($row['osatisfy'] === 'Satisfied') ? 1 : 0;
        $data6[4] += ($row['osatisfy'] === 'Very Good') ? 1 : 0;
    }
}
    $conn->close();
	}
    ?>
<main class="container" style="max-width: 100%;">
<div id="chart-container">
     <div class="chart-item">
            <canvas id="feedback-chart1"></canvas>
    </div>
    <div class="chart-item">
            <canvas id="feedback-chart2"></canvas>
    </div>
    <div class="chart-item">
            <canvas id="feedback-chart3"></canvas>
    </div>
    <div class="chart-item">
            <canvas id="feedback-chart4"></canvas>
    </div>
    <div class="chart-item">
            <canvas id="feedback-chart5"></canvas>
    </div>
    <div class="chart-item">
            <canvas id="feedback-chart6"></canvas>
    </div>
</div>
</main>

<script>
  // Step 2: Use Chart.js to create a bar graph
  var ctx1 = document.getElementById('feedback-chart1').getContext('2d');
  var feedbackChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Needs Improvement', 'Okay', 'Good', 'Satisfied', 'Very Good'],
      datasets: [
        {
          label: 'Printing Review ',
          data: <?php echo json_encode($data); ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)', // Red
            'rgba(54, 162, 235, 0.5)', // Blue
            'rgba(255, 206, 86, 0.5)', // Yellow
            'rgba(75, 192, 192, 0.5)', // Green
            'rgba(153, 102, 255, 0.5)', // Purple
            'rgba(255, 159, 64, 0.5)' // Orange
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });
  // Repeat the above steps for other charts (feedback-chart2 to feedback-chart6) with appropriate data and options
</script><script>
  // Step 2: Use Chart.js to create a bar graph for stitching review
  var ctx2 = document.getElementById('feedback-chart2').getContext('2d');
  var feedbackChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Needs Improvement', 'Okay', 'Good', 'Satisfied', 'Very Good'],
      datasets: [
        {
          label: 'Stitching Review',
          data: <?php echo json_encode($data1); ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)', // Red
            'rgba(54, 162, 235, 0.5)', // Blue
            'rgba(255, 206, 86, 0.5)', // Yellow
            'rgba(75, 192, 192, 0.5)', // Green
            'rgba(153, 102, 255, 0.5)', // Purple
            'rgba(255, 159, 64, 0.5)' // Orange
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });
  var ctx3 = document.getElementById('feedback-chart3').getContext('2d');
  var feedbackChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ['Needs Improvement', 'Okay', 'Good', 'Satisfied', 'Very Good'],
      datasets: [
        {
          label: 'Cloths Review ',
          data: <?php echo json_encode($data3); ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)', // Red
            'rgba(54, 162, 235, 0.5)', // Blue
            'rgba(255, 206, 86, 0.5)', // Yellow
            'rgba(75, 192, 192, 0.5)', // Green
            'rgba(153, 102, 255, 0.5)', // Purple
            'rgba(255, 159, 64, 0.5)' // Orange
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });

  // Chart for Customer Service
  var ctx4 = document.getElementById('feedback-chart4').getContext('2d');
  var feedbackChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
      labels: ['Needs Improvement', 'Okay', 'Good', 'Satisfied', 'Very Good'],
      datasets: [
        {
          label: 'Customer Service',
          data: <?php echo json_encode($data4); ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)', // Red
            'rgba(54, 162, 235, 0.5)', // Blue
            'rgba(255, 206, 86, 0.5)', // Yellow
            'rgba(75, 192, 192, 0.5)', // Green
            'rgba(153, 102, 255, 0.5)', // Purple
            'rgba(255, 159, 64, 0.5)' // Orange
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });

  // Chart for On-Time Delivery
  var ctx5 = document.getElementById('feedback-chart5').getContext('2d');
  var feedbackchart5 = new Chart(ctx5, {
    type: 'bar',
    data: {
      labels: ['Needs Improvement', 'Okay', 'Good', 'Satisfied', 'Very Good'],
      datasets: [
        {
          label: 'On-Time Delivery',
          data: <?php echo json_encode($data5); ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)', // Red
            'rgba(54, 162, 235, 0.5)', // Blue
            'rgba(255, 206, 86, 0.5)', // Yellow
            'rgba(75, 192, 192, 0.5)', // Green
            'rgba(153, 102, 255, 0.5)', // Purple
            'rgba(255, 159, 64, 0.5)' // Orange
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });

  // Chart for Overall Satisfaction
  var ctx6 = document.getElementById('feedback-chart6').getContext('2d');
  var feedbackchart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
      labels: ['Needs Improvement', 'Okay', 'Good', 'Satisfied', 'Very Good'],
      datasets: [
        {
          label: 'Overall Satisfaction',
          data: <?php echo json_encode($data6); ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.5)', // Red
            'rgba(54, 162, 235, 0.5)', // Blue
            'rgba(255, 206, 86, 0.5)', // Yellow
            'rgba(75, 192, 192, 0.5)', // Green
            'rgba(153, 102, 255, 0.5)', // Purple
            'rgba(255, 159, 64, 0.5)' // Orange
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      }
    }
  });
</script>
</body>
</html>
