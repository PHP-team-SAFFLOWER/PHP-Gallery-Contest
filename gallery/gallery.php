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
<?php
require './header/header.php';
?>
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