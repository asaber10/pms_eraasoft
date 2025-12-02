<?php
session_start();
require_once "../core/validation.php";
require_once "../core/functions.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Method Not Allowed");
}

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$email = sanitize_email($email);

$errors = [];

if (empty($email)) {
    $errors[] = "Email cannot be empty";
}

if (empty($password)) {
    $errors[] = "Password cannot be empty";
}

if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    header("Location: ../login.php");
    exit;
}

$user_file = "../data/users.json";

if (!file_exists($user_file)) {
    die("Users file not found");
}

$users_json = file_get_contents($user_file);
$users = json_decode($users_json, true) ?? [];

$found = false;

foreach ($users as $user) {

    if ($email === $user['email']) {
        $found = true;

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            header("Location: ../index.php");
            exit;
        } else {
            $errors[] = "Password is incorrect";
            break;
        }
    }
}

if (!$found) {
    $errors[] = "Email not found";
}

if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    header("Location: ../login.php");
    exit;
}
