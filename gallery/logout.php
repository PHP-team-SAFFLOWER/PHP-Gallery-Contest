<?php
session_start();
include("functions.php");
if (areSet($_SESSION, ['userName', 'isLogged'])) {
    if (session_destroy()){
        header("location: index.php");
    }
}