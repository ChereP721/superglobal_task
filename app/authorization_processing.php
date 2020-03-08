<?php

require $_SERVER['DOCUMENT_ROOT'] . '/app/config_db.php';

/** Очищает данные от HTML и PHP тегов
 * @param string $value
 * @return string
 */
function clean(string $value = ""): string
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

/**
 * Проверяет соответствие заданной длинне строки
 * @param string $str
 * @param int $min
 * @param int $max
 * @return bool
 */
function check_length(string $str, int $min = 2, int $max = 50): bool
{
    $countStr = mb_strlen($str);
    $result = ($countStr < $min || $countStr > $max);
    return !$result;
}

$connect = mysqli_connect(HOST, USER, PASS, DB_NAME);
if (!$connect) {
    exit('Ошибка подключения к БД!');
}
/* изменение набора символов на utf8 */
mysqli_set_charset($connect, "utf8");
mysqli_query($connect, "SET NAMES 'uft8'");

if (isset($_POST['singin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    unset($_POST);

    /** Очистка значений переменных от HTML и PHP тегов */
    $email = clean($email);
    $password = clean($password);

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $success = false;
    switch (false) {
        case (!empty($email));
        case (!empty($password));
        case (check_length($email));
        case (check_length($password)):
            $err = "Введенные данные некорректны";
            break;
        default:
            $success = true;
    }

    if ($success) {
        $password = md5($password);
        $request = "
        SELECT * FROM users WHERE email='$email' and password='$password'
        ";
        $query = mysqli_query($connect, $request);
        $resultArr = mysqli_fetch_all($query);
        if (count($resultArr) > 0) {
            header("Location: http://superglobal/www/index.php");
            setcookie("AuthCookie", md5(rand(0, 100000) . time()), time() + 3600);
        } else {
            $err = 'Пользователь не найден!';
        }
    }
}