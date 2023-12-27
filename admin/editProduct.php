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
                $product = getByID("products", "$id");

                if (mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_array($product);
                    ?>
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4 class="font-weight-bold text-white mb-0">Edit Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="category_id" class="form-label">Select Category</label>
                                        <select name="category_id" class="form-select">
                                            <option selected>Select category</option>
                                            <?php
                                            $categories = getAll("categories");
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $category) {
                                                    ?>
                                                    <option value="<?= $category['id']; ?>" <?= $data['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                                        <?= $category['name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            } else {
                                                echo "No categories available";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                        <input type="text" name="name" required value="<?= $data['name'] ?>" placeholder="Enter Product Name" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" required value="<?= $data['slug'] ?>" placeholder="Enter Slug" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="small_description" class="form-label">Small Description</label>
                                        <textarea rows="3" name="small_description" required placeholder="Enter Small Description" class="form-control"><?= $data['small_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea rows="3" name="description" required placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="original_price" class="form-label">Original Price</label>
                                        <input type="text" name="original_price" required value="<?= $data['original_price'] ?>" placeholder="Enter Original Price" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="selling_price" class="form-label">Selling Price</label>
                                        <input type="text" name="selling_price" required value="<?= $data['selling_price'] ?>" placeholder="Enter Selling Price" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="image" class="form-label">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <div class="mt-2">
                                            <label for="old_image" class="form-label">Current Image</label>
                                            <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                            <img src="../uploads/<?= $data['image'] ?>" height="200px" width="150px" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="qty" class="form-label">Quantity</label>
                                        <input type="number" required name="qty" placeholder="Enter Quantity" class="form-control" value="<?= $data['qty'] ?>">
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <div class="form-check">
                                            <input type="checkbox" <?= $data['status'] ? "checked" : "" ?> name="status" id="statusCheckbox">
                                            <label class="form-check-label" for="statusCheckbox">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <div class="form-check">
                                            <input type="checkbox" <?= $data['trending'] ? "checked" : "" ?> name="trending" id="trendingCheckbox">
                                            <label class="form-check-label" for="trendingCheckbox">Trending</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" required  name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter Meta Title" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea rows="3" required  name="meta_description" placeholder="Enter Meta Description" class="form-control"><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <textarea rows="3" required name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                    </div>
                                    <!-- Add more form fields here with appropriate Bootstrap spacing classes -->
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning btn-lg" name="update_product_btn">Update</button>
                                    <a href="product.php" class="btn btn-outline-warning float-end">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Product not found";
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
