
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
    <div class="py-5 px-7 bg-f2f2f2">
        <div class="container">
            <div class="col-md-12">
                <h4 class="fw-bolder">About Us</h4>
                <div class="underline mb-3"  style="background-color: #8B4513"></div>
                <p class="text-break">
                    Welcome to FOODIES, where culinary excellence meets a diverse tapestry of flavors! We are passionate about bringing together a myriad of tastes from around the world to create a gastronomic experience that transcends borders. Our journey began with a simple yet profound idea: to connect people through the universal language of food. Whether you're a seasoned foodie or just beginning your culinary adventure, we invite you to explore the rich and varied offerings that make up our food web.
                </p>
                <a href="aboutUs.php" class="btn btn-primary btn btn-danger float-end" role="button" >Read More</a>
            </div>
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


