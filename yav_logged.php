<?php
session_start();
echo "Welcome {$_SESSION['userName']}! You logged in successfully :)";