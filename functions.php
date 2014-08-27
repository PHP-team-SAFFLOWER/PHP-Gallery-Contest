<?php
//checks if array of fields are submitted
function areSet($submit, $arr) {
    if(empty($submit)) return false;
    $json = json_encode($submit);
    foreach ($arr as $variable) {
        if (strpos($json, $variable)==-1) return false;
    }
    return true;
}

function redirectOnError($page, $errMsg) {
?>
    <!DOCTYPE html>
    <html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="CSS/register.css">
    </head>
    <body>
    <section>
        <div class="user_interface">
            <p><?= $errMsg?></p>
        </div>
    </section>
    </body>
    </html>
<?php
    if ($_POST) {$_REQUEST=array();}
    header("refresh:2; url=$page");
    die ($errMsg);
}

function logged($userName) {
    if (!areSet($_SESSION, array('userName', 'isLogged')) || $userName !== $_SESSION[$userName]) {
        header("location: index.php");
    }
}