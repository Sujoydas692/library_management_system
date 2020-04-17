<?php
include '../connection.php';

if (isset($_GET['token'])) {
    
   $token = $_GET['token'];

$qry = mysqli_query($con, "SELECT `token`,`status` FROM `librarian` WHERE `status` = 0 AND `token` = '$token' LIMIT 1");
if (mysqli_num_rows($qry) == 1) {
    $update = mysqli_query($con, "UPDATE `librarian` SET `status` = 1 WHERE `token` = '$token' LIMIT 1"); ?>
     <div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated bounce ">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel mt-xlg">
                    <div class="panel-content">
                        <h1 class="error-number"><i class="fa fa-smile-o"></i></h1>
                        <p class="error-text">Your account has been verified.
                            <br/>You may now <a href="sign-in.php">login.</a> </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
    <?php
     
} else { ?>
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
} else { ?>
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


?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Library Management System</title>
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