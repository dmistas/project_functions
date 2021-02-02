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
// Получаем из БД существующие данные пользователя
$db_user = get_user_by_id($_POST['id']);

// Если email уже есть в БД и не принадлежит редактируемому пользователю->"email занят"
if ((boolean)get_user_by_email($_POST['email']) && ($db_user['email'] !== $_POST['email'])) {
    set_flash_message('danger', 'Данный email занят');
    redirect_to("page_security.php?id=" . $db_user['id']);
    exit();
}

// Назначаем переменным значения из $_POST, id из БД
$id = $db_user['id'];
$email = $_POST['email'];
$password = isset($_POST['password']) ? $_POST['password'] : "";
$confirmed_password = isset($_POST['confirmed_password']) ? $_POST['confirmed_password'] : "";

// Проверка паролей на валидность (пароли совпадают и не пустые)
if (!is_valid_passwords($password, $confirmed_password)) {
    set_flash_message('danger', 'Неподходящий пароль');
    redirect_to("security.php?id=$id");
    exit();
}
// Сохранение обновленных данный в БД
$is_save_security = edit_credentials($id, $email, $password);
if ($is_save_security) {
    set_flash_message('success', 'Данные сохранены');
    redirect_to("page_profile.php?id=$id");
    exit();
}


