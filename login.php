<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../Group 2/assets/css/signin.css">
</head>
<body>
    <div class="background">
        <!-- Your SVG code here -->
    </div>
    <div class="tile">
        <div class="tile-body">
            <div class="help"><a href="signup.html" style="color:#672bb0;">Sign up</a></div>
            <div class="login">Login / Sign In</div>
            <form action="" method="POST" id="form">
                <label for="" class="form-input">
                    <i class="material-icons">person</i>
                    <input type="text" name="username" autofocus="true" required />
                    <span class="label">Username</span>
                    <span class="underline"></span>
                </label>
                <label for="" class="form-input">
                    <i class="material-icons">lock</i>
                    <input type="password" name="password" autofocus="true" required />
                    <span class="label">Password</span>
                    <span class="underline"></span>
                </label>
                <div class="submit-container clearfix" style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-irenic float-right" tabindex="0">
                        <span>SIGN IN</span>
                    </button>
                </div>
            </form>
            <div class="forgot"><a href="#">forget password?</a></div>
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform your login logic here
    // Example: Check credentials and redirect if successful
    if ($username === "your_username" && $password === "your_password") {
        header("Location: welcome.php"); // Replace "welcome.php" with your actual welcome page
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>
