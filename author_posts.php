<?php

include "includes/db.php";

include "includes/header.php";

include "admin/functions.php";

?>
   
    <!-- Navigation -->
    <?php include "includes/navigation.php";  ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

   <?php
    if(isset($_GET['author'])){ 
     
    $the_post_author = $_GET['author'];
    }
      
    ?>
    
    <!-- Blog Post Content Column -->
    <div class="col-lg-8">
        <h1 class="page-header">
        All Posts
        <small>By <?php echo $the_post_author; ?></small>
        </h1>
    
   <?php     
     
    $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
    $select_all_posts_query = mysqli_query($connection, $query);
    confirmQuery($select_all_posts_query);
    
    while($row = mysqli_fetch_assoc($select_all_posts_query)){
        
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 50);
    

    ?>
                <!-- Blog Post -->

                <!-- Title -->
                <h1><a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h1>

                <!-- Author -->
                <p class="lead">
                    by <?php echo $post_author; ?>    
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> </p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Post Image">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                <?php 
        
                   }
                ?>
                
                

            </div>



      <!-- Blog Sidebar Widgets Column -->  
       <?php include "includes/sidebar.php";  ?> 
       
       
       <?php include "includes/footer.php";  ?>       


