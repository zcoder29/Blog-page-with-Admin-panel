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
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

   <?php
    if(isset($_GET['p_id'])){ 
     
    $the_post_id = $_GET['p_id'];
   
    $query = "UPDATE posts SET ";
    $query .= "post_views_count = post_views_count + 1 ";
    $query .= "WHERE post_id = '{$the_post_id}' ";
    $post_views_query = mysqli_query($connection, $query);
        
        
    $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";
    $select_all_posts_query = mysqli_query($connection, $query);
    confirmQuery($select_all_posts_query);
    
    while($row = mysqli_fetch_assoc($select_all_posts_query)){
        
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
    

    ?>
                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
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
                
                <?php 
                     }
                   }
                ?>
                
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                           <label for="">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                           <label for="">Email Address</label>
                            <input class="form-control" type="text" name="comment_email">
                        </div>
                        <div class="form-group">
                           <label for="">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>
            <?php
                
            if(isset($_POST['create_comment'])){
                
            $the_post_id = $_GET['p_id'];   
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            
            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                
            
            $comment_content = mysqli_real_escape_string($connection, $comment_content);
            $comment_date = date("F j, Y, g:i a"); 
                
            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
            $query .= "VALUES('{$the_post_id}','{$comment_author}', '{$comment_email}',  '{$comment_content}', 'Unapproved', now() ) ";
                
            $insert_comment_query = mysqli_query($connection, $query);
            confirmQuery($insert_comment_query);  
            
                
//            $query = "INSERT INTO posts(post_comment_count) VALUES(post_comment_count + 1) WHERE post_id = '{$the_post_id}' ";  
//            $insert_query = mysqli_query($connection, $query);
//                confirmQuery($insert_query);
            }    
            else{
                
                echo "<script>alert('All Fields Are Required')</script>";
            }    
                
        }
                
                ?>
                <!-- Posted Comments -->
            <?php
                
            $query = "SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}' AND comment_status = 'Approved' ORDER BY comment_id DESC"; //Show the newest id first
            $select_comment_query = mysqli_query($connection, $query);
            confirmQuery($select_comment_query);
                
            while($row = mysqli_fetch_assoc($select_comment_query)){
                
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];   
                $comment_date = $row['comment_date'];   
               
            ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date;  ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php
                } 
                ?>
                

            </div>



      <!-- Blog Sidebar Widgets Column -->  
       <?php include "includes/sidebar.php";  ?> 
       
       
       <?php include "includes/footer.php";  ?>       


