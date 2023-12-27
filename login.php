<?php
session_start();
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in";
    header('location: index.php');
    exit(); //the page will not continue after this line
}
include('./includes/header.php') ?>
<div style="padding: 180px; padding-top: 5px; position: relative; background-color: rgba(255, 255, 255, 0.75);">
    <img src="uploads/wp10509681.jpg" alt="Background Image" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: -1;">
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey! </strong><?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php
                            unset($_SESSION['message']);
                        } ?>

                <div class="card">
                    <div class="card-header">
                    <h3 class="display-5 fw-bold" style="color:#957B3F;">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="functions/authentication.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                            </div>
                            <button type="submit" name="loginBtn" class="btn btn-danger btn-hover-bg-shade-amount" role="button">Login</button>
                            <a href="passwordReset.php" class="float-end"> Forgot Password </a>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
</div>

<?php include('./includes/footer.php') ?>