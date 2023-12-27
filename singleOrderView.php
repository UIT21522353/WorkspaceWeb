<?php
include('./functions/userFunctions.php');
include('./includes/header.php');

if (isset($_GET['order'])) {
    $order_slug = $_GET['order'];
    $order_data = getBySlugOrder($order_slug);
    $order = mysqli_fetch_array($order_data);

    if ($order) {
?>
<div style="padding: 190px; padding-top: 120px;">
    <h2 style="padding-bottom: 20px; color: #6F6D6D; font-weight: 800; line-height: 20px;">My Order Detail</h2>
    <div class="card shadow">
        <div class="card-body p-0 d-flex">
            <div style="flex-basis: 50%; padding: 32px; border-right: 1px solid #D9D9D9;">
                <div class="d-flex justify-content-between align-items-center pb-4">
                    <div class="d-flex justify-content-center align-items-center" style="border-radius: 20px; background: #4F1E13; width: fit-content; height: 62px; padding: 11px; color: #FFF; font-size: 12px;">
                        <i class="fa fa-heart me-2"></i><?= $order['ordered_at']; ?>
                    </div>
                    <div><?= $order['status']; ?></div>
                </div>
                <div class="d-flex" style="gap: 16px;">
                    <div style="width: 178px; height: 103px; border-radius: 15px; box-shadow: 3px 4px 20px 0px rgba(0, 0, 0, 0.25);">
                        <img style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px;" src="uploads/<?= $order['product_image']; ?>" alt="Product Image" class="w-100">
                    </div>
                    <div class="text-truncate" style="max-width: 150px;"><?= $order['product_name']; ?></div>
                    <div>
                        <div>Qty: <?= $order['product_qty']; ?></div>
                        <div><?= $order['product_price']; ?></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">Total: <?= $order['total_price']; ?></div>
            </div>
            <div style="flex-basis: 50%; padding: 32px;">
                <h5 class="d-flex justify-content-center align-items-center" style="border-radius: 20px; background: #4F1E13; width: fit-content; height: 62px; padding: 11px; color: #FFF;">
                    Billing Address
                </h5>
                <div class="d-flex mt-4" style="gap: 30px;"><i class="fa-regular fa-user"></i><?= $order['name']; ?></div>
                <div class="d-flex" style="gap: 30px;"><i class="fa-solid fa-phone"></i><?= $order['phone']; ?></div>
                <div class="d-flex" style="gap: 30px;"><i class="fa-regular fa-envelope"></i><?= $order['email']; ?></div>
                <div class="d-flex" style="gap: 30px;"><i class="fa-solid fa-map-pin"></i><?= $order['address']; ?></div>
            </div>
        </div>
    </div>
</div>
<?php
    } else {
        echo "Order not found";
    }
} else {
    echo "Something went wrong";
}
include('./includes/footer.php') ?>