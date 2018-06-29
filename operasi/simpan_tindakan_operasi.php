<?php session_start();
include ('../include/connect.php');
include ('../include/function.php');
$id		= $_REQUEST['id_operasi'];
$ip		= getRealIpAddr();
$kode	= str_replace('_','.',$_REQUEST['kode']);
$ruang	= $_REQUEST['ruang'];
$jenis	= $_REQUEST['jenis'];
$factor	= $_REQUEST['faktor'];
$dokter = $_REQUEST['dokter'];
if($factor == 1){
	$jenis = 'E';
}else{
	$jenis = 'C';
}

$check_tmp 	= mysql_query('select * from tmp_cartbayar where IP = "'.$ip.'" and KODETARIF = "'.$kode.'" and KDDOKTER = "'.$dokter.'" and JENIS = "'.$jenis.'"');
if(mysql_num_rows($check_tmp) > 0){
	mysql_query('update tmp_cartbayar set qty = qty + 1 where IP = "'.$ip.'" and KODETARIF = "'.$kode.'" and KDDOKTER = "'.$dokter.'" and JENIS = "'.$jenis.'"');
	mysql_query('update t_operasi_tindakan_medis set qty = qty + 1 where kodejasa = "'.$kode.'" and idoperasi = "'.$id.'"');
}else{
	$tarif	= getTarif($kode);
	mysql_query('insert into tmp_cartbayar set 
	KODETARIF = "'.$kode.'", 
	QTY = 1, 
	IP ="'.$ip.'", 
	poly = "'.$ruang.'", 
	ID = "'.$id.'", 
	UNIT = "'.$_SESSION['KDUNIT'].'",
	DISCOUNT="0",
	KDDOKTER = "'.$dokter.'",
	JENIS	= "'.$jenis.'",
	TARIF = "'.$tarif['tarif'] * $factor.'", 
	TOTTARIF="'.$tarif['tarif'] * $factor.'", 
	JASA_SARANA = "'.$tarif['jasa_sarana'] * $factor.'", 
	JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'] * $factor.'"');
	mysql_query('insert into t_operasi_tindakan_medis set kodejasa = "'.$kode.'", QTY = 1, idoperasi="'.$id.'", tarif = "'.$tarif['tarif'] * $factor.'", jenis = "'.$jenis.'", dokter = "'.$dokter.'"');
}
?>