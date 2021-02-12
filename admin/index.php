
  <?php include "includes/header.php"; ?>
   
    <div id="wrapper">   
       
        <!-- Navigation -->
        <?php include "includes/navigation.php"; ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['user_name'];  ?></small>
                        </h1>
    
<!--
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
-->
                    </div>
                </div>
                <!-- /.row -->

           
          
                <!-- /.row -->
                      
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
           <?php         
        $query = "SELECT * FROM posts";
        $query = mysqli_query($connection, $query);
        $total_posts = mysqli_num_rows($query);
            ?>
                  <div class='huge'><?php echo $total_posts; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
            <?php
        $query = "SELECT * FROM comments";
        $query = mysqli_query($connection, $query);
        $total_comments = mysqli_num_rows($query); 
            ?>
                    
                     <div class='huge'><?php echo $total_comments; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
        <?php
        $query = "SELECT * FROM users";
        $query = mysqli_query($connection, $query);
        $total_users = mysqli_num_rows($query); 
        ?>
                    <div class='huge'><?php echo $total_users; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       
         <?php 
                       
        $query = "SELECT * FROM categories";
        $query = mysqli_query($connection, $query);
        $total_cat = mysqli_num_rows($query);        
                
        ?>
                        <div class='huge'><?php echo $total_cat;  ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
         
        <!-- /.row -->
   <?php         
        $query = "SELECT * FROM posts WHERE post_status = 'Published' ";
        $published_post_query = mysqli_query($connection, $query);
        $published_posts = mysqli_num_rows($published_post_query);
            
        $query = "SELECT * FROM posts WHERE post_status = 'Draft' ";
        $draft_posts_query = mysqli_query($connection, $query);
        $draft_posts = mysqli_num_rows($draft_posts_query);
                
        $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved' ";
        $unapproved_comments_query = mysqli_query($connection, $query);
        $unapproved_comments = mysqli_num_rows($unapproved_comments_query);        
        
        $query = "SELECT * FROM users WHERE user_role = 'Subscriber' ";
        $subscriber_query = mysqli_query($connection, $query);
        $total_subscriber = mysqli_num_rows($subscriber_query);  
        ?>             
                
<div class="row">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        
         ['Data', 'Count'],
            <?php  
        $element_text = ['Total Posts','Active Posts','Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subscriber', 'Categories',];
        $element_count = [$total_posts, $published_posts, $draft_posts, $total_comments, $unapproved_comments, $total_users, $total_subscriber, $total_cat];
            
         for($i = 0; $i < 8; $i++){
            
            echo"['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
        }
            
        ?>
//        ['Posts', 100]    
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: 'Posts, Categories, Users and Comments',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    
      <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>  

     </div>
      
       <!-- /.row -->  
             
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>






