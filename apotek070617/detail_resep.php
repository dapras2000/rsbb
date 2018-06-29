<script type='text/javascript' src='<?php echo _BASE_;?>js/facebox.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo _BASE_;?>css/facebox.css" />
<script>
jQuery(document).ready(function(){
	
});
</script>
<?php include '../include/function.php';?>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>PENGELUARAN RESEP</h3></div>
        <div align="left" style="margin:5px;">
<fieldset class="fieldset">
	<legend>Data Pasien</legend>
    <?php
		$ip	= getRealIpAddr();
		if($_REQUEST['rajal'] == 1){
			$sql	= mysql_query('SELECT a.*, b.nomr as NOMR, c.nama as NAMA, c.alamat as ALAMAT, c.tgllahir, e.NAMA AS carabayar, d.nama AS poly, a.tanggal AS tanggal, f.NAMADOKTER as dokter, a.tanggal
FROM t_billobat_rajal a
JOIN t_pendaftaran b ON b.idxdaftar = a.idxdaftar
JOIN m_pasien c ON c.nomr = b.nomr
JOIN m_poly d ON d.kode = b.KDPOLY
JOIN m_carabayar e ON e.KODE = b.KDCARABAYAR
JOIN m_dokter f ON f.KDDOKTER = b.KDDOKTER
WHERE noresep = "'.$_REQUEST['noresep'].'"');
		}else{
			$sql	= mysql_query('SELECT a.noresep, b.nomr as NOMR,c.NAMA, c.ALAMAT,f.nama as poly,b.nott,d.NAMADOKTER AS dokter,DATE_FORMAT(b.masukrs,"%Y/%m/%d") AS tanggal, e.NAMA AS carabayar
FROM t_billobat_ranap a
JOIN t_admission b ON b.id_admission = a.idxdaftar
JOIN m_pasien c ON c.NOMR = b.nomr
JOIN m_dokter d ON d.KDDOKTER = b.dokter_penanggungjawab
JOIN m_carabayar e ON e.KODE = b.statusbayar
JOIN m_ruang f on f.no = b.noruang
WHERE noresep = "'.$_REQUEST['noresep'].'"');
		}
		$d = mysql_fetch_array($sql);
		extract($d);
		?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td>No MR</td><td>: <?php echo $NOMR;?></td></tr>
<tr><td width="21%">Nama Pasien</td><td width="79%">: <?php echo $NAMA;?></td></tr>
<tr><td>Umur</td><td>: <?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td><td>&nbsp;</td></tr>
<tr><td valign="top">Alamat</td><td>: <?php echo $ALAMAT;?></td></tr>
<tr><td valign="top">Dokter</td><td>: <?php echo $dokter;?></td></tr>
<tr><td valign="top">Unit/Ruang</td><td>: <?php echo $poly;?>&nbsp;&nbsp;<?php echo $nott;?></td></tr>
<tr><td valign="top">Tanggal Resep</td><td>: <?php echo $tanggal;?></td></tr>
<tr><td valign="top">Cara Bayar</td><td>: <?php echo $carabayar;?></td></tr>
</table>
</fieldset>
<fieldset class="fieldset">
	<legend>List Obat Resep</legend>
    <table width="100%">
    	<tr><th>No</th><th>Nama Obat / Layanan</th><th>Harga Satuan</th><th>Qty</th><th>Subtotal</th></tr>
	<?php
	if($_REQUEST['rajal'] == 1){
		$sqls = mysql_query('SELECT a.*,
CASE SUBSTRING(kode_obat,1,3) WHEN  "07." THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
ELSE (SELECT b.nama_obat FROM m_obat b WHERE b.kode_obat = a.kode_obat) END AS nama
FROM t_billobat_rajal a
where noresep = "'.$_REQUEST['noresep'].'"');
	}else{
		$sqls = mysql_query('SELECT a.*,
CASE SUBSTRING(kode_obat,1,3) WHEN  "07." THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
ELSE (SELECT b.nama_obat FROM m_obat b WHERE b.kode_obat = a.kode_obat) END AS nama
FROM t_billobat_ranap a
where noresep = "'.$_REQUEST['noresep'].'"');
	}
	$i = 1;
	$total = 0;
	while($dsql = mysql_fetch_array($sqls)){
		$total = $total + ($dsql['harga'] * $dsql['qty']);
		echo '<tr><td>'.$i.'</td><td>'.$dsql['nama'].'</td><td align="right">'.curformat($dsql['harga']).'</td><td align="center">'.$dsql['qty'].'</td><td align="right">'.curformat($dsql['harga'] * $dsql['qty']).'</td></tr>';
		$i++;
	}
	?>
    <tr><td colspan="4" align="center" style="border-top:1px solid #666;">Total</td><td align="right" style="border-top:1px solid #666;"><?php echo curformat($total); ?></td></tr>
    </table>
</fieldset>
<div id="validbarang" ></div>

		</div>
    </div>
</div>