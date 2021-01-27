<?php
/**
 * functions.php
 * Основные функции
 */
// подключение к БД
include_once 'db.php';

/**
 * Загрузить изображение аватара
 *
 * @param int $user_id
 * @param array $img
 *
 * @return boolean
 */
function upload_avatar(int $user_id, array $img)
{
    $imgDir = 'img/demo/avatars';
    d($img,0);
    if (is_uploaded_file($img['tmp_name'])){
        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        $imgName =uniqid().".".$ext;
        $path = "$imgDir/".$imgName;
        d($path,0);
        move_uploaded_file($img['tmp_name'], $path);
        return true;
    }
    return false;
}

/**
 * Установить статус пользователя
 *
 * @param int $user_id
 * @param string $status
 *
 * @return boolean
 */
function set_status(int $user_id, string $status)
{
    global $pdo;

    $query = "UPDATE users SET status=:status
              WHERE  id = :id";
    $params = [
        'id' => intval($user_id),
        'status' => $status,
    ];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    if ($statement->rowCount()) {
        return true;
    }
    return false;
}

/**
 * Редактирование общей информации о пользователе
 *
 * @param int $user_id
 * @param string $name
 * @param string $job_title
 * @param string $phone
 * @param string $address
 *
 * @return boolean
 */
function edit(int $user_id, string $name, string $job_title, string $phone, string $address)
{
    global $pdo;

    $query = "UPDATE users SET name=:name, job_title=:job_title, phone=:phone, address=:address
              WHERE  id = :id";
    $params = [
        'id' => intval($user_id),
        'name' => $name,
        'job_title' => $job_title,
        'phone' => $phone,
        'address' => $address,
    ];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    if ($statement->rowCount()) {
        return true;
    }
    return false;
}

/**
 * Проверка является ли пользователь администратором
 *
 * @param array $user user['role']=0 == администратор
 *
 * @return boolean
 */
function is_admin(array $user)
{
    return boolval(!$user['role']);
}


/**
 * Проверка авторизации пользователя
 *
 * @return boolean
 */
function is_not_logged_in()
{
    return (!isset($_SESSION['user']) && empty($_SESSION['user']));
}

/**
 * Функция авторизации пользователя
 *
 * @param string $email
 * @param string $password
 *
 * @return boolean
 */
function authorisation_user(string $email, string $password)
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
 * Получение всех пользователей
 *
 * @return array
 */
function get_all_users()
{
    global $pdo;
    $query = "SELECT * FROM users";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Поиск пользователя по email
 *
 * @param string $email
 *
 * @return array
 */

function get_user_by_email(string $email)
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

function add_user(string $email, string $password)
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

function set_flash_message(string $name, string $message)
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

function display_flash_message(string $name)
{
    if (isset($_SESSION[$name])) {
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

function redirect_to(string $path)
{
    header("Location: $path");
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
