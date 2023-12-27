<?php
session_start();
include('./includes/header.php');
include('./config/dbconn.php');

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are not logged in";
    header('location: login.php');
    exit();
}

// Lấy thông tin người dùng từ session
$user = $_SESSION['auth_user'];

// Check if the user is an admin (role_as = 1)
$query = "SELECT role_as FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['role_as'] == 1) {
        $_SESSION['message'] = "Admins are not allowed to update profile";
        echo '<script>window.location.href = "myProfile.php";</script>';
        exit();
    }
} else {
    // Handle the case where the user is not found in the database
    $_SESSION['message'] = "Error: User not found";
    echo '<script>window.location.href = "myProfile.php";</script>';
    exit();
}
$email = $_SESSION['auth_user']['email'];

// Xử lý form cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $image = $_FILES['avatar']['name'];

    // Thực hiện truy vấn cập nhật thông tin người dùng
    $sql = "UPDATE users SET name=?, email=?, phone=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $name, $email, $phone, $user['user_id']);

    if ($stmt->execute()) {
        // Cập nhật thông tin người dùng trong session
        $_SESSION['auth_user']['name'] = $name;
        $_SESSION['auth_user']['email'] = $email;
        $_SESSION['auth_user']['phone'] = $phone;

        // Xử lý avatar nếu có được tải lên
        if ($_FILES['avatar']['name'] != "") {
            $avatar_path = "./avt-image/";
            $avatar_filename =  $_FILES['avatar']['name'];

            if (file_exists($_FILES['avatar']['tmp_name'])) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_path . $avatar_filename);

                // Lưu đường dẫn avatar vào cơ sở dữ liệu
                $update_avatar_query = "UPDATE users SET image=? WHERE id=?";
                $stmt_avatar = $conn->prepare($update_avatar_query);
                $stmt_avatar->bind_param('si', $avatar_filename, $user['user_id']);

                if (!$stmt_avatar->execute()) {
                    echo "Error updating avatar: " . $stmt_avatar->error;
                } else {
                    // Cập nhật đường dẫn avatar trong session
                    $_SESSION['auth_user']['image'] = $avatar_filename;
                }
            } else {
                echo "Error: File not found!";
            }
        }

        $_SESSION['message'] = "Record updated successfully";

        echo '<script>window.location.href = "myProfile.php";</script>';
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

?>

<style>
    .avatar-preview {
        margin-right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Profile</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <div class="d-flex align-items-center">
                                    <?php if (isset($user['image'])) : ?>
                                        <img src="<?= $user['image'] === 'default.jpg' ? './avt-image/avt.jpg' : './avt-image/' . $user['image'] ?>" alt="Avatar Preview" class="avatar-preview mr-2">
                                    <?php else : ?>
                                        <img src="./avt-image/avt.jpg" alt="Default Avatar" class="avatar-preview mr-2">
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?= $user['phone']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Update</button>

                            <a href="myProfile.php" class="btn btn-secondary" style="margin-left: 70%;">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/footer.php'); ?>