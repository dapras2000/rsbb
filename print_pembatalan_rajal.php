<?php session_start();
include 'include/connect.php';
include 'include/function.php';
$myquery = 'SELECT DISTINCT a.nomr as NOMR, b.NAMA, z.TGLBAYAR, z.JAMBAYAR 
FROM t_billrajal a
JOIN m_pasien b ON b.NOMR = a.NOMR
JOIN t_bayarrajal z ON z.NOBILL = a.NOBILL
WHERE a.NOMR = "'.$_REQUEST['nomr'].'"
AND a.NOBILL = "'.$_REQUEST['idxb'].'"';
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
#kuitansi{text-align:center; font-size:13px; font-weight:bold;}
#no_kuitansi{text-align:left; font-size:12px; font-weight:bold;}
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
#kuitansi{text-align:center; font-size:14px; font-weight:bold;}
#no_kuitansi{text-align:left; font-size:12px; font-weight:bold;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
</style>
<div id="global_print" style="font-family:'Arial', Gadget, sans-serif">
    <div id="header">
        <div id="logo_cetak"></div>
        <div id="title">
        	<div id="title1"><?=strtoupper($header1)?></div>
            <div id="title2"><?=strtoupper($header2)?></div>
			<div id="title3" style="font-size:11px;"><?=$header3?></div>
			<div id="title4" style="font-size:11px;"><?=$header4?></div>
        </div>
        <div id="kepada" style="padding-top:25px; font-size:12px;">
        	<div id="kepada1">Kepada Yth</div>
            <div id="kepada2"><div class="field">Nama pasien</div><div class="value"><?php echo $userdata['NAMA'];?></div></div><br clear="all" />
            <div id="kepada3"><div class="field">No RM</div><div class="value"><?php echo $userdata['NOMR'];?></div></div><br clear="all" />
            <div id="kepada4"><div class="field">Tanggal Bayar</div><div class="value"><?php echo $userdata['TGLBAYAR'].' '.$userdata['JAMBAYAR'];?></div></div><br clear="all" />
        </div>
    </div>
    <br clear="all" />
    <div id="kuitansi"> Kuitansi Pembatalan </div>
    <div id="no_kuitansi"> No Transaksi : <?php echo $_REQUEST['idxb']; ?></div>
    <table id="table_list">
    <tr id="header_table"><th style="text-align:left;">Nama Jasa</th><th style="width:50px;">Qty</th><th style="width:100px;">Harga</th><th style="width:100px;">Total</th></tr>
    <tbody style="height:200px;">
    <?php
	$sql = mysql_query("SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS FROM m_tarif2012 a, t_billrajal b WHERE a.kode_tindakan=b.KODETARIF AND b.NOBILL='".$_REQUEST['nobill']."'");
	$total	= 0;
	while($data = mysql_fetch_array($sql)){
		echo '<tr style="height:20px;"><td>'.$data['nama_jasa'].'</td><td align="center">'.$data['qty'].'</td><td align="right">Rp. '.curformat($data['TARIFRS'],0).'</td><td align="right">Rp. '.curformat($data['TARIFRS'] * $data['qty']).'</td></tr>';
		$total	= $total + ( $data['TARIFRS'] * $data['qty']);
	}
    ?>
    <tr style="height:auto;"><td colspan="4"></td></tr>
    </tbody>
    <tr><td colspan="3" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total yang harus dikembalikan</td><td style="border-top:1px solid #000; text-align:right;">Rp. <?php echo curformat($total); ?></td></tr>
    </table>
    <br /><br />
    <div id="footer">
    	<div id="footer1" style="float:left; width:400px; height:100px;">
        	<br />
            Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br />
		</div>
        <div id="footer2" style="float:left; width:200px;">
			<div style="text-align:center; width:100%;">Pasien</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( <?php echo $_SESSION['NIP'];?> )</div>
        </div>
    	<br clear="all" />
    </div>
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
            <tr><td style="width:100px;">Tanggal Bayar</td><td>:'.$userdata['TGLBAYAR'].' '.$userdata['JAMBAYAR'].'</td></tr>
            </table>
		</td></tr>
    	</table>
</td></tr>
<tr><td style="text-align:center; font-size:13px; font-weight:bold;">Kuitansi Pembayaran</td></tr>
<tr><td style="text-align:left; font-size:12px; font-weight:bold;">No Transaksi : '.$_REQUEST['idxb'].'</td></tr>
<tr><td>
    	<table id="table_list" style="width:100%; font-size:12px; border-collapse:0; border-spacing:0px;" >
    	<tr id="header_table"><th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Kode Jasa</th><th style="border-bottom:1px solid #000; border-top:1px solid #000;">Nama Jasa</th><th style="width:50px; border-bottom:1px solid #000; border-top:1px solid #000;">Qty</th><th style="width:200px; border-bottom:1px solid #000; border-top:1px solid #000;">Tarif</th><th style="width:100px;">Total</th></tr>';

	$sql = mysql_query("SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS FROM m_tarif2012 a, t_billrajal b WHERE a.kode_tindakan=b.KODETARIF AND b.NOBILL='".$_REQUEST['idxb']."'");
	$total	= 0;
	while($data = mysql_fetch_array($sql)){
		$report .= '<tr><td>'.$data['kode'].'</td><td>'.$data['nama_jasa'].'</td><td align="center">'.$data['qty'].'</td><td align="right">Rp. '.curformat($data['TARIFRS'],0).'</td><td>'.curformat($data['TARIFRS']*$data['qty']).'</td></tr>';
		$total	= $total + $data['TARIFRS'];
	}
    $report .= '<tr><td colspan="3" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang Harus dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. '.curformat($total).'</td></tr>
    	</table>
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
			<div style="text-align:center; width:100%;">Penerima</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( '.$_SESSION['NIP'].' )</div>
        </td></tr>
        </table>
    </td></tr>
    <tr><td style="font-size:12px; font-style:italic;">Dicetak oleh : '.$_SESSION['NIP'].' sebanyak [ 5 ] tanggal '.date('d/m/Y H:i:s').'</td></tr>
</table>
';
$dompdf = new DOMPDF();
$dompdf->load_html($report);
$dompdf->set_paper("A4","landscape");
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents($namafile.".pdf", $pdf);