<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YellowBag</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
        }
        .book-container {
            margin-top: 50px;
            padding: 20px;
        }
        .book {
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .left-page {
            flex: 1;
            background-color: #007bff;
            color: #fff;
            padding: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-search {
            background-color: #0056b3;
            border-color: #0056b3;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-search:hover {
            background-color: #003d7a;
            border-color: #003d7a;
        }
        .list-group-item {
            cursor: pointer;
        }
        .list-group-item.active {
            background-color: #007bff;
            color: #fff;
        }
.right-page {
    flex: 1;
    background-color: #fff;
    color: #000;
    padding: 20px;
    overflow-x: auto; /* Enable horizontal scrolling */
    overflow-y: hidden; /* Disable vertical scrolling */
}

.scrollable-content {
    white-space: nowrap; /* Prevent wrapping of inline elements */
}

/* Adjustments for smaller screens */
@media (max-width: 768px) {
    .right-page {
        padding: 10px; /* Adjust padding for smaller screens */
    }
}

    </style>
</head>
<body>
    <div class="container book-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="book">
                    <!-- Right Page for Search Form and Results -->
                    <div class="right-page">
                        <h2 class="text-center">Day workers' salary</h2><br>
                        <!-- Alert Message Container -->
                        <div id="message" class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Hey!</strong> <!-- Message will be filled dynamically -->
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Search Form -->
                        <form id="searchForm1">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dayworkers-month">Month</label>
                                        <input list="months" class="form-control" name="month" id="dayworkers-month" placeholder="Enter month (e.g., january)">
                                        <datalist id="months">
                                            <option value="January">
                                            <option value="February">
                                            <option value="March">
                                            <option value="April">
                                            <option value="May">
                                            <option value="June">
                                            <option value="July">
                                            <option value="August">
                                            <option value="September">
                                            <option value="October">
                                            <option value="November">
                                            <option value="December">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dayworkers-year">Year</label>
                                        <input type="text" class="form-control" name="year" id="dayworkers-year" placeholder="Enter year (e.g., 2024)">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary btn-search" id="dayworkers-searchButton">Search</button>
                            </div>
                        </form>
                        <!-- Search Results -->
                        <div id="dayworkers-searchResults"></div>
                        <!-- Salary Details -->
                        <div id="dayworkers-salaryDetails"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Event listener for the search button
            $('#dayworkers-searchButton').click(function() {
                var month = $('#dayworkers-month').val();
                var year = $('#dayworkers-year').val();

                $.ajax({
                    type: 'POST',
                    url: 'employee_names1.php', // Assuming PHP script to handle the AJAX request
                    data: { month: month, year: year },
                    success: function(response) {
                        $('#dayworkers-searchResults').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Event listener for employee names
            $(document).on('click', '#dayworkers-employeeList li', function() {
                $('#dayworkers-employeeList li').removeClass('active');
                $(this).addClass('active');
            });
            // Event listener for the display button
            $(document).on('click', '#dayworkers-displayButton', function() {
                var employeeName = $('#dayworkers-employeeList li.active').text();
                var month = $('#dayworkers-month').val();
                var year = $('#dayworkers-year').val();

                $.ajax({
                    type: 'POST',
                    url: 'display1.php', // Assuming PHP script to handle the AJAX request
                    data: { month: month, year: year, employee_name: employeeName },
                    success: function(response) {
    // Assuming response contains HTML content to be added dynamically
    $('#dayworkers-salaryDetails').html(response);
    // Ensure that the dynamically added content is wrapped in a responsive container
    $('#dayworkers-salaryDetails').find('.container').addClass('container-fluid');
},
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
