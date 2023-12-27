<?php
include('../middleware/adminMiddleware.php');
include('./includes/header.php');

?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="font-weight-bold mb-0 text-white">Add Reservation</h4>
                        </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div style="display: flex; gap: 50px;">
                                <div style="flex-basis: 50%;">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="adult" class="form-label">Adult:</label>
                                        <input type="number" name="adult" class="form-control" id="adult" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Phone" class="form-label">Phone:</label>
                                        <input type="phone" name="phone" class="form-control" id="phone" required>
                                    </div>
                                </div>
                                <div style="flex-basis: 50%;">
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Time:</label>
                                        <input type="time" name="time" class="form-control" id="time" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date:</label>
                                        <input type="date" name="date" class="form-control" id="date-reserve" required>
                                    </div>
                                </div>
                            </div>   
                        </div>  
                        <div class="mb-3">
                            <label for="note" class="form-label">Note:</label>
                            <input type="text" name="note" class="form-control" id="note"></textarea>
                        </div>                           
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end" name="add_reservation_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

