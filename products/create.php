
<?php  

// database
include '../database/db.php'   ;   
// style
 include '../shared/style.php'  ;    

//  categories
    $CatQuery = "SELECT * FROM `categories`";
    $categoires = mysqli_query($conn , $CatQuery);


// create product

    if(  isset($_POST['btn'])  ){

        // get data
        $name            =  trim($_POST['name']);
        $new_price       =  $_POST['new_price'];
        $old_price       =  $_POST['old_price'];
        $sale            =  $_POST['sale'];
        $quantity        =  $_POST['quantity'];
        $feature         =  $_POST['feature'];
        $status          =  $_POST['status'];
        $available       =  $_POST['available'];
        $rate            =  $_POST['rate'];
        $category_id     =  $_POST['category_id'];
        $image           =  $_FILES['image']['name'];

        $errors = [];
        // validate over data
        if(empty($name)){
            $errors[] = "Name Is Required";
        }

        if(empty($new_price)){
            $errors[] = "New Price Is Required";
        }else if(  $new_price < 0  ){
            $errors[] = "New Price should be Greater than 0";
        }

        if(empty($old_price)){
            $errors[] = "old Price Is Required";
        }else if(  $old_price < 0  ){
            $errors[] = "old Price should be Greater than 0";
        }

        if(empty($quantity)){
            $errors[] = "quantity Is Required";
        }else if(  $quantity < 0  ){
            $errors[] = "quantity should be Greater than 0";
        }

        if(empty($image)){
            $errors[] = "image Is Required";
        }



        if(empty($errors)){
            $tagretFile = __DIR__  .   '/../storage/uploads/'  . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name']  ,  $tagretFile );
    
    
            $insertQuery = "INSERT INTO products VALUES(null , '$name' , $new_price , $old_price , '$image' , $sale , $quantity, '$feature' , '$status' , '$available' , '$rate' , $category_id , null , null)";
            $insertResult = mysqli_query($conn , $insertQuery );
    
            if($insertResult)
            {
               echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        
                        Product Created Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            else{
                echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            
                    ther are some errors
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";        
            }
        }else{
            foreach($errors as $error){
                if (is_array($error)) {
                    $error = implode(', ', $error); // حول المصفوفة إلى نص مفصول بفواصل
                }
                
                echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    {$error}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }










    } 


 ?>

<?php    if(isset($_SESSION['id'])){   ?>

<!-- header -->
<?php   include '../shared/header.php'      ?>

<!-- notification -->
<?php   include '../shared/notification.php'      ?>



    <div class="container pb-5">
        <h1 class="text-primary text-center pt-5 pb-5">Create Product Page  </h1>
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-10 col-sm-12">

            <div class="card bg-dark text-light">
                <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data" >

                    <div class="mb-3">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">New Price</label>
                        <input type="number" class="form-control" name="new_price" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Old Price</label>
                        <input type="number" class="form-control" name="old_price" >
                    </div>
                    
                    <div class="mb-3">
                        <label  class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Product Sale</label>
                        <input type="number" class="form-control" name="sale" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" >
                    </div>
                    
                    <div class="mb-3">
                        <label  class="form-label">Feature</label>
                        <select  class="form-select" name="feature">
                            <option value="New">New</option>
                            <option value="Feature">Feature</option>
                            <option value="Brand">Brand</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Status</label>
                        <select  class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inActive">inActive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Availabel</label>
                        <select  class="form-select" name="available">
                            <option value="1">Yes </option>
                            <option value="0">No</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label  class="form-label">Rate</label>
                        <select  class="form-select" name="rate">
                            <option value="1">1 </option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Categories</label>
                        <select  class="form-select" name="category_id">
                            <?php    foreach($categoires as $item){     ?>
                                <option value="<?php  echo $item['id'] ?> ">  <?php  echo $item['name'] ?>    </option>
                            <?php } ?>
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