<input type="button" name="back" onClick="javascript:history.back(1)" value="Kembali">

<?php
include("include/connect.php");

$sql	= 'SELECT b.nama_tindakan, a.TANGGAL, c.NAMA AS carabayar,a.QTY as qty, a.TARIFRS as tarif, (a.QTY * a.TARIFRS) AS SUBTOTAL
FROM t_billranap a
JOIN m_tarif2012 b ON b.kode_tindakan = a.KODETARIF
JOIN m_carabayar c ON c.KODE = a.CARABAYAR
WHERE a.IDXDAFTAR = '.$_REQUEST['id'];
$sql 	= mysql_query($sql);

if(mysql_num_rows($sql) > 0){
	echo '<table width="100%">';
	echo '<tr><th>No</th><th>Nama Jasa</th><th>Qty</th><th>Tarif</th><th>Subtotal</th><th>Tanggal</th><th>Carabayar</th></tr>';
	$i = 1;
	$t = 0;
	while($data = mysql_fetch_array($sql)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_tindakan'].'</td><td>'.$data['qty'].'</td><td align="right">'.curformat($data['tarif']).'</td><td align="right">'.curformat($data['SUBTOTAL']).'</td><td align="center">'.$data['TANGGAL'].'</td><td>'.$data['carabayar'].'</td></tr>';
		$t = $t + $data['SUBTOTAL'];
		$i++;
	}
	echo '<tr><td colspan="4" align="right">Total</td><td align="right">'.curformat($t).'</td><td></td><td></td></tr>';
	echo '</table>';
}
?>