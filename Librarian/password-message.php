<?php
session_start();

if (isset($_SESSION['librarian_login'])) {
    header('location: index.php');
}

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>LMS</title>
    <link rel="icon" type="image/png" href="../assests/images/icon.png">
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
    <div class="page-body">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--ERROR 404-->
        <div class="row animated bounce ">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel mt-xlg">
                    <div class="panel-content">
                        <h1 class="error-number"><i class="fa fa-envelope"></i></h1>
                        <h3 class="error-name"> A password recovery link has been sent to your email</h3>
                            <p class="error-text">Please check your email and click on the link to reset your password. </p>
                    </div>
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