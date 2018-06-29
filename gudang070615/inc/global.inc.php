<?php
include("../../include/connect.php");
$host = $hostname;
$user = $username;
$pass = $password;
$name = $database;
$db = &new MySQL($host,$user,$pass,$name);
?>