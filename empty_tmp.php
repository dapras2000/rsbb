<?php 
include("include/connect.php");
include("include/function.php");
mysql_query('delete from tmp_orderpenunjang where ip = "'.getRealIpAddr().'"');
mysql_query('delete from tmp_cartbayar where ip = "'.getRealIpAddr().'"');
?>