<?php 
include '../include/connect.php';
include '../include/function.php';

mysql_query('delete from t_obat2 where id = '.$_REQUEST['id'].'');
?>