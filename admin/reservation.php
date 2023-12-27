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
                        Reservations
                        <a href="reservationHistory.php" class="btn bg-gradient-light float-end">Reservation History</a>
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
                                                <th class="ps-2">Name</th>
                                                <th class="ps-2">Phone</th>
                                                <th class="ps-2">Adult No.</th>
                                                <th class="ps-2">Date</th>
                                                <th class="ps-2">Time</th>
                                                <th class="ps-2">Note</th>
                                                <th class="ps-2">Status</th>
                                                <th class="ps-2">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $reservation = getOnGoingReservations();
                                            if (mysqli_num_rows($reservation) > 0) {
                                                foreach ($reservation as $item) {
                                            ?>
                                                    <tr>
                                                        <td class="align-middle"><?= $item['name']; ?></td>
                                                        <td class="align-middle"><?= $item['phone']; ?></td>
                                                        <td class="align-middle"><?= $item['adult']; ?></td>
                                                        <td class="align-middle"><?= $item['date']; ?></td>
                                                        <td class="align-middle"><?= $item['time']; ?></td>
                                                        <td class="align-middle"><?= $item['note']; ?></td>
                                                        <?php
                                                        if($item['status']=="1"){?>
                                                            <td class="align-middle text-bold">
                                                                <span class="badge-sm text-warning">UNCALLED</span>
                                                            </td>
                                                        <?php
                                                        }
                                                        else if($item['status']=="2"){?>
                                                            <td class="align-middle text-bold">
                                                                <span class="badge-sm text-primary">CONFIRMED</span>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td><a href="updateReservation.php?id=<?= $item['id']; ?>" class="mg-0 btn btn-success">Update</a></td>
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