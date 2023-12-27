<?php
include('../middleware/adminMiddleware.php');
include('./includes/header.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $reservation = getByID("reservations", "$id");

                if (mysqli_num_rows($reservation) > 0) {
                    $data = mysqli_fetch_array($reservation);
                    ?>
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4 class="font-weight-bold text-white mb-0">Update Reservation</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div style="display: flex; gap: 50px;">
                                        <div style="flex-basis: 50%;">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name:</label>
                                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                <input type="text" name="name" required value="<?= $data['name'] ?>" class="form-control" id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="adult" class="form-label">Adult:</label>
                                                <input type="number" name="adult" required value="<?= $data['adult'] ?>" class="form-control" id="adult" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Phone" class="form-label">Phone:</label>
                                                <input type="phone" name="phone" required value="<?= $data['phone'] ?>" class="form-control" id="phone" required>
                                            </div>
                                        </div>
                                        <div style="flex-basis: 50%;">
                                            <div class="mb-3">
                                                <label for="time" class="form-label">Time:</label>
                                                <input type="time" name="time" required value="<?= $data['time'] ?>" class="form-control" id="time" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date" class="form-label">Date:</label>
                                                <input type="date" name="date" required value="<?= $data['date'] ?>" class="form-control" id="date-reserve" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="fw-bold">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="0" <?= $data['status'] == 0 ? "selected" : "" ?>>Cancelled</option>
                                                    <option value="1" <?= $data['status'] == 1 ? "selected" : "" ?>>Uncalled</option>
                                                    <option value="2" <?= $data['status'] == 2 ? "selected" : "" ?>>Confirmed</option>
                                                    <option value="3" <?= $data['status'] == 3 ? "selected" : "" ?>>Arrived</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>   
                                </div>  
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note:</label>
                                    <input type="text" name="note" required value="<?= $data['note'] ?>" class="form-control" id="note"></textarea>
                                </div>                           
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning" name="update_reservation_btn">Update</button>
                                    <a href="reservation.php" class="btn btn-outline-warning float-end">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Reservation not found";
                }
            } else {
                echo "ID missing from URL";
            } ?>
        </div>
    </div>
</div>

<?php
include('./includes/footer.php');
?>
