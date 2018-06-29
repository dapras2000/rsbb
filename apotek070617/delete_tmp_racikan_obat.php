<?php 
include '../include/connect.php';
include '../include/function.php';
$ip	= getRealIpAddr();
mysql_query('delete from tmp_racikan_obat where IDXRACIK = '.$_REQUEST['idobat']);
?>