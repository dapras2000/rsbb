<?php session_start();
include 'include/connect.php';
include 'include/function.php';
$sql="CALL pr_savebill_tindakanrajal_tmpdokter('".$_REQUEST['nomr']."','1','".$_SESSION['NIP']."','".$_REQUEST['idxdaftar']."',CURDATE(),'0','0','".getRealIpAddr()."','".$_REQUEST['carabayar']."','".$_REQUEST['poly']."','1',".$_REQUEST['poly'].")";
if (mysql_query ($sql)){
	#mysql_query("INSERT INTO t_tindakan_medis (KODETARIF,TARIF,KDDOKTER,NOMR,IDXDAFTAR,NIP,TANGGAL,CARABAYAR,RAJAL) SELECT KODETARIF,TARIF,KDDOKTER,'".$_REQUEST['nomr']."',".$_REQUEST['idxdaftar'].",'".$_SESSION['NIP']."','".date("Y-m-d")."','".$_REQUEST['carabayar']."','1' FROM tmp_carttindakan_medis WHERE tmp_carttindakan_medis.IP = '".getRealIpAddr()."'");
	mysql_query("DELETE FROM tmp_cartbayar WHERE IP = '".getRealIpAddr()."'");
	#echo "<strong style='margin:5px; padding:5px;'>Simpan Pembayaran Sukses!</strong>";
}else{
	echo mysql_error();
}
?>