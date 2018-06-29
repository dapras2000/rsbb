<?php session_start();
include '../include/connect.php';
include '../include/function.php';
if($_REQUEST['simpan_obat']){
	$sql	= mysql_query('SELECT a.NOMR, a.KDCARABAYAR, a.KDDOKTER, a.KDPOLY, b.NAMA, b.TGLLAHIR, b.ALAMAT, c.nama AS poly, d.NAMADOKTER AS dokter, e.NAMA AS carabayar, a.TGLREG
	FROM t_pendaftaran a
	JOIN m_pasien b ON b.NOMR = a.NOMR
	JOIN m_poly c ON c.kode = a.KDPOLY
	JOIN m_dokter d ON d.KDDOKTER = a.KDDOKTER
	JOIN m_carabayar e ON e.KODE = a.KDCARABAYAR
	WHERE a.IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
	$row	= mysql_fetch_array($sql);
	$ip	= getRealIpAddr();
	
	mysql_query('insert into tmp_cartbayar set KODETARIF = "07", QTY = 1, IP = "'.$ip.'", poly = "'.$row['KDPOLY'].'",KDDOKTER = "'.$row['KDDOKTER'].'", UNIT = "'.$_SESSION['KDUNIT'].'", TARIF = "'.$_REQUEST['total'].'", DISCOUNT="0", TOTTARIF='.$_REQUEST['total'].', JASA_SARANA = '.$_REQUEST['sarana'].', JASA_PELAYANAN = '.$_REQUEST['pelayanan']);
	
	$sql_pr='CALL pr_savebill_obat_rajal("'.$row['NOMR'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.$ip.'",'.$row['KDCARABAYAR'].','.$row['KDPOLY'].',0,"'.$row['KDDOKTER'].'","'.$_SESSION['KDUNIT'].'")';
	mysql_query($sql_pr);
	header("location:"_BASE_"index.php?link=add_resep&nomr=".$row['NOMR']."&idx=".$_REQUEST['idxdaftar']."");
}
$sql = "SELECT c.*, o.nama_obat, o.harga FROM tmp_cartresep c join m_obat o on o.kode_obat = c.kode_obat WHERE c.IDXDAFTAR = ".$_REQUEST['idxdaftar'];
$sql = mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$i =1;
	$total = 0;
	$pelayanan = 0;
	$sarana = 0;
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
	echo '<table width="100%">';
	echo '<tr><td>No</td><td>Nama Obat</td><td>Sediaan</td><td>Aturan Pakai</td><td>Jumlah</td><td>Harga</td><td>Subtotal</td><td>Aksi</td><tr>';
	while($data = mysql_fetch_array($sql)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_obat'].'</td><td>'.$data['SEDIAAN'].'</td><td>'.$data['ATURAN_PAKAI'].'</td><td>'.$data['JUMLAH'].'</td><td align="right">'.curformat($data['harga']*1.25,2).'</td><td align="right">'.curformat($data['JUMLAH'] * ($data['harga']*1.25),2).'</td><td><input value="Batal" type="button" id="'.$data['IDXOBAT'].'" class="batal"></td><tr>';
		$i++;
		$sarana		= $sarana + ($data['JUMLAH'] * ($data['harga'] * 1.1));
		#$pelayanan	= $pelayanan + ($data['JUMLAH'] * ($data['harga'] * 0.125));
		$total 		= $total + ($data['JUMLAH'] * ($data['harga']*1.25));
		$pelayanan	= $pelayanan + (($total * 1.1) - $sarana);
	}
	echo '<tr><td colspan="6">Total</td><td align="right">'.curformat($total,2).'</td><td></td><tr>';
	echo '<tr><td colspan="6">PPN 10%</td><td align="right">'.curformat($total * 0.1,2).'</td><td></td><tr>';
	echo '<tr><td colspan="6">Grand Total</td><td align="right">'.curformat($total * 1.1,2).'</td><td></td><tr>';
	echo '</table>';
	echo '<input type="hidden" name="idxdaftar" value="'.$_REQUEST['idxdaftar'].'">';
	echo '<input type="hidden" name="total" value="'.$total * 1.1.'">';
	echo '<input type="hidden" name="sarana" value="'.$sarana.'">';
	echo '<input type="hidden" name="pelayanan" value="'.$pelayanan.'">';
	echo '<input type="submit" name="simpan_obat" value="Simpan" id="'.$_REQUEST['idxdaftar'].'" class="simpan_obat">';
	echo '</form>';
}
?>