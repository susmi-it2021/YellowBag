<?php
$conn = mysqli_connect("localhost", "root", "", "yellowbag");
if (!$conn) {
    die('Sorry, connection failed' . mysqli_connect_error());
}

$employee = [];
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM employee WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $employee = mysqli_fetch_array($query_run);
    } else {
        echo "<h4>No such id found</h4>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
	<title>Employee View</title>
    <style>
        .card {
            background-color: #eef4ed;
            border: 1px solid #666666;
            border-radius: 5px;
            margin-bottom: 20px;
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
        button,.btn {
            width: 100px; 
            height: 40px; 
            margin: 5px;
            text-align: center;
        }
        .form-control {
            border: 1px solid #000000;
        }



        .image-container {
            text-align: left;
        }

        .image-container img {
            max-width: 100px;
            max-height: 100px;
        }

        .employee-details,
        .bank-details {
            padding: 10px;
        }

        .employee-details label,
        .bank-details label {
            font-weight: bold;
        }

        @media (max-width: 767px) {

            .table td,
            .table th {
                display: block;
                width: 100%;
            }
        }
        .flex{
            display:flex;
            flex-direction:row;
            justify-content:space-around;
            padding:20px 0 20px 0 ;
            /* justify-content:space-between; */
            
        }

        .bor{
            border: 4px solid rgb(181, 181, 181);
            border-radius: 10px;
        }
      @media (max-width: 767px) {
            .flex {
                flex-direction: column;
                align-items: center;
            }

            .flex-content {
                width: 100%;
            }
        }
  
    </style>
    <script>
        function updateChosenFileName(input) {
            var fileName = input.value.split('\\').pop();
            var photoInput = document.getElementById('photo');

            if (fileName) {
                photoInput.value = fileName;
            } else {
                // If no file is chosen, display the existing filename
                photoInput.value = '<?=$employee["photo"];?>';
            }
        }
    </script>

</head>

<body><?php include '../header.html'; ?>
     <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <b><h4 class="mb-0">Employee Details</b> <a href="employeeinfo.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a></h4>
            </div>
            <div class="card-body image-container">
                <div class="flex">
                    <div class="flex-content ">
                        <div class="profile"><?php
                    $base64Image = base64_encode($employee['photo']);
                    echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Uploaded Image" style="width: 100px; height: 100px;">';
                    ?></div>
                    </div>
                    <div class="flex-content bank-details bor">
                        <h4>Staff Information</h4><hr>
                        <label for="name" class="form-label">Name:</label>&nbsp&nbsp
                        <?=$employee['name'];?><br>

                        <label for="age" class="form-label">Age:</label>&nbsp&nbsp
                        <?=$employee['age'];?><br>

                        <label for="gender" class="form-label">Gender:</label>&nbsp&nbsp
                        <?=$employee['gender'];?><br>

                        <label for="dob" class="form-label">Date of birth:</label>&nbsp&nbsp
                        <?=$employee['dob'];?><br>

                        <label for="joining_date" class="form-label">Joining date:</label>&nbsp&nbsp
                        <?=$employee['joining_date'];?><br>

                        <label for="education" class="form-label">Education:</label>&nbsp&nbsp
                        <?=$employee['education'];?><br>

                        <label for="job_designation" class="form-label">Job designation:</label>&nbsp&nbsp
                        <?=$employee['job_designation'];?><br>

                        <label for="current_address" class="form-label">Current address:</label>&nbsp&nbsp
                        <?=$employee['current_address'];?><br>

                        <label for="permanent_address" class="form-label">Permanent address:</label>&nbsp&nbsp
                        <?=$employee['permanent_address'];?><br>

                        <label for="phone_no" class="form-label">Contact number:</label>&nbsp&nbsp
                        <?=$employee['phone_no'];?><br>

                        <label for="contact_person_no" class="form-label">Contact person
                            number(Relative's/Friend's):</label>&nbsp&nbsp
                        <?=$employee['contact_person_no'];?><br>

                        <label for="aadhaar" class="form-label">Aadhaar number:</label>&nbsp&nbsp
                        <?=$employee['aadhaar'];?><br>

                        <label for="pan_number" class="form-label">PAN number:</label>&nbsp&nbsp
                        <?=$employee['pan_number'];?><br>

                        <label for="spouse" class="form-label">Spouse name:</label>&nbsp&nbsp
                        <?=$employee['spouse'];?><br>

                        <label for="rejoining_date" class="form-label">Rejoining date:</label>&nbsp&nbsp
                        <?=$employee['rejoining_date'];?><br>

                        <label for="rejoin_reason" class="form-label">Reason for rejoining:</label>&nbsp&nbsp
                        <?=$employee['rejoin_reason'];?><br>
                    </div>
                  
                    <div class="flex-content bank-details bor">
                        <h4>Bank Details</h4><hr>
                        <label for="gpay" class="form-label">Gpay number:</label>&nbsp&nbsp
                        <?=$employee['gpay'];?><br>

                        <label for="recipient_name" class="form-label">Recipient name in bank:</label>&nbsp&nbsp
                        <?=$employee['recipient_name'];?><br>

                        <label for="bank_name" class="form-label">Bank name:</label>&nbsp&nbsp
                        <?=$employee['bank_name'];?>State Bank of India<br>

                        <label for="ifsc_code" class="form-label">IFSC code:</label>&nbsp&nbsp
                        <?=$employee['ifsc_code'];?><br>

                        <label for="bank_account_no" class="form-label">Account number:</label>&nbsp&nbsp
                        <?=$employee['bank_account_no'];?><br>

                        <label for="entry_date" class="form-label">Date of entry:</label>&nbsp&nbsp
                        <?=$employee['entry_date'];?>

                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>