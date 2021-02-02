<?php
/**
 * functions.php
 * Основные функции
 */
// подключение к БД
include_once 'db.php';

/**
 * Записать в БД информаци. по социальным сетям
 *
 * @param int $user_id
 * @param string $vk
 * @param string $telegram
 * @param string $instagram
 */
function set_social_links(int $user_id, string $vk, string $telegram, string $instagram)
{
    global $pdo;
    $query = "UPDATE users SET vk=:vk, telegram=:telegram, instagram=:instagram
              WHERE  id = :id";
    $params = [
        'id' => $user_id,
        'vk' => $vk,
        'telegram' => $telegram,
        'instagram' => $instagram,
    ];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    if ($statement->rowCount()) {
        return true;
    }
    return false;
}

/**
 * Сформировать имя загружаемого файла uniqid + ext
 *
 * @param array $file (массив $_FILES['userfile'])
 *
 * @return string
 */
function create_upload_file_name(array $file)
{
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    return uniqid() . "." . $ext;
}

/**
 * Проверка есть ли файл картинки по пути
 *
 * @param string $image_path
 *
 * @return boolean
 */
function has_image(string $image_path){
    return file_exists($image_path);
}

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
    if (is_uploaded_file($img['tmp_name'])) {
        $imgName = create_upload_file_name($img);
        $path = "$imgDir/" . $imgName;
        $is_moved = move_uploaded_file($img['tmp_name'], $path);
        if ($is_moved) {
            set_avatar_path($user_id, $path);
            return true;
        }
    }
    return false;
}

/**
 * Записать в БД путь до изображения аватара
 *
 * @param int $user_id
 * @param string $path
 *
 * @return boolean
 */
function set_avatar_path(int $user_id, string $path)
{
    global $pdo;
    $query = "UPDATE users SET img=:img
              WHERE  id = :id";
    $params = [
        'id' => $user_id,
        'img' => $path,
    ];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    if ($statement->rowCount()) {
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
 * Проверка соответсвия паролей pass1=pass2 & !empty
 *
 * @param string $password
 * @param string $confirmed_password
 *
 * @return boolean
 */
function is_valid_passwords(string $password, string $confirmed_password){
    return ($password===$confirmed_password)&&!empty($password);
}

/**
 * Редактирование данных авторизации
 *
 * @param int $user_id
 * @param string $email
 * @param string $password
 * @param string $confirmed_password
 *
 * @return boolean
 */
function edit_credentials(int $user_id, string $email, string $password){
    global $pdo;

    $query = "UPDATE users SET email=:email, password=:password
              WHERE  id = :id";
    $params = [
        'id' => $user_id,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return boolval($statement);
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
        'id' => $user_id,
        'name' => $name,
        'job_title' => $job_title,
        'phone' => $phone,
        'address' => $address,
    ];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return boolval($statement);
}

/**
 * Проверка является ли пользователь администратором
 * $_SESSION['user']['role']=0 == администратор
 *
 * @return boolean
 */
function is_admin()
{
    return boolval(!$_SESSION['user']['role']);
}


/**
 * Проверка пользователь неавторизован = true
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
function login(string $email, string $password)
{
    $db_user = get_user_by_email($email);
    if ($db_user && (password_verify($password, $db_user['password']))) {
        $_SESSION['user']['id'] = $db_user['id'];
        $_SESSION['user']['role'] = $db_user['role'];
        $_SESSION['user']['email'] = $db_user['email'];
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
    $query = "SELECT * FROM users ORDER BY id desc";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Поиск пользователя по id
 *
 * @param int $id
 *
 * @return array
 */

function get_user_by_id(int $id)
{
    global $pdo;
    $query = "SELECT * FROM users WHERE id = (:id)";
    $params = ['id' => intval($id)];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return $statement->fetch(PDO::FETCH_ASSOC);
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
    $params = ['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)];
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    if ($statement->rowCount()) {
        return $pdo->lastInsertId();
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
