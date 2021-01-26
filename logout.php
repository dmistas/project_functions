<?php
session_start();
include_once 'functions.php';
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
}
redirect_to('page_login.php');

