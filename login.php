<?php
$arr = [1,2,3,4,5];

unset($arr[2]);

array_push($arr, 1);
$arr[] = 3;
foreach ($arr as $value){
    //echo $value . "<br/>";
}
//echo json_encode($arr);

$array = [];
for ($index = 0; $index < 10; $index++) {
    $array[] = [3,4,5];
}
//var_dump($array);
//echo json_encode($array);
$prices = ['apples' => 2.30, 'oranges' => 3];
var_dump($prices);
$prices['tomatoes'] = 5; // ADDING ELEMENT IN ASSOCIATVIE ARRAY - KEY VALUE

$pricess  = object($prices);  // TRANSFORMING PRICES FROM ASSOCIATIVE ARRAY TO AN OBJECT
$pricess -> color = 'red';
var_dump($pricess);