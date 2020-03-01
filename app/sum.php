<?php


/** Преобразовывает первый символ к int, если успех возвращает int, иначе string
 * @param $str
 * @return int|string
 */
function convertUserData($str)
{
    htmlspecialchars($str);
    $strArr = str_split($str);
    if ((int)$strArr['0'] === 0) {
        return (string)$str;
    } else {
        return (int)$str;
    }
}

/** Возвращает масив строк, если пользователь ввел строку
 * @param $str
 * @return array
 */
function findStrManyUserData($str)
{
    htmlspecialchars($str);
    $strArr = explode('/', $str);
    for ($I = 0; $I < count($strArr); $I++) {
        if (is_string(convertUserData($strArr[$I]))) {
            return $strArr;
        }
    }
}

$userData1 = null;
$userData2 = null;

if (isset($_POST['send'])) {
    $userData1 = convertUserData($_POST['number1']);
    $userData2 = convertUserData($_POST['number2']);
    $stringMerg = null;
    switch ($_POST) {
        case ($userData1 < 0 || $userData2 < 0):
            $error = 'Введите положительные числа';
            break;
        case (is_string($userData1) === true || is_string($userData2) === true):
            $stringMerg = $userData1 . $userData2;
            break;
        default:
            $sum = $userData1 + $userData2;
    }
}
