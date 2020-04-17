<?php include 'header.php'; ?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                             <li><a href="javascript:avoid(0)">Books</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>All Books</b></h4>
                        <div class="panel">
                            <div class="panel-content">
                                <form method="POST" action="">
                                    <div class="row pt-md">
                                        <div class="form-group col-sm-9 col-lg-10">
                                                <span class="input-with-icon">
                                            <input type="text" class="form-control" name="s_result" id="lefticon" placeholder="Search" required="">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        </div>
                                        <div class="form-group col-sm-3  col-lg-2 ">
                                            <button type="submit" name="s_books" class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['s_books'])) { 

                        $s_result = $_POST['s_result'];
                        ?>

                        <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">
                                    <?php

                                    $result = mysqli_query($con,"SELECT * FROM `books` WHERE `book_name` LIKE '%$s_result%'");
                                    $temp = mysqli_num_rows($result);
                                    if ($temp > 0) { ?>
                                        <?php
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                      
                                  <div class="col-sm-3 col-md-2">
                                    <img src="../images/books/<?= $row['book_image'] ?>" width='100'>
                                    <p><?= $row['book_name'] ?></p>
                                    <span><b>Aailable: <?= $row['available_qty'] ?></b></span>
                                  </div>
                              <?php  } ?>
                                        
                                    <?php }else {
                                        echo '<h3 style="text-align: center"> Books Not Found!</h3>';
                                    } ?>

                        </div>
                            </div>
                            
                        </div>
                    </div>


                        <?php
                    }else { ?>
                        <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">
                                    <?php

                                    $result = mysqli_query($con,"SELECT * FROM `books`");
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                      
                                  <div class="col-sm-3 col-md-2">
                                    <img src="../images/books/<?= $row['book_image'] ?>" width='100'>
                                    <p><?= $row['book_name'] ?></p>
                                    <span><b>Aailable: <?= $row['available_qty'] ?></b></span>
                                  </div>
                              <?php  } ?>
                        </div>
                            </div>
                            
                        </div>
                    </div>
                        <?php
                    } ?>
                    
                </div>
<?php include 'footer.php'; ?>