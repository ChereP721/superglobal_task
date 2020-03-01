<?php require 'app/singin.php'; ?>
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
    <a href="/">Главная</a>
</section>
<main class="main__container">
    <h3>Вход</h3>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="email" name="email" placeholder="Эл. почта">
        <input type="password" name="password" placeholder="Пароль">
        <input type="submit" name="singin" placeholder="Отправить">
    </form>
</main>
</body>
</html>