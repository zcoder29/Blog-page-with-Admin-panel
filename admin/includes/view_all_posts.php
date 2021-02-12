
<?php

    if(isset($_POST['checkBoxArray'])){
        
       
        foreach($_POST['checkBoxArray'] as $postValueId){
            
           $bulk_options = $_POST['bulk_options'];
            
           switch($bulk_options){
                   
               case 'Published':
                   
               $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                       
               $update_query = mysqli_query($connection, $query);
               if(!$update_query){
                   
                   die('Query failed'. mysqli_error($connection));
               }
                 
                break;
               
               case 'Draft':
                   
               $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                       
               $update_query = mysqli_query($connection, $query);
               if(!$update_query){
                   
                   die('Query failed'. mysqli_error($connection));
               }

               break;
               
               case 'Delete':
                   
               $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                       
               $delete_query = mysqli_query($connection, $query);
               if(!$delete_query){
                   
                   die('Query failed'. mysqli_error($connection));
               }

               break;
               
               case 'Clone':
                   
               $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
                       
               $select_query = mysqli_query($connection, $query);
               if(!$select_query){
                   
                   die('Query failed'. mysqli_error($connection));
               }
            while($row = mysqli_fetch_assoc($select_query)){
                
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                
            }
            
               $post_date = date('d-m-y');
                   
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', 'Draft')";

        $clone_post_query = mysqli_query($connection, $query);

            if(!confirmQuery($clone_post_query) ){
 
            echo "<p>Hola! Your Post Has Been Added</p>";
          }    
                   
            break;
                   
           }     
        }
        
       
    }


?>      
       
       <form action="" method="post">
        <!-- All Posts-->
        <table class="table table-responsive table-striped table-bordered">
           
            <div class="col-xs-4" id="bulkOptionContainer">
             <select class="form-control" name="bulk_options" id="">
               <option value="">Select Options</option>
               <option value="Published">Publish</option>
               <option value="Draft">Draft</option>
               <option value="Delete">Delete</option>
               <option value="Clone">Clone</option>
             </select>
            </div>
            <div class="col-xs-4">
               <input type="submit" class="btn btn-success" name="submit" value="Apply">
               <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>
           
              <thead>
                <tr>
                  <th><input id='selectAllBoxes' type="checkbox"></th>
                  <th>Author</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Image</th>
                  <th>Content</th>
                  <th>Tags</th>
                  <th>Status</th>
                  <th>Views</th>
                  <th>Comments</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
         <!--Show All Posts-->
         <?php  
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_all_posts =mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_posts)){

            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 8);
            $post_tags = substr($row['post_tags'], 0, 10);
            $post_status = $row['post_status'];
            $post_views_count = $row['post_views_count'];
            $post_comment_count = $row['post_comment_count'];
       
        // Post Category Title   
        $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}' ";
        $select_category = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_category)){
        $post_category_title = $row['cat_title'];
        }    
            
         
        $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' ";
        $select_all_comments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_all_comments)){
            
          $post_comment_count = mysqli_num_rows($select_all_comments); 
        }          
                  
        echo " <tr>";

        ?>

        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
        
        <?php
        echo "
        <td>{$post_author}</td>  
        <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>  
        <td>{$post_category_title}</td>  
        <td>{$post_date}</td>  
        <td><img class='img-responsive' width='100' src='../images/{$post_image}' alt='Image'></td>  
        <td>{$post_content}</td>  
        <td>{$post_tags}</td>  
        <td>{$post_status}</td>  
        <td>{$post_views_count}</td>  
        <td>{$post_comment_count}</td>  
        <td><a onClick=\"javascript: return confirm('Are You Sure You Want To Delete'); \"              href='posts.php?delete={$post_id}'>Delete</a>|
            <a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a>|
            <a href='posts.php?reset={$post_id}'>Reset</a>|
            <a href='../post.php?p_id={$post_id}'>View Post</a></td>

      </tr>";
                  
            } 
          
          ?>
          
          
          <!--Delete Post-->
          <?php
         if(isset($_GET['delete'])){ 

            $the_post_id = $_GET['delete'];    

            $query = "DELETE FROM posts WHERE post_id = '{$the_post_id}' ";  
            $delete_post_query = mysqli_query($connection, $query);  
            confirmQuery($delete_post_query);     
            header("Location: ./posts.php");
        } 

                  
        /*Reset Post*/
          
         if(isset($_GET['reset'])){ 

            $the_post_id = $_GET['reset'];    

            $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = '{$the_post_id}' ";  
            $reset_post_query = mysqli_query($connection, $query);  
            confirmQuery($reset_post_query);     
            header("Location: ./posts.php");
        }
                  
       ?>
          
           </tbody>
        </table>
</form>   

       