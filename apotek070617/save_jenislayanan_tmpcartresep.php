<?php 
include '../include/connect.php';
include '../include/function.php';
$ip	= getRealIpAddr();

$id_jenis = $_REQUEST['id_jenis'];
$qty	  = $_REQUEST['qty'];
$dokter	  = $_REQUEST['dokter'];
$sql = mysql_query('select * from m_tarif2012 where kode_tindakan = "'.$id_jenis.'"');
$row = mysql_fetch_array($sql);

$mysql	= mysql_query('select * from tmp_cartresep where KODE_OBAT = "'.$row['kode_tindakan'].'" and IP = "'.$ip.'"');
if(mysql_num_rows($mysql) > 0){
	#mysql_query('update tmp_cartresep set JUMLAH = JUMLAH + 1 where KODE_OBAT = "'.$row['kode_tindakan'].'" and IP = "'.$ip.'"');
	mysql_query('update tmp_cartresep set JUMLAH = '.$qty.' where KODE_OBAT = "'.$row['kode_tindakan'].'" and IP = "'.$ip.'"');
}else{
	#mysql_query('insert into tmp_cartresep set KODE_OBAT = "'.$row['kode_tindakan'].'", HARGA_OBAT = "'.$row['tarif'].'", JUMLAH = "1", IP = "'.$ip.'", IDXDAFTAR = "'.$_REQUEST['idx'].'", TANGGAL = CURDATE(), JASA_PELAYANAN = "'.$row['jasa_pelayanan'].'", JASA_SARANA = "'.$row['jasa_sarana'].'"');
	mysql_query('insert into tmp_cartresep set DOKTER = "'.$dokter.'", SEDIAAN = "-", ATURAN_PAKAI = "-", KODE_OBAT = "'.$row['kode_tindakan'].'", HARGA_OBAT = "'.$row['tarif'].'", JUMLAH = '.$qty.', IP = "'.$ip.'", IDXDAFTAR = "'.$_REQUEST['idx'].'", TANGGAL = CURDATE(), JASA_PELAYANAN = "'.$row['jasa_pelayanan'].'", JASA_SARANA = "'.$row['jasa_sarana'].'"');
}
?>