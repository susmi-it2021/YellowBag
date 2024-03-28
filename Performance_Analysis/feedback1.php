<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <title>YellowBag</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

    </style>
</head>

<body>
    <div class="container mt-5">
        <form id="feedback-form" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="feedback-card">
                        <div class="card-header">
                            <h4 class="mb-0"><b class="d-block d-md-inline">Enter dates to view feedback analysis</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="col-md-5"><label for="start_date" class="form-label">Start Date</label></td>
                                            <td class="col-md-7"><input type="date" name="start_date" class="form-control" id="start_date" required></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-5"><label for="end_date" class="form-label">End Date</label></td>
                                            <td class="col-md-7"><input type="date" name="end_date" class="form-control" id="end_date" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <center>
                <button type="submit" name="submitdates" class="btn btn-primary">SUBMIT</button>
            </center>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#feedback-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Submit the form via AJAX
                $.ajax({
                    url: 'feedback2.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Hide the form
                        $('#feedback-form').hide();

                        // Check if the feedback tab is active
                        if ($('#feedback-tab').hasClass('active')) {
                            // Show the body of feedback2 only in the feedback tab
                            $('#feedback-content').html(response);
                        }
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
