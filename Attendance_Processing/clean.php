<?php
// Connect to the database
$link = mysqli_connect("localhost", "root", "", "attendance");
if ($link === false) {
    die("ERROR: Could not connect" . mysqli_connect_error());
}

// Query to fetch tables from the database
$sql = "SHOW TABLES FROM attendance";
$result = mysqli_query($link, $sql);

// Array to store table names with formatted 'Month Year'
$tableNames = array();

// Loop through the result set to generate table names with formatted 'Month Year'
while ($row = mysqli_fetch_array($result)) {
    $tableName = $row[0];
    // Extract month and year from the table name
    preg_match('/([a-z]+)(\d+)/i', $tableName, $matches);
    $month = ucfirst($matches[1]);
    $year = $matches[2];
    // Format the table name as 'Month Year'
    $formattedTableName = $month . ' ' . $year;
    // Add the formatted table name to the array
    $tableNames[] = array('name' => $formattedTableName, 'table' => $tableName);
}

// Sort the table names in descending order
rsort($tableNames);

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>YellowBag</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <link rel="icon" href="booklandis.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Attendance Records</h4>
                    </div>
                    <div class="card-body">
                        <form id="deleteForm">
                            <?php
                            // Check if $tableNames is an array and not empty
                            if(is_array($tableNames) && !empty($tableNames)) {
                                // Loop through the sorted table names and display radio buttons
                                foreach ($tableNames as $table) {
                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="radio" name="tablename" id="' . $table['table'] . '" value="' . $table['table'] . '">&nbsp;&nbsp;';
                                    echo '<label class="form-check-label" for="' . $table['table'] . '">' . $table['name'] . '</label>';
                                    echo '<br></div>';
                                }
                            } else {
                                echo "No tables found.";
                            }
                            ?>
                            <br>
                            <button type="button" id="exportBtn" class="btn btn-primary" style="background-color: orange; border-color: orange;">Export</button>
                            <button type="button" id="deleteBtn" class="btn btn-primary" style="background-color: red; border-color: red;">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#deleteBtn').click(function(){
                var tablename = $("input[name='tablename']:checked").val();
                if(tablename) {
                    if(confirm("Are you sure you want to delete the selected table?")) {
                        $.ajax({
                            type: 'POST',
                            url: 'delete.php',
                            data: { tablename: tablename },
                            success: function(response){
                                alert(response);
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                alert(xhr.responseText);
                            }
                        });
                    }
                } else {
                    alert('Please select a table to delete.');
                }
            });

            // Export button click event
            $('#exportBtn').click(function(){
                var tablename = $("input[name='tablename']:checked").val();
                if(tablename) {
                    window.location = 'export.php?tablename=' + tablename;
                } else {
                    alert('Please select a table to export.');
                }
            });
        });
    </script>
</body>
</html>
