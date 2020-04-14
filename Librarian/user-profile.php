<?php
error_reporting(0);
include 'header.php';

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
                            <img alt="User photo" src="../images/librarian/<?= $row['image'] ?>" onclick="triggerClick()" id="profiledisplay" style="cursor: pointer;" >
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

               $upload = mysqli_query($con,"UPDATE `librarian` SET `image`='$photo_name' WHERE `username` = '$librarian_login' OR `email` = '$librarian_login'");

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
                <input type="submit" name="update" value="Update" required="" class="btn btn-primary btn-sm">
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

<?php include 'footer.php'; ?>                