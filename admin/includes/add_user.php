
        <div class="col-xs-6">
        <!--Add Post-->
          <?php 
         if(isset($_POST['add_user'])){

            $user_name = $_POST['user_name'];
            
            $user_password = $_POST['user_password'];
            /*$user_password = mysqli_real_escape_string($connection, $user_password);*/
            
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name']; 
            
            move_uploaded_file($user_image_temp, "../images/$user_image");
             
            $user_date = date('d-m-y');
            $user_role = $_POST['user_role']; 

            $query = "SELECT * FROM users WHERE user_email = '$user_email' ";
            $select_email_query = mysqli_query($connection, $query);
            
            //Encrypt Password 
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12) );
             
             
            if(empty($user_name) || empty($user_password) || empty($user_firstname) || empty($user_lastname) || empty($user_email) || empty($user_image) || empty($user_date) || empty($user_role) ){
                
                echo "Please fill up all the fields";
            } 
            else if( mysqli_num_rows($select_email_query) == 1 ) {  
                
                echo "This Email Address already exist";    
            
            }
 
            else{
                
                
            $query = "INSERT INTO users(user_firstname, user_lastname, user_name, user_password, user_email, user_image, date, user_role) ";
            
            $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_name}', '{$user_password}', '{$user_email}', '{$user_image}', now(), '{$user_role}')";
                
            $add_user_query = mysqli_query($connection, $query);
            
                if(!confirmQuery($add_user_query) ){
                
                echo "<p>Your account has been created <a href='users.php'>View Users</a></p>";
              }
            }
         }
            ?>
           
       <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="user-firstname">Firstname</label>
                <input type="text" name="user_firstname" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-lastname">Lastname</label>
                <input type="text" name="user_lastname" class="form-control">
            </div><div class="form-group">
               <label for="username">Username</label>
                <input type="text" name="user_name" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-email">Email</label>
                <input type="email" name="user_email" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-password">Password</label>
                <input type="password" name="user_password" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-image">Upload Image</label>
               <img src="../images/<?php echo $user_image; ?>" width="100" class="img-responsive" alt="User Image">
                <input type="file" name="user_image" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-role">role</label>
                <select name="user_role" id="">
                <option value="" class="active disabled">Choose One</option>
                <option value="Subscriber">Subscriber</option>
                <option value="Admin">Admin</option>                     
                </select>
            </div>
            
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="add_user" value="Add User"> 
            </div>
    </form>
</div>









         

         
         