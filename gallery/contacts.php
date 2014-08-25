<?php
include("functions.php");
session_start();
if (!areSet($_SESSION, ['userName', 'isLogged'])) {
    session_destroy();
    header("location: index.php");
    die;
}
$userName = $_SESSION['userName'];
$title = "Contacts";
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="CSS/header.css">
    <link rel="stylesheet" type="text/css" href="CSS/contact.css">
    <link rel="stylesheet" type="text/css" href="CSS/footer.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

</head>
<body>
<div class="container">
    <?php
    require './header/header.php';
    ?>
    <main class="team">

        <div class="person">
            <div class="role">
                <p class="fa fa-eye"><span class="span">Front End</span></p>
                <span>MIROSLAV CHALOV</span>
                <div class="person_image">
                    <img src="IMAGES/miro.png">
                </div>
            </div>

        </div>
        <div class="person">
            <div class="role">
                <p class="fa fa-database"><span class="span">Data Base</span></p>
                <span>YAVOR MITEV</span>
                <div class="person_image">
                        <img src="IMAGES/yavor.png">
                </div>
            </div>

        </div>
        <div class="person">
            <div class="role">
                <p class="fa fa-cog"><span class="span">Back-End</span></p>
                <span>YULIYAN KOSTOV</span>
                <div class="person_image">
                     <img src="IMAGES/ulian.png">
                </div>
            </div>

        </div>
        <div class="person">
            <div class="role">
                <p class="fa fa-cog"><span class="span">Back-End</span></p>
                <span>IVAYLO GLOUHTCHEV</span>
                <div class="person_image">
                    <img src="IMAGES/ivaylo.png">
                </div>
            </div>

        </div>
        <div class="person">
            <div class="role">
                <p class="fa fa-cog"><span class="span">Back-End</span></p>
                <span>VLADIMIR VELKOV</span>
                <div class="person_image">
                    <img src="IMAGES/vladi.png">
                </div>
            </div>

        </div>


    </main>

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
</div>

</body>
</html>