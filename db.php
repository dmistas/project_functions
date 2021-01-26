<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=project', "root", "", [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo "Невозможно установить соединение с БД" . $e->getMessage();
}
