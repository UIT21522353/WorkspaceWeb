<?php
include('../middleware/adminMiddleware.php');
include('./includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="text-white">
                        Orders
                        <a href="orderHistory.php" class="btn bg-gradient-light float-end">Order History</a>
                    </h4>
                </div>
                <div class="card-body" id="order_table">
                    <div class="container">
                        <div class="card card-body shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="ps-2">ID</th>
                                                <th class="ps-2">User Name</th>
                                                <th class="ps-2">Total Price</th>
                                                <th class="ps-2">Date</th>
                                                <th class="ps-2 text-center">Status</th>
                                                <th class="ps-2 text-center">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $orders = getAllOrders();
                                            if (mysqli_num_rows($orders) > 0) {
                                                foreach ($orders as $item) {
                                            ?>
                                                    <tr>
                                                        <td class="align-middle"><?= $item['id']; ?></td>
                                                        <td class="align-middle"><?= $item['name']; ?></td>
                                                        <td class="align-middle"><?= $item['total_price']; ?></td>
                                                        <td class="align-middle"><?= $item['created_at']; ?></td>
                                                        <td class="text-center align-middle text-bold">
                                                            <span class="badge-sm text-warning">ON GOING</span>
                                                        </td>
                                                        <td class="text-center align-middle"><a href="viewOrderDetail.php?t=<?= $item['tracking_no']; ?>" class="btn btn-info">View Details</a></td>

                                                    </tr>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="5">No in process yet</td>

                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
