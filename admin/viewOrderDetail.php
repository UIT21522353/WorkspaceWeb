<?php
include('../middleware/adminMiddleware.php');
include('./includes/header.php');
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary fs-3">
                    <span class="text-white">
                        Order Details
                    </span>
                    <a href="order.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
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

                                    $order_query = "SELECT orders.id as oid, orders.tracking_no, orders.user_id, order_items.*, order_items.qty as order_items_qty, products.* 
                                            FROM orders, order_items, products
                                            WHERE order_items.order_id=orders.id AND products.id=order_items.product_id AND orders.tracking_no='$tracking_no'";
                                    $order_query_run = mysqli_query($conn, $order_query);
                                    if (mysqli_num_rows($order_query_run) > 0) {
                                        foreach ($order_query_run as $item) {
                                    ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="../uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
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
                            <div class="mb-3">
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                                    <select name="order_status" class="form-select">
                                        <option value="0" <?= $data['status'] == 0 ? "selected" : "" ?>>Pending</option>
                                        <option value="1" <?= $data['status'] == 1 ? "selected" : "" ?>>Completed</option>
                                        <option value="2" <?= $data['status'] == 2 ? "selected" : "" ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_order_btn" class="btn btn-primary mt-2">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<?php include('./includes/footer.php') ?>