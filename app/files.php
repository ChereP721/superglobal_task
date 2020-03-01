<?php

/**
 * Функция возвращает расширение файла
 * @param string $filename - имя файла
 * @return string расширение файла
 */

function getExtension(string $filename): string
{
    return substr(strrchr($filename, '.'), 1);
}

$uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
if (isset($_FILES['resume'])) {
    if ($_FILES['resume']['size'] < 5000000) {
        switch ($_FILES['resume']['name']) {
            case getExtension($_FILES['resume']['name']) === 'pdf';
                move_uploaded_file($_FILES['resume']["tmp_name"], $uploadPath . $_FILES['resume']["name"]);
                break;
            default:
                echo 'не корректный формат';
        }
    } else {
        echo 'не корректный размер файла';
    }
}
