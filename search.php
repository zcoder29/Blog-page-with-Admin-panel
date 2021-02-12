<?php
ob_start();

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

        <?php
                    
        if(isset($_POST['submit'])){

            $search = $_POST['search'];

        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' "; 
        $search_query = mysqli_query($connection, $query);

        if(mysqli_num_rows($search_query) == 0 ){
            
            echo "<h1>No Result</h1>";
        }
        else{    
            
        while($row = mysqli_fetch_assoc($search_query)){
            
        $post_id= $row['post_id'];     
        $post_category_id= $row['post_category_id'];     
        $post_title= $row['post_title'];     
        $post_author= $row['post_author'];     
        $post_date= $row['post_date'];     
        $post_image= $row['post_image'];     
        $post_content= $row['post_content'];     
        $post_content= mysqli_real_escape_string($connection, $post_content);
        $post_tags= $row['post_tags'];     
               
                
        ?>       
               
               
               
               
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?> at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

               
                <hr>

               <?php 
                
                }    

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


