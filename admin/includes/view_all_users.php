
        
        <!-- All Posts-->
          <div class="col-xs-12">
            <table class="table table-responsive table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Date</th>
                  <th>Change to Admin</th>
                  <th>Change to Subscriber</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
         <!--Show All Comments-->
         <?php  
    $query = "SELECT * FROM users";
    $select_all_users =mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_users)){

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_date = $row['date'];
            
       
           
        echo " <tr>
                <td>{$user_id}</td>
                <td>{$user_name}</td>  
                <td>{$user_firstname}</td>  
                <td>{$user_lastname}</td>
                <td>{$user_email}</td>
                <td>{$user_role}</td>
                <td>{$user_date}</td>
                <td><a href='./users.php?change_to_admin={$user_id}'>Admin</a></td>
                <td><a href='./users.php?change_to_sub={$user_id}'>Subscriber</a></td>
                <td><a onClick=\"javascript: return confirm('Are You Sure You Want To Delete'); \"            href='./users.php?delete={$user_id}'>Delete</a> | 
                    <a href='./users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>
                
               </tr>";  
          
            }
                  
            ?>
            

         <!--Delete Comment-->
          <?php
         if(isset($_GET['change_to_admin'])){ 

            $the_user_id = $_GET['change_to_admin'];    

            $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = '{$the_user_id}' ";  
            $change_to_admin_query = mysqli_query($connection, $query);  
            confirmQuery($change_to_admin_query);     
            header("Location: ./users.php");
        } 
  
       ?>
         <!--Delete Comment-->
          <?php
         if(isset($_GET['change_to_sub'])){ 

            $the_user_id = $_GET['change_to_sub'];    

            $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = '{$the_user_id}' ";  
            $change_to_sub_query = mysqli_query($connection, $query);  
            confirmQuery($change_to_sub_query);     
            header("Location: ./users.php");
        } 
  
       ?>
          <!--Delete Comment-->
          <?php
         if(isset($_GET['delete'])){ 

            $the_user_id = $_GET['delete'];    

            $query = "DELETE FROM users WHERE user_id = '{$the_user_id}' ";  
            $delete_user_query = mysqli_query($connection, $query);  
            confirmQuery($delete_user_query);     
            header("Location: ./users.php");
        } 
  
       ?>
           </tbody>
        </table>
    </div>   
       

       