<?php

if (isset($_POST['singin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $success = null;
    if (strpos(file_get_contents("Users.txt"), "$email")) {
        $success = 1;
    }

    if (strpos(file_get_contents("Users.txt"), "$password")) {
        $success = 2;
    }

    if ($success === 2) {
        setcookie("AuthCookie", md5($email . $password), time() + 3600);
        header("Location: /");
    }
}