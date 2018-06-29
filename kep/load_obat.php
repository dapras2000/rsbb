<?php session_start();
include '../include/connect.php';
include '../include/function.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('.batal').click(function(){
		var id  = jQuery(this).attr('id');
		var nomr  = jQuery(this).attr('NOMR');
		jQuery.post('<?php echo _BASE_;?>kep/delete_obat.php',{nomr:nomr,id:id},function(data){
			jQuery('#validobat').load('<?php echo _BASE_;?>apotek/load_obat.php?nomr='+nomr);
		});
	});
});
</script>
<style>
.top{vertical-align:top;}
</style>
<?php
if($_REQUEST['simpan_obat'] == 'Simpan'){
	
	$ip	= getRealIpAddr();
	
	$aps_status	= '';
	if($_SESSION['apotekrajal'] == 1){
		# save ke billrajal
		if($_SESSION['apt_type'] == 'NOAPS'){
			$sql	= mysql_query('SELECT a.NOMR, a.KDCARABAYAR, a.KDDOKTER, a.KDPOLY, b.NAMA, b.TGLLAHIR, b.ALAMAT, c.nama AS poly, d.NAMADOKTER AS dokter, e.NAMA AS carabayar, a.TGLREG
			FROM t_pendaftaran a
			JOIN m_pasien b ON b.NOMR = a.NOMR
			JOIN m_poly c ON c.kode = a.KDPOLY
			JOIN m_dokter d ON d.KDDOKTER = a.KDDOKTER
			JOIN m_carabayar e ON e.KODE = a.KDCARABAYAR
			WHERE a.IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
			$row	= mysql_fetch_array($sql);
			
			$sql_resep	= 'select DOKTER,SUM(HARGA_OBAT) as harga, SUM(HARGA_OBAT * JUMLAH) as total, SUM(JASA_SARANA * JUMLAH) as jasa_sarana, SUM(JASA_PELAYANAN * JUMLAH) as jasa_pelayanan from tmp_cartresep where IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
			$sql_resep = mysql_query($sql_resep);
			$row_resep  = mysql_fetch_array($sql_resep);
			
			mysql_query('insert into tmp_cartbayar set KODETARIF = "07", QTY = 1, IP = "'.$ip.'", poly = "'.$row['KDPOLY'].'",KDDOKTER = "'.$row_resep['DOKTER'].'", UNIT = "'.$_SESSION['KDUNIT'].'", TARIF = "'.$row_resep['total'].'", DISCOUNT="0", TOTTARIF='.$row_resep['total'].', JASA_SARANA = '.$row_resep['jasa_sarana'].', JASA_PELAYANAN = '.$row_resep['jasa_pelayanan']);
		
			$sql_pr='CALL pr_savebill_obat_rajal("'.$row['NOMR'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.$ip.'",'.$row['KDCARABAYAR'].','.$row['KDPOLY'].',0,"'.$row['KDDOKTER'].'","'.$_SESSION['KDUNIT'].'")';
			mysql_query($sql_pr);
		}else{
			
			$aps_status	= '_aps';
			$sql	= mysql_query('SELECT a.NOMR, b.NAMA, b.ALAMAT, b.TGLLAHIR,a.KDCARABAYAR, a.IDXDAFTAR, c.NAMA AS carabayar
FROM t_pendaftaran_aps a 
JOIN m_pasien_aps b ON a.NOMR = b.NOMR 
JOIN m_carabayar c ON a.KDCARABAYAR = c.KODE
WHERE a.IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
			$row	= mysql_fetch_array($sql);
			
			$sql_resep	= 'select DOKTER,SUM(HARGA_OBAT) as harga, SUM(HARGA_OBAT * JUMLAH) as total, SUM(JASA_SARANA * JUMLAH) as jasa_sarana, SUM(JASA_PELAYANAN * JUMLAH) as jasa_pelayanan from tmp_cartresep where IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
			$sql_resep = mysql_query($sql_resep);
			$row_resep  = mysql_fetch_array($sql_resep);

			#echo $_SESSION['apt_type'];
			#echo '-'.$_REQUEST['idxdaftar'];
			#exit;
			#print_r($row);
			#exit;
			
			mysql_query('insert into tmp_cartbayar set KODETARIF = "07", QTY = 1, IP = "'.$ip.'", poly = "'.$_SESSION['KDUNIT'].'",KDDOKTER = "'.$row_resep['DOKTER'].'", UNIT = "'.$_SESSION['KDUNIT'].'", TARIF = "'.$row_resep['total'].'", DISCOUNT="0", TOTTARIF='.$row_resep['total'].', JASA_SARANA = '.$row_resep['jasa_sarana'].', JASA_PELAYANAN = '.$row_resep['jasa_pelayanan'].'');
		
			$sql_pr='CALL pr_savebill_obat_rajal("'.$row['NOMR'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.$ip.'",'.$row['KDCARABAYAR'].','.$_SESSION['KDUNIT'].',1,"'.$row_resep['DOKTER'].'","'.$_SESSION['KDUNIT'].'")';
			mysql_query($sql_pr);
		}
	}else{
		# save ke billranap
		$sql = mysql_query('select t_admission.*,t_admission.nomr as NOMR from t_admission where id_admission = "'.$_REQUEST['idxdaftar'].'"');
		$row	= mysql_fetch_array($sql);
		
		$sql_resep	= 'select DOKTER,SUM(HARGA_OBAT) as harga, SUM(HARGA_OBAT * JUMLAH) as total, SUM(JASA_SARANA * JUMLAH) as jasa_sarana, SUM(JASA_PELAYANAN * JUMLAH) as jasa_pelayanan from tmp_cartresep where IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
		$sql_resep = mysql_query($sql_resep);
		$row_resep  = mysql_fetch_array($sql_resep);
		
		mysql_query('insert into tmp_cartbayar set KODETARIF = "07", QTY = 1, IP = "'.$ip.'", poly = "'.$row['noruang'].'",KDDOKTER = "'.$row_resep['DOKTER'].'", UNIT = "'.$_SESSION['KDUNIT'].'", TARIF = "'.$row_resep['total'].'", DISCOUNT="0", TOTTARIF='.$row_resep['total'].', JASA_SARANA = '.$row_resep['jasa_sarana'].', JASA_PELAYANAN = '.$row_resep['jasa_pelayanan']);
		$ss = 'select * from t_bayarranap where IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'" and STATUS = "TRX" limit 1';
		$ss = mysql_query($ss);
		if(mysql_num_rows($ss) > 0){
			$ssr = mysql_fetch_array($ss);
			$sql='CALL pr_savebill_obat_ranap_add("'.$row['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.$ip.'",'.$row['statusbayar'].','.$row['noruang'].',0,"'.$ssr['NOBILL'].'")';
			mysql_query($sql);
		}else{
			$sql='CALL pr_savebill_obat_ranap("'.$row['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'",CURDATE(),0,0,"'.$ip.'",'.$row['statusbayar'].','.$row['noruang'].',0,"'.$row['nott'].'")';
			mysql_query($sql);
		}
	}
	//header('location:../index.php?link=add_resep&nomr='.$row['NOMR'].'&idx='.$_REQUEST['idxdaftar'].'&rajal='.$_SESSION['apotekrajal']);
	?>
    <SCRIPT language="JavaScript">
		alert("Data Telah Disimpan.");
		window.location="../index.php?link=add_resep<?php echo $aps_status;?>&nomr=<?php echo $row['NOMR'];?>&idx=<?php echo $_REQUEST['idxdaftar']?>&rajal=<?php echo $_SESSION['apotekrajal'];?>";
	</SCRIPT>
    <?
}
$sql = "SELECT a.obat, a.id, a.dosis, a.aturan, a.frekuensi, a.tgl_pakai, a.waktu
FROM t_obat2 a
JOIN m_pasien o ON o.NOMR = a.NOMR
WHERE a.NOMR = '".$_REQUEST['nomr']."'";
$sql = mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$i =1;
	$total = 0;
	$pelayanan = 0;
	$sarana = 0;
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
	echo '<table width="95%">';
	echo '<tr>
			<th style="width:20px;">No</th>
			<th>Nama Obat</th>
			<th>Dosis</th>
			<th>Aturan Pakai</th>
			<th>Frekuensi</th>
			<th>Tanggal dan Waktu</th>
			<th style="width:70px;">Delete</th><tr>';
	while($data = mysql_fetch_array($sql)){
		echo '<tr><td class="top">'.$i.'</td>
		<td>'.$data['obat'].'</td>
		<td>'.$data['dosis'].'</td>
		<td>'.$data['aturan'].'</td>
		<td>'.$data['frekuensi'].'</td>
		<td>'.$data['tgl_pakai'].'&nbsp;'.$data['waktu'].'</td>
		<td class="top"><input value="Hapus" type="button" id="'.$data['id'].'" class="batal text"></td><tr>';
		$i++;
		
	}
	echo '</form>';
}
?>