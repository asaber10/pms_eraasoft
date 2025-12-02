<?php
session_start();
require_once "../core/functions.php";
require_once "../core/validation.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Method Not Allowed");
}

$name             = $_POST["name"] ?? '';
$email            = $_POST["email"] ?? '';
$password         = $_POST["password"] ?? '';
$confirm_password = $_POST["confirm_password"] ?? '';

$name  = sanitize_string($name);
$email = sanitize_email($email);

$errors = validate_register($name, $email, $password, $confirm_password);

if (!empty($errors)) {
    $_SESSION['reg_errors'] = $errors;
    header("Location: ../register.php");
    exit;
}

$user_file = "../data/users.json";

if (!file_exists($user_file)) {
    file_put_contents($user_file, json_encode([]));
}

$users = json_decode(file_get_contents($user_file), true);

if (!is_array($users)) {
    $users = [];
}

foreach ($users as $user) {
    if ($user["email"] === $email) {
        $_SESSION['reg_errors'] = ["Email already exists"];
        header("Location: ../register.php");
        exit;
    }
}

$new_user = [
    "name"     => $name,
    "email"    => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT),
];

$users[] = $new_user;

file_put_contents($user_file, json_encode($users, JSON_PRETTY_PRINT));

$_SESSION['success'] = "Account created successfully, please login";
header("Location: ../login.php");
exit;
