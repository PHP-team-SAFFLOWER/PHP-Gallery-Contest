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
    <script type="javascript" src="js/Stars.js"></script>
    <script type="text/javacsript" src="js/jquery-1.11.1.min.js"></script>
    <script>
        function stars(radioButton) {
            var currentStarValue = parseInt(radioButton.value);

            var starRadioButtons = document.getElementsByName('star');
            for (var i = 0, len = starRadioButtons.length; i < len; i++) {
                var currentValue = parseInt(starRadioButtons[i].value);
                if (currentValue <= currentStarValue) {
                    starRadioButtons[i].style.width = '100px';
                } else {
                    starRadioButtons[i].style.width = '10px';
                }
            }
        }
    </script>
</head>
<body>
<div class="container">
<?php
include './header/header.php';
?>
</div>

<div class="container_gallery">
    <div class="photo">
        <img src="./IMAGES/vladi.png">
        <div class="rate">
            <form onsubmit="" class="stars">
                <input type="radio" name="star" value="1" class="radio" onclick="stars(this)"><span>1 Stars</span>>
                <input type="radio" name="star" value="2" class="radio" onclick="stars(this)"><span>2 Stars</span>>
                <input type="radio" name="star" value="3" class="radio" onclick="stars(this)"><span>3 Stars</span>>
                <input type="radio" name="star" value="4" class="radio" onclick="stars(this)"><span>4 Stars</span>>
                <input type="radio" name="star" value="5" class="radio" onclick="stars(this)"><span>5 Stars</span>>
            </form>
        </div>
    </div>
    <div class="coments">
        <div class="text">

        </div>

    </div>


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