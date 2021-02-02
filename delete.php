<?php
session_start();
include_once 'functions.php';
// если не авторизован, перенаправляем на login
if (is_not_logged_in()) {
    redirect_to('page_login.php');
    exit();
}

$user_id = $_GET['id'];
// Есть ли права на редактирование
if (!is_admin() && $user_id !== $_SESSION['user']['id']) {
    set_flash_message('danger', 'Недостаточно прав для редактирования');
    redirect_to('users.php');
    exit();
}
// Формируем путь для редиректа
$redirect_path = ($user_id == $_SESSION['user']['id']) ? "page_register.php" : "users.php";

// Удаляем изображение аватара
$img_path = get_user_by_id($user_id)['img'];
delete_img($img_path);

$is_deleted_user = delete_user($user_id);
if (!$is_deleted_user) {
    set_flash_message('danger', 'Ошибка при удалении');
    redirect_to('users.php');
    exit();
}

// Усли не админ, закрываем сессию
if (!is_admin()) {
    logout();
}

set_flash_message('success', 'Пользователь был удален');
redirect_to($redirect_path);


