<?php
include '../connection.php';

if (!isset($_GET['token'])) { ?>
  <div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated bounce ">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel mt-xlg">
                    <div class="panel-content">
                        <h1 class="error-number">4<i class="fa fa-frown-o"></i>4</h1>
                        <h2 class="error-name"> Sorry! The Page not found</h2>
                        <p class="error-text">Sorry, the page you are looking for cannot be found.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
  <?php
    
    
}

$token = $_GET['token'];

$qry = mysqli_query($con, "SELECT `email` FROM `token` WHERE `token` = '$token'");
if (mysqli_num_rows($qry) == 0) { ?>
  <div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated bounce ">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel mt-xlg">
                    <div class="panel-content">
                        <h1 class="error-number">4<i class="fa fa-frown-o"></i>4</h1>
                        <h2 class="error-name"> Sorry! The Page not found</h2>
                        <p class="error-text">Sorry, the page you are looking for cannot be found.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
  <?php
    
}

$password = isset($_POST['password']) ? $_POST['password']:'';
$c_password = isset($_POST['c_password']) ? $_POST['c_password']:'';

if (strlen($password) > 7) {
    if ($password == $c_password) {

        $row = mysqli_fetch_assoc($qry);
        $email = $row['email'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($con, "UPDATE `student` SET `password` = '$password_hash' WHERE `email` = '$email' OR `username` = '$email' ");

        if ($query) {

            $query = mysqli_query($con, "DELETE FROM `token` WHERE `token` = '$token'");
            $success = "Password updated!";
            
        }else {
            $error = "Something wrong";
        }
        
    }else {
            $c_password_error = "Password does not match!";
          }
    
}else {
        $password_error = "Password more than 8 characters!";
    }


?>
<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>LMS</title>
    <link rel="icon" type="image/png" href="../assests/images/icon.png">
    <!-- <link rel="apple-touch-icon" sizes="120x120" href="../assests/favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assests/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assests/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assests/favicon/favicon-16x16.png"> -->
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
            <h1 class="text-center">Reset New Password</h1>
            <?php
              if (isset($success)) {
                ?>
                  <div class="alert alert-success" role="alert">
                    <?= $success; ?>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                <?php
                  
              }

               ?>

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
               <?php
               if (isset($password_error)) {
                ?>
                 <div class="alert alert-warning" role="alert">
                    <?= $password_error; ?>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                 <?php  
               }

               ?>
                <?php
               if (isset($c_password_error)) {
                ?>
                 <div class="alert alert-danger" role="alert">
                    <?= $c_password_error; ?>
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
                    <form method="POST" action="">
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required="">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm Password" required="">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Reset" class="btn btn-primary btn-block">
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