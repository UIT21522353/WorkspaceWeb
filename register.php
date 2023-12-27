<?php
session_start();
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in";
    header('location: index.php');
    exit(); //the page will not continue after this line
}
include('./includes/header.php') ?>
<div style="padding: 200px; padding-top: 10px; position: relative; background-color: rgba(255, 255, 255, 0.75);">
    <img src="uploads/wp10509681.jpg" alt="Background Image" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: -1;">
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
                    <h3 class="display-5 fw-bold" style="color:#957B3F;">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="functions/authentication.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter your phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email" required>
                            </div>

                            <!-- password field with regex validation -->
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password" 
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Password must contain at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character">
                                <!-- The pattern in the provided code is a regular expression (regex) used to enforce certain requirements for the password. 
                                    ^: Start of the string
                                    (?=.*[a-z]): At least one lowercase letter.
                                    (?=.*[A-Z]): At least one uppercase letter.
                                    (?=.*\d): At least one digit.
                                    (?=.*[@$!%*?&]): At least one special character from the list @, $, !, %, *, ?, &.
                                    [A-Za-z\d@$!%*?&]{8,}: At least eight characters from the specified character set, including uppercase and lowercase letters, digits, and special characters @, $, !, %, *, ?, &.
                                    $: End of the string.
                                -->
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="Confirm password">
                            </div>

                            <button type="submit" name="registerBtn" class="btn btn-danger btn-hover-bg-shade-amount" role="button">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<?php include('./includes/footer.php') ?>