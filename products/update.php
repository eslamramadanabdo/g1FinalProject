
<?php  

// database
include '../database/db.php'   ;   
// style
 include '../shared/style.php'  ;    

//  categories
    $CatQuery = "SELECT * FROM `categories`";
    $categoires = mysqli_query($conn , $CatQuery);


// get one product
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $selectOneProductQuery = "SELECT products.id as prodID , products.name , products.new_price , products.old_price , products.image, products.sale, products.quantity, products.feature, products.status, products.availabale, products.rate, products.category_id, categories.id, categories.name as catName from products left join categories on products.category_id = categories.id where products.id = $id ";
        $selectOneProductQueryResult = mysqli_query($conn , $selectOneProductQuery);

        $count = mysqli_num_rows($selectOneProductQueryResult);
        if($count > 0){
            $product = mysqli_fetch_assoc($selectOneProductQueryResult);
        }
    }
   

// create product
    if(  isset($_POST['btn'])  ){

        // get data
        $id              = $_POST['id'];
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

        echo $id;

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
    
    
            $updateQuery = "UPDATE `products` SET `name` = '$name', `new_price` = $new_price, `old_price` = $old_price, `image` = '$image', `sale` = $sale, `quantity` = $quantity, `feature` = '$feature', `status` = '$status', `availabale` = '$available', `rate` = $rate, `category_id` = $category_id WHERE `products`.`id` = $id";
            $updateResult = mysqli_query($conn , $updateQuery );
    
            if($updateResult)
            {
            //    echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        
            //             Product update Successfully
            //             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            //         </div>";
            header("location: /g1FinalProject/products/list.php");
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
        <h1 class="text-primary text-center pt-5 pb-5">Update Product Page  </h1>
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-10 col-sm-12">

            <div class="card bg-dark text-light">
                <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data" >

                    <input type="number" hidden  name="id"  value="<?php  echo $product['prodID']   ?>">

                    <div class="mb-3">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?php  echo $product['name'] ?>" name="name" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">New Price</label>
                        <input type="number" class="form-control" value="<?php  echo $product['new_price'] ?>" name="new_price" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Old Price</label>
                        <input type="number" class="form-control" value="<?php  echo $product['old_price'] ?>" name="old_price" >
                    </div>
                    
                    <div class="mb-3">
                        <label  class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Product Sale</label>
                        <input type="number" class="form-control" value="<?php  echo $product['sale'] ?>" name="sale" >
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Quantity</label>
                        <input type="number" class="form-control" value="<?php  echo $product['quantity'] ?>" name="quantity" >
                    </div>
                    
                    <div class="mb-3">
                        <label  class="form-label">Feature</label>
                        <select  class="form-select" name="feature">
                            <option value="New"       <?=  $product['feature']=='New' ?  "selected" :  ''   ?>      >New</option>
                            <option value="Feature"   <?=  $product['feature']=='Feature' ?   "selected" :  ''   ?>  >Feature</option>
                            <option value="Brand"     <?=  $product['feature']=='Brand' ?  "selected" :  ''   ?>   >Brand</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Status</label>
                        <select  class="form-select" name="status">
                            <option value="active"  <?=  $product['status']=='active' ?  "selected" :  ''   ?> >Active</option>
                            <option value="inActive" <?=  $product['status']=='inActive' ?  "selected" :  ''   ?>>inActive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Availabel</label>
                        <select  class="form-select" name="available">
                            <option value="1"  <?=  $product['availabale']=='1' ?  "selected" :  ''   ?> >Yes </option>
                            <option value="0"  <?=  $product['availabale']=='0' ?  "selected" :  ''   ?> >No</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label  class="form-label">Rate</label>
                        <select  class="form-select" name="rate">
                            <option value="1" <?= $product['rate']=='1' ?  "selected" :  ''   ?> >1 </option>
                            <option value="2" <?= $product['rate']=='2' ?  "selected" :  ''   ?> >2</option>
                            <option value="3" <?= $product['rate']=='3' ?  "selected" :  ''   ?> >3</option>
                            <option value="4" <?= $product['rate']=='4' ?  "selected" :  ''   ?> >4</option>
                            <option value="5" <?= $product['rate']=='5' ?  "selected" :  ''   ?> >5</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Categories</label>
                        <select  class="form-select" name="category_id">
                            <?php    foreach($categoires as $item){     ?>
                                <option value="<?php  echo $item['id'] ?> "
                                    <?= $product['category_id'] == $item['id'] ?  "selected" :  ''   ?>
                                >  <?php  echo $item['name'] ?>    </option>
                            <?php } ?>
                        </select>
                    </div>


                    <button type="submit" name="btn" class="btn btn-primary">Update</button>
                </form>
                </div>
            </div>

            </div>
        </div>
    </div>





<!-- closed -->
<?php   include '../shared/script.php'      ?>
<?php   } else {  header("location: /g1FinalProject/auth/login.php "); } ?>