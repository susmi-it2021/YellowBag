<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","yellowbag");
    if(!$conn){
    die('Sorry,connection failed'. mysqli_connect_error());
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <title>Order Details</title>
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

        .btn-gap {
            margin-left: 10px;
        }

        .btn {
            width: 100px;
            height: 40px;
            text-align: center;
        }

        .table th,
        .table td {
            text-align: left;
            vertical-align: top;
			padding: 15px;
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><b class="d-block d-md-inline">Order Details</b>
                            <a href="user_credentials.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                    <?php 
                                        $query = "SELECT `order`.order_id AS id, `order`.user_id, user.Username, user.Email, user.Phone, 
              `order`.name,`order`.address,`order`.phone, `order`.background, `order`.purpose, `order`.occurence, `order`.gst, `order`.print_type, 
              `order`.print_option, `order`.order_date 
              FROM `order` 
              INNER JOIN user ON `order`.user_id = user.Id
              ORDER BY `order`.order_id ASC";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
?>
            <tr>
                <td><?= $row['id']; ?></td>
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
<?php
        }
    } else {
        echo "<tr><td colspan='13'>No records found</td></tr>";
    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
