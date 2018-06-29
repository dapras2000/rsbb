<?php session_start();
include("../include/connect.php");
include("../include/function.php");
$ip = getRealIpAddr();

print_r($_REQUEST);
$aturanpakai = $_REQUEST['aturan_obat_nr'];
$sediaan = $_REQUEST['sediaan_obat_nr'];

$dokter = $_REQUEST['dokter_resep_nr'];
$lapkemenkes = $_REQUEST['lapkemenkes'];
$laplain	= $_REQUEST['laplain'];

if($aturanpakai == "..."){
	$aturanpakai = $_REQUEST['aturan_text_nr'];
}
if($sediaan == "..."){
	$sediaan = $_REQUEST['sediaan_text_nr'];
}

$sql = mysql_query('select * from tmp_cartresep where KODE_OBAT = '.$_REQUEST['kode_obat_nr'].' and IDXDAFTAR = '.$_REQUEST['txtIdxDaftar'].' and IP = "'.$ip.'"');
if(mysql_num_rows($sql) > 0){
	mysql_query('update tmp_cartresep set JUMLAH = JUMLAH + '.$_REQUEST['jml_permintaan_nr'].' where KODE_OBAT = '.$_REQUEST['kode_obat_nr'].' and IDXDAFTAR = '.$_REQUEST['txtIdxDaftar'].' and IP = "'.$ip.'"');
}else{
	mysql_query('insert into tmp_cartresep set LAPKEMENKES = "'.$lapkemenkes.'", LAPLAIN = "'.$laplain.'", DOKTER = "'.$dokter.'", KODE_OBAT = "'.$_REQUEST['kode_obat_nr'].'", SEDIAAN = "'.$sediaan.'", ATURAN_PAKAI = "'.$aturanpakai.'", IP = "'.$ip.'", IDXDAFTAR = "'.$_REQUEST['txtIdxDaftar_nr'].'", JUMLAH = "'.$_REQUEST['jml_permintaan_nr'].'", HARGA_OBAT = "'.$_REQUEST['harga_obat_nr'].'",TANGGAL = CURDATE()');
	
}