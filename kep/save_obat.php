<?php 
include '../include/connect.php';
include '../include/function.php';
$ip	= getRealIpAddr();

$nomr = $_REQUEST['nomr'];
$obat	  = $_REQUEST['obat'];
$dosis	  = $_REQUEST['dosis'];
$frekuensi	  = $_REQUEST['frekuensi'];
$aturan	  = $_REQUEST['aturan'];
$tgl	  = $_REQUEST['tgl'];
$waktu	  = $_REQUEST['waktu'];
$sql = mysql_query('select NAMA_OBAT from m_pasien where NOMR = "'.$nomr.'"');
$row = mysql_fetch_array($sql);
if(mysql_num_rows($mysql) <= 0){
	#mysql_query('update tmp_cartresep set JUMLAH = JUMLAH + 1 where KODE_OBAT = "'.$row['kode_tindakan'].'" and IP = "'.$ip.'"');
	mysql_query('update m_pasien set NAMA_OBAT = "'.$obat.'",DOSIS="'.$dosis.'",CARA_PEMBERIAN="'.$aturan.'",FREKUENSI="'.$frekuensi.'",WAKTU_TGL="'.$tgl.'",LAMA_WAKTU="'.$waktu.'" where NOMR = "'.$nomr.'"');
	mysql_query('insert into t_obat2 set NOMR = "'.$nomr.'", obat = "'.$obat.'",dosis="'.$dosis.'",aturan="'.$aturan.'",frekuensi="'.$frekuensi.'",tgl_pakai="'.$tgl.'",waktu="'.$waktu.'"');
}else{
	#mysql_query('insert into tmp_cartresep set KODE_OBAT = "'.$row['kode_tindakan'].'", HARGA_OBAT = "'.$row['tarif'].'", JUMLAH = "1", IP = "'.$ip.'", IDXDAFTAR = "'.$_REQUEST['idx'].'", TANGGAL = CURDATE(), JASA_PELAYANAN = "'.$row['jasa_pelayanan'].'", JASA_SARANA = "'.$row['jasa_sarana'].'"');
		mysql_query('insert into t_obat2 set NOMR = "'.$nomr.'", obat = "'.$obat.'",dosis="'.$dosis.'",aturan="'.$aturan.'",frekuensi="'.$frekuensi.'",tgl_pakai="'.$tgl.'",waktu="'.$waktu.'"');
}
?>