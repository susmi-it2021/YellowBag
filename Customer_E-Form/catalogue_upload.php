<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "yellowbag");
if (!$conn) {
    die('Sorry, connection failed' . mysqli_connect_error());
}
mysqli_query($conn, "SET GLOBAL max_allowed_packet = 524288000");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <title>Upload Catalogues</title>
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
    </style>
</head>
<body>
<?php include '../header.html'; ?>
    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><b class="d-block d-md-inline">Upload Catalogues</b><a href="user_credentials.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                            <td class="col-md-5"><label for="file1">Sareebag Catalogue (PDF):</label></td>
                            <td class="col-md-7"><input type="file" class="form-control" id="file1" name="file1" accept=".pdf" required></td>
							</tr>
                            <tr>
                            <td class="col-md-5"><label for="file2">Promotional Bag Catalogue (PDF):</label></td>
                            <td class="col-md-7"><input type="file" class="form-control" id="file2" name="file2" accept=".pdf" required></td>
                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <center>
                <button type="submit" class="btn btn-primary">UPLOAD</button>
            </center>
        </form><br><?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate file type (PDF)
    if ($_FILES['file1']['type'] !== 'application/pdf' || $_FILES['file2']['type'] !== 'application/pdf') {
        echo "<div class='alert alert-warning text-center'><h5>Error: Only PDF files are allowed.</h5></div>";
        // Handle error or exit script
        exit;
    }

    // File 1
    $file1_tmp_name = $_FILES['file1']['tmp_name'];
    $file1_contents = file_get_contents($file1_tmp_name);

    // File 2
    $file2_tmp_name = $_FILES['file2']['tmp_name'];
    $file2_contents = file_get_contents($file2_tmp_name);

    // Check if there's an existing record in the catalogues table
    $check_query = "SELECT * FROM catalogue";
    $check_result = mysqli_query($conn, $check_query);
    $row_count = mysqli_num_rows($check_result);

    if ($row_count > 0) {
        // Update the existing record with new PDF content
        $update_query = "UPDATE catalogue SET file1 = ?, file2 = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, 'ss', $file1_contents, $file2_contents);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<div class='alert alert-success text-center'><h5>Files uploaded successfully.</h5></div>";
        } else {
            echo "<div class='alert alert-warning text-center'><h5>Error uploading files.</h5></div>";
        }
    } else {
        // Insert a new record with PDF content
        $insert_query = "INSERT INTO catalogue (file1, file2) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, 'ss', $file1_contents, $file2_contents);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<div class='alert alert-success text-center'><h5>Files uploaded successfully.</h5></div>";
        } else {
            echo "<div class='alert alert-warning text-center'><h5>Error uploading files.</h5></div>";
        }
    }
}
?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
