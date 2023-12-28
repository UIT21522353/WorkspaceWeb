<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');
?>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="display-4 fw-bold text-center text-primary mb-4">Shopping Cart</h3>

                    <?php
                    $items = getCartItems();

                    if (mysqli_num_rows($items) > 0) {
                        foreach ($items as $citem) {
                    ?>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <img src="uploads/<?= $citem['image'] ?>" alt="Product Image" class="img-fluid rounded">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2"><?= $citem['name'] ?></h5>
                                    <input type="hidden" class="product_id" value="<?= $citem['pid'] ?>">
                                    <div class="input-group">
                                        <button class="input-group-text bg-danger text-white decrement-btn update_qty">-</button>
                                        <input type="text" class="form-control input-qty bg-light text-center" value="<?= $citem['product_qty'] ?>" disabled>
                                        <button class="input-group-text bg-success text-white increment-btn update_qty">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <h5 class="mb-2"><?= $citem['selling_price'] ?>vnd</h5>
                                    <button class="btn btn-danger btn-sm deleteItem" value="<?= $citem['cid'] ?>">
                                        <i class="fa fa-trash me-2"></i>Remove
                                    </button>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                    ?>
                        <div class="text-center">
                            <h4 class="py-3">
                                Your cart is empty
                            </h4>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="float-end mt-4">
                        <a href="checkout.php" class="btn btn-primary btn-lg" role="button">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/footer.php') ?>
