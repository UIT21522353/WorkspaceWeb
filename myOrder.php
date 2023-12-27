<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');

?>
<img class="img-fluid opacity-25 position-absolute w-100 h-100" src="uploads/wp10509681.jpg">
<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrders();
                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['tracking_no']; ?></td>
                                        <td><?= $item['total_price']; ?></td>
                                        <td><?= $item['created_at']; ?></td>
                                        <td><a href="viewOrderDetail.php?t=<?= $item['tracking_no']; ?>" class="btn btn-danger btn-hover-bg-shade-amount" role="button">View Details</a></td>

                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No order yet</td>

                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <!-- <div class="float-end py-5">
            <a href="checkout.php" class="btn btn-outline-primary">Checkout</a>
        </div> -->
    </div>

</div>


<?php include('./includes/footer.php') ?>