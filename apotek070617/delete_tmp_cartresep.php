<?php 
include '../include/connect.php';
include '../include/function.php';
$ip	= getRealIpAddr();
mysql_query('delete from tmp_cartresep where IDXOBAT = '.$_REQUEST['idobat']);
?>