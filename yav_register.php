<?php
//checks if array of fields are submitted
function areSet($submit, $arr) {
    $json = json_encode($submit);
    foreach ($arr as $variable) {
        if (strpos($json, $variable)==-1) return false;
    }
    return true;
}
$title = "Register";
include("yav_header.php");

if (areSet($_POST,['regName','regPass'])) {
    $regName = mysql_real_escape_string(stripcslashes($_POST['regName']));
    $regPass = mysql_real_escape_string(stripcslashes($_POST['regPass']));
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
    $con = mysqli_connect($host, $name, NULL, $db_name);
    //check if tbl_name exist. if no create it
    $tblIsSet = mysqli_query($con, "SHOW TABLES LIKE '$tbl_name'");
    if ($tblIsSet->num_rows==0) {
        echo "Table $tbl_name does not exist. Creating one...<br/>";
        $createTable = "CREATE TABLE {$tbl_name} (user_id INT(11) NOT NULL AUTO_INCREMENT, user_name VARCHAR (50) NOT NULL, password VARCHAR (32) NOT NULL, date_reg int(11) NOT NULL, PRIMARY KEY (user_id) )";
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
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['user_name']==$regName) {
                echo "User name already exists! Redirecting to index.php in 2 seconds";
                $newUser = false;
                header("refresh:2; url=index.php");
                break;
            }
        }
    }
    mysqli_free_result($query);
    //if no - add user to table
    if ($newUser) {
        $insertUser = mysqli_query($con, "INSERT INTO {$tbl_name} (`user_id`, `user_name`, `password`, `date_reg`) VALUES (NULL, '{$regName}', MD5('{$regPass}'), UNIX_TIMESTAMP())");
        if (!$insertUser) {
            die ("Error description: " . mysqli_error($con));
        } else {
            echo "successfully registered {$regName}<br/>You can now logg in";
            header("refresh:2; url=index.php");
        }
    }
    //close connection on finish
    mysqli_close($con);
}
?>
