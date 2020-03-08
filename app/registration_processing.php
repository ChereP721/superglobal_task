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

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $resumePath = $uploadPath . $_FILES['resume']["name"];
    unset($_POST);

    /** Очистка значений переменных от HTML и PHP тегов */
    $name = clean($name);
    $surname = clean($surname);
    $patronymic = clean($patronymic);
    $phone = clean($phone);
    $email = clean($email);
    $password = clean($password);

    $success = false;
    $err = '';
    $successMessage = '';

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    switch (false) {
        case (!empty($name));
        case (!empty($surname));
        case (!empty($patronymic));
        case (!empty($phone));
        case (!empty($password));
        case (check_length($name));
        case (check_length($surname));
        case (check_length($patronymic));
        case (check_length($password, 6));
        case (check_length($phone)):
            unset($successMessage);
            $err = "Введенные данные некорректны";
            break;
        default:
            $checkPassed = true;
    }

    if ($checkPassed) {
        $password = md5($password);

        $request = "
        SELECT email FROM users WHERE email='$email'
        ";
        $query = mysqli_query($connect, $request);
        $resultArr = mysqli_fetch_all($query);

        if (count($resultArr) > 0) {
            unset($successMessage);
            $success = false;
            $err = 'Пользователь с данным e-mail уже зарегистрирован!';
        } else {
            $request = "
        INSERT INTO users (name, surname, patronymic, phone, email, password, resume_path) 
        VALUES ('$name', '$surname', '$patronymic', '$phone', '$email', '$password', '$resumePath')
        ";
            $query = mysqli_query($connect, $request);
            unset($err);
            $success = true;
        }
    }


    switch ($success) {
        case(true):
            setcookie("AuthCookie", md5(rand(0, 100000) . time()), time() + 3600);
            unset($err);
            $successMessage = 'Регистрация прошла успешно!';
            header("Location: http://superglobal/www/index.php");
            break;
        default:
            echo $err;
    }
}


