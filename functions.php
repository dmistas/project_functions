<?php
/**
 * functions.php
 * Основные функции
 */
// подключение к БД
include_once 'db.php';

/**
 * Функция авторизации пользователя
 *
 * @param string $email
 * @param string $password
 *
 * @return boolean
 */
function authorisation_user($email, $password)
{
    $db_user = get_user_by_email($email);
    if ($db_user && ($db_user['password'] === $password)) {
        $_SESSION['user'] = $db_user['email'];
        return true;
    } else {
        set_flash_message('auth_error', 'Данная пара логин пароль не найдена');
        return false;
    }
}


/**
 * Функция отладки. Останавливает работу проргаммы выводя значение переменной
 *
 * @param null $value
 * @param int $die
 */
function d($value = null, $die = 1)
{
    echo 'Debug: <br><pre>';
    print_r($value);
    echo '</pre>';
    if ($die) die;
}

/**
 * Поиск пользователя по email
 *
 * @param string $email
 *
 * @return array
 */

function get_user_by_email($email)
{
    global $pdo;
    $query = "SELECT * FROM users WHERE email = (:email)";
    $params = ['email' => $email];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return $statement->fetch(PDO::FETCH_ASSOC);
}


/**
 * Добавить пользователя в БД
 *
 * @param string $email
 * @param string $password
 *
 * @return int|boolean (user_id)
 */

function add_user($email, $password)
{
    global $pdo;

    $query = "INSERT INTO users(email, password) VALUES (:email, :password)";
    $params = ['email' => $email, 'password' => $password];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    if ($statement->rowCount()) {
        $user = get_user_by_email($email);
        return $user['id'];
    }
    return false;
}


/**
 *  Подготовить флеш сообщение
 *
 * @param string $name (ключ в сессии)
 * @param string $message (значение, текст сообщения)
 *
 * @return void
 */

function set_flash_message($name, $message)
{
    $_SESSION[$name] = $message;
}


/**
 *  Вывести флеш сообщение
 *
 * @param string $name (ключ в сессии)
 *
 * @return void
 */

function display_flash_message($name)
{
    if (isset($_SESSION[$name])){
        echo "<div class=\"alert alert-$name\">$_SESSION[$name]</div>";
    }
    unset($_SESSION[$name]);
}


/**
 * Перенаправить на другую страницу
 *
 * @param string $path
 *
 * @return void
 */

function redirect_to($path)
{
    header("Location: $path");
}




