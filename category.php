<?php

include "includes/db.php";

include "includes/header.php";

?>
   
    <!-- Navigation -->
    <?php include "includes/navigation.php";  ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
            </h1>
        <?php
         if(isset($_GET['cat_id'])){
              
         $the_cat_id = $_GET['cat_id'];
         }
                
        $query = "SELECT * FROM posts WHERE post_category_id = '{$the_cat_id}' ";   $select_post_category_id = mysqli_query($connection, $query);
        
        if(mysqli_num_rows($select_post_category_id) == 0 ){
            
          echo "<h3>Sorry! There is no post based on your selected Category</h3>";
        }
         else{
            
        $query = "SELECT * FROM posts WHERE post_category_id = '{$the_cat_id}' "; 
        $select_posts_by_id = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_posts_by_id)){
            
        $post_id= $row['post_id'];     
        $post_category_id= $row['post_category_id'];     
        $post_title= $row['post_title'];     
        $post_author= $row['post_author'];     
        $post_date= $row['post_date'];     
        $post_image= $row['post_image'];     
        $post_content= substr($row['post_content'], 0, 100);     
        $post_tags= $row['post_tags'];      
         
         ?>   
        <!-- First Blog Post -->
            
        <h2>
        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
        by <a href="#"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> at 10:00 PM</p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
        <hr>
        <p><?php echo $post_content; ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


        <hr>
        <?php
            
            }       
           }     
        ?>        
        


                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

      <!-- Blog Sidebar Widgets Column -->  
       <?php include "includes/sidebar.php";  ?> 
       
       
       <?php include "includes/footer.php";  ?>       


