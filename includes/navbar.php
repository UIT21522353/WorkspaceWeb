<!-- ***** Header Area Start ***** -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container py-2 px-4">
        <div class="row">
            <div class="col-md-2">
                <a class="navbar-brand fs-4" href="index.php" style="font-weight: bolder;">GogaTwo</a>
                <button class="navbar-toggler float-end " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col-md-2">
                <form id="searchForm" action="product.php" method="GET" class="d-flex justify-content-between">
                    <input class="form-control" type="text" id="search" name="key" placeholder="Type to search..." aria-label="Search" style="width: auto">
                    <button class="btn" type="submit" title="Search" style="background-color: white;">
                        <i class="fa fa-search" style="color: #7D6323;"></i>
                    </button>
                </form>
            </div>

            <div class="col-md-8s">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php"><i class="fa-regular fa-house"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" style="width:95px;" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" style="width:auto;" href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'category.php') ? 'active' : ''; ?>" style="width:100px;" href="category.php"><i class="fa-regular fa-store"></i>Product </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'wishlist.php') ? 'active' : ''; ?>" href="wishlist.php"><i class="fa-regular fa-heart"></i>Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'cart.php') ? 'active' : ''; ?>" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a>
                        </li>
                    </ul>

                    <?php // include('./includes/checkUser.php') ?>

                </div>
            </div>
        </div>
    </div>
</nav>
<!-- ***** Header Area End ***** -->
