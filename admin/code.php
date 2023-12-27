<?php
include('../config/dbconn.php');
include('../functions/myFunctions.php');
if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $category_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description,meta_keywords, status,popular, image) VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular','$filename')";
    $category_query_run = mysqli_query($conn, $category_query);
    if ($category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("addCategory.php", "Category Added Successfully");
    } else {
        redirect("addCategory.php", "Something went wrong");
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";
    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            //delete image
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("editCategory.php?id=$category_id", "Category updated successfully");
    } else {
        redirect("editCategory.php?id=$category_id", "Something went wrong");
    }
} else if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        echo 200;
        // redirect("category.php?", "Category deleted successfully");
    } else {
        echo 500;
        // redirect("category.php", "Something went wrong");
    }
} else if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // check null
    if (
        $name != "" && $slug != "" && $description != ""
        && $original_price != "" && $selling_price != "" && $qty != ""
    ) {
        $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, qty, meta_title, meta_description, meta_keywords, status, trending, image ) VALUES 
        ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price', '$qty', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$trending', '$filename')";

        $product_query_run = mysqli_query($conn, $product_query);
        if ($product_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            redirect("addProduct.php", "Product Added Successfully");
        } else {
            redirect("addProduct.php", "Something went wrong");
        }
    } else {
        redirect("addProduct.php", "All fields are mandatory");
    }
} else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $update_product_query = "UPDATE products SET name='$name',slug='$slug',small_description='$small_description',description='$description',
     original_price='$original_price', selling_price='$selling_price', qty='$qty', 
     meta_title='$meta_title',meta_description='$meta_description', meta_keywords='$meta_keywords',
     status='$status', trending='$trending', image='$update_filename' WHERE id='$product_id'";
    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            //delete image
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("editProduct.php?id=$product_id", "Product updated successfully");
    } else {
        redirect("editProduct.php?id=$product_id", "Something went wrong");
    }
} else if (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'";
    $product_query_run = mysqli_query($conn, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        echo 200;
        // redirect("product.php", "Product deleted successfully");
        
    } else {
        echo 500;
        // redirect("product.php", "Something went wrong");
       
    }
} else if (isset($_POST['update_order_btn'])) {
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $update_order_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no'";
    $update_order_query_run = mysqli_query($conn, $update_order_query);
    redirect("viewOrderDetail.php?t=$track_no", "Order status updated successfully");

} else if (isset($_POST['update_reservation_btn'])) {
    $id = $_POST['id'];

    $name = $_POST['name'];
    $adult = $_POST['adult'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $note = $_POST['note'];
    $status = $_POST['status'];

    $update_reservation_query = "UPDATE reservations SET name='$name',adult='$adult',phone='$phone',date='$date',time='time',
    note='$note',status='$status' WHERE id='$id'";
    $update_reservation_query_run = mysqli_query($conn, $update_reservation_query);

    if ($update_reservation_query_run) {
        redirect("updateReservation.php?id=$id", "Reservation updated successfully");
    } else {
        redirect("updateReservation.php?id=$id", "Something went wrong");
    }
} else if (isset($_POST['add_reservation_btn'])) {

    $name = $_POST['name'];
    $adult = $_POST['adult'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $note = $_POST['note'];
    $status = 2;

    $reservation_query = "INSERT INTO reservations (name,phone,adult,date,time,note,status) VALUES ('$name','$phone','$adult','$date', '$time', '$note', '$status')";
    $reservation_query_run = mysqli_query($conn, $reservation_query);
    if ($reservation_query_run) {
        redirect("reservation.php", "Reservation Added Successfully");
    } else {
        redirect("reservation.php", "Something went wrong");
    }
} else {
    header('location: ../index.php');
}