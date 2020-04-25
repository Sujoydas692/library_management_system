<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../assests/PHPMailer/src/Exception.php';
require '../assests/PHPMailer/src/PHPMailer.php';
require '../assests/PHPMailer/src/SMTP.php';

include '../connection.php';

session_start();

if (isset($_SESSION['librarian_login'])) {
    header('location: index.php');
}

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $mobile = $_POST['mobile'];
    $token = md5(time().$email);

    // $image = explode('.', $_FILES['image']['name']);
    // $image_ext = end($image);

    // $image = date('Ymdhis.').$image_ext;

     $input_error = array();
     if (empty($fname)) {
        $input_error['fname'] = "This field is required!";
         
     }
     if (empty($email)) {
        $input_error['email'] = "This field is required!";
         
     }
     if (empty($username)) {
        $input_error['username'] = "This field is required!";
         
     }
     if (empty($password)) {
        $input_error['password'] = "This field is required!";
         
     }
     if (empty($c_password)) {
        $input_error['c_password'] = "This field is required!";
         
     }
     if (empty($mobile)) {
        $input_error['mobile'] = "This field is required!";
         
     }
     if (count($input_error) == 0) {


        $email_check = mysqli_query($con,"SELECT * FROM `librarian` WHERE `email` = '$email'");
        $email_check_row = mysqli_num_rows($email_check);

        if ($email_check_row == 0) {

            $username_check = mysqli_query($con,"SELECT * FROM `librarian` WHERE `username` = '$username'");
        $username_check_row = mysqli_num_rows($username_check);

        if ($username_check_row == 0) {

            if (strlen($username) > 7) {

                if (strlen($password) > 7) {
                    if ($password == $c_password) {

                            $phone_check = mysqli_query($con,"SELECT * FROM `librarian` WHERE `mobile` = '$mobile'");
                        $phone_check_row = mysqli_num_rows($phone_check);

                        if ($phone_check_row == 0) {

                                 $result = mysqli_query($con, "INSERT INTO `librarian`(`fname`, `email`, `username`, `password`, `token`, `status`, `mobile`) VALUES ('$fname','$email','$username','$password','$token','0','$mobile')");

                                 if ($result) {

                                    // move_uploaded_file($_FILES['image']['tmp_name'], '../images/librarian/'.$image);

                                    $mail = new PHPMailer(true);

                                        try {
                                            //Server settings
                                            $mail->isSMTP();                                            // Send using SMTP
                                            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                                            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                            $mail->Username   = 'sujoydas692@gmail.com';                     // SMTP username
                                            $mail->Password   = 'sujoysubir05050575';                               // SMTP password
                                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                            //Recipients
                                            $mail->setFrom('sujoydas692@gmail.com', 'Anonymous');
                                            $mail->addAddress($email);     // Add a recipient
                                            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

                                            // Content
                                            $url = $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/verify.php?token=$token";
                                            $mail->isHTML(true);                                  // Set email format to HTML
                                            $mail->Subject = 'Register Your Account';
                                            $mail->Body    = "Click on the linkn below to register your account.<br>
                                                               <a href='$url'>Register Your Account</a>";
                                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                            $mail->send();
                                            header('location: thankyou.php');
                                        } catch (Exception $e) {
                                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                        }
                                        exit();
                                    //$success = "Registration Successfully!";

                                    
                                    //header('location: register.php');
                                    
                                     
                                 }else {
                                     $error = "Something Worng!";
                                 }

                            
                        }else {
                            $phone_error = "This Phone Number is Exists!";
                        }   
                    }else {
                        $c_password_error = "Password does not match!";
                    }
                    
                }else {
                    $password_error = "Password more than 8 characters!";
                }
                
            }else {
            $username_exists = "Username more than 8 characters!";
        }
            
        }else {
            $username_exists = "This username already exists!";
        }
            
            
        }else {
            $email_exists = "This email already exists!";
        }
         
         
     }


   
    
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
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h2 class="text-center">Registration</h2>

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
              if (isset($email_exists)) {
                ?>
                  <div class="alert alert-danger" role="alert">
                    <?= $email_exists; ?>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                <?php
                  
              }

               ?>

               <?php
               if (isset($username_exists)) {
                ?>
                 <div class="alert alert-danger" role="alert">
                    <?= $username_exists; ?>
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
                 <div class="alert alert-danger" role="alert">
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
               <?php
               if (isset($phone_error)) {
                ?>
                 <div class="alert alert-danger" role="alert">
                    <?= $phone_error; ?>
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
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Full Name" name="fname" value="<?= isset($fname) ? $fname:'' ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset($input_error['fname'])) {
                                echo '<span class="input-error">'.$input_error['fname'].'</span>';
                                
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?= isset($email) ? $email:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php if (isset($input_error['email'])) {
                                echo '<span class="input-error">'.$input_error['email'].'</span>';
                                
                            } ?>

                        </div>
                         <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= isset($username) ? $username:'' ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset($input_error['username'])) {
                                echo '<span class="input-error">'.$input_error['username'].'</span>';
                                
                            } ?>

                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php if (isset($input_error['password'])) {
                                echo '<span class="input-error">'.$input_error['password'].'</span>';
                                
                            } ?>

                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="c_password">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php if (isset($input_error['c_password'])) {
                                echo '<span class="input-error">'.$input_error['c_password'].'</span>';
                                
                            } ?>

                        </div>
                         <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Phone No." name="mobile" pattern="01[3|4|5|6|7|8|9][0-9]{8}" value="<?= isset($mobile) ? $mobile:'' ?>">
                                <i class="fa fa-phone"></i>
                            </span>
                            <?php if (isset($input_error['mobile'])) {
                                echo '<span class="input-error">'.$input_error['mobile'].'</span>';
                                
                            } ?>

                        </div>
                        <!-- <div class="form-group mt-md">
                             <div class="col-sm-6 offset-3">
                               <input id="image" type="file" name="image" required="">
                             </div><br>
                         </div> -->
                        <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="register" value="Sign Up">
                            
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="sign-in.php">Sign In</a>
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
