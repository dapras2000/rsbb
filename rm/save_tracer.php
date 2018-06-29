<?php 
session_start();
include("../include/connect.php");
$apps	= _BASE_;
$sql	= "select * from t_rekammedik WHERE IDXDAFTAR = ".trim($_POST['idxdaftar']);
$row = mysql_query($sql)or die(mysql_error());
if(mysql_num_rows($row) > 0){
  	echo $sqls= ("update t_rekammedik set jam_kirim_rm=CURTIME(),pengirim='".$_POST['pengirim_rm']."', tgl_kirim='".$_POST['tglkirim']."',kdpoly=".$_POST['kdpoly'].",statusrm=".$_POST['statusrm']." WHERE IDXDAFTAR = '".trim($_POST['idxdaftar'])."'");
}else{
 	echo $sqls= "insert into t_rekammedik (tgl_kirim ,idxdaftar ,kdpoly ,pengirim ,statusrm, jam_kirim_rm,apps) 
		values('".$_POST['tglkirim']."',".$_POST['idxdaftar'].",".$_POST['kdpoly'].",'".$_POST['pengirim_rm']."',".$_POST['statusrm'].",CURTIME(),'".$apps."')";
}
mysql_query($sqls);
?>

<script language="javascript" type="text/javascript">
 alert("Simpan Sukses");
 //history.back();
 window.location="../index.php?link=13";
</script>
 
