<?php
session_start();
include_once 'functions.php';
$user = get_user_by_email("dmistas@gmail.com");

d($user);