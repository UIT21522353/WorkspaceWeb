<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container py-2 px-4">
    <div class="row">
    <div class="col-md-2">
        <a class="navbar-brand fs-4" href="index.php" style="font-weight: bolder; ">Foodies</a>
        <button class="navbar-toggler float-end " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <div class="col-md-2">
        <form id="searchForm" action="product.php?" method="GET" class="d-flex justify-content-between">
          <input class="form-control" type="text" id="search" name="key" placeholder="Search for" aria-label="Search" style="width: 85%">
          <button class="btn" type="submit" title="Search" style="background-color: white;">
            <i class="fa fa-search" style="color: #7D6323;"></i>
          </button>
        </form>
      </div>

      <div class="col-md-8">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'aboutUs.php') ? 'active' : ''; ?>" style="width:95px;" href="aboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contactUs.php') ? 'active' : ''; ?>" style="width:110px;" href="contactUs.php">Contact Us</a> <!-- Check ref -->
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'reservation.php') ? 'active' : ''; ?>" style="width:110px;" href="reservation.php">Reservation</a> <!-- Thêm ref -->
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'category.php') ? 'active' : ''; ?>" style="width:100px;" href="category.php">Our Menu </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'wishlist.php') ? 'active' : ''; ?>" href="wishlist.php">Wishlist</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'cart.php') ? 'active' : ''; ?>" href="cart.php">Cart</a>
            </li>
          </ul>

          
            <ul class="navbar-nav ms-auto">
              <?php
              if (isset($_SESSION['auth'])) {
              ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['auth_user']['name'];   ?>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="myOrder.php">My Orders</a></li>
                    <li><a class="dropdown-item" href="myProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </li>
              <?php
              } else {
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              <?php
              }
              ?>
            </ul>
          
        </div>
      </div>
    </div>
  </div>
</nav>