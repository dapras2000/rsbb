<?php session_start();
include 'include/connect.php';
include 'include/function.php';

$myquery = 'SELECT a.nomr AS NOMR, b.NAMA, DATE_FORMAT(a.masukrs,"%d/%m/%Y %H:%i:%s") AS tgldeposit, c.nama AS ruang, a.id_admission,a.deposit,
a.NIP
FROM t_admission a 
JOIN m_pasien b ON b.NOMR = a.nomr
JOIN m_ruang c ON a.noruang = c.no
WHERE a.id_admission = "'.$_REQUEST['id_admission'].'"';
$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get);
?>
<style type="text/css" media="screen">
#global_print{width:900px;}
#header{ height:100px; width:100%;}
#logo_cetak{float:left; height:100px; width:100px;}
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
#header{ height:100px; width:100%;}
#logo_cetak{float:left; height:100px; width:100px;}
#title{float:left; width:400px;}
#kepada{float:right; width:350px;}
#kepada .field{float:left; width:100px;}
#kepada .value{float:left; width:250px;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold; }
#no_kuitansi{text-align:left; font-size:16px;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
</style>
<div id="global_print" style="font-family:'Arial', Gadget, sans-serif; height:550px; width:780px;">
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
            <div id="kepada2"><div class="field">Nama pasien</div><div class="value"><?php echo $userdata['NAMA'];?></div></div><br clear="all" />
            <div id="kepada3"><div class="field">No RM</div><div class="value"><?php echo $userdata['NOMR'];?></div></div><br clear="all" />
            <div id="kepada4"><div class="field">Tanggal</div><div class="value"><?php echo $userdata['tgldeposit'];?></div></div><br clear="all" />
            <div id="kepada4"><div class="field">Ruang</div><div class="value"><?php echo $userdata['ruang'];?></div></div><br clear="all" />
        </div>
    </div>
    <br clear="all" />
    <div id="kuitansi"> Kuitansi Pembayaran </div>
    <div id="no_kuitansi"> No Admission : <?php echo $userdata['id_admission']; ?></div>
    <table id="table_list">
    <tr id="header_table"><th style="text-align:left;">Nama Jasa</th><th style="width:50px;">Qty</th><th style="width:100px;">Harga</th><th style="width:100px;">Total</th></tr>
    <tbody style="height:200px;">
    <?php
	/*$sql = mysql_query("SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS,c.NAMADOKTER
FROM m_tarif2012 a, t_billrajal b 
JOIN m_dokter c ON c.KDDOKTER = b.KDDOKTER
WHERE a.kode_tindakan=b.KODETARIF 
AND b.NOBILL='".$_REQUEST['idxb']."'");
	$total	= 0;
	while($data = mysql_fetch_array($sql)){
		echo '<tr style="height:20px;"><td>'.$data['nama_jasa'].' &nbsp; &nbsp;( '.$data['NAMADOKTER'].' )</td><td align="center">'.$data['qty'].'</td><td align="right">Rp. '.curformat($data['TARIFRS'],0).'</td><td align="right">Rp. '.curformat($data['TARIFRS'] * $data['qty']).'</td></tr>';
		$total	= $total + ( $data['TARIFRS'] * $data['qty']);
	}
	*/
	echo '<tr style="height:20px;"><td>Pembayaran Deposit Rawat Inap</td><td align="center">1</td><td align="right">Rp. '.curformat($userdata['deposit'],0).'</td><td align="right">Rp. '.curformat($userdata['deposit']).'</td></tr>';
    ?>
    <tr style="height:auto;"><td colspan="4"></td></tr>
    </tbody>
    <tr><td style="text-align:left; padding-right:10px; border-top:1px solid #000;"><em>Terbilang: <?php echo Terbilang($userdata['deposit']);?> rupiah</em></td><td colspan="2" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. <?php echo curformat($userdata['deposit']); ?></td></tr>

    </table>
    <br />
    <br />
    <div id="footer">
    	<div id="footer1" style="float:left; width:400px; height:100px;">
        	<br />
            Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br />
		</div>
        <div id="footer2" style="float:left; width:200px; ">
			<div style="text-align:center; width:100%;">Kasir</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( <?php echo $_SESSION['NIP'];?> )</div>
        </div>
    	<br clear="all" />
    </div>
    <div id="last_line"> Dicetak oleh : <?php echo $_SESSION['NIP']; ?> sebanyak [ 5 ] tanggal <?php echo date('d/m/Y H:i:s'); ?></div>
</div>
<?php
require_once("dompdf/dompdf_config.inc.php");
$namafile	= date('Y-m-d').'-'.$userdata['id_admission'].'-'.$userdata['NOMR'];
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
            <tr><td style="width:100px;">Tanggal</td><td>: '.$userdata['tgldeposit'].'</td></tr>
			<tr><td style="width:100px;">Ruang</td><td>: '.$userdata['ruang'].'</td></tr>
            </table>
		</td></tr>
    	</table>
</td></tr>
<tr><td style="text-align:center; font-size:13px; font-weight:bold;">Kuitansi Pembayaran</td></tr>
<tr><td style="text-align:left; font-size:12px; font-weight:bold;">No Admission : '.$userdata['id_admission'].'</td></tr>
<tr><td>
    	<table id="table_list" style="width:100%; font-size:12px; border-collapse:0; border-spacing:0px;" >
    	<tr id="header_table">
			<th style="border-bottom:1px solid #000; border-top:1px solid #000;">Nama Jasa</th>
			<th style="width:50px; border-bottom:1px solid #000; border-top:1px solid #000;">Qty</th>
			<th style="width:200px; border-bottom:1px solid #000; border-top:1px solid #000;">Tarif</th>
			<th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Total</th>
		</tr>';
		/*
		$sql = mysql_query("SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS,c.NAMADOKTER
FROM m_tarif2012 a, t_billrajal b 
JOIN m_dokter c ON c.KDDOKTER = b.KDDOKTER
WHERE a.kode_tindakan=b.KODETARIF 
AND b.NOBILL='".$_REQUEST['idxb']."'");
	
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
		*/
		$report .= '<tr style="height:20px;">
						<td>Pembayaran Deposit Rawat Inap</td>
						<td align="center">1</td>
						<td align="right">Rp. '.curformat($userdata['deposit']).'</td>
						<td align="right">Rp. '.curformat($userdata['deposit']).'</td>
					</tr>';
		$report .= '<tr><td style="text-align:left; padding-right:10px; border-top:1px solid #000;"><em>Terbilang: '.Terbilang($userdata['deposit']).' rupiah</em></td><td colspan="2" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. '.curformat($userdata['deposit']).'</td></tr>';
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
$base		= './pdf_deposit/';
$folder		= date('Ymd');
$ext		= '.pdf';
if(!file_exists($base)){
	mkdir($base,0777);
}
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