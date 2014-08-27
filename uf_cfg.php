<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$thisPath = dirname($_SERVER['PHP_SELF']);
$onlyPath = str_replace($rootPath, '', $thisPath);

$max_file_size = 2097152; // Размера в KB !
$upload_path = "./IMAGES/";
$upload_slash = DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
?>