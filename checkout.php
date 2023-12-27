<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
include('authenticate.php');
$cartItems = getCartItems();
if (mysqli_num_rows($cartItems) == 0) {
    echo '<script>window.location.href = "category.php";</script>';
}

$hcm_districts = array(
    'District 1' => array('Ward Ben Nghe', 'Ward Co Giang', 'Ward Ben Thanh', 'Ward Cau Kho', 'Ward Da Kao', 'Ward Cau Ong Lanh', 'Ward Nguyen Thai Binh', 'Ward Nguyen Cu Trinh', 'Ward Pham Ngu Lao', 'Ward Tan Dinh'),
    'District 2' => array('Ward An Khanh', 'Ward An Loi Dong', 'Ward An Phu', 'Ward Binh An', 'Ward Binh Khanh', 'Ward Binh Trung Dong', 'Ward Binh Trung Tay', 'Ward Cat Lai', 'Ward Thanh My Loi', 'Ward Thao Dien', 'Ward Thu Thiem'),
    'District 3' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward Vo Thi Sau',),
    'District 4' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 6', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 13', 'Ward 14', 'Ward 15', 'Ward 16', 'Ward 18',),
    'District 5' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward 15'),
    'District 6' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14'),
    'District 7' => array('Ward Tan Thuan Dong', 'Ward Tan Thuan Tay', 'Ward Tan Kieng', 'Ward Tan Hung', 'Ward Tan Quy', 'Ward Tan Phong', 'Ward Tan Phu', 'Ward Binh Thuan', 'Ward Phu Thuan', 'Ward Phu My'),
    'District 8' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward 15', 'Ward 16'),
    'District 9' => array('Ward Phuoc Long A', 'Ward Phuoc Long B', 'Ward Tan Phu', 'Ward Long Phuoc', 'Ward Tang Nhon Phu A', 'Ward Phuoc Binh', 'Ward Long Binh', 'Ward Tăng Nhon Phu B', 'Ward Hiep Phu', 'Ward Phu Huu', 'Ward Long Truong', 'Ward Long Thanh My', 'Ward My Thanh'),
    'District 10' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward 15'),
    'District 11' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward 15', 'Ward 16'),
    'District 12' => array('Ward An Phu Dong', 'Ward Dong Hung Thuan', 'Ward Hiep Thanh', 'Ward Tan Chanh Hiep', 'Ward Tan Hung Thuan', 'Ward Tan Thoi Hiep', 'Ward Tan Thoi Nhat', 'Ward Thanh Loc', 'Ward Thanh Xuan', 'Ward Thoi An', 'Ward Trung My Tay'),
    'District Binh Thanh' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward 15', 'Ward 17', 'Ward 19', 'Ward 21', 'Ward 22', 'Ward 24', 'Ward 25', 'Ward 26', 'Ward 27', 'Ward 28'),
    'District Binh Tan' => array('Ward An Lac', 'Ward An Lac A', 'Ward Binh Hung Hoa', 'Ward Binh Hung Hoa A', 'Ward Binh Hung Hoa B', 'Ward Binh Tri Dong', 'Ward Binh Tri Dong A', 'Ward Binh Tri Dong B', 'Ward Tan Tao', 'Ward Tan Tao A'),
    'District Tan Binh' => array('Ward 1', 'Ward 2', 'Ward 3', 'Ward 4', 'Ward 5', 'Ward 6', 'Ward 7', 'Ward 8', 'Ward 9', 'Ward 10', 'Ward 11', 'Ward 12', 'Ward 13', 'Ward 14', 'Ward 15'),
    'District Thu Duc' => array('Ward Binh Chieu', 'Ward Binh Tho', 'Ward Hiep Binh Chanh', 'Ward Hiep Binh Phuoc', 'Ward Linh Chieu', 'Ward Linh Dong', 'Ward Linh Tay', 'Ward Linh Trung', 'Ward Linh Xuan', 'Ward Tam Binh', 'Ward Tam Phu', 'Ward Truong Tho'),
);
?>



<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <form action="functions/placeOrder.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                   
                    <h3 class="display-6 fw-bold" style="color:#957B3F;">Basic detail</h3>
                  
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Name</label>
                                <input type="text" name="name" id="name" required placeholder="Enter your full name" class="form-control">
                                <small class="text-danger name"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Phone</label>
                                <input type="text" name="phone" id="phone" required placeholder="Enter your phone number" class="form-control">
                                <small class="text-danger phone"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">E-mail</label>
                                <input type="email" name="email" id="email" required placeholder="Enter your email" class="form-control">
                                <small class="text-danger email"></small>
                            </div>

                            <input type="hidden" name="address" id="address" value="">
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">District</label>
                                <select name="district" id="district" class="form-control" required onchange="loadWards(this.value)">
                                    <option value="" disabled selected>Select your district</option>
                                    <?php
                                    foreach ($hcm_districts as $district => $wards) {
                                        echo "<option value='$district'>$district, Ho Chi Minh City</option>";
                                    }
                                    ?>
                                </select>
                                <small class="text-danger district"></small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Ward</label>
                                <select name="ward" id="ward" class="form-control" required>
                                    <option value="" disabled selected>Select your ward</option>
                                </select>
                                <small class="text-danger ward"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">House Number</label>
                                <input type="text" name="house_number" id="house_number" required placeholder="Enter your address" class="form-control">
                                <small class="text-danger house_number"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Street Address</label>
                                <input type="text" name="street_address" id="street_address" required placeholder="Enter your street address" class="form-control">
                                <small class="text-danger street_address"></small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Comments</label>
                                <textarea name="comments" id="comments" class="form-control" rows="3"></textarea>
                                <small class="text-danger comments"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 overflow-auto">
                    <h3 class="display-6 fw-bold" style="color:#957B3F;">Order Detail</h3>
                        <hr>
                        <?php
                        $items = getCartItems();
                        $totalPrice = 0;
                        foreach ($items as $citem) {
                        ?>
                            <div class="mb-1 border">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="65px" height="90px">
                                    </div>
                                    <div class="col-md-5">
                                        <label><?= $citem['name'] ?></label>
                                    </div>
                                    <div class="col-md-2">
                                        <label>x <?= $citem['product_qty']  ?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <label><?= $citem['selling_price'] ?>vnd</label>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $totalPrice += $citem['selling_price'] * $citem['product_qty'];
                            $convertDollar = $totalPrice / 25000;
                        }
                        ?>
                        <hr>
                        <h5>Total Price: <span class="float-end mx-5 fw-bold"><?= $totalPrice ?>vnd</span></h5>
                        <div class="">
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" name="placeOrderBtn" class="btn btn-success w-100">
                                Confirm and place order | COD
                            </button>
                            <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="./functions/placeOrder.php">
                                <input type="hidden" value="<?php echo $totalPrice ?>" name="totalPrice">
                                <input type="submit" name="momoQRBtn" value="MOMO QR Code" class="btn btn-danger w-100" style="background-color: #C62E86;">
                            </form>
                            <div id="paypal-button-container" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function loadWards(selectedDistrict, selectedWard = '') {
        var wards = <?php echo json_encode($hcm_districts); ?>;
        var selectedWards = wards[selectedDistrict] || [];
        var wardSelect = document.getElementById('ward');
        wardSelect.innerHTML = "<option value='' disabled selected>Select your ward</option>";
        selectedWards.forEach(function (ward) {
            wardSelect.innerHTML += "<option value='" + ward + "'>" + ward + "</option>";
        });

        if (selectedWard) {
            wardSelect.value = selectedWard;
        }
        var streetAddressInput = document.getElementById('street_address');
        var houseNumberInput = document.getElementById('house_number');

        var defaultWard = selectedWards.length > 0 ? selectedWards[0] : '';
        var defaultStreetAddress = ' ';
        var defaultHouseNumber = ' ';
        streetAddressInput.value = defaultStreetAddress;
        houseNumberInput.value = defaultHouseNumber;

        var selectedAddress = defaultHouseNumber + ', ' + defaultStreetAddress + ', ' + defaultWard + ', ' + selectedDistrict;
        var addressInput = document.getElementById('address');
        addressInput.value = selectedAddress;
    }
</script>


<?php include('./includes/footer.php') ?>
<!-- Replace the "test" client-id value with your client-id -->
<script src="https://www.paypal.com/sdk/js?client-id=AVz3lHrq_vQjrPadRGvrRswIvHAq2OuJ0qq-ynQS2Y-FjcvtrxrS9Z95HK2BHozkc6FZu0TGgDhlgvMm&currency=USD"></script>
<script>
    
    paypal.Buttons({
        onClick() {
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var selectedDistrict = $('#district').val();
            var selectedWard = $('#ward').val();

            // Call loadWards function to set the address
            loadWards(selectedDistrict, selectedWard);

            // Now you can use the updated address components
            var district = selectedDistrict;
            var ward = selectedWard;
            var houseNumber = $('#house_number').val();
            var streetAddress = $('#street_address').val();

            // Combine components to create the address
            var formattedAddress = district + ' ' + ward + ' ' + houseNumber + ' ' + streetAddress;

            if (name.length == 0) {
                // alert("name is required");
                $('.name').text("*This field is required");
            } else {
                $('.name').text("");
            }
            if (email.length == 0) {
                // alert("name is required");
                $('.email').text("*This field is required");
            } else {
                $('.email').text("");
            }
            if (phone.length == 0) {
                // alert("name is required");
                $('.phone').text("*This field is required");
            } else {
                $('.phone').text("");
            }
            // if (formattedAddress.length == 0) {
            //     // alert("name is required");
            //     $('.formattedAddress').text("*This field is required");
            // } else {
            //     $('.formattedAddress').text("");
            // }
            if (name.length == 0 || email.length == 0 || phone.length == 0) {
                return false;
            }

        },
        //set up the transactions when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $convertDollar ?>'
                        // value: '0.1'
                    }
                }]
            });
        },
        // finalize the transaction after paper approval
        onApprove: (data, actions) => {
            return actions.order.capture().then((orderData) => {
                // Get the selected district and ward
                var houseNumber = $('#house_number').val();
                var streetAddress = $('#street_address').val();
                loadWards(selectedDistrict, selectedWard);
               
                var selectedDistrict = $('#district').val();
         
                var selectedWard = $('#ward').val();

                // // Call loadWards function to set the address
                // loadWards(selectedDistrict, selectedWard);

                // Now you can use the updated address components
                var district = selectedDistrict;
                var ward = selectedWard;
               

                // Combine components to create the address
                var formattedAddress = district + ' ' + ward + ' ' + houseNumber + ' ' + streetAddress;

                // Additional data to be sent to the server
                var additionalData = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'phone': $('#phone').val(),
                    'comments': $('#comments').val(),
                    'payment_mode': "Paid by PayPal",
                    'payment_id': orderData.purchase_units[0].payments.captures[0].id,
                    'placeOrderBtn': true,
                    'address':  formattedAddress, // Include the formatted address
                };

                // Send the combined data to the server
                $.ajax({
                    method: "POST",
                    url: "functions/placeOrder.php",
                    data: additionalData,
                    success: function(response) {
                        if (response == 201) {
                            alertify.success("Order Placed Successfully");
                            window.location.href = 'myOrder.php';
                            $email = $('#email').val();
                            $subject = 'Order Placed Successfully';
                            $content = 'Dear our beloved customer, <br><br> Thank you for supporting us. Hope you like it! ';
                            sendOrderConfirmationEmail($('#name').val(), $email, $tracking_no);
                            // Redirect the user after the order is placed
                            // window.location.href = 'myOrder.php';
                            // actions.redirect('myOrder.php');
                            header('location: ../myOrder.php');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>

<?php include('./includes/footer.php') ?>