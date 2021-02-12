<?php include "includes/db.php";
include "includes/header.php"; ?>
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
                
        $query = "SELECT * FROM posts WHERE post_status = 'Published'";
        $select_all_posts = mysqli_query($connection, $query);
        $count = mysqli_num_rows($select_all_posts);        
                
        $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC ";
        $select_all_posts = mysqli_query($connection, $query);
                
        if( mysqli_num_rows($select_all_posts) == 0 ){
            
             echo "<h3>Sorry! No Post</h3>";
        }
        else{
            
        while($row = mysqli_fetch_assoc($select_all_posts)){
            
        $post_id = $row['post_id'];     
        $post_category_id = $row['post_category_id'];     
        $post_title = $row['post_title'];     
        $post_author = $row['post_author'];     
        $post_date = $row['post_date'];     
        $post_image = $row['post_image'];     
        $post_content = substr($row['post_content'], 0, 100);     
        $post_tags = $row['post_tags'];     
        $post_status = $row['post_status'];     
        
            
         ?>
           
        <!-- First Blog Post -->
        <h2>
        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
        by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="Image">
        <hr>
        <p><?php echo $post_content; ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


        <hr>
        <?php
            
            }
       }
                
        ?> 

                <!-- Pager -->
                 
<!--
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
-->

            </div>

      <!-- Blog Sidebar Widgets Column -->  
<?php include "includes/sidebar.php"; ?> 
     
<?php include "includes/footer.php"; ?>       


