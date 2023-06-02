<?php
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Loan Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="images/logoo.png">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="wrap" style="max-width: 1200px">
        <img src="images/logo.png" alt="" class="outside-logo">
        <div class="container mx-auto">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="logo">
                        <div class="welcome-container">
                            <h2 class="welcome-text">Welcome</h2>
                        </div>
                        <img src="images/logoo.png" alt="Loan Management System Logo" class="logo-pic">
                        <h1 class="left-text">INTRODUCING LOAN MANAGEMENT SYSTEM</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="login-form">
                        <form id="login-form" method="post" action="login.php">
                            <h2 class="login-text">LOGIN</h2>
                            <?php 
											session_start();
											if(ISSET($_SESSION['message'])){
												echo "<center><label class='text-danger'>".$_SESSION['message']."</label></center>";
											}
										?>
                            <div class="form-group">
                                <label class="form-control-label" for="username">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="username" name="username" value="">
                                    <div class="input-group-prepend">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                    <div class="input-group-prepend">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <a href="#" class="forgot-password-link">Forgot Password?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn center-button" name="login_user">Log In</button>
                            </div>
                            <div class="signup-text">
                                Don't have an account yet? 
                                <a href="registration.php" style="text-decoration: underline;">Sign Up</a>
                            </div>                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img src="images/rectangle.png" alt="" class="outside-logo-below">
    </div>
    <!-- index.php -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>