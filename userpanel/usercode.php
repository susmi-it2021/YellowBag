<?php 
session_start();
$con = mysqli_connect("localhost", "root", "", "yellowbag");
$errors = [];

if (isset($_POST['signup'])) {
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Password = mysqli_real_escape_string($con, $_POST['Password']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $Phone = mysqli_real_escape_string($con, $_POST['Phone']);
    $name_check_query = "SELECT * FROM user WHERE Username = '$Username'";
    $name_check_result = mysqli_query($con, $name_check_query);

    if (mysqli_num_rows($name_check_result) > 0) {
        $errors['Username'] = "Username already exists!";
        $_SESSION['message'] = "Sorry, the username already exists!";
    }

    if (empty($errors)) {
        if (strlen($Phone) !== 10 || !ctype_digit($Phone)) {
            $errors['Phone'] = "Phone number must be 10 digits long!";
            $_SESSION['message'] = "Invalid phone number!";
        }
        if (empty($errors)) {
            $encpass = password_hash($Password, PASSWORD_BCRYPT);
            $insert_query = "INSERT INTO user (Username, Password, Email, Phone) VALUES ('$Username', '$encpass', '$Email', '$Phone')";
            if (mysqli_query($con, $insert_query)) {
                $_SESSION['message'] = "You have registered successfully!";
            } else {
                $_SESSION['message'] = "Failed to register!";
            }
        }
    }

    header("Location: usersignup.php");
    exit();
}
if (isset($_POST['login'])) {
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Password = mysqli_real_escape_string($con, $_POST['Password']);

    $check_user_query = "SELECT * FROM user WHERE Username = '$Username'";
    $result = mysqli_query($con, $check_user_query);

    if (mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
        $fetch_pass = $fetch['Password'];

        if (password_verify($Password, $fetch_pass)) {
            $_SESSION['Username'] = $Username;
            $_SESSION['Email'] = $fetch['Email'];
            $_SESSION['Id'] = $fetch['Id'];
            header("Location: order_request.php");
            exit();
        } else {
            $_SESSION['message'] = "Incorrect password!";
        }
    } else {
        $_SESSION['message'] = "User not found. Click on the bottom link to sign up.";
    }

    header("Location: userlogin.php");
    exit();
}
if (isset($_POST['forgotpswd'])) {
    $Username = mysqli_real_escape_string($con, $_POST['Username']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $check_user_query = "SELECT * FROM user WHERE Username = '$Username' AND Email = '$Email'";
    $result = mysqli_query($con, $check_user_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['reset_username'] = $Username;
        header("Location: reset_password.php");
        exit();
    } else {
        $_SESSION['message'] = "Username and email combination not found.";
        header("Location: forgot_password.php");
        exit();
    }
}

if (isset($_POST['resetpswd'])) {
    $newPassword = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_password']);
    if ($newPassword !== $confirmPassword) {
        $_SESSION['message'] = "Passwords do not match!";
        header("Location: reset_password.php");
        exit();
    }
    $username = $_SESSION['reset_username'];
    $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    $update_password_query = "UPDATE user SET Password = '$newHashedPassword' WHERE Username = '$username'";
    mysqli_query($con, $update_password_query);

    $_SESSION['message'] = "Password reset successful. You can now login with your new password.";
    unset($_SESSION['reset_username']);

    header("Location: reset_password.php");
    exit();
}
?>
