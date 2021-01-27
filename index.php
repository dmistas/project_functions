<?php
session_start();
include_once 'functions.php';

$email = '3new@email.com';
$pass = '123';
$new_user =add_user($email, $pass);
if ($new_user){
    $is_edit = edit($new_user,'sapegewyh@mailinator.com', 'mailinator', '+7123456', 'Moscow');
    echo "updated";
}
