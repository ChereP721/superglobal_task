<?php

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $resumePath = $uploadPath . $_FILES['resume']["name"];

    $f = fopen('Users.txt', 'a+');
    fwrite($f, "Имя пользователя: " . $name . "\n");
    fwrite($f, "Фамилия пользователя: " . $surname . "\n");
    fwrite($f, "Отчество пользователя: " . $patronymic . "\n");
    fwrite($f, "Телефон пользователя: " . $phone . "\n");
    fwrite($f, "Email пользователя: " . $email . "\n");
    fwrite($f, "Пароль пользователя: " . $password . "\n");
    fwrite($f, "Резюме пользователя: " . $resumePath . "\n");
    fwrite($f, "------------------------------" . "\n");
    fclose($f);

    setcookie("AuthCookie", md5($email . $password), time() + 3600);
    header("Location: /");
}
