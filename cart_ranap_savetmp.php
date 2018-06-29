<?php session_start();
include 'include/connect.php';
include 'include/function.php';
$kode	= str_replace('_','.',$_REQUEST['kode']);
$sql=mysql_query("select * from tmp_cartbayar where IP='".getRealIpAddr()."' and KODETARIF = '".$kode."' and KDDOKTER = '".$_REQUEST['dokter']."'");
if(mysql_num_rows($sql) > 0){
	mysql_query("update tmp_cartbayar set QTY=QTY+1 where IP='".getRealIpAddr()."' and KODETARIF ='".$kode."' and KDDOKTER = '".$_REQUEST['dokter']."'");
}else{
	$sq	= mysql_query('select * from m_tarif2012 where kode_tindakan = "'.$kode.'"');
	$dd	= mysql_fetch_assoc($sq);
	$ttotal	= $dd['tarif']+$_REQUEST['adm']-$_REQUEST['disc'];
	mysql_query('insert into tmp_cartbayar set KODETARIF = "'.$kode.'", IP = "'.getRealIpAddr().'", QTY=1, poly ='.$_REQUEST['ruang'].', DISCOUNT="'.$_REQUEST['disc'].'", ADMINISTRASI="'.$_REQUEST['adm'].'", TARIF = "'.$dd['tarif'].'", TOTTARIF="'.$ttotal.'", JASA_PELAYANAN = "'.$dd['jasa_pelayanan'].'", JASA_SARANA = "'.$dd['jasa_sarana'].'", UNIT = "'.$_SESSION['KDUNIT'].'", KDDOKTER = '.$_REQUEST['dokter']);
}
?>