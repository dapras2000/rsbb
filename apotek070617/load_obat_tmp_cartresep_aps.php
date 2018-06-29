<?php session_start();
include '../include/connect.php';
include '../include/function.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('.batal').click(function(){
		var idobat  = jQuery(this).attr('id');
		var idx = jQuery(this).attr('idx');
		jQuery.post('<?php echo _BASE_;?>apotek/delete_tmp_cartresep.php',{idobat:idobat},function(data){
			jQuery('#validbarang').load('<?php echo _BASE_;?>apotek/load_obat_tmp_cartresep.php?idxdaftar='+idx);
		});
	});
	jQuery('.detail').click(function(){
		var kode= jQuery(this).attr('id');
		var idx = jQuery(this).attr('idx');
		var svn = jQuery(this).attr('svn');
		var row	= jQuery(this).attr('row');
		if(svn == 'show'){
			jQuery.post('<?php echo _BASE_;?>apotek/detail_resep_racikan.php',{kode:kode,idx:idx},function(data){
				jQuery('#show_detail_racikan_'+row).empty().append(data);
			});
			jQuery(this).attr('svn','close');
		}else{
			jQuery('#show_detail_racikan_'+row).empty();
			jQuery(this).attr('svn','show');
		}
	});
});
</script>
<style>
.top{vertical-align:top;}
</style>
<?php
if($_REQUEST['simpan_obat'] == 'Simpan'){
	
	$ip	= getRealIpAddr();
	
	
	if($_SESSION['apotekrajal'] == 1){
		# save ke billrajal
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
		window.location="../index.php?link=add_resep&nomr=<?php echo $row['NOMR'];?>&idx=<?php echo $_REQUEST['idxdaftar']?>&rajal=<?php echo $_SESSION['apotekrajal'];?>";
	</SCRIPT>
    <?
}
$sql = "SELECT c.*, o.nama_obat
FROM tmp_cartresep c
JOIN m_obat o ON o.kode_obat = c.kode_obat
WHERE c.IDXDAFTAR = ".$_REQUEST['idxdaftar']."
UNION
SELECT c.*, t.nama_tindakan
FROM tmp_cartresep c
JOIN m_tarif2012 t ON t.kode_tindakan = c.kode_obat
WHERE c.IDXDAFTAR = ".$_REQUEST['idxdaftar'];
$sql = mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$i =1;
	$total = 0;
	$pelayanan = 0;
	$sarana = 0;
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
	echo '<input type="hidden" name="rajal" value="'.$_SESSION['apotekrajal'].'">';
	echo '<table width="95%">';
	echo '<tr>
			<th style="width:20px;">No</th>
			<th>Nama Obat</th>
			<th style="width:100px;">Sediaan</th>
			<th style="width:100px;">Aturan Pakai</th>
			<th style="width:100px;">Jumlah</th>
			<th style="width:100px;">Harga</th>
			<th style="width:100px;">Subtotal</th>
			<th style="width:70px;">Aksi</th><tr>';
	while($data = mysql_fetch_array($sql)){
		if(substr($data['KODE_OBAT'],0,1) == "R"){
			$kk	= '&nbsp;&nbsp;&nbsp;<span class="detail" svn="show" id="'.$data['KODE_OBAT'].'" idx="'.$_REQUEST['idxdaftar'].'" style="font-weight:bold; color:#FF0000; cursor:pointer;">+ detail</span>';
		}else{
			$kk	= "";
		}
		echo '<tr><td class="top">'.$i.'</td>
		<td>'.$data['nama_obat'];
		if(substr($data['KODE_OBAT'],0,1) == "R"){
			echo '&nbsp;&nbsp;&nbsp;<span class="detail" row="'.$i.'" svn="show" id="'.$data['KODE_OBAT'].'" idx="'.$_REQUEST['idxdaftar'].'" style="font-weight:bold; color:#FF0000; cursor:pointer;">+ detail</span>';
		}
		echo '<div id="show_detail_racikan_'.$i.'"></div></td>
		<td class="top">'.$data['SEDIAAN'].'</td>
		<td class="top">'.$data['ATURAN_PAKAI'].'</td>
		<td class="top">'.$data['JUMLAH'].'</td>
		<td class="top" align="right">'.curformat($data['HARGA_OBAT'],2).'</td>
		<td class="top" align="right">'.curformat($data['JUMLAH'] * ($data['HARGA_OBAT']),2).'</td>
		<td class="top"><input value="Batal" type="button" id="'.$data['IDXOBAT'].'" idx="'.$_REQUEST['idxdaftar'].'" class="batal text"></td><tr>';
		$i++;
		$total 		= $total + ($data['JUMLAH'] * ($data['HARGA_OBAT']));
	}
	echo '<tr><td colspan="6">Total</td><td align="right">'.curformat($total,2).'</td><td></td><tr>';
	echo '</table>';
	echo '<input type="hidden" name="idxdaftar" value="'.$_REQUEST['idxdaftar'].'">';
	echo '<input type="hidden" name="total" value="'.$total.'">';
	echo '<input type="submit" name="simpan_obat" value="Simpan" id="'.$_REQUEST['idxdaftar'].'" class="simpan_obat">';
	echo '</form>';
}
?>