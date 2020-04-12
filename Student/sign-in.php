<?php

include '../connection.php';
session_start();

if (isset($_SESSION['student_login'])) {
    header('location: index.php');
}

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

   $result = mysqli_query($con, "SELECT * FROM `student` WHERE `email` = '$email' OR `username` = '$email';");

   if (mysqli_num_rows($result) == 1) {
       $row = mysqli_fetch_assoc($result);

       if (password_verify($password, $row['password'])) {

        if ($row['status'] == 1) {
            $_SESSION['student_login'] = $email;
            $_SESSION['student_id'] = $row['id'];
            header('location: index.php');
            
        }else {
            $error = "Your Status is Inactive. Please contact to the librarian";
        }
           
       }else {
           $error = "Password Invalid!";
       }


   }else {
       $error = "Email or Username Invalid!";
   }



    
    
}

?>


<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>LMS</title>
    <link rel="apple-touch-icon" sizes="120x120" href="../assests/favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assests/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assests/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assests/favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assests/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assests/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assests/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assests/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h1 class="text-center">LMS</h1>

            <?php
              if (isset($error)) {
                ?>
                  <div class="alert alert-danger" role="alert">
                    <?= $error; ?>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                <?php
                  
              }

               ?>
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email/Username" value="<?= isset($email) ? $email:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked>
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" value="Sign In" class="btn btn-primary btn-block">
                        </div>
                        <div class="form-group text-center">
                            <a href="forgot-password.php">Forgot password?</a>
                            <hr/>
                             <span>Don't have an account?</span>
                            <a href="register.php" class="btn btn-block mt-sm">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assests/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assests/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assests/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assests/javascripts/template-script.min.js"></script>
<script src="../assests/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>
</html>
