<?php
include('./functions/userFunctions.php');
include('./includes/header.php');

if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getBySlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);

    if ($product) {
?>
        <img class="d-flex img-fluid opacity-25 position-absolute w-100" style="max-height: 110vh;" src="uploads/wp10509681.jpg">
        <div class="py-4 position-relative">
            <div class="container product_data mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <h1 class="fw-bold col-md-8"><?= $product['name']?></h1> 
                            <span class="text-danger col-md-4 text-end h4 fw-bold"><?php if ($product['trending']) {echo "Trending";} ?></span>
                            <p><?= $product['small_description']; ?></p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="mb-0"> <span class="text-success fw-bold"><?= $product['selling_price']; ?></span> VND</h3>
                            </div>
                            <div class="col-auto align-items-center d-flex">
                                <h5 class="mb-0" style="height:fit-content";><s class="text-danger"><?= $product['original_price']; ?></s> VND</h5>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-auto me-1">
                                <div class="input-group mb-3" style="width:7rem">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control input-qty bg-white text-center" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-auto me-5">
                                <button class="btn btn-success px-4 addToCartBtn" value="<?= $product['id']; ?>">
                                    <i class="fa fa-shopping-cart me-2 "></i>Add to Cart</button>
                            </div>
                            <div class="col-auto">
                                <button class="btn  btn-danger px-4 addToWishlistBtn" value="<?= $product['id']; ?>">
                                    <i class="fa fa-heart me-2"></i>Add to Wishlist</button>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <h5 class="fw-bold">Product Description</h5>
                        <p><?= $product['description']; ?></p>

                    </div>

                </div>
            </div>
        </div>
        </div>


<?php
    } else {
        echo "Product not found";
    }
} else {
    echo "Something went wrong";
}
include('./includes/footer.php') ?>