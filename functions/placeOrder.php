<?php
session_start();
include('../config/dbconn.php');
include('./myFunctions.php');
function generateUniqueId()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $uniqueId = '';

    for ($i = 0; $i < 20; $i++) { // Generating a 20-character ID
        $randomIndex = mt_rand(0, $charLength - 1);
        $uniqueId .= $characters[$randomIndex];
    }

    return $uniqueId;
}

if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);

        if ($name == "" || $email == "" || $phone == "" || $address == "") {
            $_SESSION['message'] = "All field are mandatory";
            header('location: ../checkout.php');
            exit(0);
        }

        $userID = $_SESSION['auth_user']['user_id'];
        $query = "SELECT carts.id as cid, carts.product_qty, products.id as pid, products.name, products.image, products.selling_price 
        FROM carts, products
        WHERE carts.product_id=products.id
        AND carts.user_id='$userID'
        ORDER BY carts.id DESC";
        $query_run = mysqli_query($conn, $query);


        $totalPrice = 0;
        foreach ($query_run as $citem) {
            $totalPrice += $citem['selling_price'] * $citem['product_qty'];
        }

        $tracking_no = generateUniqueId();

        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, total_price, payment_mode, payment_id)
        VALUES('$tracking_no', '$userID', '$name', '$email', '$phone', '$address', '$totalPrice', '$payment_mode', '$payment_id')";
        $insert_query_run = mysqli_query($conn, $insert_query);

        if ($insert_query_run) {
            $order_id = mysqli_insert_id($conn);
            foreach ($query_run as $citem) {

                $product_id = $citem['pid'];
                $product_qty = $citem['product_qty'];
                $price = $citem['selling_price'];
                $insert_items_query = "INSERT INTO order_items (order_id, product_id, qty, price) 
                VALUES ('$order_id','$product_id', '$product_qty', '$price')";
                $insert_items_query_run = mysqli_query($conn, $insert_items_query);


                $product_fetch_query = "SELECT * FROM products WHERE id='$product_id' LIMIT 1";
                $product_fetch_query_run = mysqli_query($conn, $product_fetch_query);

                $productData = mysqli_fetch_array($product_fetch_query_run);
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $product_qty;

                $update_productQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$product_id' ";
                $update_productQty_query_run = mysqli_query($conn, $update_productQty_query);
            }
            sendOrderConfirmationEmail($name, $email, $tracking_no);
            //after place order -> cart need to be empty
            $delete_cart_query = "DELETE FROM carts WHERE user_id='$userID'";
            $delete_cart_query_run = mysqli_query($conn, $delete_cart_query);
            if ($payment_mode == "COD") {
                $_SESSION['message'] = "Order placed sucessfully";
                header('location: ../myOrder.php');
                die();
            } else {
                echo 201;
            }
        }
    } else if (isset($_POST['momoQRBtn'])) {
        // header('location: ../checkout.php');
        // $_SESSION['message'] = 'This feature will be coming soon';

        header('Content-type: text/html; charset=utf-8');

        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data)
                )
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }
        $userID = $_SESSION['auth_user']['user_id'];
        $query = "SELECT carts.id as cid, carts.product_qty, products.id as pid, products.name, products.image, products.selling_price 
        FROM carts, products
        WHERE carts.product_id=products.id
        AND carts.user_id='$userID'
        ORDER BY carts.id DESC";
        $query_run = mysqli_query($conn, $query);


        $totalPrice = 0;
        foreach ($query_run as $citem) {
            $totalPrice += $citem['selling_price'] * $citem['product_qty'];
        }
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua mã QR Momo";
        $amount = $_POST['totalPrice'];
        $orderId = time() . "";
        $redirectUrl = "http://localhost:8080/Foodies/checkout.php";
        $ipnUrl = "http://localhost:8080/Foodies/checkout.php";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "captureWallet";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        header('Location: ' . $jsonResult['payUrl']);
    }
} else {
    header('location: ../index.php');
}