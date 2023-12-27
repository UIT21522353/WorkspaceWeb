
<?php
    include('./functions/userFunctions.php');
    include('./includes/header.php');
    include('./includes/slider.php'); ?>

    <div class="py-5">
        <div class="container">
            <div class="col-md-12">
                <h4 class="fw-bolder">Trending Now</h4>
                <div class="underline mb-3" style="width: 200px; background-color: #8B4513"> </div>

                <div class="owl-carousel">
                    <?php
                    $trendingProducts = getAllTrending();
                    if (mysqli_num_rows($trendingProducts) > 0)
                        foreach ($trendingProducts as $item) {
                    ?>
                        <div class="item">
                            <a href="singleProductView.php?product=<?= $item['slug']; ?>">
                                <div class="card shadow">
                                    <div class="card-body" style="height: 470px">
                                        <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100 center-cropped">
                                        <h5 class="text-center mt-sm-3 mb-sm-3 fw-bolder" style="color: #8B4513;"><?= $item['name'];  ?></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                        }
                    ?>
                </div>

            </div>
        </div>
    </div>
    </div>

<?php include('./includes/footer.php') ?>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navClass: ['owl-prev', 'owl-next'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    })
</script>


