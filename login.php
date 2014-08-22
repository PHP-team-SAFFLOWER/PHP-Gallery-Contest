<?php

$host = "localhost"; // Името на Host
$username = ""; // Mysql username
$password = ""; // Mysql password
$db_name = "login_test_db"; // Името на базата данни - сменяме го с правилното
$tbl_name = "members"; // Името на нашата таблица - сменяме я с правилната
// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password изпратени от формата
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];


//**********************************************************************
//TO CHECK WHERE TO PUT THIS CHECK
if(!isset($_POST['username']) || !isset($_POST['password'])){
    die('Fill all the fields');
}
//**********************************************************************


// По този начин валидираме и се предпазваме от injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result = mysql_query($sql);

// Mysql_num_row брои броя на редовете
$count = mysql_num_rows($result);

// Ако резултата от $myusername и $mypassword съвпадне, броя на table row трябва да е 1
//тоест имаме само едно съвпадение (unique user)

if ($count == 1) {

// Регистрира $myusername, $mypassword и пренасочва към "login_success.php" - който аз съп си правил за при  мен дали работи
    session_register("myusername");
    session_register("mypassword");
    header("location:login_success.php");//да сложим нащшата локация където ще пренасочваме 
} else {
    echo "Wrong Username or Password";
}
?>