<?php 
include("../include/connect.php");

$sql_rad = "delete from t_orderlab where IDXORDERLAB = '".$_GET['idxorder']."'";
mysql_query($sql_rad);

$psn="Hapus Data Berhasil";
header("Location:../index.php?link=62&nomr=".$_GET['nomr']."&idx=".$_GET['idx']);
exit;
?>