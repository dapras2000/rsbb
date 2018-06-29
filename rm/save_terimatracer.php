<?php 
session_start();
include("../include/connect.php");

$sql= "update t_rekammedik set jam_terima_rm=CURTIME(), penerima='".$_POST['penerima_rm']."', tgl_terima='".$_POST['tgl_terima']."' WHERE IDXDAFTAR = ".trim($_POST['idxdaftar']);
 mysql_query($sql);
?>

<script language="javascript" type="text/javascript">
 alert("Simpan Sukses");
 //history.back();
 window.location="../index.php?link=13";
</script>
 
