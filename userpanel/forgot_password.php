<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password Form</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../yellowbagside-svg.svg" />
  <link rel="stylesheet" href="../style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    a {
      text-decoration: none;
      color: var(--second-color);
      text-decoration: underline;
    }

    a:hover {
      text-decoration: underline;
      font-weight: bold;
	  color:white;
    }
  </style>
</head>
<body>
<?php
session_start();
include('post.php');
?>
  <div class="wrapper">
    <div class="login_box">
      <div class="login-header">
      </div>
      <form action="usercode.php" method="POST">
	  <h2><center>PASSWORD RESET</center></h2>
       <div class="input_box">
          <input type="text" id="Username" class="input-field" name="Username" required>
          <label for="Username" class="label">Username</label>
          <i class="bx bx-user icon"></i>
        </div>
		<div class="input_box">
          <input type="email" id="Email" class="input-field" name="Email" required>
          <label for="Email" class="label">Email</label>
          <i class="bx bx-envelope icon"></i>
        </div>
        <div class="input_box">
          <input type="submit" class="input-submit" name="forgotpswd" value="Continue">
        </div>
        <div>
          <p><center>Remembered your password? <a href="userlogin.php">Login here</a></center></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
