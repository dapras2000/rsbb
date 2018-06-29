<?php 
include("../../include/connect.php");

$sql_rad = "delete from t_radiologi where IDXORDERRAD = '".$_GET['idxorder']."'";
mysql_query($sql_rad);

$psn="Hapus Data Berhasil";
header("Location:../../index.php?pesan=$psn&menu=3&link=51&nomr=".$_GET['nomr']."&idx=".$_GET['idx']);
exit;
?>