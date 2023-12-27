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
                        Products
                    </h4>
                </div>
                <div class="card-body" id="products_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $products = getAll("products");
                                if (mysqli_num_rows($products) > 0) {
                                    foreach ($products as $item) {
                                ?>
                                        <tr>
                                            <td class="text-center"><?= $item['id']; ?></td>
                                            <td class="text-center"><?= $item['name']; ?></td>
                                            <td class="text-center"><img src="../uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>"></td>
                                            <td class="text-center"><?= $item['status'] == "0" ? "Visible" : "Hidden"; ?></td>
                                            <td class="text-center">
                                                <a href="editProduct.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                            <td class="text-center">
                                              
                                                    <!-- <form action="code.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="delete_product_btn">Delete</button>
                                                    </form> -->
                                              
                                                <button type="button" class="btn btn-sm btn-outline-warning delete_product_btn" value="<?= $item['id']; ?>">Delete</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No record found";
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

<?php
include('./includes/footer.php');
?>