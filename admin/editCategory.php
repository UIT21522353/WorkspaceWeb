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
                $category = getByID("categories", "$id");

                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
                    ?>
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4 class="font-weight-bold text-white mb-0">Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Slug" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="description">Description</label>
                                        <textarea rows="3" name="description" placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
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
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter Meta Title" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea rows="3" name="meta_description" placeholder="Enter Meta Description" class="form-control"><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?= $data['status'] ? "checked" : "" ?> name="status" id="statusCheckbox">
                                            <label class="form-check-label" for="statusCheckbox">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?= $data['popular'] ? "checked" : "" ?> name="popular" id="popularCheckbox">
                                            <label class="form-check-label" for="popularCheckbox">Popular</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning" name="update_category_btn">Update</button>
                                        <a href="category.php" class="btn btn-outline-warning float-end">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Category not found";
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
