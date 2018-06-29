<?php

session_start();



$_SESSION[w] = $_GET[w];

$_SESSION[h] = $_GET[h];



if(isset($_SESSION[w]) && isset($_SESSION[h])){

header('location: index.php');

}

?>

