<?php
// Check if the login form is submitted
if (isset($_POST["login"])) {
    $username = $_POST["user"];     // Retrieve the username from the form
    $password = $_POST["pass"];     // Retrieve the password from the form

    // Simple authentication check
    if ($username == "admin" && $password == "admin") {
        echo "<script type='text/javascript'>alert('Login Success')</script>";      // Display success alert
    } else {
        echo "<script type='text/javascript'>alert('Login Error')</script>";        // Display error alert
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        
        <!-- Include Bootstrap CSS for styling -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Include Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            /* Styling for the login page */
            body {
                background-color: #f9f9f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .login-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                padding: 40px;
                width: 400px;
                text-align: center;
            }
            .logo {
                margin-bottom: 20px;
            }
            .form-control {
                border-radius: 20px;
            }
            .btn-login {
                background-color: #800000;
                color: white;
                border-radius: 20px;
            }
            .btn-login:hover {
                background-color: #600000;
            }
            .cookies-notice {
                font-size: 0.8em;
                color: #aaa;
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <!-- Display the logo -->
            <div class="logo">
                <!-- UTM logo -->
                <img src="{{ asset('images/utm-logo.png') }}" alt="UTM Logo" width="200">
            </div>

            <!-- Title -->
            <h3 class="mb-4 text-uppercase fw-bold" style="color: #800000;">Timetable Management</h3>
            
            <!-- Login Form -->
            <form action="" method="POST">
                @csrf <!-- CSRF Token for security -->
                <div class="mb-3">
                    <!-- Username input -->
                    <input type="text" name="user" class="form-control" placeholder="Enter UTMID" required>
                </div>
                <div class="mb-3">
                    <!-- Password input -->
                    <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
                </div>
                    <!-- Submit button -->
                    <button type="submit" name="login" class="btn btn-login w-100">Log in</button>
            </form>
        </div>

        <!-- Include Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
