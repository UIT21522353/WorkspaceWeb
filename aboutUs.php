<?php
include('./functions/userFunctions.php');
include('./includes/header.php');
?>

<style>
    .bg-image {
        background: url(./assets/img/aboutUs.png);
        background-size: cover;
        height: 550px;
    }

    .bg-masterchef {
        background: url(./assets/img/masterchef.svg);
        background-size: cover;

    }

    .bg-standard {
        background: url(./assets/img/standard.png);
        background-size: cover;
    }
</style>

<div class="p-5 bg-image text-white d-flex align-items-center ">
    <h1 class="display-1 fw-bold">About Us</h1>
</div>

<div class="py-5 bg-f2f2f2 mb-2">
    <div class="container">
        <div class="row">
            <h3 class="fw-bolder d-flex justify-content-center"> Our Story </h3>
        </div>
        <div class="row">
            <p class="d-flex justify-content-center text-center">Our story began with a love of family, food, and the Italian way of life. We source our ingredients from local farmers and markets whenever possible, and we take pride in preparing our dishes with care and attention to detail.</p>
        </div>
        <div class="row">
            <p class="d-flex justify-content-center text-center">We believe that food is more than just sustenance. It is a way to bring people together and to celebrate life. We invite you to come and experience the magic of Italian dining at our restaurant. We will welcome you with open arms and treat you like family.</p>
        </div>
    </div>
    <br>
    <div class="underline mb-3" style="width: 15%; margin: auto; background-color: #8B4513;"></div>
</div>
<div class="p-5 bg-masterchef d-flex justify-content-center text center ">
    <div class="container">
        <div class="row">
            <h3 class="fw-bolder d-flex justify-content-center"> Masterchef </h3>
        </div>
        <div class="row">
            <p class="d-flex justify-content-center text-center">Chef Antonio was born and raised in the small town of Amalfi, Italy, where he grew up surrounded by the fresh seafood and seasonal produce that have become the hallmarks of his cuisine. His passion for cooking began at a young age, when he would spend hours in his grandmother's kitchen learning the secrets of traditional Italian recipes. Chef Antonio is passionate about creating a warm and welcoming dining experience for his guests. He invites you to come and taste the authentic flavors of Amalfi at his restaurant, where he will take you on a culinary journey through the heart of Southern Italy.</p>
        </div>
        <div class="row">
            <p class="d-flex justify-content-center text-center fw-bolder">Explore our website today and experience the magic of Chef Atonio's cuisine.</p>
        </div>
        <div class="row">
            <a href="category.php" class="btn text-white btn-hover-bg-shade-amount" style="background-color: #8B4513;" role="button" >Explore Our Menu</a>
        </div>
    </div>
</div>
<div class="py-5 bg-f2f2f2 pb-4">
    <div class="underline mt-3 m-auto" style="width: 15%; background-color: #8B4513;"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
            </div>
            <div class="col-md-3">
                <h3 class="fw-bolder d-flex justify-content-evenly p-3"> Testimalnial </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <p class="d-flex justify-content-center text-end">Chef Antonio was born and raised in the small town of Amalfi, Italy, where he grew up surrounded by the fresh seafood and seasonal produce that have become the hallmarks of his cuisine. His passion for cooking began at a young age, when he would spend hours in his grandmother's kitchen learning the secrets of traditional Italian recipes. Chef Antonio is passionate about creating a warm and welcoming dining experience for his guests. He invites you to come and taste the authentic flavors of Amalfi at his restaurant, where he will take you on a culinary journey through the heart of Southern Italy. </p>
            </div>
            <div class="col-md-3">
                <img src="./assets/img/testimalnial.png" alt="testimalnial">
            </div>
        </div>
    </div>
    <div class="underline mt-5 m-auto" style="width: 15%; background-color: #8B4513;"></div>
</div>
<div class="p-4 bg-standard d-flex justify-content-center text-center">
    <div class="container">
        <div class="row">
            <h3 class="fw-bolder d-flex justify-content-center"> Our Standard </h3>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="row">
                    <p class="d-flex justify-content-center text-center">Authentic Italian cuisine</p>
                </div>
                <div class="row">
                    <p class="d-flex justify-content-center text-center">Warm and inviting atmosphere</p>
                </div>
                <div class="row">
                    <p class="d-flex justify-content-center text-center">Extensive wine list</p>
                </div>
                <div class="row">
                    <p class="d-flex justify-content-center text-center">Fair prices</p>
                </div>
                <div class="row">
                    <p class="d-flex justify-content-center text-center">Commitment to excellence</p>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<div class="py-4 bg-f2f2f2 ">
    <div class="underline mt-0 mb-5 m-auto" style="width: 15%; background-color: #8B4513;"></div>
    <div class="container">
        <div class="col-md-5">
            <div class="row">
                <h3 class="fw-bolder d-flex justify-content-center"> Our Mission </h3>
            </div>
            <div class="row">
            <p class="d-flex justify-content-center text-center">We are committed to providing our guests with a warm and welcoming atmosphere, excellent service, and a menu that features something for everyone. We want our restaurant to be a place where people come to celebrate special occasions, enjoy a meal with family and friends, or simply relax and enjoy a delicious Italian meal.</p>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row"></div>
            <div class="row">
            <img src="./assets/img/mission.svg" alt="mission">
            </div>
        </div>
    </div>
</div>
<?php include('./includes/footer.php') ?>
