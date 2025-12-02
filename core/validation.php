<?php
function validate_register($name, $email, $password, $confirm_password){
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email format is invalid";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (!empty($password) && strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if (empty($confirm_password)) {
        $errors[] = "Confirm password is required";
    } else if (!empty($password) && !empty($confirm_password) && $password != $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    return $errors;
}
function validate_login ($email, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email format is invalid";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
        return $errors;
    }
}



