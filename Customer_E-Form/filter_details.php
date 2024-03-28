<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "yellowbag");
if (!$conn) {
    die('Sorry, connection failed' . mysqli_connect_error());
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <title>Filter Details</title>
    <style>
        .card {
            background-color: #eef4ed;
            border: 1px solid #666666;
            border-radius: 5px;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            border-bottom: 1px solid #0056b3;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .form-control {
            border: 1px solid #000000;
        }

        button,
        .btn {
            width: 100px;
            height: 40px;
            margin: 5px;
            text-align: center;
        }

        .output input {
            display: block;
            margin-top: 20px;
        }

        .table th,
        .table td {
            text-align: left;
            vertical-align: top;
			padding: 15px;
        }

        .output {
            display: flex;
            flex-direction: column;
            /* Align items vertically */
            justify-content: center;
            /* Center items horizontally */
            align-items: center;
            /* Center items vertically */
            margin-top: 30px;
        }

        .comments-column {
            min-width: 300px; /* Adjust width as needed */
        }
		.col {
            min-width: 160px; /* Adjust width as needed */
        }
		.col1 {
            min-width: 100px; /* Adjust width as needed */
        }
		.col2 {
            min-width: 200px; /* Adjust width as needed */
        }
    </style>
</head>

<body>
    <?php include '../header.html'; ?>
    <div class="container mt-5">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><b class="d-block d-md-inline">Filter Order, Feedback Details</b><a href="user_credentials.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="col-md-5"><label for="start_date" class="form-label">Start Date</label></td>
                                            <td class="col-md-7"><input type="date" name="start_date" class="form-control" id="start_date" required></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-5"><label for="end_date" class="form-label">End Date</label></td>
                                            <td class="col-md-7"><input type="date" name="end_date" class="form-control" id="end_date" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <center>
                <button type="submit" name="filter" class="btn btn-primary">FILTER</button>
            </center>
        </form><br><br>
        <?php
        if (isset($_POST['filter'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $query = "SELECT feedback.*, user.* 
          FROM feedback 
          INNER JOIN user ON feedback.user_id = user.Id 
          WHERE feedback.feedback_date >= '$start_date' AND feedback.feedback_date <= DATE_ADD('$end_date', INTERVAL 1 DAY) 
          ORDER BY feedback.id ASC";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>
		                   <h2 class="text-center">Feedback Details</h2><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th class="col1">Feedback Id</th>
                                <th class="col1">User Id</th>
                                <th class="col">Username</th>
                                <th class="col">Email ID</th>
                                <th class="col">Whatsapp Number</th>
                                <th class="col">Printing Review</th>
                                <th class="col">Stitching Review</th>
                                <th class="col">Cloth Review</th>
                                <th class="col">Customer Service</th>
                                <th class="col">On Time Delivery</th>
                                <th class="col">Overall experience</th>
                                <th class="comments-column">Comments</th>
                                <th class="col">Entry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($query_run as $row) : ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['user_id']; ?></td>
                                    <td><?= $row['Username']; ?></td>
                                    <td><?= $row['Email']; ?></td>
                                    <td><?= $row['Phone']; ?></td>
                                    <td><?= $row['printrev']; ?></td>
                                    <td><?= $row['stitchrev']; ?></td>
                                    <td><?= $row['clothrev']; ?></td>
                                    <td><?= $row['custservice']; ?></td>
                                    <td><?= $row['otd']; ?></td>
                                    <td><?= $row['osatisfy']; ?></td>
                                    <td><?= $row['comments']; ?></td>
                                    <td><?= $row['feedback_date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo "<div class='alert alert-warning text-center'><h5>No records found</h5></div>";
            }?><br><?php
    $query2 = "SELECT `order`.*, user.* 
              FROM `order` 
              INNER JOIN user ON `order`.user_id = user.Id 
              WHERE `order`.order_date >= '$start_date' 
              AND `order`.order_date <= DATE_ADD('$end_date', INTERVAL 1 DAY) 
              ORDER BY `order`.order_id ASC";
    $query_run2 = mysqli_query($conn, $query2);

    if (mysqli_num_rows($query_run2) > 0) {
?>
        <h2 class="text-center">Order Details</h2><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th class="col1">Order Id</th>
                        <th class="col1">User Id</th>
                        <th class="col">Username</th>
						<th class="col">Email ID</th>
						<th class="col">Whatsapp Number</th>
						<th class="col">Customer Name</th>
                        <th class="col2">Address</th>
                        <th class="col">Office/Resident Phone Number</th>
                        <th class="col">Background</th>
                        <th class="col2">Purpose</th>
						<th class="col">Customer Engagement type</th>
                        <th class="col">GST</th>
                        <th class="col">Print Type</th>
                        <th class="col">Print Option</th>
                        <th class="col">Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($query_run2 as $row) : ?>
                        <tr>
                            <td><?= $row['order_id']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['Username']; ?></td>
							<td><?= $row['Email']; ?></td>
							<td><?= $row['Phone']; ?></td>
							<td><?= $row['name']; ?></td>
                            <td><?= $row['address']; ?></td>
                            <td><?= $row['phone']; ?></td>
                            <td><?= $row['background']; ?></td>
                            <td><?= $row['purpose']; ?></td>
							<td><?= $row['occurence']; ?></td>
                            <td><?= $row['gst']; ?></td>
                            <td><?= $row['print_type']; ?></td>
                            <td><?= $row['print_option']; ?></td>
                            <td><?= $row['order_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?php
    } else {
        echo "<div class='alert alert-warning text-center'><h5>No order records found</h5></div>";
    }
}

        
            ?>
            <br><br><br>
    </div><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>