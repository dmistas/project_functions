<?php
<<<<<<< HEAD
=======
session_start();
include_once 'functions.php';

$login_email = isset($_POST['email'])?$_POST['email']:"";
$login_password = isset($_POST['password'])?$_POST['password']:"";

if (authorisation_user($login_email, $login_password)){
    set_flash_message('success', 'Авторизация успешно пройдена!');
    redirect_to('users.php');
} else {
    set_flash_message('danger', 'Пара логин пароль не верна');
    redirect_to('page_login.php');
}


>>>>>>> 9cfa121e518e4e66d2a067893d66caaecb51c7b3
