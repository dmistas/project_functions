<?php
session_start();
include_once 'functions.php';
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if (get_user_by_email($email)) {
        set_flash_message('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
        redirect_to("create_user.php");
    } else {
        $new_user_id = add_user($email, $pass); //добавляем нового пользователя в БД, функция возвращает id нового пользователя
        edit($new_user_id, $_POST['name'], $_POST['job_title'], $_POST['phone'], $_POST['address']);
        set_status($new_user_id, $_POST['status']);
        upload_avatar($new_user_id, $_FILES['img']);
        set_social_links($new_user_id, $_POST['vk'], $_POST['telegram'], $_POST['instagram']);
        set_flash_message('success', 'Пользователь добавлен');
        redirect_to('users.php');
    }
}

