
<?php  

// database
include '../database/db.php'   ;   
// style
 include '../shared/style.php'  ;    
    


    if(isset($_POST['btn'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'] ;

        $selectData = "SELECT * FROM users WHERE email = '$email' and  password = '$pass'";
        $slectResult = mysqli_query($conn , $selectData);

        $count = mysqli_num_rows($slectResult);

        if($count == 1){
            
            $user = mysqli_fetch_assoc($slectResult);

            $_SESSION['id']  = $user['id'];

            header("location: /g1FinalProject/index.php");

        }else{
            echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    
            Please enter email or password valid
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }



    }


 ?>



    <div class="container pb-5">
        <h1 class="text-primary text-center pt-5 pb-5">Login Page  </h1>
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-10 col-sm-12">

            <div class="card bg-dark text-light">
                <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label  class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" >
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
