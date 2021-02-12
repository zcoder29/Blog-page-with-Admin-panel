
<?php include "includes/header.php"; ?>

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
            </div>
        <div class="col-xs-6">
        <!--Add Category-->
          <?php add_categories(); ?>
           <form action="" method="post">
            <div class="form-group">
               <label for="cat-title">Add Category</label>
                <input type="text" name="cat_title" class="form-control">
            </div>
           <div class="form-group">
             <input class="btn btn-primary" type="submit" name="add_category" value="Add Category"> 
            </div>
        </form>
        
        <!--Update Category-->
        <?php
        if(isset($_GET['edit'])){

        $cat_id = $_GET['edit'];

        include "includes/update_categories.php";    

        }

      ?>
          
        </div>
        
        <!-- All Categories-->
          <div class="col-xs-6">
            <table class="table table-responsive table-striped table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Category Name</th>
                  <th>Option</th>
              </tr>
              </thead>
              <tbody>
         <!--Show All Category-->
         <?php  show_all_category(); ?> 
           
           <!--Delete Category--> 
            <?php delete_category(); ?>
            
           </tbody>
        </table>
    </div>   
       

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>






