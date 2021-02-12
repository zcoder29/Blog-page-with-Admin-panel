 <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                     <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form> 
                </div>
                
                <!-- Login Form -->
                <div class="well">
                    <h4>Login Form</h4>
                    <form action="includes/login.php" method="post">
                     <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                     <input class="btn btn-primary" type="submit" name="login" value="Submit"> 
                    </div>
                    <!-- /.input-group -->
                    </form> 
                </div>
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            
              <?php  
                                
               $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                    
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                
                  ?>
                
                <li><a href="category.php?cat_id=<?php echo $cat_id; ?>"><?php echo $cat_title; ?></a></li>
                                
                 <?php

                    }                                     
                   ?>              

                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>