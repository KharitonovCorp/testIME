<?php

include_once 'class_user/class_add.php';
include_once 'class_user/class_connect.php';

$name = $_POST["name"];
$age = $_POST["age"];
$phone = $_POST["phone"];

$user = new CreaterUser($name,$age,$phone);

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
if ($user->addition())
    alert('Запись успешно добавлена!');
else {
    alert('Ошибка');
}

?>
    <div style="text-align: center;">
        <h1>Тестовое задание на позицию Junior PHP Developer</h1>
        <form action="index.php" method="post">
            <label>Имя пользователя <input type="text" name="name" required placeholder="Введите ваше имя"></label>
            <br><br>
            <label>Возраст <input type="number" name="age" required placeholder="Введите ваш возраст"></label>
            <br><br>
            <label>Номер телефона <input type="tel" name="phone" required placeholder="+7 (999) 136-34-40" value="+7" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"></label>
            <br><br>
            <input type="submit" value="Отправить данные">
        </form>
    </div>