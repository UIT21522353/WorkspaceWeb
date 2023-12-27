<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');
?>
<img class="img-fluid opacity-25 position-absolute w-100 h-100" src="uploads/wp10509681.jpg">
<div class="container py-5">
    <h3 class="display-1 fw-bold" style="color: #957B3F;">Wishlist</h3>
    <div class="row" id="wishlistContainer">
        <?php
        $products = getWishlistItems();
        if (mysqli_num_rows($products) > 0) {
            foreach ($products as $item) {
        ?>
            <div class="col-md-3 mb-2">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                            <div class="d-flex pt-2 ">
                                <a href="singleProductView.php?product=<?= $item['name']; ?>"><h6><?= $item['name'];  ?></h6></a> 
                                <button class="toggleWishlistBtn border border-0 bg-transparent" value="<?= $item['wid']; ?>"><i class="fa fa-trash me-2" style="color: #f22626;"></i></button>
                            </div>
                        </div>
                    </div>
            </div>
        <?php
            }} else {
            echo "No data available";
            }
        ?>
    </div>
</div>

<?php include('./includes/footer.php') ?>

