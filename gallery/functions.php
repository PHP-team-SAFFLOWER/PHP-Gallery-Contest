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
    if ($_POST) {$_POST=[];}
    header("refresh:2; url=$page");
    die ($errMsg);
}

function logged($userName) {
    if (!areSet($_SESSION, ['userName', 'isLogged']) || $userName !== $_SESSION[$userName]) {
        header("location: index.php");
    }
}