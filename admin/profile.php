
  <?php include "includes/header.php"; ?>
   
   
  <?php

    if(isset($_SESSION['user_name'])){
        
     $username = $_SESSION['user_name'];
    
     $query = "SELECT * FROM users WHERE user_name = '$username' ";
     $select_user_profile_query = mysqli_query($connection, $query);
        
     while($row = mysqli_fetch_assoc($select_user_profile_query)){
         
        $user_id = $row['user_id'];
        $username = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
         
         
         
     }    
   
    }

    ?>


 <?php

 if(isset($_POST['update_profile'])) {
     

    $updated_username = $_POST['update_user_name'];
    $updated_password = $_POST['update_password'];
    $updated_firstname = $_POST['update_firstname'];
    $updated_lastname = $_POST['update_lastname'];
    $updated_email = $_POST['update_email'];
    $user_date = date('d-m-y');
     
    $updated_image = $_FILES['update_image']['name'];
    $updated_image_temp = $_FILES['update_image']['tmp_name']; 
    move_uploaded_file($updated_image_temp, "../images/$updated_image");
    
    
     
    if(empty($updated_image)) {
                
        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
        $select_user_image = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_user_image)){

            $updated_image = $row['user_image'];

        } 
      }
     if(empty($updated_password)){
        
        $query = "SELECT user_password FROM users WHERE user_name = '{$username}' ";
        $select_user_password = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_user_password)){
                
            $password = $row['user_password'];
                
        }
         
     }else{
         
         $password = password_hash($updated_password, PASSWORD_BCRYPT, array('cost' => 10) );
     }
    
     $query = "UPDATE users SET ";   
     $query .= "user_name = '{$updated_username}', ";   
     $query .= "user_password = '{$password}', ";   
     $query .= "user_firstname = '{$updated_firstname}', ";   
     $query .= "user_lastname = '{$updated_lastname}', ";   
     $query .= "user_email = '{$updated_email}', ";   
     $query .= "user_image = '{$updated_image}', ";   
     $query .= "date = now() ";
     $query .= "WHERE user_name = '{$username}'";   
        
     $edit_user_query = mysqli_query($connection, $query);
      if(!confirmQuery($edit_user_query)){
              
          echo "<p>Your Profile Has Been Updated</p>";
      }
       
     header("Location: index.php");
    }
?> 
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['user_name'];  ?></small>
                    </h1>

           <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="user-firstname">Firstname</label>
                <input type="text" value="<?php echo $user_firstname; ?>" name="update_firstname" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-lastname">Lastname</label>
                <input type="text" value="<?php echo $user_lastname; ?>" name="update_lastname" class="form-control">
            </div><div class="form-group">
               <label for="username">Username</label>
                <input type="text" value="<?php echo $username; ?>" name="update_user_name" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-email">Email</label>
                <input type="email" value="<?php echo $user_email; ?>" name="update_email" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-password">Password</label>
                <input type="password" autocomplete="off" name="update_password" class="form-control">
            </div>
            <div class="form-group">
               <label for="user-image">Upload Image</label>
               <img src="../images/<?php echo $user_image; ?>" alt="" width="100" class="img-responsive">
                <input type="file" name="update_image" class="form-control">
            </div> 
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile"> 
            </div>
        </form>
            
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>

