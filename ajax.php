<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    return false;
} 

    $data = array();
    $name = ($_POST['user-name']);
    $email = ($_POST['user-email']);
    $pay = ($_POST['pay-option']);
    $message = ($_POST['message']);
    $disturb = ($_POST['dont-disturb']);

    $disturb = isset($disturb) ? $disturb : 'ДА';
   
    $headers = "From: Администратор сайта <admin@loftschool.com>\r\n". 
    "MIME-Version: 1.0" . "\r\n" . 
    "Content-type: text/html; charset=UTF-8" . "\r\n";

$mail_message = '
<html>
    <head>
        <title>Заявка</title>
    </head>
    <body>
        <h2>Заказ</h2>
        <ul>
            <li>Имя:' . $name . '</li>
            <li>Email: ' .  $email . '</li>
            <li>Способ оплаты: ' .  $pay . '</li>
            <li>Комментарий к заказу: ' .  $message . '</li>
            <li>Нужно ли перезванивать клиенту: ' .  $disturb . '</li>
        </ul>
    </body>
</html>';

$mail = mail('koval@loftschool.com', 'Заказ', $mail_message, $headers);

if($mail){
    $data['status'] = "OK";
    $data['mes'] = "Письмо успешно отправлено";
}else{
    $data['status'] = "NO";
    $data['mes'] = "На сервере произошла ошибка";
}

echo json_encode($data);


// шпаргалка
// bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )
// http://php.net/manual/ru/function.mail.php 
// встроеный сервер
// http://php.net/manual/ru/features.commandline.webserver.php
// C:\OSPanel\userdata\temp\email - отправленные письма лежат тут

?>
