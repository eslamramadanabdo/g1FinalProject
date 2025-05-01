
<?php  

// database
include '../database/db.php'   ;   
// style
 include '../shared/style.php'  ;    
    

// select all users
    $seslectQuery ="SELECT * FROM `users`";
    $selectResult =   mysqli_query( $conn,$seslectQuery);
 


// delete  user
    if(  isset($_POST['delete']) ){
        $id = $_POST['id'];
        
        $deleteQuery = "DELETE FROM users WHERE id = $id";
        $deleteResult = mysqli_query($conn ,  $deleteQuery);

        if($deleteResult)
        {
           echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    
                    User Deleted Successfully
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                header("location: /g1FinalProject/users/list.php");
        }
        else{
            echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    
                Can't Delete User
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";        
        }
    }
 ?>



<?php    if(isset($_SESSION['id'])){   ?>
<!-- header -->
<?php   include '../shared/header.php'      ?>
    <div class="container">
        <h1 class="text-primary text-center pt-5 pb-5">List All Users Page  </h1>
        <div class="row justify-content-center ">
            <div class="col-lg-8 col-md-10 col-sm-12">

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th  colspan="2" >Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php  foreach(  $selectResult as $item   ) { ?>
                    <tr>
                        <th >  <?php  echo $item['id']  ?>   </th>
                        <td><?php  echo $item['name']  ?></td>
                        <td><?php  echo $item['email']  ?></td>
                        <td><?php  echo $item['role']  ?></td>
                        <td>
                            <form action="" method="POST" style=" display: inline; ">
                                <input hidden type="text" value="<?php  echo $item['id']  ?>" name="id" >
                                <button class="btn btn-sm btn-danger"  name="delete"> Delete</button>
                            </form>
                        </td>
                        <td>edit</td>
                    </tr>

                <?php   } ?>
                </tbody>
                </table>

            </div>
        </div>
    </div>

<!-- closed -->
<?php   include '../shared/script.php'      ?>


<?php   } else {  header("location: /g1FinalProject/auth/login.php "); } ?>