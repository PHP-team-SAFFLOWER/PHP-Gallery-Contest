<?php
// Разделяме страницата на части и правим две функции function my_header($title) и function my_footer()
// Параметърът $title във my_header() е заглавието на стрницата. Пр.: Main page, Log in, Register и т.н.;

function my_header($title) {
    session_start(); //Стартиране на сесия за проследяване потребителя

//Изписване на header частта на всяка страница
echo '
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>' . $title . '</title>
<!--    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">-->
<!--    <link rel="stylesheet" type="text/css" href="CSS/header.css">-->
<!--    <link rel="stylesheet" type="text/css" href="CSS/footer.css">-->
<!--    <link rel="stylesheet" type="text/css" href="CSS/Register.css">-->
</head>
<body>
<div class="container">
    <header>
        <div id="wrapper">
            <div id="logo" >
                <a href="#" id="logo_main">SAFFLOWER</a>
            </div>
            <div id="user">
                <p class="fa fa-user" ><a href="">User</a></p>
                <p class="fa fa-sign-out"><a href="">Log Out</a></p>
            </div>
        </div>
        <nav>
            <hr class="neon_lines">
            <ul class="menu">
                <li><a href="">INFO</a></li>
                <li><a href="">UPLOAD</a></li>
                <li><a href="">REGISTER</a></li>
                <li><a href="">GALLERY</a></li>
                <li><a href="">CATEGORY</a></li>
            </ul>
            <hr class="neon_lines">
        </nav>
    </header>
</div>
';
}
?>

<?php
//Изписване на footer частта на всяка страница

function my_footer() {
echo'
<hr class="neon_lines_footer">

<footer class="footer">
    <div class="contacts">
        <p>Contacts</p>
        <ul>
            <li class="fa fa-facebook-square"><a href="">Facebook page</a></li>
            <li class="fa fa-github-alt"><a href=""> Git Hub</a> </li>
            <li class="fa fa-users"><a href=""> Team Members</a> </li>
        </ul>
    </div>
</footer>
</body>
</html>';
}

function db_init() {
    $host = 'localhost'; // Host name
    $username = 'root'; // Mysql username
    $password = ''; // Mysql password
    $db_name = 'phpproject'; // Database name

    $connect = mysql_connect($host, $username, $password) or die ('Problem with database');

    if (!mysql_select_db($db_name)) {
        echo 'Unable to select ' . $db_name . ': ' . mysql_error();
        exit;
    }
}
?>