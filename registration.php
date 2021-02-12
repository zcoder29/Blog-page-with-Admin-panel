<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->   
<?php  include "includes/navigation.php"; ?>
<?php
if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $user_date = date('d-m-y');
    
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name']; 
    move_uploaded_file($image_temp, "images/$image");

    //Check Email with existed email
    $query = "SELECT * FROM users WHERE user_email = '$email' ";
    $select_query = mysqli_query($connection, $query);
    
    if( empty($username) || empty($email) || empty($password) || empty($firstname) || empty($lastname) || empty($image) ){
     
       $message = "Fields cannot be empty"; 
    
    }elseif(mysqli_num_rows($select_query) == 1 ){
 
        $message = "This Email Address already exist";    

    } else{
        
     //Encrypt Password   
     $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12) );

  
    $query = "INSERT INTO users(user_firstname, user_lastname, user_name, user_password, user_email, user_image, date, user_role) ";
            
    $query .= "VALUES('{$firstname}', '{$lastname}', '{$username}', '{$password}', '{$email}', '{$image}', now(), 'Subscriber')";

    $add_user_query = mysqli_query($connection, $query);

        if($add_user_query){

        $message = "You Have Successfully Registered";
        
        }else{
            
            die("Query failed" . mysqli_error($connection));
        }               
    }
       
}else{
    
    $message = "";
     
}
    ?>
        
<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class='text-center'>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                       
                       <h4 class='text-center'><?php echo $message; ?></h4>
                        
                        <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                           <label for="user-image" class="sr-only">Upload Image</label>
                           <img src="../images/<?php echo $image; ?>" width="100" class="img-responsive" alt="User Image">
                           <input type="file" name="image" class="form-control">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>
