<?php   
    require_once "./database/db.php";


?>

<!-- head of html file  -->
<?php   include "./shared/style.php"; ?>

<!-- header -->
<?php   include "./shared/header.php"; ?>


<h1 class="text-primary text-center pt-3 ">Welcome To Our System</h1>



<?php  echo isset($_SESSION['id']); ?>





<!-- style and closed of html file -->
<?php   include "./shared/script.php"; ?>
