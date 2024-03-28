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
    <title>Feedback Details</title>
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
                        <h4 class="mb-0"><b class="d-block d-md-inline">Feedback Details</b>
                            <a href="user_credentials.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                    <?php 
                                        $query = "SELECT feedback.id AS feedback_id, feedback.user_id, user.Username, user.Email, user.Phone, 
                                                  feedback.printrev, feedback.stitchrev, feedback.clothrev, feedback.custservice, 
                                                  feedback.otd, feedback.osatisfy, feedback.comments, feedback.feedback_date 
                                                  FROM feedback 
                                                  INNER JOIN user ON feedback.user_id = user.Id
                                                  ORDER BY feedback.id ASC";
                                        $query_run = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            while ($feedback = mysqli_fetch_assoc($query_run)) {
                                                ?>
                                                <tr>
                                                    <td><?= $feedback['feedback_id']; ?></td>
                                                    <td><?= $feedback['user_id']; ?></td>
                                                    <td><?= $feedback['Username']; ?></td>
                                                    <td><?= $feedback['Email']; ?></td>
                                                    <td><?= $feedback['Phone']; ?></td>
                                                    <td><?= $feedback['printrev']; ?></td>
                                                    <td><?= $feedback['stitchrev']; ?></td>
                                                    <td><?= $feedback['clothrev']; ?></td>
                                                    <td><?= $feedback['custservice']; ?></td>
                                                    <td><?= $feedback['otd']; ?></td>
                                                    <td><?= $feedback['osatisfy']; ?></td>
                                                    <td style="width: 1000px;"><?= $feedback['comments']; ?></td>
                                                    <td><?= $feedback['feedback_date']; ?></td>
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
