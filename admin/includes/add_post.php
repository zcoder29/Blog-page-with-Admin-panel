
        <div class="col-xs-6">
        <!--Add Post-->
          <?php 
         if(isset($_POST['add_post'])){

            $post_category_id = $_POST['post_category_id'];
            $post_title = $_POST['post_title'];
            $post_author = $_POST['post_author'];
            
            $post_date = date('d-m-y');
             
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
             
            move_uploaded_file($post_image_temp, "../images/$post_image");
             
            $post_content = $_POST['post_content'];
            $post_content= mysqli_real_escape_string($connection, $post_content);
            $post_tags = $_POST['post_tags'];
            $post_status = $_POST['post_status'];
            
            if(empty($post_category_id) || empty($post_title) || empty($post_author) || empty($post_image) || empty($post_content) || empty($post_tags) || empty($post_status)){
                
                echo "Please fill up all the fields";
            } 
            else{
                
            $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
            
            $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
                
            $add_post_query = mysqli_query($connection, $query);
            
            $the_post_id = mysqli_insert_id($connection);
                
                if(!confirmQuery($add_post_query) ){
                
                echo "<p>Hola! Your Post Has Been Added | <a href='../post.php?p_id={$the_post_id}'>View Post</a></p>";
              }
            }
         }
            ?>
        
       <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="post-author">Author Name</label>
                <input type="text" name="post_author" class="form-control">
            </div>
            <div class="form-group">
               <label for="post-title">Title</label>
                <input type="text" name="post_title" class="form-control">
            </div>
            <div class="form-group">
               <label for="post-category-id">Category</label>
                <select name="post_category_id" id="">
                <option value="" class="active disabled">Choose One</option>
             <?php

                $query = "SELECT * FROM categories";
                $select_category_query = mysqli_query($connection, $query);

                confirmQuery($select_category_query);
                while($row = mysqli_fetch_assoc($select_category_query)){

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo " <option value='{$cat_id}'>$cat_title</option>";

                }
                ?>   
                   
                </select>
            </div>
            <div class="form-group">
               <label for="post-image">Upload Image</label>
                <input type="file" name="image">
            </div>
              <div class="form-group">
               <label for="post-content">Post Content</label><br>
                <textarea class="form-control" name="post_content"  id="body" cols="30" rows="30"></textarea>
            </div>
            <div class="form-group">
               <label for="post-status">Status</label>
                <select name="post_status" id="">
                   <option value="" class="disabled">Choose One</option>
                    <option value="Published">Publish</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>
              <div class="form-group">
               <label for="post-tags">Post Tags</label>
                <input type="text" name="post_tags" class="form-control">
            </div>
            
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="add_post" value="Add Post"> 
            </div>
    </form>
</div>









         

         
         