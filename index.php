<?php
session_start();
//ob_start();
$title = "Login";
include("functions.php");

if ($_POST && areSet($_POST,array('user_login','user_password'))) {
    $logName = $_POST['user_login'];
    $logPass = $_POST['user_password'];
    $host="localhost"; // Host name
    $name="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="gallery_db"; // Database name
    $tbl_name="users"; // Table name

    //connect to mysql
    $con = mysqli_connect($host, $name, $password);
    $logName = mysqli_real_escape_string($con, stripcslashes($_POST['user_login']));
    $logPass = mysqli_real_escape_string($con, stripcslashes($_POST['user_password']));
    // Check connection
    if (mysqli_connect_errno()) {
        mysqli_close($con);
        redirectOnError("index.php", "Failed to connect to MySQL: ". mysqli_connect_error());
    }
    //check if db_name exists. if no go to index.php
    $dbIsSet = mysqli_query($con, "SHOW DATABASES LIKE '$db_name'");
    if ($dbIsSet->num_rows==0) {
        mysqli_close($con);
        redirectOnError("index.php", "Database $db_name does not exist. Redirection to index.php<br/>");

    }
    mysqli_free_result($dbIsSet);
    $con = mysqli_connect($host, $name, $password, $db_name);
    // Check connection
    if (mysqli_connect_errno()) {
        mysqli_close($con);
        redirectOnError("index.php", "Failed to connect to MySQL: " . mysqli_connect_error());
    }
    //check if user name and password are correct
    $query=mysqli_query($con,"SELECT user_name, password FROM users WHERE user_name = '$logName' AND password = '".MD5($logPass)."'");
    if ($query->num_rows==1) {
//        $row = mysqli_fetch_assoc($query);
        $_REQUEST = array();
        $_SESSION['userName'] = $logName;
        $_SESSION['isLogged'] = true;
        header("location:gallery.php");
        mysqli_close($con);
        die;
    }
    else {
        mysqli_close($con);
        redirectOnError("index.php", "Wrong Username or Password");
    }

    mysqli_free_result($query);
    //close connection on finish
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="CSS/register.css">

</head>
<body>
<?php
include './header/header.php';
?>

</body>
</html>