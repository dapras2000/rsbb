<?php 
include '../include/connect.php';
include '../include/function.php';
$ip	= getRealIpAddr();

echo $harga_satuan = $_REQUEST['total'] / $_REQUEST['qty'];
$total		= $_REQUEST['total'];
$jasa_sarana =  $harga_satuan * (1.2 / 1.25);
$jasa_pelayanan =  $harga_satuan - $jasa_sarana;
$dokter		= $_REQUEST['dokter'];

mysql_query('insert into tmp_cartresep set LAPKEMENKES = "Non Generik", LAPLAIN = "Non Generik", DOKTER = "'.$dokter.'", KODE_OBAT = "'.$_REQUEST['kode'].'", HARGA_OBAT = '.$harga_satuan.',JUMLAH = "'.$_REQUEST['qty'].'", IP = "'.$ip.'", IDXDAFTAR = "'.$_REQUEST['idx'].'", TANGGAL = CURDATE(), SEDIAAN = "'.$_REQUEST['sediaan'].'", ATURAN_PAKAI = "'.$_REQUEST['aturan'].'", JASA_SARANA = "'.$jasa_sarana.'", JASA_PELAYANAN = "'.$jasa_pelayanan.'"');
$last_cartresep = getLastIDXOBATtmp();
mysql_query('update tmp_racikan_obat set IDXOBAT = '.$last_cartresep.' where IP = "'.$ip.'"');

?>