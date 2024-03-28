<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "yellowbag");
if (!$conn) {
    die('Sorry, connection failed' . mysqli_connect_error());
}

if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}');</script>";
    unset($_SESSION['message']);
}

if (isset($_POST['delete_employee'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete_employee']);

    $query = "DELETE FROM employee WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Employee details deleted successfully.";
    } else {
        $_SESSION['message'] = "Employee details not deleted successfully!";
    }
	header("Location: employeeinfo.php");
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="yellowbagside-svg.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <title>Employee Search</title>
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
		button,.btn {
            width: 100px; 
            height: 40px; 
            margin: 5px;
            text-align: center;
        }
        .output input{
          display:block;
          margin-top:20px;
        }
        .output{
            display: flex;
            flex-direction: column; /* Align items vertically */
            justify-content: center; /* Center items horizontally */
            align-items: center; /* Center items vertically */
            margin-top:30px;
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
                    <h4 class="mb-0"><b class="d-block d-md-inline">Search For Employee Details</b><a href="employeeinfo.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a></h4>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="col-md-5" ><label for="name" class="form-label">Name</label></td>
                                    <td class="col-md-7"><input type="text" name="name" class="form-control" id="name"></td>
                                </tr>
                                 <tr>
                                <td><label for="dob" class="form-label">Date of birth</label></td>
                                <td><input type="date" name="dob" class="form-control" id="dob"></td>
                                </tr> 
                                </tbody>
                        </table></div>
                </div>
            </div>
        </div>
    </div><br>
    <center>
	 <button type="submit" name="search_employee" class="btn btn-primary">SEARCH</button>
	</center>
    </form><br><br>
    <?php
$conn = mysqli_connect("localhost", "root", "", "yellowbag");
$db = mysqli_select_db($conn, 'yellowbag');

if (isset($_POST['search_employee'])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $query = "SELECT * FROM employee WHERE name='$name' OR dob='$dob'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        ?>
		
        <div class="table-responsive">
           <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>Photo</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Date of birth</th>
                        <th>Job designation</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($query_run as $employee) : ?>
                        <tr>
                            <td>
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($employee['photo']) . '" alt="Uploaded Image" style="width: 100px; height: 100px;">'; ?>
                            </td>
                            <td><?= $employee['id']; ?></td>
                            <td><?= $employee['name']; ?></td>
                            <td><?= $employee['age']; ?></td>
                            <td><?= $employee['gender']; ?></td>
                            <td><?= $employee['dob']; ?></td>
                            <td><?= $employee['job_designation']; ?></td>
                            <td align="center">
                                <a href="view.php?id=<?= $employee['id']; ?>" class="btn btn-info text-center">VIEW</a>
                                <a href="edit.php?id=<?= $employee['id']; ?>" class="btn btn-success text-center">EDIT</a>
                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="delete_employee" value="<?= $employee['id']; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $employee['id']; ?>)">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo "<div class='alert alert-warning text-center'><h5>No records found</h5></div>";
    }
}
?>

    
<br><br><br>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>




</body>
</html>
