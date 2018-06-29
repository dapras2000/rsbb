<?php session_start();
include '../include/connect.php';
include '../include/function.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body onload="javascript:window.print()">

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
<style type="text/css">
    .fonte{font-size: 12px; font-family: arial; }
    .lebar{width: 90%;}
</style>
<div style="width: 90%;text-align: center;font-weight: bold;">RSI BANYUBENING</div>
<table class="fonte" cellpadding="0", cellspacing="0">
    <tr><td>Kepada Yth</td><td></td></tr>
    <tr><td>Nama Pasien</td><td>&nbsp;:&nbsp;<?php echo $NAMA;?></td></tr>
    <tr><td>No RM</td><td>&nbsp;:&nbsp;<?php echo $NOMR;?></td></tr>
    <tr><td>Tanggal bayar</td><td>&nbsp;:&nbsp;<?php echo $tanggal;?></td></tr>
    <tr><td>Unit</td><td>&nbsp;:&nbsp;<?php echo $poly;?></td></tr>
    <tr><td>Pembayaran</td><td>&nbsp;:&nbsp;<?php echo $carabayar;?></td></tr>
</table>
<div style="width: 90%;text-align: center;font-weight: bold;">Kuitansi Pembayaran</div>
<span class="fonte">No Resep : <?php echo $_REQUEST['noresep']; ?></span>

<table style="width: 90%; border-collapse: collapse;"><tr><th align="left">Nama Jasa</th><th>Qty</th><th>Harga</th><th>Total</th></tr>
<tbody>
    <?php
    if ($_REQUEST['rajal'] == 1){
        $sqls = mysql_query('SELECT a.*,
CASE SUBSTRING(kode_obat,1,3) WHEN  "07." THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
ELSE (SELECT b.nama_barang FROM m_barang b WHERE b.kode_barang = a.kode_obat) END AS nama
FROM t_billobat_rajal a
where noresep = "'.$_REQUEST['noresep'].'"');
    }else{
        $sqls = mysql_query('SELECT a.*,
CASE SUBSTRING(kode_obat,1,3) WHEN  "07." THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
ELSE (SELECT b.nama_barang FROM m_barang b WHERE b.kode_barang = a.kode_obat) END AS nama
FROM t_billobat_ranap a
where noresep = "'.$_REQUEST['noresep'].'"');
    }
    $i = 1;
    $total = 0;
    while($dsql = mysql_fetch_array($sqls)){
        $total = $total + ($dsql['harga'] * $dsql['qty']);
        echo '<tr><td>'.$dsql['nama'].'</td><td align="center">'.$dsql['qty'].'</td><td align="right">'.curformat($dsql['harga']).'</td><td align="right">'.curformat($dsql['harga'] * $dsql['qty']).'</td></tr>';
        $i++;
    }
    ?>
</tbody>

</table>
<hr width="90%" align="left">
<table style="width: 90%;" class="fonte"><tr><td><em>Terbilang: <?php echo Terbilang($total);?> rupiah</em></td><td>Total Yang Harus dibayarkan</td><td align="right" width="30%" style="font-size: 14px;">Rp. <?php echo curformat($total); ?></td></tr></table>
<div class="fonte">
Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br />
</div>
<div class="fonte" align="center" style="width: 90%;">
    <table width="100%" border="0" align="center">
        <tr>
            <td align="center" width="50%">
    Penerima Obat<br /><br />
(.................)
</td>
            <td align="center" width="50%">Kasir<br /><br />
( <?php echo $_SESSION['NIP'];?> )</td>

        </tr>
    </table>
</div>

<div class="fonte" style="font-size: 10px;">Dicetak oleh : <?php echo $_SESSION['NIP']; ?> sebanyak [ 5 ] tanggal <?php echo date('d/m/Y H:i:s'); ?></div>
<style type="text/css" media="screen">

table#table_list{width:90%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:90%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:90%;}
</style>


<div class="page-break"></div>
<?php
$base		= './pdf_pembayaran/';
$folder		= date('Ymd');
$ext		= '.pdf';
if(file_exists($base.$folder)){
	$folder_simpan	= $base.$folder;
	if(file_exists($folder_simpan.'/'.$namafile.$ext)){
		$uniq 		= date('His');
		$filesave	= $folder_simpan.'/'.$namafile.'_('.$uniq.')'.$ext;
	}else{
		$filesave	= $folder_simpan.'/'.$namafile.$ext;
	}
}else{
	mkdir($base.$folder,0777);
	$folder_simpan  = $base.$folder;
	$filesave		= $folder_simpan.'/'.$namafile.$ext;
}
$dompdf = new DOMPDF();
$dompdf->load_html($report);
$dompdf->set_paper("A5","landscape");
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents($filesave,$pdf);
?>

</body>
</html>