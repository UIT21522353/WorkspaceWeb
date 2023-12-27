<?php
include('../middleware/adminMiddleware.php');
include('./includes/header.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header bg-primary">
                    <h4 class="font-weight-bold text-white mb-0">Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="category_id" class="mb-0">Select Category</label>
                                <select name="category_id" class="form-select mb-2">
                                    <option selected>Select category</option>
                                    <?php
                                    $categories = getAll("categories");
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $category) {
                                    ?>
                                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "<option disabled>No category available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="mb-0">Name</label>
                                <input type="text" required name="name" placeholder="Enter Product Name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug" class="mb-0">Slug</label>
                                <input type="text" required name="slug" placeholder="Enter Slug" class="form-control mb-2">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="small_description" class="mb-0">Small Description</label>
                                <textarea rows="3" required name="small_description" placeholder="Enter Small Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="mb-0">Description</label>
                                <textarea rows="3" required name="description" placeholder="Enter Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="original_price" class="mb-0">Original Price</label>
                                <input type="text" required name="original_price" placeholder="Enter Original Price" class="form-control mb-2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="selling_price" class="mb-0">Selling Price</label>
                                <input type="text" required name="selling_price" placeholder="Enter Selling Price" class="form-control mb-2">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="image" class="mb-0">Upload Image</label>
                                <input type="file" required name="image" class="form-control mb-2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty" class="mb-0">Quantity</label>
                                <input type="number" required name="qty" placeholder="Enter Quantity" class="form-control mb-2">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="status" class="mb-0"></label>
                                <div class="form-check">
                                    <input type="checkbox" name="status" id="statusCheckbox">
                                    <label class="form-check-label" for="statusCheckbox">Status</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="trending" class="mb-0"></label>
                                <div class="form-check">
                                    <input type="checkbox" name="trending" id="trendingCheckbox">
                                    <label class="form-check-label" for="trendingCheckbox">Trending</label>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_title" class="mb-0">Meta Title</label>
                                <input type="text" required name="meta_title" placeholder="Enter Meta Title" class="form-control mb-2">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_description" class="mb-0">Meta Description</label>
                                <textarea rows="3" required name="meta_description" placeholder="Enter Meta Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_keywords" class="mb-0">Meta Keywords</label>
                                <textarea rows="3" required name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control mb-2"></textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn  btn-primary" name="add_product_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


