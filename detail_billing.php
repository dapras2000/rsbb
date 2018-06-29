<input type="button" name="back" onClick="javascript:history.back(1)" value="Kembali">

<?php
#include("include/connect.php");
/*
$sql = 'SELECT a.NOMR,b.nama_tindakan, a.QTY AS qty, b.tarif,c.NAMA AS carabayar,
CASE r.STATUS WHEN "LUNAS" THEN ("LUNAS") ELSE ("BELUM DI BAYAR") END AS lunas
FROM t_billrajal a 
JOIN m_tarif2012 b ON b.kode_tindakan = a.KODETARIF
JOIN t_bayarrajal r ON r.NOBILL = a.NOBILL
JOIN m_carabayar c ON c.KODE = a.CARABAYAR
where a.NOMR = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'" and r.STATUS != "BATAL"';
*/
$sql	= 'SELECT a.NOMR, c.nama_tindakan, b.QTY as qty, b.TARIFRS as tarif, d.NAMA AS carabayar, f.NAMADOKTER,
CASE a.STATUS WHEN "LUNAS" THEN ("LUNAS") ELSE ("BELUM DI BAYAR") END AS lunas
FROM t_bayarrajal a
JOIN t_billrajal b ON a.nobill = b.nobill
JOIN m_tarif2012 c ON c.kode_tindakan = b.KODETARIF 
JOIN m_carabayar d ON d.KODE = a.CARABAYAR 
LEFT JOIN m_dokter f on f.KDDOKTER = b.KDDOKTER
where a.NOMR = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR ="'.$_REQUEST['idxdaftar'].'" and a.STATUS != "BATAL"';
$sql 	= mysql_query($sql);

if(mysql_num_rows($sql) > 0){
	echo '<table width="100%">';
	echo '<tr><th>No</th><th>Nama Jasa</th><th>Qty</th><th>Tarif</th><th>Subtotal</th><th>Status Bayar</th><th>Carabayar</th></tr>';
	$i = 1;
	while($data = mysql_fetch_array($sql)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_tindakan'].' &nbsp;&nbsp; ( '.$data['NAMADOKTER'].' )</td><td>'.$data['qty'].'</td><td>'.curformat($data['tarif']).'</td><td>'.curformat($data['tarif'] * $data['qty']).'</td><td>'.$data['lunas'].'</td><td>'.$data['carabayar'].'</td></tr>';
		$i++;
	}
	echo '</table>';
}
?>