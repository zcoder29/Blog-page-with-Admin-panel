<?php

if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $connection = mysqli_connect('localhost','root','','cms');
    
    if(!$connection){
        die("Connection failed" . mysqli_error);
    }
    
    
    $query = "INSERT INTO users(username,password) ";
    $query .= "VALUES ('$username','$password')";
    
    $result = mysqli_query($connection,$query);
    
    if(!$result){
        
        die("Query Failed" . mysqli_error);
    }
    
    
    
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login Page</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    
    <div class="container">
    <div class="col-xs-6">
      <form action="login.php" method="post">
          <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control">
          </div>
          
          <div class="form-group">
          <label for="password">Password</label>
          <input type="password"  class="form-control" name="password">
          </div>
          <input class="btn btn-primary" type="submit" name="submit" value="Send">
          
          
      </form>
  </div>
  </div>
  
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>