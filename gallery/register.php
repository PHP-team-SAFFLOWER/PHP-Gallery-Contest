<?php
session_start();
//ob_start();
$title = "Register";
include("functions.php");

if (areSet($_POST,['regName','regPass', 'confPass', 'email'])) {
    $regName = $_POST['regName'];
    if (strlen($regName)>50) {
        redirectOnError('register.php', 'Too long user name');
    }
    $regPass = $_POST['regPass'];
    $confPass = $_POST['confPass'];
    if ($regPass!==$confPass) {
        redirectOnError('register.php', 'Wrong Confirmation Password');
    }
    $email = $_POST['email'];
    if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $email) or (strlen($email)>50)) {
        redirectOnError('register.php', 'Invalid email');
    }
    $host="localhost"; // Host name
    $name="root"; // Mysql username
    $password=""; // Mysql password
    $db_name="gallery_db"; // Database name
    $tbl_name="users"; // Table name

    //connect to mysql
    $con = mysqli_connect($host, $name, $password);
    $regName = mysqli_real_escape_string($con, stripcslashes($_POST['regName']));
    $regPass = mysqli_real_escape_string($con, stripcslashes($_POST['regPass']));
    $email = mysqli_real_escape_string($con, stripcslashes($_POST['email']));
    // Check connection
    if (mysqli_connect_errno())
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    //check if db_name exists. if no create it
    $dbIsSet = mysqli_query($con, "SHOW DATABASES LIKE '$db_name'");
    if ($dbIsSet->num_rows==0) {
        echo "Database $db_name does not exist. Creating one...<br/>";
        $createDB = "CREATE DATABASE {$db_name} COLLATE=utf8_unicode_ci";
        if (!mysqli_query($con, $createDB)) {
            die ("Cant create database! ".mysqli_error($con)."(".mysqli_errno($con).")<br/>");
        }
        echo "database $db_name created successfully :)<br/>";
    }
    mysqli_free_result($dbIsSet);

    //connect to db_name
    $con = mysqli_connect($host, $name, $password, $db_name);
    //check if tbl_name exist. if no create it
    $tblIsSet = mysqli_query($con, "SHOW TABLES LIKE '$tbl_name'");
    if ($tblIsSet->num_rows==0) {
        echo "Table $tbl_name does not exist. Creating one...<br/>";
        $createTable = "CREATE TABLE {$tbl_name} ( "
        ."user_id INT(11) NOT NULL AUTO_INCREMENT, "
        ."user_name VARCHAR (50) NOT NULL, "
        ."password VARCHAR (32) NOT NULL, "
        ."email VARCHAR (50) NOT NULL, "
        ."date_reg int(11) NOT NULL, "
        ."PRIMARY KEY (user_id) )";
        if (!mysqli_query($con, $createTable)) {
            die ("Cant create table! ".mysqli_error($con)."(".mysqli_errno($con).")<br/>");
        }
        echo "table $tbl_name created successfully :)<br/>";
    }
    mysqli_free_result($tblIsSet);

    $newUser = true;
    //check if user name already exist
    $query=mysqli_query($con,"SELECT user_name FROM {$db_name}.{$tbl_name}");
    if ($query->num_rows>0) {
        if (mysqli_fetch_assoc($query)['user_name']==$regName) {
            $newUser = false;
            redirectOnError('index.php', 'User name already exists! Redirecting to index.php in 2 seconds');
        }
    }
    mysqli_free_result($query);
    //if no - add user to table
    if ($newUser) {
        $inputStr = "INSERT INTO {$tbl_name} (user_id, user_name, password, email, date_reg) "
            ."VALUES (NULL, '{$regName}', MD5('{$regPass}'), '{$email}', UNIX_TIMESTAMP())";
        $insertUser = mysqli_query($con, $inputStr);
        if (!$insertUser) {
            die ("Error description: " . mysqli_error($con));
        } else {
            redirectOnError("index.php", "successfully registered {$regName}<br/>You can now logg in");
        }
    }
    //close connection on finish
    mysqli_close($con);
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="CSS/register.css">

</head>
<body>
<header>
    <h1>Neon Gallery</h1>
    <nav class="user_interface">
        <header>REGISTRATION FORM</header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <input type="text" name="regName" id="user" required="" placeholder="USERNAME">
    <input type="password" name="regPass" id="password" required="" placeholder="PASSWORD">
    <input type="password" name="confPass" id="confpassword" placeholder="REPEAT PASSWORD">
    <input type="email" name="email" id="mail" required="" placeholder="EMAIL">
    <input type="submit" name="submit" id="submit" value="REGISTER NOW">
    </form>
        <form>
            <input type="submit" name="try_free" id="try_free" required="" value="TRY FOR FREE">
            <input type="submit" name="login" id="login" required="" value="LOGIN">
        </form>
    </nav>

</header>

</body>
</html>