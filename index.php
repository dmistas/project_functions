<?php
session_start();
include_once 'functions.php';
echo isset($_GET['edit'])?"edit":"no edit";
d($_GET, 0);
d($_SERVER);