<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');
?>

<div class="container py-5">
    <h3 class="display-1 fw-bold text-center text-black mb-5">Wishlist</h3>

    <div class="row row-cols-1 row-cols-md-4 g-4" id="wishlistContainer">
        <?php
        $products = getWishlistItems();

        if (mysqli_num_rows($products) > 0) {
            foreach ($products as $item) {
                ?>
                <div class="col mb-4">
                    <div class="card h-100 border border-light shadow">
                        <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="card-img-top">
                        <div class="card-body text-dark">
                            <h5 class="card-title fs-5"><a href="singleProductView.php?product=<?= $item['name']; ?>" class="text-decoration-none text-dark"><?= $item['name']; ?></a></h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button class="btn btn-danger toggleWishlistBtn"><i class="fa fa-trash me-2"></i>Remove</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-white text-center'>Your wishlist is empty.</p>";
        }
        ?>
    </div>
</div>

<?php include('./includes/footer.php'); ?>
