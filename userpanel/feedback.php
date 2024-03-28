<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
<title>YellowBag</title>
<link rel="stylesheet" href="styles.css">
<style>@charset "UTF-8";
@import url("https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Potta+One&display=swap");
* {
  box-sizing: border-box;
}
html {
  font-size: 6.25vmax;
}
@media (max-width: 1000px) {
html {
    font-size: 18px;
  }
}
body{
  min-height: 100vh;
  padding: 0.5rem;
  display: r;
  justify-content: center;
  align-items: center;
  color: #222;
  font-size: 0.24rem;
  font-family: "Space Grotesk", sans-serif;
  background-image: radial-gradient(farthest-side, #afc8f9 90%, #fff0), radial-gradient(farthest-side, #ddc1fb 90%, #fff0), radial-gradient(circle at 0 0, #d5e0fa, #e5d5f6) !important;
  background-size: 7rem 7rem, 6rem 6rem, auto;
  background-position: 30% 10%, 80% 90%, 0;
  background-repeat: no-repeat;
  backdrop-filter: blur(50px);
}
p{
font-size: 20px;
letter-spacing: 0px;
word-spacing: 1.4px;
color: #000000;
font-weight: 700;
font-style: normal;
font-variant: normal;
}
.wrapper {
  width: 9rem; /* Adjusted width */
  padding: 0.3rem; /* Increased padding */
  display: flex;
  margin: 0 auto; /* Centering the form horizontally */
  flex-direction: column;
  align-items: center;
  gap: 0.3rem; /* Increased gap */
  border-radius: 0.25rem;
  box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.2);
  background-color: rgba(255, 255, 255, 0.5);
  z-index: 1;
}
.wrapper .title {
  font-weight: bold;
  font-size: 0.2rem;
  text-align:center;
}
.wrapper .content {
  line-height: 1.6;
  color: #555;
}

.rate-box {
  display: flex;
  flex-direction: row-reverse;
}
.rate-box input {
  display: none;
}
.rate-box input:hover ~ .star:before {
  color: rgba(255, 204, 51, 0.5);
}
.rate-box input:active + .star:before {
  transform: scale(0.9);
}
.rate-box input:checked ~ .star:before {
  color: #ffcc33;
  text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
}
.rate-box .star:before {
  content: "★";
  display: inline-block;
  font-family: "Potta One", cursive;
  font-size: 1rem; /* Adjusted font size */
  cursor: pointer;
  color: #0000;
  text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
  background-color: #aaa;
  background-clip: text;
  -webkit-background-clip: text;
  transition: all 0.3s;
}

textarea {
  border: none;
  resize: none;
  width: 100%;
  padding: 0.5rem; /* Increased padding */
  color: inherit;
  font-family: inherit;
  line-height: 1.5;
  border-radius: 0.2rem;
  box-shadow: inset 2px 2px 8px rgba(0, 0, 0, 0.3), inset -2px -2px 8px rgba(255, 255, 255, 0.8);
  background-color: rgba(255, 255, 255, 0.3);
}
textarea::placeholder {
  color: #aaa;
}
textarea:focus {
  outline-color: #ffcc33;
}
.wrapper .title {
  font-weight: bold;
  font-size: 0.36rem; /* Adjusted font size */
}
.wrapper .content {
  line-height: 1.6;
  color: #555;
}

.rate-box {
  display: flex;
  flex-direction: row-reverse;
  gap: 0.5rem; /* Increased gap */
}
.rate-box input {
  display: none;
}
.rate-box input:hover ~ .star:before {
  color: rgba(255, 204, 51, 0.5);
}
.rate-box input:active + .star:before {
  transform: scale(0.9);
}
.rate-box input:checked ~ .star:before {
  color: #ffcc33;
  text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
}
.rate-box .star:before {
  content: "★";
  display: inline-block;
  font-family: "Potta One", cursive;
  font-size: 0.8rem; /* Adjusted font size */
  cursor: pointer;
  color: #0000;
  text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
  background-color: #aaa;
  background-clip: text;
  -webkit-background-clip: text;
  transition: all 0.3s;
}

textarea{
  border: none;
  resize: none;
  width: 100%;
  padding: 0.3rem; /* Increased padding */
  color: inherit;
  font-family: inherit;
  line-height: 1.3;
  border-radius: 0.2rem;
  box-shadow: inset 2px 2px 8px rgba(0, 0, 0, 0.3), inset -2px -2px 8px rgba(255, 255, 255, 0.8);
  background-color: rgba(255, 255, 255, 0.3);
}
input {
  border: none;
  resize: none;
  width: 100%;
  height: 10px;
  padding: 0.5rem; /* Increased padding */
  color: inherit;
  font-family: inherit;
  line-height: 1.5;
  border-radius: 0.2rem;
  box-shadow: inset 2px 2px 8px rgba(0, 0, 0, 0.3), inset -2px -2px 8px rgba(255, 255, 255, 0.8);
  background-color: rgba(255, 255, 255, 0.3);
}
textarea::placeholder,input::placeholder {
  color: #aaa;
}
textarea:focus.input:focus{
  outline-color: #ffcc33;
}

.submit-btn {
  width: 200px; /* Set the desired width */
    height: 50px; /* Set the desired height */
    display: block; /* Ensure the button is a block-level element */
    margin: 0 auto; /* Center the button horizontally */
    /* Additional styles */
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
    border-radius: 0.3rem;
    cursor: pointer;
    background-color: rgba(255, 204, 51, 0.8);
    transition: all 0.2s;
    text-align: center;
	font-size: 20px;
}
.submit-btn:active {
  transform: translate(2px, 2px);
}
@media (max-width: 1000px) {
  .wrapper {
    width: 90%; /* Adjusted width for smaller screens */
    max-width: 400px; /* Added max-width to prevent form from stretching too much on larger screens */
  }
  
  .feedback-section {
    width: 100%; /* Make feedback sections full width */
  }
  
  .rate-box {
    justify-content: center; /* Center the star ratings */
  }
  
  .rate-box input {
    margin: 0 0.2rem; /* Adjusted margin for smaller screens */
  }
  
  .wrapper .title {
    font-size: 1rem; /* Adjusted font size for smaller screens */
  }
  
  .wrapper .content {
    font-size: 0.8rem; /* Adjusted font size for smaller screens */
  }
  
  textarea,
  input[type="text"] {
    width: 100%; /* Make textareas and input fields full width */
  }
  
  .submit-btn {
   font-size: 0.9rem;
    border-radius: 1.3rem; /* Maintain the same border radius */
  }
   .rate-box .star:before {
    font-size: calc(1.5rem + 0.1vw); /* Adjusted font size with gradual change */
  }
}



</style>
<?php 
include 'userheader.html'; ?>
</head>
<body>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "yellowbag");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve form data
    $printing_rating = mapRating($_POST["printing"]) ?? "";
    $stitching_rating = mapRating($_POST["stitching"]) ?? "";
    $cloth_rating = mapRating($_POST["cloth"]) ?? "";
    $service_rating = mapRating($_POST["service"]) ?? "";
    $delivery_rating = mapRating($_POST["delivery"]) ?? "";
    $overall_rating = mapRating($_POST["overall"]) ?? "";
    $feedback_text = $_POST["feedback"] ?? "";
    $user_id = $_SESSION['Id'] ?? "";

    // Prepare SQL statement
    $sql = "INSERT INTO feedback
	(user_id, printrev, stitchrev, clothrev, custservice, otd, osatisfy, comments)
            VALUES ('$user_id','$printing_rating', '$stitching_rating', '$cloth_rating', '$service_rating', '$delivery_rating', '$overall_rating', '$feedback_text')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Feedback noted! Thank you for your time.");';
        echo 'window.location.href = "feedback.php";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close database connection
    $conn->close();
}

// Function to map ratings from 1-5 to descriptive words
function mapRating($rating) {
    $rating_words = [
        1 => "Very Good",
        2 => "Satisfied",
        3 => "Good",
        4 => "Okay",
        5 => "Needs Improvement",
    ];
    return $rating_words[$rating] ?? "";
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="wrapper"> 
  <div class="title">CUSTOMER FEEDBACK FORM</div>
  <div class="content">Please rate your experience with our service</div>
  <div class="feedback-section">
    <p>Printing Review:</p>
    <div class="rate-box">
      <input type="radio" name="printing" value="1" id="printing0"required />
      <label class="star" for="printing0"></label>
      <input type="radio" name="printing" value="2" id="printing1"/>
      <label class="star" for="printing1"></label>
      <input type="radio" name="printing" value="3" id="printing2" />
      <label class="star" for="printing2"></label>
      <input type="radio" name="printing" value="4" id="printing3"/>
      <label class="star" for="printing3"></label>
      <input type="radio" name="printing" value="5" id="printing4"/>
      <label class="star" for="printing4"></label>
    </div>
  </div>
  <div class="feedback-section">
    <p>Stitching Review:</p>
    <div class="rate-box">
      <input type="radio" name="stitching" value="1" id="stitching0"required />
      <label class="star" for="stitching0"></label>
      <input type="radio" name="stitching" value="2" id="stitching1"/>
      <label class="star" for="stitching1"></label>
      <input type="radio" name="stitching" value="3" id="stitching2" />
      <label class="star" for="stitching2"></label>
      <input type="radio" name="stitching" value="4" id="stitching3"/>
      <label class="star" for="stitching3"></label>
      <input type="radio" name="stitching" value="5" id="stitching4"/>
      <label class="star" for="stitching4"></label>
    </div>
  </div>
  <div class="feedback-section">
    <p>Cloth Review:</p>
    <div class="rate-box">
      <input type="radio" name="cloth" value="1" id="cloth0"required />
      <label class="star" for="cloth0"></label>
      <input type="radio" name="cloth" value="2" id="cloth1"/>
      <label class="star" for="cloth1"></label>
      <input type="radio" name="cloth" value="3" id="cloth2" />
      <label class="star" for="cloth2"></label>
      <input type="radio" name="cloth" value="4" id="cloth3"/>
      <label class="star" for="cloth3"></label>
      <input type="radio" name="cloth" value="5" id="cloth4"/>
      <label class="star" for="cloth4"></label>
    </div>
  </div>
  <div class="feedback-section">
    <p>Service Review:</p>
    <div class="rate-box">
      <input type="radio" name="service" value="1" id="service0"required />
      <label class="star" for="service0"></label>
      <input type="radio" name="service" value="2" id="service1"/>
      <label class="star" for="service1"></label>
      <input type="radio" name="service" value="3" id="service2" />
      <label class="star" for="service2"></label>
      <input type="radio" name="service" value="4" id="service3"/>
      <label class="star" for="service3"></label>
      <input type="radio" name="service" value="5" id="service4"/>
      <label class="star" for="service4"></label>
    </div>
  </div>
  <div class="feedback-section">
    <p>Delivery Review:</p>
    <div class="rate-box">
      <input type="radio" name="delivery" value="1" id="delivery0"required />
      <label class="star" for="delivery0"></label>
      <input type="radio" name="delivery" value="2" id="delivery1"/>
      <label class="star" for="delivery1"></label>
      <input type="radio" name="delivery" value="3" id="delivery2" />
      <label class="star" for="delivery2"></label>
      <input type="radio" name="delivery" value="4" id="delivery3"/>
      <label class="star" for="delivery3"></label>
      <input type="radio" name="delivery" value="5" id="delivery4"/>
      <label class="star" for="delivery4"></label>
    </div>
  </div>
  <div class="feedback-section">
    <p>Overall Experience:</p>
    <div class="rate-box">
      <input type="radio" name="overall" value="1" id="overall0"required />
      <label class="star" for="overall0"></label>
      <input type="radio" name="overall" value="2" id="overall1"/>
      <label class="star" for="overall1"></label>
      <input type="radio" name="overall" value="3" id="overall2" />
      <label class="star" for="overall2"></label>
      <input type="radio" name="overall" value="4" id="overall3"/>
      <label class="star" for="overall3"></label>
      <input type="radio" name="overall" value="5" id="overall4"/>
      <label class="star" for="overall4"></label>
    </div>
  </div>
  <textarea name="feedback" placeholder="Enter your feedback here..." required></textarea>
  <button type="submit" class="submit-btn">Submit</button> <!-- Changed button type to submit -->
</div><br>
</form>
</body>
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
});</script>
</html>
