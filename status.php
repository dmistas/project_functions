<?php
session_start();
include_once 'functions.php';
// если не авторизован, перенаправляем на login
if (is_not_logged_in()) {
    redirect_to('page_login.php');
    exit();
}
// Есть ли права на редактирование
if (!is_admin() ?? $_POST['id'] !== $_SESSION['user']['id']) {
    set_flash_message('danger', 'Недостаточно прав для редактирования');
    redirect_to('users.php');
    exit();
}

if (set_status($_POST['id'], $_POST['status'])){
    set_flash_message('success', 'Статус успешно изменен');
    redirect_to('page_profile.php?id='.$_POST['id']);
}