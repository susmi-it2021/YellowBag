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
    <title>Employee List</title>
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
	.btn{
		width: 100px; 
        height: 40px; 
		text-align:center;
		margin-bottom:5px;
	}
	</style>
</head>
<body>
<?php include '../header.html'; ?>
    <div class="container mt-5">
        <?php include('postmessage.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><b class="d-block d-md-inline">Employee List</b>					    
                            <a href="insert.php" class="btn btn-warning float-md-end mt-2 mt-md-0 btn-gap">ADD</a>
							<a href="search.php" class="btn btn-warning float-md-end mt-2 mt-md-0 btn-gap">SEARCH</a>
							<a href="#" class="btn btn-warning float-md-end mt-2 mt-md-0 btn-gap" id="backupLink">EXPORT</a>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                <?php 
                                    $query = "SELECT * FROM employee";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $employee)
                                        {
                                            ?>
                                            <tr>
											     <?php
                                                      $base64Image = base64_encode($employee['photo']);
                                                 ?>
											    <td><?php  echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Uploaded Image" style="width: 100px; height: 100px;">';?></td>
                                                <td><?= $employee['id']; ?></td>
                                                <td><?= $employee['name']; ?></td>
                                                <td><?= $employee['age']; ?></td>
                                                <td><?= $employee['gender']; ?></td>
                                                <td><?= $employee['dob']; ?></td>
												<td><?= $employee['job_designation']; ?></td>
                                                <td align="center">
                                                    <a href="view.php?id=<?= $employee['id']; ?>" class="btn btn-info text-center">VIEW</a>
                                                    <a href="edit.php?id=<?= $employee['id']; ?>" class="btn btn-success text-center">EDIT</a>
                                                    <form action="phpcode.php" method="POST" class="d-inline">
    <input type="hidden" name="delete_employee" value="<?= $employee['id']; ?>">
    <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $employee['id']; ?>)">DELETE</button>
</form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No records found </h5>";
                                    }
                                             ?>
                            </tbody>
                        </table>
                    </div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(id) {
        console.log("Confirm Delete called with ID:", id);
        var result = confirm("Are you sure you want to delete this employee record?");
        if (result) {
            document.querySelector('form input[name="delete_employee"]').value = id;
            document.querySelector('form').submit();
        }
    }
	document.getElementById('backupLink').addEventListener('click', function(event) {
    event.preventDefault();

    var form = document.createElement('form');
    form.method = 'post';
    form.action = 'backup.php';

    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'backup';
    input.value = '1';

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
});
    </script>
</body>
</html>