<?php
session_start();

if (!isset($_GET['id'])) {
    die("Invalid product");
}

$id = intval($_GET['id']);

$products = json_decode(file_get_contents("../data/products.json"), true);

$product_found = null;

foreach ($products as $p) {
    if ($p['id'] == $id) {
        $product_found = $p;
        break;
    }
}

if (!$product_found) {
    die("Product not found");
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    $_SESSION['cart'][$id] = [
        "name" => $product_found['name'],
        "price" => $product_found['price'],
        "qty" => 1
    ];
}

header("Location: ../cart.php");
exit;
