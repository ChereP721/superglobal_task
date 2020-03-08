<?php require $_SERVER['DOCUMENT_ROOT'] . '/app/sum.php' ?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_COOKIE['AuthCookie'])) {
    ?>
    <main class="main__container main__page">
        <p>Добро пожаловать, Вы успешно авторизованы на сайте</p>
        <h3>Введите два положительных числа, чтобы посчитать их сумму или 2 строки, чтобы вывести их конкатенацию</h3>
        <form action="index.php" method="post">
            <label>
                <input type="text" name="number1" maxlength="20">
            </label>
            <label>
                <input type="text" name="number2" maxlength="20">
            </label>
            <input type="submit" name="send">
        </form>
        <h3> <?php
            if (isset($_POST['send'])) {
                if (isset($error)) {
                    echo $error;
                } elseif (isset($sum)) {
                    echo 'Сумма чисел равна: ' . $sum;
                } else {
                    echo 'Конкатенация строк: ' . $stringMerg;
                }
            }
            ?>
        </h3>

        <h3>Введите любое количество положительных целых чисел через /, чтобы посчитать их сумму</h3>
        <form action="index.php" method="post">
            <label>
                <input type="text" name="numbers" maxlength="300">
            </label>
            <input type="submit" name="submit">
        </form>
        <h3> <?php
            if (isset($_POST['submit'])) {
                $resultProcessing = findStrManyUserData($_POST['numbers']);
                if (is_array($resultProcessing)) {
                    echo 'Конкатенация строк: ' . implode($resultProcessing);
                } else {
                    $numbersArr = explode('/', $_POST['numbers']);
                    echo 'Сумма чисел равна: ' . array_sum($numbersArr);
                }
            }
            ?>
        </h3>
    </main>

<?php } else { ?>
    <section class="btn main__btn">
        <a href="registration.php">Регистрация</a>
        <a href="authorization.php">Вход</a>
    </section>
    <?php
    echo '<main class="main__container main__page"><h3>Войдите или зарегистрируйтесь</h3></main>';
} ?>

</body>
</html>