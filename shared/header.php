


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NTI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/g1FinalProject/index.php">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Users
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/g1FinalProject/users/list.php">List All User</a></li>
            <li><a class="dropdown-item" href="/g1FinalProject/users/create.php">Creat User</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/g1FinalProject/products/list.php">List All</a></li>
            <li><a class="dropdown-item" href="/g1FinalProject/products/create.php">Create </a></li>
          </ul>
        </li>

      </ul>
      <?php   if(isset($_SESSION['id'])) { ?>
          <form class="d-flex" action="/g1FinalProject/auth/logout.php" method="POST" style=" display: inline; ">
              <button class="btn btn-danger" type="submit" name="logout">Logout</button>
        </form>
      <?php   } else{  ?>
          <form class="d-flex">
            <a  href="/g1FinalProject/auth/login.php" class="btn btn-success me-2" type="submit">Login</a>
          </form>
      <?php }  ?>
    </div>
  </div>
</nav>