<?php
include '../include/connect.php';
$sql_pr='CALL pr_savebill_tindakanrajal_dokter_delete("'.$_REQUEST['idxdaftar'].'","'.$_REQUEST['nobill'].'","'.$_REQUEST['idxbill'].'")';
mysql_query($sql_pr);
?>