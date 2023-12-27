<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];
    $orderData = checkTrackingNoExist($tracking_no);
    if (mysqli_num_rows($orderData) < 0) {
?>
        <h4>Something went wrong</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>Something went wrong</h4>
    die();
<?php
}
$data = mysqli_fetch_array($orderData);
?>
<div class="py-3 bg-primary">
    <div class="container">

        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <a class="text-white" href="myOrder.php">
                My Orders /
            </a><a class="text-white" href="#">
                View Orders Details
            </a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary fs-3">
                            <span class="text-white">
                                Order Details
                            </span>
                            <a href="myOrder.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Delivery Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Your Name</label>
                                            <div class="border p-1">
                                                <?= $data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Your Email</label>
                                            <div class="border p-1">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-1">
                                                <?= $data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking Number</label>
                                            <div class="border p-1">
                                                <?= $data['tracking_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1">
                                                <?= $data['address']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $userID = $_SESSION['auth_user']['user_id'];
                                            $order_query = "SELECT orders.id as oid, orders.tracking_no, orders.user_id, order_items.*, order_items.qty as order_items_qty, products.* 
                                            FROM orders, order_items, products
                                            WHERE orders.user_id='$userID' AND order_items.order_id=orders.id AND products.id=order_items.product_id AND orders.tracking_no='$tracking_no'";
                                            $order_query_run = mysqli_query($conn, $order_query);
                                            if (mysqli_num_rows($order_query_run) > 0) {
                                                foreach ($order_query_run as $item) {
                                            ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                            <?= $item['name']; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?= $item['order_items_qty']; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?= $item['price']; ?> vnd
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }


                                            ?>

                                        </tbody>
                                    </table>

                                    <hr>
                                    <h5>Total Price: <span class="float-end fw-bold me-4"><?= $data['total_price']; ?> vnd</span></h5>

                                    <label class="fw-bold">Payment Mode</label>
                                    <div class="border p-1 mb-3">
                                        <?= $data['payment_mode'] ?>
                                    </div>

                                    <label class="fw-bold">Status</label>
                                    <div class="border p-1 mb-3">
                                        <?php

                                        if ($data['status'] == 0) {
                                            echo "Pending";
                                        } else if ($data['status'] == 1) {
                                            echo "Completed";
                                        } else if ($data['status'] == 2) {
                                            echo "Cancelled";
                                        } ?>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>


<?php include('./includes/footer.php') ?>