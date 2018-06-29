<?php 
include '../include/connect.php';
include '../include/function.php';
$ip	= getRealIpAddr();

$sql = mysql_query('select * from tmp_racikan_obat where KODE_OBAT = '.$_REQUEST['kode_obat_racik'].' and IDXDAFTAR = '.$_REQUEST['txtIdxDaftar'].' and IP = "'.$ip.'" and NORACIKAN = "'.$_REQUEST['noracikan'].'"');
if(mysql_num_rows($sql) > 0){
	mysql_query('update tmp_racikan_obat set JUMLAH = JUMLAH + '.$_REQUEST['jml_obat_racik'].' where KODE_OBAT = '.$_REQUEST['kode_obat_racik'].' and IDXDAFTAR = '.$_REQUEST['txtIdxDaftar'].' and IP = "'.$ip.'"');
}else{
	mysql_query('insert into tmp_racikan_obat set KODE_OBAT = "'.$_REQUEST['kode_obat_racik'].'", IP = "'.$ip.'", IDXDAFTAR = "'.$_REQUEST['txtIdxDaftar'].'", JUMLAH = "'.$_REQUEST['jml_obat_racik'].'", HARGA_OBAT = "'.$_REQUEST['harga_obat_racik'].'",TANGGAL = CURDATE(),NORACIK = "'.$_REQUEST['noracikan'].'"');
	
}
?>