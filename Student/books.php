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
                                    <a href="javascript:avoid(0)" data-toggle="modal" data-target="#book-<?= $row['id'] ?>"><img src="../images/books/<?= $row['book_image'] ?>" width='100'></a>
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
                        <?php

                    $result = mysqli_query($con, "SELECT * FROM `books`");
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <!-- Modal -->
                            <div class="modal fade" id="book-<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Info</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                <th>Book Name</th>
                                                <td><?= $row['book_name'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Book Image</th>
                                                 <td><img src="../images/books/<?= $row['book_image'] ?>" width='100'></td>
                                             </tr>
                                             <tr>
                                                 <th>Author Name</th>
                                                 <td><?= $row['book_author_name'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Publication Name</th>
                                                 <td><?= $row['book_publication_name'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Book Quantity</th>
                                                 <td><?= $row['book_qty'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Available Quantity</th>
                                                 <td><?= $row['available_qty'] ?></td>
                                             </tr>
                                            </table>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                            
                                }
                            ?>
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
                                    <a href="javascript:avoid(0)" data-toggle="modal" data-target="#book-<?= $row['id'] ?>"><img src="../images/books/<?= $row['book_image'] ?>" width='100'></a>
                                    <p><?= $row['book_name'] ?></p>
                                    <span><b>Aailable: <?= $row['available_qty'] ?></b></span>
                                  </div>
                              <?php  } ?>
                        </div>
                            </div>
                            
                        </div>
                        <?php

                    $result = mysqli_query($con, "SELECT * FROM `books`");
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <!-- Modal -->
                            <div class="modal fade" id="book-<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Info</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                <th>Book Name</th>
                                                <td><?= $row['book_name'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Book Image</th>
                                                 <td><img src="../images/books/<?= $row['book_image'] ?>" width='100'></td>
                                             </tr>
                                             <tr>
                                                 <th>Author Name</th>
                                                 <td><?= $row['book_author_name'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Publication Name</th>
                                                 <td><?= $row['book_publication_name'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Book Quantity</th>
                                                 <td><?= $row['book_qty'] ?></td>
                                             </tr>
                                             <tr>
                                                 <th>Available Quantity</th>
                                                 <td><?= $row['available_qty'] ?></td>
                                             </tr>
                                            </table>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                            
                                }
                            ?>
                    </div>
                        <?php
                    } ?>
                    
                </div>
<?php include 'footer.php'; ?>