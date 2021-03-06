<?php require $_SERVER['DOCUMENT_ROOT'] . '/app/registration_processing.php'; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/app/file_processing.php' ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Регистрация</title>
</head>
<body>
<section class="btn">
    <a href="/www/index.php">Главная</a>
</section>
<main class="main__container">
    <h3>Регистрация</h3>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="text" name="surname" placeholder="Фамилия" required>
        <input type="text" name="patronymic" placeholder="Отчество" required>
        <input type="tel" name="phone" placeholder="Телефон" required>
        <input type="email" name="email" placeholder="Эл. почта" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="file" name="resume" placeholder="Резюме в формате *.pdf" required>
        <p>Загрузите резюме в формате *.pdf</p>
        <input type="submit" name="send" placeholder="Отправить">
    </form>

    <h3><?php

        if (isset($successMessage)) {
            echo $successMessage;
            unset($successMessage);
        }
        if (isset($err)) {
            echo $err;
            unset($err);
        } ?></h3>

</main>
</body>
</html>