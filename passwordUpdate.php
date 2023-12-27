<?php
session_start();

include('./includes/header.php') ?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey! </strong><?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php
                            unset($_SESSION['message']);
                        } ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authentication.php" method="POST">

                            <input type="hidden" name="passwordToken" value="<?php if (isset($_GET['token'])) {echo $_GET['token'];} ?>">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" value="<?php if (isset($_GET['email'])) {echo $_GET['email'];} ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter your email" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="InputResetPassword" class="form-label">New Password</label>
                                <input type="password" name="newPassword" class="form-control" placeholder="Enter your new password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Password must contain at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character">
                            </div>
                            <div class="mb-3">
                                <label for="ConfirmNewPassword" class="form-label"> Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm your new password">
                            </div>
                            <button type="submit" name="updatePasswordBtn" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<?php include('./includes/footer.php') ?>