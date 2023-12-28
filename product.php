<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
?>
<img class="d-flex img-fluid opacity-25 position-absolute w-100" src="uploads/wp10509681.jpg">
<?php
if (isset($_GET['category'])) {

    $category_slug = $_GET['category'];
    $category_data = getBySlugActive("categories", $category_slug);
    $category = mysqli_fetch_array($category_data);

    if ($category) {
        $cateID = $category['id'];
?>
        <div class="py-4 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Category: <span class="text-success"><?= $category['name']; ?></span></h1>
                        <hr>
                        <div class="row">
                            <?php
                            $products = getProductsByCate($cateID);
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                            ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="singleProductView.php?product=<?= $item['slug']; ?>">
                                            <div class="card shadow-lg mb-5 rounded border-0">
                                                <div class="card-body p-0">
                                                    <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100 center-cropped">
                                                    <h5 class="text-center mt-sm-3 mb-sm-3 fw-bolder" style="color: #8B4513;"><?= $item['name'];  ?></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '<p class="ms-1">' . "No data available" . '</p>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        } else {
            echo '<p class="ms-1">' . "Something went wrong" . '</p>';
        }
} else
if (isset($_GET['key'])) {

    $key = $_GET['key'];
    $search_query= searchProduct($key);
    $result = mysqli_fetch_array($search_query);
    ?>
    <div class="py-4 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Your search result for:&nbsp;<span class="fst-italic"><?= $key; ?></span></h1>
                    <hr>
                    <div class="row">
                        <?php
                        if ($result) {
                            $resultID = $result['id'];
                            $products = getProductsByID($resultID);
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                        ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="singleProductView.php?product=<?= $item['slug']; ?>">
                                        <div class="card shadow-lg mb-5 rounded border-0">
                                                    <div class="card-body p-0">
                                                        <img src="./uploads/product/<?= $item['image']; ?>" alt="Product Image" class="w-100 center-cropped">
                                                        <h5 class="text-center mt-sm-3 mb-sm-3 fw-bolder" style="color: #8B4513;"><?= $item['name'];  ?></h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                <?php
                                    }
                            } else {
                                echo '<h5 class="ms-1 text-danger">' . "No product found. Please search for another one!" . '</5>';
                            }
                        } else {
                            echo '<h5 class="ms-1 text-danger">' . "No product found. Please search for another one!" . '</5>';
                        }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
} else {
    echo '<p class="ms-1">' . "Something went wrong" . '</p>';}

include('./includes/footer.php') 
?>
