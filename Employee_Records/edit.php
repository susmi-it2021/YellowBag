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
    <title>Employee Edit</title>
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
        @media (max-width: 767px) {
            .table td, .table th {
                display: block;
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
<body>
<?php include '../header.html'; ?>
<?php include('postmessage.php'); ?>
<div class="container mt-5">
<form action="phpcode.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><b class="d-block d-md-inline">Edit Staff Information</b><a href="employeeinfo.php" class="btn btn-danger float-md-end mt-2 mt-md-0">BACK</a></h4>
                </div>
                <div class="card-body">
                        <?php
                         if(isset($_GET['id']))
                         {
                          $id=mysqli_real_escape_string($conn,$_GET['id']);
                          $query="SELECT * FROM employee WHERE id='$id' ";
                          $query_run=mysqli_query($conn,$query);
                          if(mysqli_num_rows($query_run)>0)
                          {
                             $employee=mysqli_fetch_array($query_run);
                         ?>
                        
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <input type="hidden" name="id" value="<?=$employee['id'];?>">
                                <tr>
                                    <td class="col-md-5"><label for="name" class="form-label">Name</label></td>
                                    <td class="col-md-7"><input type="text" name="name" value="<?=$employee['name'];?>" class="form-control" id="name" required></td>
                                </tr>
                                <tr>
                                <td><label for="photo" class="form-label">Profile photo</label></td>
                                            <td>
                                                <div class="input-group">
                                                    <?php
                                                     $base64Image = base64_encode($employee['photo']);
                                                    ?>
                                                   
                                                    <input type="file" name="photo" class="form-control" id="photo" accept="image/*" size="5242880">
                                                    <?php  echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Uploaded Image" style="width: 100px; height: 100px;">';?>
                                                </div>
                                            </td>
                                </tr>
                                <tr>
                                    <td><label for="age" class="form-label">Age</label></td>
                                    <td><input type="text" name="age" value="<?=$employee['age'];?>" class="form-control" id="age" required></td>
                                </tr>
                                <tr>
                                    <td><label for="gender" class="form-label">Gender</label></td>
                                    <td><input type="text" name="gender" value="<?=$employee['gender'];?>" class="form-control" id="gender" required></td>
                                </tr>
                                <tr>
                                    <td><label for="dob" class="form-label">Date of birth</label></td>
                                    <td><input type="date" name="dob"  value="<?=$employee['dob'];?>"class="form-control" id="dob" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="joining_date" class="form-label">Joining date</label></td>
                                    <td><input type="date" name="joining_date" value="<?=$employee['joining_date'];?>" class="form-control" id="joining_date" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="education" class="form-label">Education</label></td>
                                    <td><input type="text" name="education" value="<?=$employee['education'];?>" class="form-control" id="education" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="job_designation" class="form-label">Job designation</label></td>
                                    <td><input type="text" name="job_designation" value="<?=$employee['job_designation'];?>" class="form-control" id="job_designation" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="current_address" class="form-label">Current address</label></td>
                                    <td><textarea name="current_address"  class="form-control" id="current_address" rows="3" required><?= $employee['current_address']; ?></textarea></td>
                                </tr>
                                  <tr>
                                    <td><label for="permanent_address" class="form-label">Permanent address</label></td>
                                    <td><textarea name="permanent_address"  class="form-control" id="permanent_address" rows="3" required><?= $employee['permanent_address']; ?></textarea></td>
                                </tr>
                                  <tr>
                                    <td><label for="phone_no" class="form-label">Contact number</label></td>
                                    <td><input type="text" name="phone_no"  value="<?=$employee['phone_no'];?>" class="form-control" id="phone_no" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="contact_person_no" class="form-label">Contact person number(Relative's/Friend's)</label></td>
                                    <td><input type="text" name="contact_person_no"  value="<?=$employee['contact_person_no'];?>" class="form-control" id="contact_person_no" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="aadhaar" class="form-label">Aadhaar number</label></td>
                                    <td><input type="text" name="aadhaar"  value="<?=$employee['aadhaar'];?>" class="form-control" id="aadhaar" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="pan_number" class="form-label">PAN number</label></td>
                                    <td><input type="text" name="pan_number"   value="<?=$employee['pan_number'];?>" class="form-control" id="pan_number" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="spouse" class="form-label">Spouse name</label></td>
                                    <td><input type="text" name="spouse"  value="<?=$employee['spouse'];?>" class="form-control" id="spouse"></td>
                                </tr>
                                  <tr>
                                    <td><label for="rejoining_date" class="form-label">Rejoining date</label></td>
                                    <td><input type="date" name="rejoining_date"  value="<?=$employee['rejoining_date'];?>" class="form-control" id="rejoining_date"></td>
                                </tr>
                                  <tr>
                                    <td><label for="rejoin_reason" class="form-label">Reason for rejoining</label></td>
                                    <td><textarea name="rejoin_reason"  class="form-control" id="rejoin_reason" rows="3"><?= $employee['rejoin_reason']; ?></textarea></td>
                                </tr>
                            </tbody>
                         </table></div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Edit Bank Details</b></h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="col-md-5"><label for="gpay" class="form-label">Gpay number</label></td>
                                    <td class="col-md-7"><input type="text" name="gpay" value="<?=$employee['gpay'];?>" class="form-control" id="gpay"></td>
                                </tr>
                                <tr>
                                    <td><label for="recipient_name" class="form-label">Recipient name in bank</label></td>
                                    <td><input type="text" name="recipient_name" value="<?=$employee['recipient_name'];?>" class="form-control" id="recipient_name" required></td>
                                </tr>
                                <tr>
                                    <td><label for="bank_name" class="form-label">Bank name</label></td>
                                    <td><input type="text" name="bank_name"  value="<?=$employee['bank_name'];?>" class="form-control" id="bank_name" required></td>
                                </tr>
                                <tr>
                                    <td><label for="ifsc_code" class="form-label">IFSC code</label></td>
                                    <td><input type="text" name="ifsc_code" value="<?=$employee['ifsc_code'];?>"  class="form-control" id="ifsc_code" required></td>
                                </tr>
                                  <tr>
                                    <td><label for="bank_account_no" class="form-label">Account number</label></td>
                                    <td><input type="text" name="bank_account_no" value="<?=$employee['bank_account_no'];?>" class="form-control" id="bank_account_no" required></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
         <table class="table">
               <tbody>
                  <tr>
                  <td class="col-md-5"><label for="entry_date" class="form-label">Date of entry</label></td>
                  <td class="col-md-7"><input type="date" name="entry_date" value="<?=$employee['entry_date'];?>" class="form-control" id="entry_date" required></td>
                  </tr>
               </tbody>
         </table>
    </div>
           <?php
                          }
                         else
                         {
                            echo "<h4>No such id found</h4>"; 
                         }
            }
            ?>
    <center>
     <a href="employeeinfo.php" name="cancel_employee" class="btn btn-danger">CANCEL</a>
     <button type="submit" name="savechanges_employee" class="btn btn-primary">SAVE</button>
    </center>
       </form>
<br><br><br>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>