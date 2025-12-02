<?php
function sanitize_string($value){
    $value = trim($value ?? '');
    return  htmlspecialchars($value, ENT_QUOTES);
}
function sanitize_email($value){
    $value = trim($value ?? '');
    return filter_var($value, FILTER_SANITIZE_EMAIL);
}

