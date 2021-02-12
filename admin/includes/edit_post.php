
      
    <!--Update Post-->
      <?php

 if(isset($_GET['p_id'])){
     
     $the_post_id = $_GET['p_id'];
 }
     
    $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' ";
    $select_post_by_id =mysqli_query($connection, $query);
    confirmQuery($select_post_by_id);
     
    while($row = mysqli_fetch_assoc($select_post_by_id)){

    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];

    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];

       ?>
       <form action="" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
           <label for="post-author">Author</label>
               <input type="text" name="update_post_author" class="form-control" value="<?php echo $post_author; ?>">
        </div>
        <div class="form-group">
           <label for="post-title">Title</label>
            <input type="text" name="update_post_title" class="form-control" value="<?php echo $post_title; ?>">
        </div>
        <div class="form-group">
           <label for="post-category-id">Category Id</label>
            <select name="update_post_category_id" id="">
            <?php
            
            $query = "SELECT * FROM categories";
            $select_query = mysqli_query($connection, $query);
            confirmQuery($select_query);
            
            while($row = mysqli_fetch_assoc($select_query)){
            
             $cat_id = $row['cat_id'];
             $cat_title = $row['cat_title'];
            
            if( $cat_id == $post_category_id ) {
                
                echo "<option value='{$cat_id}' selected>$cat_title</option>";
            }
                else{
               
                echo "<option value='{$cat_id}'>$cat_title</option>";
              }
            }
           ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post-image">Image</label>
            <img src="../images/<?php echo $post_image; ?>" alt="Image" class="img-responsive" width="100" > 
            <input type="file" name="update_post_image">   
        </div>     
        <div class="form-group">
            <label for="post-content">Content</label><br>
            <textarea class="form-control" name="update_post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>    
        </div>       
        <div class="form-group">
           <label for="post-tags">Tags</label>
            <input type="" name="update_post_tags" class="form-control" value="<?php echo $post_tags; ?>">
        </div>
        <div class="form-group">
           <label for="post-status">Status</label>
            <select name="update_post_status" id="">
              <?php 
            echo "<option value='{$post_status}'>$post_status</option>";
            
            if($post_status == 'Published'){
              
             echo "<option value='Draft'>Draft</option>";
            }
            else{
                
             echo "<option value='Published'>Publish</option>";
            }
            
        
                ?>
            </select>
        </div>       

           <?php 
             }
                   
            ?>
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="edit_post" value="Update Post"> 
            </div>
            
        </form>
         <!--Update Query-->    
        <?php
        if(isset($_POST['edit_post'])){

        $the_post_title = $_POST['update_post_title'];
        $the_post_author = $_POST['update_post_author'];
        $the_post_category_id = $_POST['update_post_category_id'];
            
            
        $the_post_date = date('d-m-y');
            
            
        $the_post_image = $_FILES['update_post_image']['name'];
        $the_post_image_temp = $_FILES['update_post_image']['tmp_name'];
            
        move_uploaded_file($the_post_image_temp, "../images/$the_post_image");
        
        if(empty($the_post_image)) {
            
        $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' "; 
        $select_image_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_image_query)){
            
            $the_post_image = $row['post_image'];
            
            }    
        }   
        $the_post_content = $_POST['update_post_content'];
        $the_post_tags = $_POST['update_post_tags'];
        $the_post_status = $_POST['update_post_status'];

        
          
        $query = "UPDATE posts SET ";
        $query .= "post_category_id = '{$the_post_category_id}', ";
        $query .= "post_title = '{$the_post_title}', ";
        $query .= "post_author = '{$the_post_author}', ";
        $query .= "post_date = now(), ";
        $query .= "post_image = '{$the_post_image}', ";
        $query .= "post_content = '{$the_post_content}', ";
        $query .= "post_tags = '{$the_post_tags}', ";
        $query .= "post_status = '{$the_post_status}' ";
        $query .= "WHERE post_id = '{$the_post_id}' ";
            
            
        $update_post_query = mysqli_query($connection, $query);

        /*confirmQuery($update_post_query);*/
          if(!$update_post_query){
              
              die("Query Failed" . mysqli_error($connection));
          }
            
            
        echo "<h5 class='bg-success'>Post Has Been Updated <a href='../post.php?p_id={$the_post_id}'>View Post</a> | <a href='./posts.php'>Edit More Posts</a></h5>";
        
        }
      
        
        ?>
  
        
          
       
               
                             