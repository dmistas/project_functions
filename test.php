<?php
// этот файл не участвует в работе сайта
session_start();
include_once 'functions.php';
d(get_user_by_id(42));