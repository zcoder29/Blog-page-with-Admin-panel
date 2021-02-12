      
        <!--Update Category-->
           <form action="" method="post">
            <div class="form-group">
               <label for="cat-title">Update Category</label>
               
               <?php
              
                    
                $query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}' ";
                $select_category =mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_category)){
                
                $cat_title = $row['cat_title'];    
                    
                ?>
               
               <input type="text" name="update_cat_title" class="form-control" value="<?php echo $cat_title; ?>">
                
                <?php 
                }
                  
                ?>
                
            </div>
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="update_category" value="Update Category"> 
            </div>
            </form>
            
        <?php
        if(isset($_POST['update_category'])){

        $the_cat_title = $_POST['update_cat_title'];

        $query = "SELECT * FROM categories WHERE cat_title = '{$the_cat_title}' ";
        $select_category =mysqli_query($connection, $query);
            
        if( mysqli_num_rows($select_category) == 1 ){

            echo "This category already exist";
        }
        
        else{
             
         $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = '{$cat_id}' ";

        $update_category_query = mysqli_query($connection, $query);

        confirmQuery($update_category_query); 
        header("Location: categories.php");
            
            }
        }
        ?>
        
        
         