<?php
session_start();
include_once 'functions.php';
upload_avatar(1, $_FILES['img']);
