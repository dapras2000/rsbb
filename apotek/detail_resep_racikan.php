<?php session_start();
include '../include/connect.php';
include '../include/function.php';
$sql = 'select tmp_racikan_obat.*, m_barang.nama_barang
				   from tmp_racikan_obat
				   join m_barang on m_barang.kode_barang = tmp_racikan_obat.KODE_OBAT
				   where tmp_racikan_obat.NORACIK = "'.$_REQUEST['kode'].'" 
				   and tmp_racikan_obat.IDXDAFTAR = '.$_REQUEST['idx'];
$sql = mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$i = 1;
	echo '<table width="100%">';
	echo '<tr><th>No</th><th>Nama Obat</th><th>Qty</th></tr>';
	while($data = mysql_fetch_array($sql)){
		echo '<tr><td style="width:20px;">'.$i.'</th><td>'.$data['nama_obat'].'</td><td style="width:70px;">'.$data['JUMLAH'].'</td></tr>';
		$i++;
	}
	echo '<table>';
}
?>