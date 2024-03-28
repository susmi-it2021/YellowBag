<?php
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

// Function to fetch count of records from a table
function getCount($conn, $table) {
    $sql = "SELECT COUNT(*) as count FROM `$table`"; // Using backticks around table name
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return 0;
    }
}

// Fetch count of records from each table
$adminCount = getCount($conn, 'admin');
$employeeCount = getCount($conn, 'employee');
$catalogueCount = getCount($conn, 'catalogue');
$feedbackCount = getCount($conn, 'feedback');
$orderCount = getCount($conn, 'order');
$userCount = getCount($conn, 'user');

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>YellowBag</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  .chart-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* Adjust column width */
    gap: 20px;
    padding: 20px;
    max-width: 200%;
    max-height: 100%;
  }
  .chart-box {
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border: 2px solid black;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    color: #fff; /* Text color */
  }
  .counter {
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #ffffff; /* Counter text color */
  }
  .icon {
    font-size: 50px;
    margin-bottom: 10px;
  }
</style>
</head>
<body>

<main class="container" style="max-width: 100%;">
  <div class="chart-container">
    <div class="chart-box" style="background-color: #3498db;"> <!-- Blue -->
      <div class="counter" data-toggle="counter-up"><?php echo $adminCount; ?></div>
      <div class="icon"><i class="fas fa-user-tie"></i></div>
      <div class="text">Admins</div>
    </div>
    <div class="chart-box" style="background-color: #2ecc71;"> <!-- Green -->
      <div class="counter" data-toggle="counter-up"><?php echo $employeeCount; ?></div>
      <div class="icon"><i class="fas fa-user"></i></div>
      <div class="text">Employees</div>
    </div>
    <div class="chart-box" style="background-color: #9b59b6;"> <!-- Purple -->
      <div class="counter" data-toggle="counter-up"><?php echo $userCount; ?></div>
      <div class="icon"><i class="fas fa-users"></i></div>
      <div class="text">Customers</div>
    </div>
    <div class="chart-box" style="background-color: #f39c12;"> <!-- Yellow -->
      <div class="counter" data-toggle="counter-up"><?php echo $orderCount; ?></div>
      <div class="icon"><i class="fas fa-box"></i></div>
      <div class="text">Orders</div>
    </div>
    <div class="chart-box" style="background-color: #e74c3c;"> <!-- Red -->
      <div class="counter" data-toggle="counter-up"><?php echo $feedbackCount; ?></div>
      <div class="icon"><i class="fas fa-pen-square"></i></div>
      <div class="text">Feedback</div>
    </div>
    <div class="chart-box" style="background-color: #f1c40f;"> <!-- Orange -->
      <div class="counter" data-toggle="counter-up"><?php echo $catalogueCount; ?></div>
      <div class="icon"><i class="fas fa-folder"></i></div>
      <div class="text">Catalogues</div>
    </div>
  </div>
</main>

<script>
function animateValue(obj, start, end, duration) {
  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
    obj.innerHTML = Math.floor(progress * (end - start) + start);
    if (progress < 1) {
      window.requestAnimationFrame(step);
    }
  };
  window.requestAnimationFrame(step);
}

document.querySelectorAll('.counter').forEach(element => {
  const startValue = 0; // Start from zero for animation effect
  const endValue = parseInt(element.innerHTML);
  animateValue(element, startValue, endValue, 1000); // Adjust duration as needed
});
</script>

</body>
</html>
