<?php
include '../include/connect.php';
include '../include/function.php';
mysql_query('delete from tmp_cartbayar where IDXBAYAR = '.$_REQUEST['idxbayar']);
?>