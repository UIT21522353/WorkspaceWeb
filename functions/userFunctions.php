<?php
session_start();
include('config/dbconn.php');

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status='0'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getAllTrending()
{
    global $conn;
    $query = "SELECT * FROM products WHERE trending='1'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('location:' . $url);
    exit();
}

function getByIDActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id=? AND status='0'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getBySlugActive($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE slug=? AND status='0' LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getProductsByCate($category_id)
{
    global $conn;
    $query = "SELECT * FROM products WHERE category_id=? AND status='0'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getProductsByID($product_id)
{
    global $conn;
    $query = "SELECT * FROM products WHERE id=? AND status='0'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getCartItems()
{
    global $conn;
    $userID = $_SESSION['auth_user']['user_id'];
    $query = "SELECT carts.id as cid, carts.product_qty, products.id as pid, products.name, products.image, products.selling_price 
    FROM carts, products
    WHERE carts.product_id=products.id
    AND carts.user_id=?
    ORDER BY carts.id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getOrders()
{
    global $conn;
    $userID = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function checkTrackingNoExist($trackingNo)
{
    global $conn;
    $userID = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no=? AND user_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $trackingNo, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getWishlistItems()
{
    global $conn;
    $userID = $_SESSION['auth_user']['user_id'];
    $query = "SELECT wishlist.id as wid, wishlist.product_qty, products.id as pid, products.name, products.image, products.selling_price 
    FROM wishlist, products
    WHERE wishlist.product_id=products.id
    AND wishlist.user_id=?
    ORDER BY wishlist.id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function searchProduct($key)
{
    global $conn;
    $query = "SELECT * FROM products WHERE products.name LIKE ?";
    $stmt = $conn->prepare($query);
    $key = '%' . $key . '%';
    $stmt->bind_param('s', $key);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getOrdersItems()
{
    global $conn;
    $userID = $_SESSION['auth_user']['user_id'];
    $query = "SELECT tracking_no, total_price, status, created_at
    FROM orders
    ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getBySlugOrder($slug)
{
    global $conn;
    $query = "SELECT products.name as product_name, products.image as product_image, 
    order_items.qty as product_qty, order_items.price as product_price, 
    orders.name as name, orders.email as email, orders.phone as phone, orders.address as address, 
    orders.total_price as total_price, orders.status as status, orders.created_at as ordered_at
    FROM products, order_items, orders 
    WHERE orders.tracking_no=?
    AND orders.id=order_items.order_id
    AND products.id=order_items.product_id";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
?>