<?php
session_start();
include_once 'functions.php';

if (!(isset($_POST['id']) && isset($_FILES['img']))){
    set_flash_message('danger', 'Ошибка запроса, повторите попытку');
    redirect_to('users.php');
    exit();
}

$uploaded_img = upload_avatar($_POST['id'], $_FILES['img']);
if ($uploaded_img){
    set_flash_message('success', 'Данные успешно обновлены');
    redirect_to('page_profile.php?id='.$_POST['id']);
    exit();
}
set_flash_message('danger', 'Ошибка запроса, повторите попытку');
redirect_to('page_profile.php?id=' . $_POST['id']);