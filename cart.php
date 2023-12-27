<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');
?>
<div style="padding: 200px; padding-top: 30px; position: relative; background-color: rgba(255, 255, 255, 0.75);">
    <img src="uploads/wp10509681.jpg" alt="Background Image" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: -1;">
    <div class="py-5">
        <h3 class="display-1 fw-bold" style="color:#957B3F;">Shopping cart</h3><br>
        <div class="container">
            <div class="card card-body shadow">
                <div class="row">
                    <div class="col-md-12">
                        <div id="mycart">
                            <?php
                            $items = getCartItems();
                            if (mysqli_num_rows($items) > 0) {
                            ?>
                                <div>
                                    <?php
                                    foreach ($items as $citem) {
                                    ?>
                                        <div class="card product_data shadow-sm mb-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <img src="uploads/<?= $citem['image'] ?>" alt="Image" class="w-50">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5><?= $citem['name'] ?></h5><br>
                                                    <input type="hidden" class="product_id" value="<?= $citem['pid'] ?>">
                                                    <div class="input-group mb-3" style="width:130px">
                                                        <button class="input-group-text decrement-btn update_qty">-</button>
                                                        <input type="text" class="form-control input-qty bg-white text-center" value="<?= $citem['product_qty'] ?>" disabled>
                                                        <button class="input-group-text increment-btn update_qty">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <h5><?= $citem['selling_price']  ?>vnd</h5><br>
                                                    <button class="btn btn-danger btn-sm deleteItem" value="<?= $citem['cid'] ?>">
                                                        <i class="fa fa-trash me-2"></i>Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            } // End of if statement
                            else {
                            ?>
                                <div class="card card-body text-center">
                                    <h4 class="py-3">
                                        Your cart is empty
                                    </h4>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-end py-5">
                <a href="checkout.php" class="btn btn-danger btn-hover-bg-shade-amount" role="button">Checkout</a>
            </div>
        </div>
    </div>
    <?php include('./includes/footer.php') ?>

    <style>
        h1 {
            font-weight: bold;
            color: #7D6323;
            padding-left: 4.5rem;
        }

        .btn-outline-primary {
            color: #7D6323;
            border-color: #7D6323;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #7D6323;
            border-color: #7D6323;
        }

        .deleteItem {
            margin-top: -1rem;
        }

        .btn.btn-danger.btn-sm.deleteItem {
            color: #fff;
            background-color: #7D6323;
            border-color: #7D6323;
        }

        .card.card-body.shadow {
            padding-top: 2rem;
            padding-left: 2rem;
            padding-right: 2rem;
        }
    </style>