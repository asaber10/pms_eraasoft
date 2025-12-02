<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$phone    = $_POST['phone'] ?? '';
$notes   = $_POST['notes'] ?? '';

$errors = [];

if ($name == '')    $errors[] = "Name is required";
if ($email == '')   $errors[] = "Email is required";
if ($address == '') $errors[] = "Address is required";
if ($phone == '')   $errors[] = "Phone is required";

if (!empty($errors)) {
    foreach($errors as $e){
        echo $e . "\n";
    }
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

$order = [
    "id"         => time(),
    "name"       => $name,
    "email"      => $email,
    "address"    => $address,
    "phone"      => $phone,
    "notes"      => $notes,
    "total"      => $total,
    "items"      => $_SESSION['cart'],
    "created_at" => date("Y-m-d H:i:s")
];

$file = "../data/orders.json";

if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

$old = json_decode(file_get_contents($file), true);

if (!is_array($old)) {
    $old = [];
}

$old[] = $order;

file_put_contents($file, json_encode($old, JSON_PRETTY_PRINT));

unset($_SESSION['cart']);

echo "Order Created Successfully";
