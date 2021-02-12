<?php 

if(isset($_GET['user_id'])){
    
    $the_user_id = $_GET['user_id'];
}
   

    $query = "SELECT * FROM users WHERE user_id = '$the_user_id' ";
    $select_users_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_users_query)){
        
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_date = $row['date'];
        $user_role = $row['user_role'];
    
    }
    
 
//Edit Post

 if(isset($_POST['edit_user'])){

    $username  = $_POST['user_name'];
    $firstname = $_POST['user_firstname'];
    $lastname  = $_POST['user_lastname'];
    $password  = $_POST['user_password']; 
    $email     = $_POST['user_email'];

    $image = $_FILES['user_image']['name'];
    $image_temp = $_FILES['user_image']['tmp_name']; 

    move_uploaded_file($image_temp, "../images/$image");

    $date = date('d-m-y');
    $role = $_POST['user_role']; 

    if(empty($username) || empty($firstname) || empty($lastname) || empty($password) || empty($email)){

        $message = "<h4>Fields cannot be empty</h4>";

    }else{
         
    if(!empty($password)){

    $query = "SELECT user_password FROM users WHERE user_id = '$the_user_id' ";
    $select_password_query = mysqli_query($connection, $query);
        
    while($row = mysqli_fetch_array($select_password_query)){
        
        $db_user_password = $row['user_password'];
    } 
        
        if($db_user_password !== $password) {
        
    // Encrypt Password 
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));   
    
        }
        
    }   
    

    if(empty($user_image)) {

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_user_image = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_user_image)){

        $image = $row['user_image'];
        }    
    }
         
    $query = "UPDATE users SET ";
    $query .= "user_name = '{$username}', ";
    $query .= "user_password = '{$password}', ";
    $query .= "user_firstname = '{$firstname}', ";
    $query .= "user_lastname = '{$lastname}', ";
    $query .= "user_email = '{$email}', ";
    $query .= "user_image = '{$image}', ";
    $query .= "date = now(), ";
    $query .= "user_role = '{$role}' ";
    $query .= "WHERE user_id = '{$the_user_id}' ";


    $update_user_query = mysqli_query($connection, $query);

     if(!confirmQuery($update_user_query)){

        $message = "Your Profile Has Been Updated <a href='./users.php'>View Profile</a>";
      }
 
 }
     
 }else{
     
     $message = ""; 
 }    
            

?>

       
<div class="col-xs-6">
      <h4><?php echo $message; ?></h4>
       <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="user-firstname">Firstname</label>
                <input type="text" value="<?php echo $user_firstname; ?>" name="user_firstname" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-lastname">Lastname</label>
                <input type="text" value="<?php echo $user_lastname; ?>" name="user_lastname" class="form-control">
            </div><div class="form-group">
               <label for="username">Username</label>
                <input type="text" value="<?php echo $user_name; ?>" name="user_name" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-email">Email</label>
                <input type="email" value="<?php echo $user_email; ?>" name="user_email" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-password">Password</label>
                <input type="password" value="<?php echo $user_password; ?>" name="user_password" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-image">Upload Image</label>
               <img src="../images/<?php echo $user_image; ?>" alt="" width="100" class="img-responsive">
                <input type="file" name="user_image" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-role">role</label>
                <select name="user_role" id="">
                <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                <?php
                    
                    if($user_role == 'Admin' ){
                      
                        echo "<option value='Subscriber'>Subscriber</option>";  
                    }
                    else{
                        
                      echo "<option value='Admin'>Admin</option>"; 
                    }
                    ?>
                                   
                </select>
            </div>
            
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User"> 
            </div>
    </form>
</div>






         

         
         