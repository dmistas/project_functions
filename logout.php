<?php
session_start();
include_once 'functions.php';
logout();
redirect_to('page_login.php');

