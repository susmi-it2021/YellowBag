<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","yellowbag");
    if(!$conn){
        die('Sorry, connection failed'. mysqli_connect_error());
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <title>User Details</title>
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
            width: 150px;
            height: 40px;
            text-align: center;
        }

        .table th,
        .table td {
            text-align: left;
            vertical-align: top;
			padding: 15px;
        }
		.custom-buttons {
            display: flex;
            flex-wrap: wrap; /* Allow buttons to wrap */
            justify-content: center;
            margin-bottom: 5px;
        }

        .custom-buttons .btn {
            margin: 5px; /* Add some spacing between buttons */
        }

        /* Media Query for smaller screens */
        @media (max-width: 768px) {
            .btn {
                width: 120px; /* Decrease button width */
                height: 30px; /* Decrease button height */
                font-size: 0.9rem; /* Decrease font size */
            }
            .btn-above {
                display: none; /* Hide buttons above on smaller screens */
            }
            .btn-below {
                display: inline-block; /* Display buttons below on smaller screens */
            }
        }
    </style>
</head>

<body>
    <?php include '../header.html'; ?>
	<div class="custom-buttons">
        <a href="catalogue_upload.php" class="btn btn-warning btn-gap">CATALOGUES</a>
		<a href="order_details.php" class="btn btn-warning btn-gap">ORDERS</a>
		<a href="feedback_details.php" class="btn btn-warning btn-gap">FEEDBACKS</a>
		<a href="search_details.php" class="btn btn-warning btn-gap">SEARCH</a>
		<a href="filter_details.php" class="btn btn-warning btn-gap">FILTER</a>
	</div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><b class="d-block d-md-inline">User Credentials</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>User Id</th>
                                        <th>Username</th>
                                        <th>Email ID</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = "SELECT Id, Username, Email, Phone FROM user";
                                        $query_run = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            while ($user = mysqli_fetch_assoc($query_run)) {
                                                ?>
                                                <tr>
                                                    <td><?= $user['Id']; ?></td>
                                                    <td><?= $user['Username']; ?></td>
                                                    <td><?= $user['Email']; ?></td>
                                                    <td><?= $user['Phone']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No records found</td></tr>";
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
