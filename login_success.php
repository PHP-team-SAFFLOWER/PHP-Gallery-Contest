<?php
//Слагаме кода най-отгоре на страницата
session_start();
// Проверява дали сесията не е регестрирана, пренасочва обратно към основната страница

if(!session_is_registered(myusername)){
header("location:main_login.php");// файла който се отваря след логина
}
?>

<html>
    <body>
        Login Successful
    </body>
</html>
