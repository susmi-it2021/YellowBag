<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "yellowbag");
$errors = [];

// Fetch PDF contents from the database
$query = "SELECT * FROM catalogue";
$result = mysqli_query($con, $query);

$pdf1_content = "";
$pdf2_content = "";

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $pdf1_content = $row['file1'];
    $pdf2_content = $row['file2'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>YellowBag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
	.print-options {
    display: flex;
    justify-content: space-between; /* Ensure containers are spaced evenly */
}

.print-options .form-field {
    flex-basis: 48%; /* Adjust the width of each print option */
}

.print-options .form-field label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #3c2c97;
}

.text-container {
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    padding: 10px;
    margin-top: 5px;
    height: 80%; /* Ensure both text containers have the same height */
}

.text-container p {
    margin: 0;
}

        .form-container {
            max-width: 800px;
            margin: 1px auto 0px auto;
            padding: 5px 20px 20px 20px;
            background: linear-gradient(to bottom right, #ffff66 21%, #66ccff 97%);
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .submit-btn {
            width: 200px;
            height: 50px;
            display: block;
            margin: 0 auto;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
            border-radius: 1.3rem;
            cursor: pointer;
            background-color: rgba(255, 204, 51, 0.8);
            transition: all 0.2s;
            text-align: center;
            font-size: 20px;
        }

        .submit-btn:active {
            transform: translate(2px, 2px);
        }

        .form-field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #3c2c97;
			padding-bottom:3px;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            margin-top: 5px;
            display: inline-block;
        }

        textarea {
            resize: vertical;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 10px;
        }
.radio-groups {
    display: flex;
    gap: 5px; /* Adjust the space between options */
}

.print-options {
    display: flex;
    flex-wrap: wrap;
}

.print-options .form-field {
    flex-basis: calc(50% - 10px); /* Adjust the width of each option */
}

/* Ensure print options are displayed in separate lines */
.print-options .form-field label {
    display: block;
    margin-bottom: 10px;
}


/* Media query for responsive layout */
@media (max-width: 600px) {
    .radio-groups {
        flex-direction: column;
    }
}

.form-field img {
    border: 1px solid #ccc;
    display: block;
    margin-top: 10px;
}

        .pdf-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .catalogue {
            flex-basis: calc(50% - 20px);
            margin-bottom: 20px;
            text-align: center;
        }

        .catalogue h2 {
            color: #3c2c97;
        }

        .pdf-wrapper {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
            margin-top: 10px;
        }

        .pdf-embed {
            width: 100%;
            height: 100%;
            border: 1px solid #ddd;
        }

        .download-button {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 999;
            color: #fff;
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 5px;
        }

        @media (max-width: 630px) {
            .catalogue {
                flex-basis: 100%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .message-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .success-message,
        .error-message {
            padding: 10px;
            margin-bottom: 10px;
            font-weight: bold;
            color: white;
        }

        .success-message {
            background-color: #4CAF50;
        }

        .error-message {
            background-color: #f44336;
        }

        @media (max-width: 1000px) {
            .form-title h1 {
                font-size: 1.2rem;
            }

            .submit-btn {
                font-size: 1rem;
                border-radius: 1.3rem;
            }
        }

        .form-title {
            padding-bottom: 0.1px;
        }
		.content {
         line-height: 1.7;
         color: #555;
        }
    </style>
    <?php include 'userheader.html'; ?>
</head>

<body>
		<marquee direction="center" scrollamount="5" behavior="scroll" style="margin-right: 20px;margin-left: 20px;">
           <em>Need assistance or have questions? Contact: <span style="color: blue; font-weight: bold;">7339252770</span></em>
        </marquee>
   <div class="message-container" id="messageContainer"></div>
    <div class="form-container">
        <div class="form-title">
            <h1 style="text-align: center; color: black;">ORDER REQUEST FORM</h1>
        </div>
		<center><div class="content">Share your details and interests for personalized bag delivery. Expect a follow-up from our team soon.</div></center>
        <br>
                <form action="usercode.php" method="post" enctype="multipart/form-data">
            <div class="form-field">
                <label for="name">Customer Name:</label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" required>
                </div>
            </div>
            <div class="form-field">
                <label for="officeAddress">Residental / Office Address:</label>
                <div class="input-wrapper">
                    <textarea id="officeAddress" name="officeAddress" rows="3" required></textarea>
                </div>
            </div>
            <div class="form-field">
                <label for="phone">Office Phone Number ( Optional ) :</label>
                <div class="input-wrapper">
                    <input type="text" id="phone" name="phone">
                </div>
            </div>
            <div class="form-field">
                <label>Background:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="background" value="corporate" required>
                        Corporate
                    </label>
                    <label>
                        <input type="radio" name="background" value="promotional">
                        Promotional
                    </label>
                    <label>
                        <input type="radio" name="background" value="resellers">
                        Resellers
                    </label>
                    <label>
                        <input type="radio" name="background" value="sareebag">
                        Saree Bags
                    </label>
                    <label>
                        <input type="radio" name="background" value="individual">
                        Individual
                    </label>
                </div>
            </div>
            <div class="form-field">
                <label for="purpose">Purpose:</label>
                <div class="input-wrapper">
                    <input type="text" id="purpose" name="purpose" required>
                </div>
            </div>
			<div class="form-field">
                <label>Customer Engagement Type:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="occurence" value="new" required>
                        New Occurrence
                    </label>
                    <label>
                        <input type="radio" name="occurence" value="frequent">
                        Frequent Occurrence
                    </label>
                    <label>
                        <input type="radio" name="occurence" value="yearly">
                        Yearly Occurrence
                    </label>
                </div>
            </div>
            <div class="form-field">
                <label>GST:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="gst" value="consumer" required>
                        Consumer
                    </label>
                    <label>
                        <input type="radio" name="gst" value="business">
                        Registered Business
                    </label>
                </div>
            </div>
<div class="form-field">
    <label>Print:</label>
    <div class="radio-groups">
        <div class="print-option">
            <label><input type="radio" name="print_type" value="withPrint" onclick="togglePrintOptions()" required>With Print</label>
        </div>
        <div class="print-option">
            <label><input type="radio" name="print_type" value="withoutPrint" onclick="clearPrintOptions()">Without Print</label>
        </div>
    </div>
</div>
<div id="withPrintOptions" style="display: none;">
    <div class="form-field print-options">
        <div class="form-field">
            <label>
                <input type="radio" name="printOption" value="screenPrint" onclick="unselectWithPrint()">
                Screen Print
            </label>
            <div class="text-container">
			    <b><p>Supports printing with 4 colors only</p></b>
                <p>2 rs per color per side</p>
                <p>Screen cost: 600 (for one color)</p>
                <p>GST @12% and transport cost additional</p>
            
            <div class="form-field" id="screenPrintImage" style="display: none;">
                <img src="../yellowbag_logo.svg" alt="Screen Print Image" height="150" width="200">
            </div>
        </div></div>
        <div class="form-field">
            <label>
                <input type="radio" name="printOption" value="digitalPrint" onclick="unselectWithPrint()">
                Digital Print
            </label>
            <div class="text-container">
                <b><p>Supports printing with multiple colors</p></b>
            <br><br><br>
            <div class="form-field" id="digitalPrintImage" style="display: none;">
                <img src="../yellowbag_logo.svg" alt="Digital Print Image" height="150" width="200">
            </div></div>
        </div>
    </div>
</div>

            <div class="form-field">
                <label for="catalogue">Catalogues:</label>
                <div class="form-field">
                        <p>Size of Saree Bags:</p>
                        <p>1. 9" W 11" H 4"Flap</p>
                        <p>2. 11" W 13" H 4" Flap</p>
                        <p>3. 14" W 17" H 5" Flap</p>
                        <p>Closure Types: Button, Velcro, Lace.</p>
                    <div class="pdf-container">
                        <div class="catalogue">
                            <h4>SAREEBAGS CATALOGUE</h4>
                            <div class="pdf-wrapper">
                                <embed src="data:application/pdf;base64,<?php echo base64_encode($pdf1_content); ?>"
                                    type="application/pdf" class="pdf-embed" />
                                <a href="data:application/pdf;base64,<?php echo base64_encode($pdf1_content); ?>"
                                    download="Dress_Keeper_catalog.pdf" class="download-button">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="catalogue">
                            <h4>PROMOTIONAL BAGS CATALOGUE</h4>
                            <div class="pdf-wrapper">
                                <embed src="data:application/pdf;base64,<?php echo base64_encode($pdf2_content); ?>"
                                    type="application/pdf" class="pdf-embed" />
                                <a href="data:application/pdf;base64,<?php echo base64_encode($pdf2_content); ?>"
                                    download="YellowBag_catalog.pdf" class="download-button">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div><br><br>
    <script>
        function resetForm() {
            // Modify this function as needed to reset the form fields
            document.getElementById("yourFormId").reset();
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Your existing script
            var textInputs = document.querySelectorAll('input[type="text"], textarea');

            textInputs.forEach(function (input) {
                input.addEventListener('focus', function () {
                    this.style.border = '2px solid #3c2c97';
                });

                input.addEventListener('blur', function () {
                    this.style.border = '1px solid #4c1c49';
                });
            });
        });

        // Other existing scripts...
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var textInputs = document.querySelectorAll('input[type="text"], textarea');

            textInputs.forEach(function (input) {
                input.addEventListener('focus', function () {
                    this.style.border = '2px solid #3c2c97';
                });

                input.addEventListener('blur', function () {
                    this.style.border = '1px solid #4c1c49';
                });
            });
        });
		
    </script>
    <script>
        function togglePrintOptions() {
            var withPrintOptions = document.getElementById("withPrintOptions");
            var screenPrintImage = document.getElementById("screenPrintImage");
            var digitalPrintImage = document.getElementById("digitalPrintImage");

            withPrintOptions.style.display = "block";
            screenPrintImage.style.display = "block";
            digitalPrintImage.style.display = "block";
        }

        function unselectWithPrint() {
            var withPrintRadio = document.querySelector('input[name="print"][value="withPrint"]');
            withPrintRadio.checked = false;
        }

        function clearPrintOptions() {
            var withPrintOptions = document.getElementById("withPrintOptions");
            var screenPrintImage = document.getElementById("screenPrintImage");
            var digitalPrintImage = document.getElementById("digitalPrintImage");
            var screenPrintRadio = document.querySelector('input[name="printOption"][value="screenPrint"]');
            var digitalPrintRadio = document.querySelector('input[name="printOption"][value="digitalPrint"]');
            var withPrintRadio = document.querySelector('input[name="print"][value="withPrint"]');

            withPrintOptions.style.display = "none";
            screenPrintImage.style.display = "none";
            digitalPrintImage.style.display = "none";
            screenPrintRadio.checked = false;
            digitalPrintRadio.checked = false;
            withPrintRadio.checked = false;
        }
    </script>
     <script>
      $(document).ready(function () {
    $('form').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                var messageContainer = $('#messageContainer');
                if (response.status === 'success') {
                    messageContainer.html("<div class='success-message'>" + response.message + "</div>");

                    // Scroll to the top to see the success message
                    $('html, body').animate({ scrollTop: 0 }, 'slow');

                    // Reset the form and hide the message after a delay (e.g., 3000 milliseconds or 3 seconds)
                    setTimeout(function () {
                        $('form')[0].reset(); // Reset the first form on the page, you may need to adjust if there are multiple forms
                        messageContainer.empty(); // Clear the message container
                    }, 5000);
                } else {
                    messageContainer.html("<div class='error-message'>" + response.message + "</div>");
                }
            },
            error: function () {
                console.error('Error submitting the form.');
            }
        });
    });
});
function togglePrint(printType) {
    var detailsId = printType === 'screenPrint' ? 'screenPrintDetails' : 'digitalPrintDetails';
    var imageId = printType === 'screenPrint' ? 'screenPrintImage' : 'digitalPrintImage';

    var details = document.getElementById(detailsId);
    var image = document.getElementById(imageId);

    if (details.style.display === 'none') {
        details.style.display = 'block';
        image.style.display = 'block';
    } else {
        details.style.display = 'none';
        image.style.display = 'none';
    }
}

    </script>
</body>
</html>