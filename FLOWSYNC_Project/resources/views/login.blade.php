<?php
if (isset($_POST["login"])) {
    $username = $_POST["user"];
    $password = $_POST["pass"];
    if ($username == "admin" && $password == "admin") {
        echo "<script type='text/javascript'>alert('Login Success')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Login Error')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <!-- Add Bootstrap for styling -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body {
                background: linear-gradient(135deg, #b26666 0%, #800000 100%);
                font-family: Arial, sans-serif;
                color: #fff;
            }
            .login-container {
                max-width: 400px;
                margin: 100px auto;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                padding: 20px;
            }
            .form-control {
                background: rgba(255, 255, 255, 0.2);
                color: #fff;
                border: none;
                border-radius: 5px;
            }
            .form-control:focus {
                background: rgba(255, 255, 255, 0.4);
                color: #fff;
                box-shadow: none;
            }
            .btn-primary {
                background-color: #6a11cb;
                border: none;
            }
            .btn-primary:hover {
                background-color: #2575fc;
            }
        </style>
    </head>

    <body>
        <div class="login-container text-center">
            <h1 class="mb-4">Login Form</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf <!-- CSRF protection for Laravel -->
                <div class="mb-3">
                    <label for="user" class="form-label">UTMID</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="user" name="user" class="form-control" placeholder="Enter UTMID">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password">
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
        </div>

        <!-- Bootstrap and JS libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
