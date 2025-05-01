
<?php  

// database
include '../database/db.php'   ;   
// style
 include '../shared/style.php'  ;    
    

// select all users
    $seslectQuery ="SELECT products.id as prodID , products.name , products.new_price , products.old_price , products.image, products.sale, products.quantity, products.feature, products.status, products.availabale, products.rate, products.category_id, categories.id, categories.name as catName from products left join categories on products.category_id = categories.id;";
    $selectResult =   mysqli_query( $conn,$seslectQuery);
 


// delete  user
    // if(  isset($_POST['delete']) ){
    //     $id = $_POST['id'];
        
    //     $deleteQuery = "DELETE FROM users WHERE id = $id";
    //     $deleteResult = mysqli_query($conn ,  $deleteQuery);

    //     if($deleteResult)
    //     {
    //        echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    
    //                 User Deleted Successfully
    //                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    //             </div>";
    //             header("location: /g1FinalProject/users/list.php");
    //     }
    //     else{
    //         echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    
    //             Can't Delete User
    //             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    //         </div>";        
    //     }
    // }
 ?>



<?php    if(isset($_SESSION['id'])){   ?>
<!-- header -->
<?php   include '../shared/header.php'      ?>
    <div class="container">
        <h1 class="text-primary text-center pt-5 pb-5">List All Products Page eng  Islam </h1>
        <div class="row justify-content-center ">
            <div class="col-lg-12 col-md-12 col-sm-12">

            <table class="table">
                <thead>
                    <tr>
                    <th >ID</th>
                    <th >Image</th>
                    <th >Name</th>
                    <th >New Price</th>
                    <th >Old Price</th>
                    <th >Sale</th>
                    <th >Quantity</th>
                    <th >Feature</th>
                    <th >Status</th>
                    <th >Availabel</th>
                    <th >Rate</th>
                    <th >Category Name</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php  foreach(  $selectResult as $item   ) { ?>
                    <tr>
                        <th >  <?php  echo $item['prodID']  ?>   </th>
                        <td>
                            <div class="" style="width: 60px ; height: 60px; border-radius: 50%; ">
                                <img src="../storage/uploads/<?php  echo $item['image']  ?>" style=" border-radius: 50%; width: 100%; height: 100%; " alt="">
                            </div>
                        </td>
                        <td><?php  echo $item['name']  ?></td>
                        <td><?php  echo $item['new_price']  ?></td>
                        <td><?php  echo $item['old_price']  ?></td>
                        <td><?php  echo $item['sale']  ?></td>
                        <td><?php  echo $item['quantity']  ?></td>
                        <td>
                            <?php  if( $item['feature'] ==  'Feature'   ) { ?>

                                <h5> <span class="badge bg-primary"> <?php  echo $item['feature']  ?></span></h5>
                            
                            <?php }else if($item['feature'] ==  'New' ){ ?>

                                <h5> <span class="badge bg-warning"> <?php  echo $item['feature']  ?></span></h5>
                            
                            <?php }else { ?>

                                <h5> <span class="badge bg-info"> <?php  echo $item['feature']  ?></span></h5>

                           <?php } ?>
                        </td>
                        <td><?php  echo $item['status']  ?></td>
                        <td><?php  echo $item['availabale']  ?></td>
                        <td><?php  echo $item['rate']  ?></td>
                        <td><?php  echo $item['catName']  ?></td>
                        <td>
                            <form action="" method="POST" style=" display: inline; ">
                                <input hidden type="text" value="<?php  echo $item['prodID']  ?>" name="id" >
                                <button class="btn btn-sm btn-danger"  name="delete"> Delete</button>
                            </form>
                        </td>
                        <td>
                            <a href="/g1FinalProject/products/update.php?edit=<?php  echo $item['prodID']  ?>" class="btn btn-sm btn-primary">edit</a>
                        </td>
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