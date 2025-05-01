
<?php  

// database
include '../database/db.php'   ;   
// style
 include '../shared/style.php'  ;    
    


// create users

    if(  isset($_POST['btn'])  ){
        $name      =  $_POST['name'];
        $email     =  $_POST['email'];
        $password  =  $_POST['pass'];
        $role      =  $_POST['role'];

        $insertQuery = "INSERT INTO users VALUES(null , '$name' , '$email' , '$password' , '$role')";
        $insertResult = mysqli_query($conn , $insertQuery );

        if($insertResult)
        {
           echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    
                    User Created Successfully
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        else{
            echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        
                User Created Successfully
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";        
        }

    } 


 ?>

<?php    if(isset($_SESSION['id'])){   ?>

<!-- header -->
<?php   include '../shared/header.php'      ?>

<!-- notification -->
<?php   include '../shared/notification.php'      ?>



    <div class="container pb-5">
        <h1 class="text-primary text-center pt-5 pb-5">Create User Page  </h1>
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-10 col-sm-12">

            <div class="card bg-dark text-light">
                <div class="card-body">
                <form method="POST"  >
                    <div class="mb-3">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" >
                    </div>
                    
                    <div class="mb-3">
                        <label  class="form-label">Role</label>
                        <select  class="form-select" name="role">
                            <option value="admin">Admin</option>
                            <option value="user">Users</option>
                        </select>
                    </div>
                    <button type="submit" name="btn" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>

            </div>
        </div>
    </div>





<!-- closed -->
<?php   include '../shared/script.php'      ?>
<?php   } else {  header("location: /g1FinalProject/auth/login.php "); } ?>