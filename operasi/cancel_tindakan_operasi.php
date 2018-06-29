<?php
include ('../include/connect.php');
include ('../include/function.php');
$ip		= getRealIpAddr();
$kode	= str_replace('_','.',$_REQUEST['kode']);

mysql_query('delete from tmp_cartbayar where IDXBAYAR = "'.$_REQUEST['idxbayar'].'"');

?>