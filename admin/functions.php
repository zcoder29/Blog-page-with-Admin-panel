<?php

/*Users Online*/

function users_online(){
    

    if(isset($_GET['onlineusers'])){
        
    global $connection;
    
    if(!$connection){
        
        session_start();
        
        include("../includes/db.php");
        
    
        
$session = session_id(); //hold session id
$time = time();
$time_out_in_seconds = 5;
$time_out = $time - $time_out_in_seconds;

        
    $query = "SELECT * FROM users_online WHERE session = '$session' ";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL){

           mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

    }else{

           mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");     
        }

       $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' "); 

        echo $count_user = mysqli_num_rows($users_online_query);
        
     
    }
        
        
    } // Get Request isset() 
        
}

users_online(); // Calling the function



/*Confirm Query*/

function confirmQuery($result){
    
global $connection;
 
if(!$result){
     
     die("Query Failed" . mysqli_error($connection));
 }

}

/*Show All Category*/
function show_all_category(){
    
global $connection;    
    $query = "SELECT * FROM categories";
        $select_all_categories =mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_categories)){

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
       
        echo " <tr>
                <td>{$cat_id}</td>
                <td>{$cat_title}</td>  
                <td><a href='categories.php?delete={$cat_id}'>Delete</a>|<a href='categories.php?edit={$cat_id}'>Update</a></td>
                  
              </tr>";
                  
            } 
}


/*Add Category*/
function add_categories(){
    
global $connection;

if(isset($_POST['add_category'])){

            $cat_title = $_POST['cat_title'];

            $query = "SELECT * FROM categories WHERE cat_title = '{$cat_title}' ";
            $query = mysqli_query($connection, $query);
            
            if(mysqli_num_rows($query) == 1 ){
                
                echo "This Category has been already added";
            }
       
            else if( $cat_title == "" || empty($cat_title) ){
                
                echo "This field should not be empty";
            }
            
            else {
                
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}')";
                
            $add_category_query = mysqli_query($connection, $query);
            confirmQuery($add_category_query);
                
            if($add_category_query){
                
                echo "<p>Category has been added</p>";
              }
            }
           }   
}

/*Delete Category*/

function delete_category(){
    
global $connection;
      
    if(isset($_GET['delete'])){ 

    $the_cat_id = $_GET['delete'];    

    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";  
    $delete_category_query = mysqli_query($connection, $query);  
    header("Location: categories.php");      

    confirmQuery($delete_category_query);      
     
     }     
    }






?>