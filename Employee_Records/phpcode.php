<?php
// Example to increase memory limit


session_start();
$conn = mysqli_connect("localhost","root","","yellowbag");
mysqli_query($conn, "SET GLOBAL max_allowed_packet = 5242880");
if(!$conn){
die('Sorry,connection failed'. mysqli_connect_error());
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
if(isset($_POST['savechanges_employee']))
{
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $joining_date = mysqli_real_escape_string($conn, $_POST['joining_date']);
    $education = mysqli_real_escape_string($conn, $_POST['education']);
    $job_designation = mysqli_real_escape_string($conn, $_POST['job_designation']);
    $current_address = mysqli_real_escape_string($conn, $_POST['current_address']);
    $permanent_address = mysqli_real_escape_string($conn, $_POST['permanent_address']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $contact_person_no = mysqli_real_escape_string($conn, $_POST['contact_person_no']);
    $aadhaar = mysqli_real_escape_string($conn, $_POST['aadhaar']);
    $pan_number= mysqli_real_escape_string($conn, $_POST['pan_number']);
    $spouse = mysqli_real_escape_string($conn, $_POST['spouse']);
    $rejoining_date = mysqli_real_escape_string($conn, $_POST['rejoining_date']);
    $rejoin_reason = mysqli_real_escape_string($conn, $_POST['rejoin_reason']);
    $gpay = mysqli_real_escape_string($conn, $_POST['gpay']);
    $recipient_name= mysqli_real_escape_string($conn, $_POST['recipient_name']);
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $ifsc_code= mysqli_real_escape_string($conn, $_POST['ifsc_code']);
    $bank_account_no = mysqli_real_escape_string($conn, $_POST['bank_account_no']);
    $entry_date= mysqli_real_escape_string($conn, $_POST['entry_date']);
 
    // Assuming $existingPhotoBinaryData contains the binary data of the existing photo

    if (!empty($_FILES['photo']['name'])) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
        $photo = mysqli_real_escape_string($conn, $photo);
        $query = "UPDATE employee SET 
            name='$name', 
            age='$age', 
            gender='$gender', 
            dob='$dob', 
            joining_date='$joining_date', 
            education='$education', 
            job_designation='$job_designation', 
            current_address='$current_address', 
            permanent_address='$permanent_address', 
            phone_no='$phone_no', 
            contact_person_no='$contact_person_no', 
            aadhaar='$aadhaar', 
            pan_number='$pan_number', 
            spouse='$spouse', 
            rejoining_date='$rejoining_date', 
            rejoin_reason='$rejoin_reason', 
            gpay='$gpay', 
            recipient_name='$recipient_name', 
            bank_name='$bank_name', 
            ifsc_code='$ifsc_code', 
            bank_account_no='$bank_account_no', 
            entry_date='$entry_date',
            photo='$photo'
            WHERE id='$id'";
    } else {
        $query = "UPDATE employee SET 
            name='$name', 
            age='$age', 
            gender='$gender', 
            dob='$dob', 
            joining_date='$joining_date', 
            education='$education', 
            job_designation='$job_designation', 
            current_address='$current_address', 
            permanent_address='$permanent_address', 
            phone_no='$phone_no', 
            contact_person_no='$contact_person_no', 
            aadhaar='$aadhaar', 
            pan_number='$pan_number', 
            spouse='$spouse', 
            rejoining_date='$rejoining_date', 
            rejoin_reason='$rejoin_reason', 
            gpay='$gpay', 
            recipient_name='$recipient_name', 
            bank_name='$bank_name', 
            ifsc_code='$ifsc_code', 
            bank_account_no='$bank_account_no', 
            entry_date='$entry_date'
            WHERE id='$id'";
    }
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Changes saved successfully.";
        header("Location: employeeinfo.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Changes not saved!";
        header("Location: employeeinfo.php");
        exit(0);
    }

}
    if(isset($_POST['save_employee']))
{   
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
	if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
    $photo = file_get_contents($_FILES['photo']['tmp_name']);
    $photo = mysqli_real_escape_string($conn, $photo);
} else {
$photo = ''; }
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $joining_date = mysqli_real_escape_string($conn, $_POST['joining_date']);
    $education = mysqli_real_escape_string($conn, $_POST['education']);
    $job_designation = mysqli_real_escape_string($conn, $_POST['job_designation']);
    $current_address = mysqli_real_escape_string($conn, $_POST['current_address']);
    $permanent_address = mysqli_real_escape_string($conn, $_POST['permanent_address']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $contact_person_no = mysqli_real_escape_string($conn, $_POST['contact_person_no']);
    $aadhaar = mysqli_real_escape_string($conn, $_POST['aadhaar']);
    $pan_number= mysqli_real_escape_string($conn, $_POST['pan_number']);
    $spouse = mysqli_real_escape_string($conn, $_POST['spouse']);
    $rejoining_date = mysqli_real_escape_string($conn, $_POST['rejoining_date']);
    $rejoin_reason = mysqli_real_escape_string($conn, $_POST['rejoin_reason']);
    $gpay = mysqli_real_escape_string($conn, $_POST['gpay']);
    $recipient_name= mysqli_real_escape_string($conn, $_POST['recipient_name']);
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $ifsc_code= mysqli_real_escape_string($conn, $_POST['ifsc_code']);
    $bank_account_no = mysqli_real_escape_string($conn, $_POST['bank_account_no']);
    $entry_date= mysqli_real_escape_string($conn, $_POST['entry_date']);
    $query = "INSERT INTO employee (name,photo,age,gender,dob,joining_date,education,job_designation,current_address,permanent_address,phone_no,contact_person_no,aadhaar,pan_number,spouse,
    rejoining_date,rejoin_reason,gpay,recipient_name,bank_name,ifsc_code,bank_account_no,entry_date) VALUES ('$name','$photo','$age','$gender','$dob','$joining_date','$education',
    '$job_designation','$current_address','$permanent_address','$phone_no','$contact_person_no','$aadhaar','$pan_number','$spouse',
    '$rejoining_date','$rejoin_reason','$gpay','$recipient_name','$bank_name','$ifsc_code','$bank_account_no','$entry_date')";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Employee details added successfully.";
        header("Location: insert.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Employee details not added.";
        header("Location: insert.php");
        exit(0);
    }
}

?>