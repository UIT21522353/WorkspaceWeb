<?php
include('../middleware/adminMiddleware.php');
include('./includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">
                        Order History
                        <a href="order.php" class="btn btn-warning float-end">Back</a>
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
                                                <th class="text-center ps-2">Status</th>
                                                <th class="text-center ps-2">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $orders = getOrderHistory();
                                            if (mysqli_num_rows($orders) > 0) {
                                                foreach ($orders as $item) {
                                            ?>
                                                    <tr>
                                                        <td class="align-middle"><?= $item['id']; ?></td>
                                                        <td class="align-middle"><?= $item['name']; ?></td>
                                                        <td class="align-middle"><?= $item['total_price']; ?></td>
                                                        <td class="align-middle"><?= $item['created_at']; ?></td>
                                                        <?php
                                                        if($item['status']=="0"){?>
                                                            <td class="text-center align-middle text-bold">
                                                                <span class="badge-sm text-warning">ON GOING</span>
                                                            </td>
                                                        <?php
                                                        }
                                                        else if($item['status']=="1"){?>
                                                            <td class="text-center align-middle text-bold">
                                                                <span class="badge-sm text-success">COMPLETED</span>
                                                            </td>
                                                        <?php
                                                        }
                                                        else if($item['status']=="2"){?>
                                                            <td class="text-center align-middle text-bold">
                                                                <span class="badge-sm text-danger">CANCELED</span>
                                                            </td>
                                                        <?php
                                                        }?>
                                                        <td class="text-center"><a href="viewOrderDetail.php?t=<?= $item['tracking_no']; ?>" class="mg-0 btn btn-primary">View Details</a></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('./includes/footer.php') ?>