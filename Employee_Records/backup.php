<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['backup'])) {
    $host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'yellowbag'; 
    $table_name = 'employee'; 

    $conn = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create a CSV file
    $filename = 'backup_'.$table_name.'_'.date('Ymd_His').'.csv';
    $csv_file = fopen($filename, 'w');

    $data_query = "SELECT `id`, `name`, `age`, `gender`, `dob`, `joining_date`, `education`, `job_designation`, `current_address`, `permanent_address`, `phone_no`, `contact_person_no`, `aadhaar`, `pan_number`, `spouse`, `rejoining_date`, `rejoin_reason`, `gpay`, `recipient_name`, `bank_name`, `ifsc_code`, `bank_account_no`, `entry_date` FROM $table_name";
    $data_result = $conn->query($data_query);

    // Add column headings
    $columns = [];
    for ($i = 0; $i < $data_result->field_count; $i++) {
        $columns[] = $data_result->fetch_field_direct($i)->name;
    }
    fputcsv($csv_file, $columns, ',');

    // Add data to the CSV file
    while ($data_row = $data_result->fetch_assoc()) {
        fputcsv($csv_file, $data_row, ',');
    }

    fclose($csv_file);

    // Provide the backup file for download
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"$filename\"");
    readfile($filename);
    unlink($filename); // Remove the backup file from the server
    exit;
}
?>
