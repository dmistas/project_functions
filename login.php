<?php
session_start();
include_once 'functions.php';

$login_email = isset($_POST['email'])?$_POST['email']:"";
$login_password = isset($_POST['password'])?$_POST['password']:"";

if (authorisation_user($login_email, $login_password) || !is_not_logged_in()){
    redirect_to('users.php');
} else {
    set_flash_message('danger', 'Пара логин пароль не верна');
    redirect_to('page_login.php');
}

