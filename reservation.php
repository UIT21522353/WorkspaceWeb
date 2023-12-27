<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
?>

<div style="padding: 5%; position: relative; background-color: rgba(255, 255, 255, 0.75);  margin: auto;">
    <img src="uploads/wp10509681.jpg" alt="Background Image" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: -1;">

    <div style="padding: 5%; padding-top: 0%;">
        <div class="border border-5 p-3 p-md-5 rounded ">
            <h2 class="display-4 fw-bold text-center" style="color: #957B3F;">Reservation</h2>
            <div class="underline mb-3" style="width: 20%; margin: auto;"></div>
            <form action="functions/reserve.php" method="POST" class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="adult" class="form-label">Adult:</label>
                        <input type="number" name="adult" class="form-control" id="adult" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time:</label>
                        <input type="time" name="time" class="form-control" id="time" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number:</label>
                        <input type="phone" name="phone" class="form-control" id="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control" id="date-reserve" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note:</label>
                        <input type="text" name="note" class="form-control" id="note">
                    </div>
                </div>
                <div class="col-12 mt-4 d-flex justify-content-end">
                    <button type="submit" name="reserveBtn" class="btn btn-danger btn-hover-bg-shade-amount" role="button">Reserve now</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white">Foodies Bistro & Garden</h4>
                <div class="underline mb-2" style="background-color: #8B4513"> </div>
                <a href="index.php" class="text-white">Home</a> <br>
                <a href="aboutUs.php" class="text-white">About Us</a><br>
                <a href="category.php" class="text-white">Our Menu</a> <br>
            </div>
            <div class="col-md-4">
                <h4 class="text-white">Address</h4>
                <p class="text-white">65 Xuân Thủy, Thảo Điền, Quận 2, Thành phố Hồ Chí Minh, Việt Nam</p>
                <a href="tel: +84989598472" class="text-white"><i class="fa fa-phone"></i> +(84) 98 95 98 472</a><br>
                <a href="mailto:xyz@gmail.com" class="text-white"><i class="fa fa-envelope"></i> foddiesbistroandgarden@gmail.com</a>
            </div>
            <div class="col-md-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0981234431147!2d106.73096857405383!3d10.803796389346632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317526198a4d887d%3A0x1b459a5fe9c1c3b7!2zNjUgWHXDom4gVGjhu6d5LCBUaOG6o28gxJBp4buBbiwgUXXhuq1uIDIsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1702875935138!5m2!1svi!2s" class="w-100" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="py-2" style="background-color: #8B4513">
    <div class="text-end">
        <div class="mb-0 me-3 text-white">All rights reserved. Copy right @Foodies Bistro & Garden - <?= date('Y'); ?> </div>
    </div>
</div>
<?php include('./includes/footer.php') ?>