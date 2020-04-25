<?php
error_reporting(0);

include '../connection.php';

$page = explode('/', $_SERVER['PHP_SELF']);
$page = end($page);

session_start();

if (!isset($_SESSION['librarian_login'])) {
    header('location: sign-in.php');
}

$librarian_login = $_SESSION['librarian_login'];

 $result = mysqli_query($con, "SELECT * FROM `librarian` WHERE `username` = '$librarian_login' OR `email`= '$librarian_login'");
 $row = mysqli_fetch_assoc($result);

 if (isset($_POST['update_profile'])) {

    $fname = $_POST['fname'];
    $mobile = $_POST['mobile'];


    $qry = "UPDATE `librarian` SET `fname`='$fname',`mobile`='$mobile' WHERE `username` = '$librarian_login' OR `email` = '$librarian_login'";

    $result = mysqli_query($con,$qry);

    if ($result) {

       ?>
        <script type="text/javascript">
            alert('Profile Updated Successfully!');
            javascript:history.go(-1);
        </script>
        <?php
    }else {
         ?>
        <script type="text/javascript">
            alert('Profile Not Update!');
        </script>
        <?php
    }

  }


?>

<!doctype html>
<html lang="en" class="fixed left-sidebar-top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= ucwords($row['fname']) ?></title>
    <link rel="icon" type="image/png" href="../assests/images/icon.png">
    <!-- <link rel="apple-touch-icon" sizes="120x120" href="../assests/favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assests/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assests/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assests/favicon/favicon-16x16.png"> -->
    <!--load progress bar-->
    <script src="../assests/vendor/pace/pace.min.js"></script>
    <link href="../assests/vendor/pace/pace-theme-minimal.css" rel="stylesheet" />

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assests/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assests/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assests/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="../assests/vendor/toastr/toastr.min.css">
    <!--Magnific popup-->
    <link rel="stylesheet" href="../assests/vendor/magnific-popup/magnific-popup.css">
     <!--dataTable-->
    <link rel="stylesheet" href="../assests/vendor/data-table/media/css/dataTables.bootstrap.min.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assests/stylesheets/css/style.css">


</head>

<body>
    <div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        <div class="page-header">
            <!-- LEFTSIDE header -->
            <div class="leftside-header">
                <div class="logo">
                    <a href="index.php" class="on-click">
                        <h3 style="margin-left: 10px"> LMS</h3>
                    </a>
                </div>
                <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- RIGHTSIDE header -->
            <div class="rightside-header">
                <div class="header-middle"></div>
                
                <!--USER HEADERBOX -->
                <div class="header-section" id="user-headerbox">
                    <div class="user-header-wrap">
                        <div class="user-photo">
                            <img alt="profile photo" src="../images/librarian/<?= empty($row['image']) ? "logo.png" : $row['image'] ?>" style="border-radius: 50%; width: 100%; height: 30px; background-size: cover;" />
                        </div>
                        <div class="user-info">
                            <span class="user-name"><?= ucwords($row['fname']) ?></span>
                            <span class="user-profile">Admin</span>
                        </div>
                        <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                        <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                    </div>
                    <div class="user-options dropdown-box">
                        <div class="drop-content basic">
                            <ul>
                                <li> <a href="user-profile.php?id=<?= base64_encode($row['id']) ?>&username=<?= ucwords($row['username']) ?>&name=<?= ucwords($row['fname']) ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-separator"></div>
                <!--Log out -->
                <div class="header-section">
                    <a href="logout.php" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
            <div class="left-sidebar">
                <!-- left sidebar HEADER -->
                <div class="left-sidebar-header">
                    <div class="left-sidebar-title">Navigation</div>
                    <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                        <span></span>
                    </div>
                </div>
                <!-- NAVIGATION -->
                <!-- ========================================================= -->
                <div id="left-nav" class="nano">
                    <div class="nano-content">
                        <nav>
                            <ul class="nav nav-left-lines" id="main-nav">
                                <!--HOME-->
                                <li class="<?= $page == 'index.php' ? 'active-item':'' ?>"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                                 <li class="<?= $page == 'student.php' ? 'active-item':'' ?>"><a href="student.php?id=<?= base64_encode($row['id']) ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Student</span></a></li>
                                 <li class="has-child-item close-item <?= $page == 'add-book.php' ? 'open-item':'' ?><?= $page == 'manage-book.php' ? 'open-item':'' ?>">
                                    <a><i class="fa fa-book" aria-hidden="true"></i><span>Books</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li class="<?= $page == 'add-book.php' ? 'active-item':'' ?>"><a href="add-book.php?id=<?= base64_encode($row['id']) ?>">Add Book</a></li>
                                        <li class="<?= $page == 'manage-book.php' ? 'active-item':'' ?>"><a href="manage-book.php?id=<?= base64_encode($row['id']) ?>">Manage Books</a></li>
                                    </ul>
                                </li>
                                <li class="<?= $page == 'issue-book.php' ? 'active-item':'' ?>"><a href="issue-book.php?id=<?= base64_encode($row['id']) ?>"><i class="fa fa-book" aria-hidden="true"></i><span>Issue Book</span></a></li>
                                <li class="<?= $page == 'return-book.php' ? 'active-item':'' ?>"><a href="return-book.php?id=<?= base64_encode($row['id']) ?>"><i class="fa fa-book" aria-hidden="true"></i><span>Return Book</span></a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- CONTENT -->
            <!-- ========================================================= -->
            <div class="content">

<div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                        <li><a href="javascript:avoid(0)">User Profile</a></li>
                    </ul>
                </div>
            </div>


<div class="col-sm-6 col-sm-offset-3">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--PROFILE-->
                    <div>
                        <div class="profile-photo">
                                <img alt="User photo" src="../images/librarian/<?= empty($row['image']) ? "logo.png" : $row['image'] ?>" title="Change Profile Photo" onclick="triggerClick()" id="profiledisplay" style="cursor: pointer; border-radius: 50%; width: 100%; height: 140px; background-size: cover;">
                               
                            
                        </div>
                        <div class="user-header-info">
                            <h2 class="user-name"><?= ucwords($row['fname']) ?></h2>
                            <h5 class="user-position">Admin</h5>
                        </div>
                        <div>

            <?php

               if (isset($_POST['update'])) {

                $photo = explode('.', $_FILES['image']['name']);
                $photo = end($photo);
                $photo_name = date('Ymdhis.').$photo;

                $sql = "UPDATE `librarian` SET `image`='$photo_name' WHERE `username` = '$librarian_login' OR `email` = '$librarian_login'";

               $upload = mysqli_query($con,$sql);

               if ($upload) {

                move_uploaded_file($_FILES['image']['tmp_name'], '../images/librarian/'.$photo_name);
                 ?>
        <script type="text/javascript">
            alert('Image Updated Successfully!');
            javascript:history.go(-1);
        </script>
        <?php
                
               }
                    
                } 



            ?>



            <form action="" enctype="multipart/form-data" method="POST">
                <br><input type="file" name="image" onchange="displayImage(this)" required="" id="image" style="display: none;">
                <input type="submit" name="update" value="Update" required="" class="btn btn-primary btn-sm" style="margin-left: 35px;" >
            </form>
            
        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    <!--CONTACT INFO-->
                    <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
                        <div class="panel-content">
                            <h4 class=""><b>Contact Information</b></h4>
                            <ul class="user-contact-info ph-sm">
                                <li><b><i class="color-primary mr-sm fa fa-user"></i></b> <?= ucwords($row['fname']) ?></li>
                                <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b> <?= $row['email'] ?></li>
                                <li><b><i class="color-primary mr-sm fa fa-user"></i></b> <?= $row['username'] ?></li>
                                <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> <?= $row['mobile'] ?></li>
                            </ul>
                             <a href="javascript:avoid(0)" class="btn btn-primary btn-sm offset-9" data-toggle="modal" data-target="#primary-modal">Edit Profile</a>
                        </div>
                       
                        
                    </div>
                </div>

                <!-- Modal -->
                            <div class="modal fade" id="primary-modal" tabindex="-1" role="dialog" aria-labelledby="modal-primary-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-primary-label"><i class="fa fa-pencil"></i>Update Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="panel-content">
                                              <div class="row">
                                                  <div class="col-md-12">
                                                       <form method="POST" action="">
                                        <div class="form-group">
                                            <label for="fname">Full Name</label>
                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Full Name" value="<?= $row['fname'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $row['email'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?= $row['username'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone No.</label>
                                            <input type="text" class="form-control" name="mobile" id="phone" placeholder="Phone No." value="<?= $row['mobile'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="update_profile"><i class="fa fa-save"></i> Update</button>
                                        </div>
                                    </form>
                                                    </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

           </div>
            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
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
    <!--Notification msj-->
    <script src="../assests/vendor/toastr/toastr.min.js"></script>
    <!--morris chart-->
    <script src="../assests/vendor/chart-js/chart.min.js"></script>
    <!--Gallery with Magnific popup-->
    <script src="../assests/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!--dataTable-->
    <script src="../assests/vendor/data-table/media/js/jquery.dataTables.min.js"></script>
    <script src="../assests/vendor/data-table/media/js/dataTables.bootstrap.min.js"></script>
    <!--Examples-->
    <script src="../assests/javascripts/examples/tables/data-tables.js"></script>
    <!--Examples-->
    <script src="../assests/javascripts/examples/script.js"></script>
    <script src="./assests/javascripts/examples/dashboard.js"></script>

</body>
</html>                