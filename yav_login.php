<?php
//checks if array of fields are submitted
function areSet($submit, $arr) {
    $json = json_encode($submit);
    foreach ($arr as $variable) {
        if (strpos($json, $variable)==-1) return false;
    }
    return true;
}
session_start();
$title = "Login";
include("yav_header.php");

if (areSet($_POST,['logName','logPass'])) {
    $logName = mysql_real_escape_string(stripcslashes($_POST['logName']));
    $logPass = mysql_real_escape_string(stripcslashes($_POST['logPass']));
    $host="localhost"; // Host name
    $name="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="test_db"; // Database name
    $tbl_name="users"; // Table name

    //connect to mysql

    $con = mysqli_connect($host, $name, NULL);
    // Check connection
    if (mysqli_connect_errno())
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    //check if db_name exists. if no go to index.php
    $dbIsSet = mysqli_query($con, "SHOW DATABASES LIKE '$db_name'");
    if ($dbIsSet->num_rows==0) {
        header("refresh:2; url=index.php");
        die ("Database $db_name does not exist. Redirection to index.php<br/>");
    }
    mysqli_free_result($dbIsSet);
    $con = mysqli_connect($host, $name, NULL, $db_name);
    // Check connection
    if (mysqli_connect_errno()) {
        header("refresh:2; url=index.php");
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    //check if user name and password are correct
    $query=mysqli_query($con,"SELECT user_name, password FROM users WHERE user_name = '$logName' AND password = '".MD5($logPass)."'");
    $row = mysqli_fetch_assoc($query);
    if ($query->num_rows==1) {
        $_SESSION['userName'] = $logName;
        $_SESSION['isLogged'] = true;
        header("location:yav_logged.php");
    }
    else {
        echo "Wrong Username or Password";
        header("refresh:2; url=index.php");
    }

    mysqli_free_result($query);
    //close connection on finish
    mysqli_close($con);
}
