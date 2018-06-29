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
			jQuery('#validbarang').load('<?php echo _BASE_;?>apotek/load_obat_tmp_cartresep_rajal.php?idxdaftar='+idx+'&nomr='+nomr);
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
	$a = mysql_query("SELECT now() as tgl");
			$b = mysql_fetch_assoc($a);
			$tanggal = $b['tgl'];	
	$aps_status	= '';
		if($_SESSION['apt_type'] == 'NOAPS'){
			$sql	= mysql_query('SELECT a.IDXDAFTAR, a.NOMR, a.KDCARABAYAR, a.KDDOKTER, a.KDPOLY, b.NAMA, b.TGLLAHIR, b.ALAMAT, c.nama AS poly, d.NAMADOKTER AS dokter, e.NAMA AS carabayar, a.TGLREG
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
			
			/////INPUT NONRACIKAN//////////
			$sqlresep = "SELECT IDXOBAT, KODE_OBAT, HARGA_OBAT, SEDIAAN,
						ATURAN_PAKAI, JENIS, JUMLAH, IP, IDXDAFTAR, TANGGAL, DOKTER, LAPKEMENKES, LAPLAIN
						FROM
						tmp_cartresep
						WHERE IDXDAFTAR = '".$_REQUEST['idxdaftar']."'";
			$row2 = mysql_query($sqlresep)or die(mysql_error());
			$nip = $_SESSION['NIP'];
			$norm = $_REQUEST['norm'];
			$ip	= getRealIpAddr();
			if(count($row2) > 0){
				while($data = mysql_fetch_array($row2)){
					  $idx_obat = $data['IDXOBAT'];
					  $kode_obat = $data['KODE_OBAT'];
					  $harga_obat = $data['HARGA_OBAT'];
					  $sediaan = $data['SEDIAAN'];
					  $aturan = $data['ATURAN_PAKAI'];
					  $jenis = $data['JENIS'];
					  $jmlh_pesan = $data['JUMLAH'];
					  $idx_daftar = $data['IDXDAFTAR'];
					  $js=$data['JASA_SARANA'];
					  $jp=$data['JASA_PELAYANAN'];
					  $tgl_pesan = $data['TANGGAL'];
					  $dokter = $data['DOKTER'];
					  $lapkemenkes = $data['LAPKEMENKES'];
					  $laplain = $data['LAPLAIN'];
						
					  $date = date("Ymd");
					
					  $no =  ''.$date.'-'.$row['NOMR'].''.$row['KDPOLY'].''.$row['kdcarabayar'].''.$dokter.''.$idx_daftar;
					  mysql_query("INSERT INTO t_permintaan_apotek_rajal
									(no,tgl_pesan, norm, kdpoli, kddokter, kdcarabayar, kode_obat, 
										harga_obat, aturan_pakai, jasa_sarana, jasa_pelayanan, 
										jenis, jmlh_pesan, idxdaftar, lapkemenkes, laplain,nip,ip)
								   VALUES('$no','$tanggal', '".$row['NOMR']."', '".$row['KDPOLY']."', '$dokter', '".$row['KDCARABAYAR']."','$kode_obat',
										'$harga_obat','$aturan','$js','$jp',
										'$jenis', '$jmlh_pesan', '$idx_daftar', '$lapkemenkes', '$laplain','$nip','$ip')");
										//die;
					 
				}	
			}
			
			/////INPUT RACIKAN//////////
			$sqlresep2 = "SELECT IDXOBAT, IDXRACIK, KODE_OBAT, HARGA_OBAT,
						  JUMLAH, IP, IDXDAFTAR, TANGGAL,NORACIK
						  FROM
						  tmp_racikan_obat
						  WHERE IDXDAFTAR = '".$_REQUEST['idxdaftar']."'";
			$row3 = mysql_query($sqlresep2)or die(mysql_error());
			if(count($row3) > 0){
				while($data1 = mysql_fetch_array($row3)){
					  $idx_obat1 = $data1['IDXOBAT'];
					  $idracik1 = $data1['IDXRACIK'];
					  $kode_obat1 = $data1['KODE_OBAT'];
					  $harga_obat1 = $data1['HARGA_OBAT'];
					  $jmlh_pesan1 = $data1['JUMLAH'];
					  $idx_daftar1 = $data1['IDXDAFTAR'];
					  $tgl_pesan1 = $data1['TANGGAL'];
					  $noracik1 = $data1['NORACIK'];
					  $ip1 = $data1['IP'];
					
					$date = date("Ymd");
					$no =  ''.$date.'-'.$row['NOMR'].''.$row['KDPOLY'].''.$row['kdcarabayar'].''.$dokter.''.$idx_daftar1;
					mysql_query("INSERT INTO t_permintaan_apotek_rajal_racikan
									(no,kode_obat, harga_obat,jumlah, ip, idxdaftar, tanggal,koderacik)
								VALUES('$no','$kode_obat1','$harga_obat1',' $jmlh_pesan1', '$ip1', '$idx_daftar1', '$tanggal','$noracik1')");
				}



				//Merubah Idxdaftar di t_permintaan_apotek_rajal_racikan sesuai dengan t_permintaan_apotek_rajal
				$data_cari=mysql_fetch_array(mysql_query("SELECT idxdaftar FROM t_permintaan_apotek_rajal_racikan ORDER BY idxracik DESC"));
				$berdasarkan_cari = $data_cari['idxdaftar'];
				
				$zzz = "select a.idxpesanobat, b.koderacik
													  from
													    t_permintaan_apotek_rajal as a,
													    t_permintaan_apotek_rajal_racikan as b
													  where
													    a.idxdaftar=b.idxdaftar AND
													    a.kode_obat=b.koderacik AND
													    b.idxdaftar='$berdasarkan_cari' ";
				$xxx = mysql_query($zzz)or die(mysql_error());
				while($data_sleksi = mysql_fetch_array($xxx)){
					$berdasarkan_sleksi = $data_sleksi['idxpesanobat'];
					$berdasarkan_cari1  = $data_sleksi['koderacik'];
					$ubah_idxpesanobat =  "UPDATE t_permintaan_apotek_rajal_racikan SET
												idxpesanobat='$berdasarkan_sleksi'
											 WHERE 
												idxdaftar ='$berdasarkan_cari' AND
												koderacik ='$berdasarkan_cari1' "; 
					mysql_query($ubah_idxpesanobat) or die(mysql_error());
				}


			}
			
	
		}else{
			
			$aps_status	= '_aps';
			$sql	= mysql_query('SELECT a.IDXDAFTAR, a.NOMR, b.NAMA, b.ALAMAT, b.TGLLAHIR,a.KDCARABAYAR, a.IDXDAFTAR, c.NAMA AS carabayar
						FROM t_pendaftaran_aps a 
						JOIN m_pasien_aps b ON a.NOMR = b.NOMR 
						JOIN m_carabayar c ON a.KDCARABAYAR = c.KODE
						WHERE a.IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"');
			$row	= mysql_fetch_array($sql);
	
			
			$sql_resep	= 'select DOKTER,SUM(HARGA_OBAT) as harga, SUM(HARGA_OBAT * JUMLAH) as total, SUM(JASA_SARANA * JUMLAH) as jasa_sarana, SUM(JASA_PELAYANAN * JUMLAH) as jasa_pelayanan from tmp_cartresep where IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
			$sql_resep = mysql_query($sql_resep);
			$row_resep  = mysql_fetch_array($sql_resep);
			
			mysql_query('insert into tmp_cartbayar set KODETARIF = "07", QTY = 1, IP = "'.$ip.'", poly = "'.$row['KDPOLY'].'",KDDOKTER = "'.$row_resep['DOKTER'].'", UNIT = "'.$_SESSION['KDUNIT'].'", TARIF = "'.$row_resep['total'].'", DISCOUNT="0", TOTTARIF='.$row_resep['total'].', JASA_SARANA = '.$row_resep['jasa_sarana'].', JASA_PELAYANAN = '.$row_resep['jasa_pelayanan'].'');
			
			/////INPUT NONRACIKAN//////////
			$sqlresep = "SELECT IDXOBAT, KODE_OBAT, HARGA_OBAT, SEDIAAN,
						ATURAN_PAKAI, JENIS, JUMLAH, IP, IDXDAFTAR, TANGGAL, DOKTER, LAPKEMENKES, LAPLAIN
						FROM
						tmp_cartresep
						WHERE IDXDAFTAR = '".$_REQUEST['idxdaftar']."'";
			$row2 = mysql_query($sqlresep)or die(mysql_error());
			
			if(count($row2) > 0){
				while($data = mysql_fetch_array($row2)){
					  $idx_obat = $data['IDXOBAT'];
					  $kode_obat = $data['KODE_OBAT'];
					  $harga_obat = $data['HARGA_OBAT'];
					  $sediaan = $data['SEDIAAN'];
					  $aturan = $data['ATURAN_PAKAI'];
					  $jenis = $data['JENIS'];
					  $jmlh_pesan = $data['JUMLAH'];
					  $idx_daftar = $data['IDXDAFTAR'];
					  $js=$data['JASA_SARANA'];
					  $jp=$data['JASA_PELAYANAN'];
					  $tgl_pesan = $data['TANGGAL'];
					  $dokter = $data['DOKTER'];
					  $lapkemenkes = $data['LAPKEMENKES'];
					  $laplain = $data['LAPLAIN'];
				
					  $date = date("Ymd");
					
					  $no =  ''.$date.'-'.$row['NOMR'].''.$row['KDPOLY'].''.$row['kdcarabayar'].''.$dokter.''.$idx_daftar;
					mysql_query("INSERT INTO t_permintaan_apotek_rajal
									(no,tgl_pesan, norm, kdpoli, kddokter, kdcarabayar, kode_obat, 
									harga_obat, aturan_pakai, jasa_sarana, jasa_pelayanan, 
									jenis, jmlh_pesan, idxdaftar, lapkemenkes, laplain,aps)
								 VALUES('$no','$tanggal', '".$row['NOMR']."', '".$row['KDPOLY']."', '$dokter', '".$row['KDCARABAYAR']."','$kode_obat',
									'$harga_obat','$aturan','$js','$jp',
									'$jenis', '$jmlh_pesan', '$idx_daftar', '$lapkemenkes', '$laplain','1')");
						 
				}  		
			}
			
			/////INPUT RACIKAN//////////
			$sqlresep2 = "SELECT IDXOBAT, IDXRACIK, KODE_OBAT, HARGA_OBAT,
						  JUMLAH, IP, IDXDAFTAR, TANGGAL,NORACIK
						  FROM
						  tmp_racikan_obat
						  WHERE IDXDAFTAR = '".$_REQUEST['idxdaftar']."'";
			$row3 = mysql_query($sqlresep2)or die(mysql_error());
			if(count($row3) > 0){
				while($data1 = mysql_fetch_array($row3)){
					  $idx_obat1 = $data1['IDXOBAT'];
					  $idracik1 = $data1['IDXRACIK'];
					  $kode_obat1 = $data1['KODE_OBAT'];
					  $harga_obat1 = $data1['HARGA_OBAT'];
					  $jmlh_pesan1 = $data1['JUMLAH'];
					  $idx_daftar1 = $data1['IDXDAFTAR'];
					  $tgl_pesan1 = $data1['TANGGAL'];
					  $noracik1 = $data1['NORACIK'];
					  $ip1 = $data1['IP'];
				
					
					mysql_query("INSERT INTO t_permintaan_apotek_rajal_racikan
									(kode_obat, harga_obat,jumlah, ip, idxdaftar, tanggal,koderacik)
								VALUES('$kode_obat1','$harga_obat1',' $jmlh_pesan1', '$ip1', '$idx_daftar1', '$tanggal','$noracik1')");

				}
				
			}
			
		}
	?>




    <SCRIPT language="JavaScript">
		alert("Data Telah Disimpan.");
		window.location="../index.php?link=51&nomr=<?php echo $row['NOMR'];?>&menu=1&idx=<?php echo $_REQUEST['idxdaftar']?>";
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