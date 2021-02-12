<?php phpinfo();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   
   
   
   <?php  //Dynamic PHP  ?> 
  
    
    <?php  $title = "Edwin diaz's site"; ?>
    <div class="demo">
        <ul>
            <li><a href="" class="a1"></a></li>
            <li><a href="" class="a1"></a></li>
            <li><a href="" class="a1"></a></li>
            <li><a href="" class="a1"></a></li>
            <li><a href="" class="a1"></a></li>
        </ul>
    </div>
    
    <h1><?php echo $title; ?></h1>
    
    <?php  //Single line comment  ?>
    
    <?php  
    
    /*
    Multiple lines comments
    Multiple lines comments
    Multiple lines comments
    Multiple lines comments
    */
    
    ?>
    
    <?php
    
    //Variables in php
    
    $NAME = 'Zaman';
    $number = 100;
    
    echo $NAME. " ". $number;
    
    echo "<h1>$NAME $number</h1>"; 
        
 
    ?>
    
    <?php
    
//    Math in php
    
    $pen = 100;
    $pensil= 29;
    $money = 11;
    $eraser = 2;
    
    echo $pen-$pensil + $money * $eraser / $pen + $pensil;
    echo "<br>";
    echo $pen-$pensil ;
    echo "<br>";
    echo $money * $eraser / $pen ;
    echo "<br>";
    echo $eraser / $pen / $pensil ;
    echo "<br>";
    echo "<br>";
    echo "<br>";
    
  //    arrays in php  
    
    $list = array(22,33,44,76,86765,'HARRY',11233);
    $list2 = [22,33,44,76,86765,'HARRY',11233];
    
    echo $list[5];
    echo "<br>";
    echo $list[0];
    echo "<br>";
    echo $list[3];
    echo "<br>";
    
    print_r($list);    
    echo "<br>";
    print_r($list2);
    echo "<br>";
    echo "<br>";
    echo "<br>";
     
  //    associative array in php  
    
    $names = ["first_name" => 'Nowme' , 'last_name' => 'Zaman', 'id' => 12];
    echo $names['first_name'] ." ". $names['last_name'] . "<br>Id :". " ". $names['id'];
    
 

//................. 
    
// This whole php code for form submission can be written in a different page. Ex: form_process.php
    
//     if(isset($_POST['submit'])){
//         
////       echo "yes it works";  
//         
//      if(isset($_POST['username']) && isset($_POST['password']))   {
//          
//          $username = $_POST['username'];
//          $password = $_POST['password'];
//        
//          if(strlen($username) < 5 || strlen($username) > 10){
//            
//            echo "Username has to be longer than 5 characters and less than 10 characters";
//        }
//       else{
//           
//         echo "<br>your account has been created.<br>";
//          echo $username . "<br>";
//          echo $password."<br>";
//       }
//        }  
//  
//     }
//.................
    
  if(isset($_POST['submit']))  {
      
      $name = ["Amin","loca","sadia","jasi"];
      
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      if(!in_array($username, $name)){
          
          echo "Sorry you are not allowed";
      }
      else{
          
          echo "Welcome";
      }
      
  }
    
  //    Math in php  
  //    Math in php  
    ?>
    
<!--    form in php -->
    <form action="index.php" method="post">
        
        <input type="text" placeholder="Username" name="username"><br>
        <input type="password" placeholder="Password" name="password"><br>
        <input type="submit" name="submit">
        
    </form>
    
     
    
    
</body>
</html>