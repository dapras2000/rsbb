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
<style type="text/css" media="screen">
#global_print{width:900px;}
#header{ width:100%;}
#logo_cetak{float:left; width:100px;}
#title{float:left; width:400px;}
#kepada{float:right; width:350px;}
#kepada .field{float:left; width:100px;}
#kepada .value{float:left; width:250px;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold;}
#no_kuitansi{text-align:left; font-size:16px;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
</style>
<style type="text/css" media="print">
#global_print{width:900px;}
#header{width:100%;}
#logo_cetak{float:left; }
#title{float:left;}
#kepada{float:right; width:350px;}
#kepada .field{float:left; width:50%;}
#kepada .value{float:left;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold; }
#no_kuitansi{text-align:left; font-size:16px;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
.page-break  { display:block; page-break-before:always; }
</style>
<div id="global_print" style="font-family: sans-serif; width:420px;">
    <div id="header">
        <div id="logo_cetak"></div>
        <div id="title">
        	<div id="title1"><?=strtoupper($header1)?></div>
            <div id="title2"><?=strtoupper($header2)?></div>
			<div id="title3" style="font-size:11px;"><?=$header3?></div>
			<div id="title4" style="font-size:11px;"><?=$header4?></div>
        </div>
        <div id="kepada" style="padding-top:10px; font-size:12px;">
        	<div id="kepada1">Kepada Yth</div>
            <div id="kepada2"><div class="field">Nama pasien</div><div class="value"><?php echo $NAMA;?></div></div><br clear="all" />
            <div id="kepada3"><div class="field">No RM</div><div class="value"><?php echo $NOMR;?></div></div><br clear="all" />
            <div id="kepada4"><div class="field">Tanggal Bayar</div><div class="value"><?php echo $tanggal;?></div></div>
            <div id="kepada4"><div class="field">UNIT</div><div class="value"><?php echo $poly;?></div></div><br clear="all" />
            <div id="kepada4"><div class="field">Pembayaran</div><div class="value"><?php echo $carabayar;?></div></div><br clear="all" />
        </div>
    </div>
    <br clear="all" />
    <div id="kuitansi"> Kuitansi Pembayaran</div>
    <div id="no_kuitansi"> No Resep : <?php echo $_REQUEST['noresep']; ?></div>
    <table id="table_list">
    <tr id="header_table"><th style="text-align:left;width:50%">Nama Jasa</th><th style="width:10%;">Qty</th><th style="width:20%;">Harga</th><th style="width:20%;">Total</th></tr>
    <!--<tbody style="height:200px;">-->
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
    <!--<tr style="height:auto;"><td colspan="4">133</td></tr>-->
    </tbody>
    <tr><td style="text-align:left;border-top:1px solid #000;"><em>Terbilang: <?php echo Terbilang($total);?> rupiah</em></td><td colspan="2" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang Harus dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. <?php echo curformat($total); ?></td></tr>
    <?php if(!empty($userdata['TOTASKES']) > 0){ ?>
    <!--<tr><td colspan="3" style="text-align:right; padding-right:10px;">Di Bayarkan Asuransi</td><td style="text-align:right;">Rp. <?php echo curformat($userdata['TOTASKES']); ?></td></tr>-->
    <?php } ?>
    <?php if(!empty($userdata['TOTCOSTSHARING']) > 0){ ?>
    <!--<tr><td colspan="3" style="text-align:right; padding-right:10px;">Keringanan Biaya</td><td style="text-align:right;">Rp. <?php echo curformat($userdata['TOTCOSTSHARING']); ?></td></tr>-->
    <?php } ?>
    <?php if( (!empty($userdata['TOTASKES']) > 0) or (!empty($userdata['TOTCOSTSHARING']) > 0) ): ?>
    <!--<tr><td colspan="3" style="text-align:right; padding-right:10px;">Sisa Yang Harus dibayarkan</td><td style="text-align:right;">Rp. <?php echo curformat($userdata['JMBAYAR']); ?></td></tr>-->
    <?php endif; ?>
	<tr><td width="100%">
	<br />
            Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br/>
	</td></tr>
	<tr><td>
	<br />
            <div style="text-align:center; width:100%;">Kasir</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( <?php echo $_SESSION['NIP'];?> )</div>
	</td></tr>
    </table>
	<br clear="all" />
    
    <div id="last_line"> Dicetak oleh : <?php echo $_SESSION['NIP']; ?> sebanyak [ 5 ] tanggal <?php echo date('d/m/Y H:i:s'); ?></div>
</div>
<?php
require_once("dompdf/dompdf_config.inc.php");
$namafile	= date('Y-m-d').'-'.$_REQUEST['idxb'].'-'.$userdata['NOMR'];
$report = '
<table style="font-family:"Arial", Gadget, sans-serif;">
<tr><td>
    	<table id="header" style="height:100px; width:100%;">
		<tr>
		<td style="height:100px; width:100px;"></td>
		<td style="width:400px;">
        	<div id="title1">'.strtoupper($header1).'</div>
            <div id="title2">'.strtoupper($header2).'</div>
			<div id="title3" style="font-size:12px;">'.$header3.'</div>
			<div id="title4" style="font-size:12px;">'.$header4.'</div>
		</td><td style="padding-top:25px; font-size:12px; width:350px;">
        	<table width="100%">
            <tr><td colspan="2">Kepada Yth.</td></tr>
            <tr><td style="width:100px;">Nama Pasien</td><td>: '.$userdata['NAMA'].'</td></tr>
            <tr><td style="width:100px;">No RM</td><td>: '.$userdata['NOMR'].'</td></tr>
            <tr><td style="width:100px;">Tanggal Bayar</td><td>: '.$userdata['TGLBAYAR'].' '.$userdata['JAMBAYAR'].'</td></tr>
			<tr><td style="width:100px;">Pembayaran</td><td>: '.$userdata['carabayar'].'</td></tr>
            </table>
		</td></tr>
    	</table>
</td></tr>
<tr><td style="text-align:center; font-size:13px; font-weight:bold;">Kuitansi Pembayaran</td></tr>
<tr><td style="text-align:left; font-size:12px; font-weight:bold;">No Transaksi : '.$_REQUEST['idxb'].'</td></tr>
<tr><td>
    	<table id="table_list" style="width:100%; font-size:12px; border-collapse:0; border-spacing:0px; letter-spacing: 1px;" >
    	<tr id="header_table">
			<th style="border-bottom:1px solid #000; border-top:1px solid #000;">Nama Jasa</th>
			<th style="width:50px; border-bottom:1px solid #000; border-top:1px solid #000;">Qty</th>
			<th style="width:200px; border-bottom:1px solid #000; border-top:1px solid #000;">Tarif</th>
			<th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Total</th>
		</tr>';
		$sql = mysql_query('SELECT b.KODE_OBAT,d.NAMADOKTER, b.qty,b.HARGA AS TARIFRS,
CASE SUBSTR(b.KODE_OBAT,1,3) WHEN "07." THEN (SELECT c.nama_tindakan FROM m_tarif2012 c WHERE c.kode_tindakan = b.kode_obat)
ELSE (SELECT c.nama_obat FROM m_obat c WHERE c.kode_obat = b.kode_obat) END AS nama_jasa
FROM t_billrajal a
JOIN t_billobat_rajal b ON a.nobill = b.nobill
LEFT JOIN m_dokter d ON d.KDDOKTER = b.dokter
WHERE b.NOBILL="'.$_REQUEST['idxb'].'"');
	
		$total	= 0;
		while($data = mysql_fetch_array($sql)){
			$report .= '<tr style="height:20px;">
						<td>'.$data['nama_jasa'].' &nbsp; &nbsp;( '.$data['NAMADOKTER'].' )</td>
						<td align="center">'.$data['qty'].'</td>
						<td align="right">Rp. '.curformat($data['TARIFRS'],0).'</td>
						<td align="right">Rp. '.curformat($data['TARIFRS']*$data['qty']).'</td>
					</tr>';
			$total	= $total + $data['TARIFRS'] * $data['qty'];
		}
		$report .= '<tr><td style="text-align:left; padding-right:10px; border-top:1px solid #000;"><em>Terbilang: '.Terbilang($total).' rupiah</em></td><td colspan="2" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang Harus dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. '.curformat($total).'</td></tr>';
		if($userdata['TOTCOSTSHARING'] > 0):
		$report .= '<tr><td colspan="3" style="text-align:right; padding-right:10px;">Keringanan Biaya</td><td style="text-align:right;">Rp. '.curformat($userdata['TOTCOSTSHARING']).'</td></tr>
		<tr><td colspan="3" style="text-align:right; padding-right:10px;">Sisa Yang Harus dibayarkan</td><td style="text-align:right;">Rp. '.curformat($userdata['JMBAYAR']).'</td></tr>';
		endif;
		
		$report	.='</table>
		</td></tr>
<tr><td>
    	<table style="width:100%; font-size:12px; border-collapse:0; border-spacing:0px;">
        <tr><td style="width:400px; height:100px;">
        	<br />
            Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br />
		</td><td style="width:200px;">
			<div style="text-align:center; width:100%;">Kasir</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( '.$_SESSION['NIP'].' )</div>
        </td></tr>
        </table>
    </td></tr>
    <tr><td style="font-size:12px; font-style:italic;">Dicetak oleh : '.$_SESSION['NIP'].' sebanyak [ 5 ] tanggal '.date('d/m/Y H:i:s').'</td></tr>
</table>
';
?>
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