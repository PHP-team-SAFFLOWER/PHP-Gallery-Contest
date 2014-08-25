<?php
include("functions.php");
session_start();
if (!areSet($_SESSION, ['userName', 'isLogged'])) {
    session_destroy();
    header("location: index.php");
    die;
}
$userName = $_SESSION['userName'];
$title = "Gallery";

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="CSS/header.css">
    <link rel="stylesheet" type="text/css" href="CSS/footer.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <header>
        <div id="wrapper">
            <div id="logo" >
                <a href="#" id="logo_main">SAFFLOWER</a>
            </div>
            <div id="user">
                <p class="fa fa-user" ><a href="#">User: <?=$userName?></a></p>
                <p class="fa fa-sign-out"><a href="logout.php">Log Out</a></p>
            </div>
        </div>
        <nav>
            <hr class="neon_lines">
            <ul class="menu">
                <li><a href="">INFO</a></li>
                <li><a href="uf.html">UPLOAD</a></li>
                <li><a href="">REGISTER</a></li>
                <li><a href="">GALLERY</a></li>
                <li><a href="">CATEGORY</a></li>
            </ul>
            <hr class="neon_lines">

        </nav>

    </header>
</div>

<hr class="neon_lines_footer">
<footer class="footer">
    <div class="contacts">
        <p>Contacts</p>
        <ul>
            <li class="fa fa-facebook-square"><a href="">Facebook page</a></li>
            <li class="fa fa-github-alt"><a href="https://github.com/PHP-team-SAFFLOWER"> Git Hub</a> </li>
            <li class="fa fa-users"><a href="contacts.php"> Team Members</a> </li>
        </ul>

    </div>
</footer>


</body>
</html>