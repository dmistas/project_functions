<?php

include_once "functions.php";
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if (get_user_by_email($email)){
        session_start();
        set_flash_message('danger_email_already_in_use', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
        set_flash_message('email', $email);
        redirect_to("page_register.php");
    } else {
        $new_user = add_user($email, $pass);
        set_flash_message("success_registration", "Регистрация успешна");
        set_flash_message('email', $email);
        redirect_to("page_login.php");
    }
}
