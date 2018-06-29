<?php session_start();
include 'include/connect.php';
include 'include/function.php';
$myquery = 'SELECT a.nomr AS NOMR, b.NAMA, a.TGLBILLING, a.TGLBAYAR, a.JAMBAYAR,a.DEPOSIT,a.TOTASKES,a.TOTCOSTSHARING, a.STATUS
FROM t_bayarranap a
JOIN m_pasien b ON b.NOMR = a.NOMR
WHERE a.NOMR = "'.$_REQUEST['nomr'].'"
AND a.NOBILL = "'.$_REQUEST['nobill'].'"';
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
#global_print{width:900px; margin:0px !important; margin-top: 0em; margin-left: 0em;}
#header{ height:100px; width:100%;}
#logo_cetak{float:left; height:100px; width:100px;}
#title{float:left; width:400px;}
#kepada{float:right; width:350px;}
#kepada .field{float:left; width:100px;}
#kepada .value{float:left; width:250px;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold; }
#no_kuitansi{text-align:left; font-size:16px;}
table.table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
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
            <div id="kepada4"><div class="field">Tanggal Masuk</div><div class="value"><?php echo $userdata['TGLBILLING'];?></div></div><br clear="all" />
            <div id="kepada4"><div class="field">Tanggal Bayar</div><div class="value"><?php echo $userdata['TGLBAYAR'].' '.$userdata['JAMBAYAR'];?></div></div><br clear="all" />
            
        </div>
    </div>
    <br clear="all" />
    <div id="kuitansi"> Kuitansi Pembayaran </div>
    <div id="no_kuitansi"> No Transaksi : <?php echo $_REQUEST['nobill']; ?></div>
    <table id="table_list">
    <tr id="header_table"><th style="text-align:left;">Nama Jasa</th><th style="width:150px;">Tanggal</th><th style="width:30px;">Qty</th><th style="width:100px;">Harga</th><th style="width:100px;">Total</th></tr>
    <tbody style="height:200px;">
    <?php
	$sql = "SELECT g.nama_tindakan, h.NAMADOKTER, i.nama AS CARABAYAR, f.QTY, f.TARIFRS, f.QTY * f.TARIFRS AS TOTAL, f.TANGGAL, f.STATUS AS STATUS
FROM t_billranap f
LEFT JOIN m_tarif2012 g ON g.kode_tindakan = f.KODETARIF
LEFT JOIN m_dokter h ON h.KDDOKTER = f.KDDOKTER 
JOIN m_carabayar i ON i.KODE = f.CARABAYAR
WHERE  f.NOBILL='".$_REQUEST['nobill']."' and f.NOMR = '".$_REQUEST['nomr']."' and f.STATUS != 'BERJALAN'
ORDER BY f.tanggal ASC";
	$sql = mysql_query($sql);
	$total	= 0;
	
	while($data = mysql_fetch_array($sql)){
		if($data['NAMADOKTER'] == ''){
			$dr = '';
		}else{
			$dr = '( '.$data['NAMADOKTER'].' )';
		}
		echo '<tr style="height:20px;"><td>'.$data['nama_tindakan'].' &nbsp;&nbsp; '.$dr.'</td><td align="center">'.$data['TANGGAL'].' - '.$data['CARABAYAR'].'</td><td align="center">'.$data['QTY'].'</td><td align="right">Rp. '.curformat($data['TARIFRS'],0).'</td><td align="right">Rp. '.curformat($data['TOTAL']).'</td></tr>';
		$total	= $total + $data['TOTAL'];
	}
    ?>
    <tr style="height:auto;"><td colspan="5"></td></tr>
    </tbody>
    <tr><td style="text-align:left; padding-right:10px; border-top:1px solid #000;"><em><?php echo 'Terbilang: '.Terbilang($total);?> rupiah</em></td><td colspan="3" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang Harus dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. <?php echo curformat($total); ?></td></tr>
    <?php
	if($userdata['TOTASKES'] > 0):
	echo '<tr><td colspan="3" style="text-align:right; padding-right:10px;">Asuransi</td><td style="text-align:right;">Rp. '.curformat($userdata['TOTASKES']).'</td></tr>';
	endif;
	if($userdata['TOTCOSTSHARING'] > 0):
	echo '<tr><td colspan="3" style="text-align:right; padding-right:10px;">Keringanan</td><td style="text-align:right;">Rp. '.curformat($userdata['TOTCOSTSHARING']).'</td></tr>';
	endif;
	$totals	= $total - $userdata['TOTASKES'] - $userdata['TOTCOSTSHARING'] - $userdata['DEPOSIT'];
	?>
	<?php if (($userdata['STATUS'])=='LUNAS'){?>
	<tr><td></td><td colspan="3" style="text-align:right; padding-right:10px;">Status</td><td style="text-align:right;">LUNAS</td></tr>
	<?php }else{?>

    <tr><td></td><td colspan="3" style="text-align:right; padding-right:10px;">Deposit</td><td style="text-align:right;">Rp. <?php echo curformat($userdata['DEPOSIT']); ?></td></tr>
    
    <?php if($totals < 0){ ?>
    <tr><td></td><td colspan="3" style="text-align:right; padding-right:10px;">Uang yang harus di kembalikan</td><td style="text-align:right;">Rp. <?php echo curformat($totals); ?></td></tr>
	<?php }else{ ?>
    <tr><td></td><td colspan="3" style="text-align:right; padding-right:10px;">Sisa yang harus di bayarkan</td><td style="text-align:right;">Rp. <?php echo curformat($totals); ?></td></tr>
    <?php } 
	}
    ?>
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
			<div style="text-align:center; width:100%;">Kasir</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( <?php echo $_SESSION['NIP'];?> )</div>
        </div>
    	<br clear="all" />
    </div>
    <div id="last_line"> Dicetak oleh : <?php echo $_SESSION['NIP']; ?> sebanyak [ 5 ] tanggal <?php echo date('d/m/Y H:i:s'); ?></div>
</div>
<?php
$total_row	= mysql_num_rows($sql);
if($total_row > 18){
	$type 	= 'A4';
	$pos	= 'Portrait';
}else{
	$type 	= 'A5';
	$pos	= 'landscape';
}
$report = '<table style="font-family:"Arial", Gadget, sans-serif; width:100%; margin:0px;">
		<tr><td>
    	<table class="header" style="height:100px; width:100%;">
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
			<tr><td style="width:100px;">Tanggal Masuk</td><td>: '.$userdata['TGLBILLING'].'</td></tr>
            <tr><td style="width:100px;">Tanggal Bayar</td><td>:'.$userdata['TGLBAYAR'].' '.$userdata['JAMBAYAR'].'</td></tr>
            </table>
		</td></tr>
    	</table>
</td></tr>
<tr><td style="text-align:center; font-size:13px; font-weight:bold;">Kuitansi Pembayaran</td></tr>
<tr><td style="text-align:left; font-size:12px; font-weight:bold;">No Transaksi : '.$_REQUEST['nobill'].'</td></tr>
<tr><td>
    	<table class="table_list" style="font-size:12px; border-collapse:0; border-spacing:0px;" >
		<thead>
    	<tr class="header_table">
			<th style="border-bottom:1px solid #000; border-top:1px solid #000;">Nama Jasa</th>
			<th style="width:150px; border-bottom:1px solid #000; border-top:1px solid #000;">Tanggal</th>
			<th style="width:30px; border-bottom:1px solid #000; border-top:1px solid #000;">Qty</th>
			<th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Tarif</th>
			<th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Total</th>
		</tr>
		</thead>
		<tbody>
		';
	$sqls = mysql_query("SELECT g.nama_tindakan, h.NAMADOKTER, i.nama AS CARABAYAR, f.QTY, f.TARIFRS, f.QTY * f.TARIFRS AS TOTAL, f.TANGGAL
FROM t_billranap f
JOIN m_tarif2012 g ON g.kode_tindakan = f.KODETARIF
LEFT JOIN m_dokter h ON h.KDDOKTER = f.KDDOKTER 
JOIN m_carabayar i ON i.KODE = f.CARABAYAR
WHERE f.NOBILL='".$_REQUEST['nobill']."' and f.NOMR = '".$_REQUEST['nomr']."'
ORDER BY f.tanggal ASC");
	$total	= 0;
	$page	= 1;
	$no		= 1;
	$lp		= 1;
	while($datas = mysql_fetch_array($sqls)){
		$report .= '<tr><td>'.$datas['nama_tindakan'].' &nbsp;&nbsp; ( '.$datas['NAMADOKTER'].' )</td>
						<td align="center">'.$datas['TANGGAL'].' - '.$datas['CARABAYAR'].'</td>
						<td align="center">'.$datas['QTY'].'</td>
						<td align="right">Rp. '.curformat($datas['TARIFRS']).'</td>
						<td align="right">Rp. '.curformat($datas['TOTAL']).'</td></tr>';
		$total	= $total + $datas['TOTAL'];
		$i++;
		if($no >= 25){
			$page = $page + 1;
			$no = 0;
			$report .= '</tbody></table>';
			$report .= '<div style="page-break-after:always;"></div>';
			$report .= '<table class="table_list" style="width:100%; font-size:12px; border-collapse:0; border-spacing:0px;" >
			<thead>
			<tr class="header_table">
				<th style="border-bottom:1px solid #000; border-top:1px solid #000;">Nama Jasa</th>
				<th style="width:150px; border-bottom:1px solid #000; border-top:1px solid #000;">Tanggal</th>
				<th style="width:30px; border-bottom:1px solid #000; border-top:1px solid #000;">Qty</th>
				<th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Tarif</th>
				<th style="width:100px; border-bottom:1px solid #000; border-top:1px solid #000;">Total</th>
			</tr>
			</thead><tbody>';
		
		}
		$no++;
	}
	/*
	
	*/
	
    $report .= '</tbody><tfoot><tr><td style="text-align:left; padding-right:10px; border-top:1px solid #000;"><em>Terbilang: '.Terbilang($total).' rupiah</em></td><td colspan="3" style="text-align:right; padding-right:10px; border-top:1px solid #000;">Total Yang Harus dibayarkan</td><td style="border-top:1px solid #000; text-align:right;">Rp. '.curformat($total).'</td></tr>';
	if($userdata['TOTASKES'] > 0):
	$report .= '<tr><td colspan="3" style="text-align:right; padding-right:10px;">Asuransi</td><td style="text-align:right;">Rp. '.curformat($userdata['TOTASKES']).'</td></tr>';
	endif;
	if($userdata['TOTCOSTSHARING'] > 0):
	$report .= '<tr><td colspan="4" style="text-align:right; padding-right:10px;">Keringanan</td><td style="text-align:right;">Rp. '.curformat($userdata['TOTCOSTSHARING']).'</td></tr>';
	endif;
	$totals	= $total - $userdata['TOTASKES'] - $userdata['TOTCOSTSHARING'] - $userdata['DEPOSIT'];
    $report .= '<tr><td colspan="4" style="text-align:right; padding-right:10px;">Deposit</td><td style="text-align:right;">Rp. '.curformat($userdata['DEPOSIT']).'</td></tr>';
    if($totals < 0){
    $report .= '<tr><td colspan="4" style="text-align:right; padding-right:10px;">Uang yang harus di kembalikan</td><td style="text-align:right;">Rp. '.curformat($totals).'</td></tr>';
	}else{
    $report .= '<tr><td colspan="4" style="text-align:right; padding-right:10px;">Sisa yang harus di bayarkan</td><td style="text-align:right;">Rp. '.curformat($totals).'</td></tr>';
    }
    $report .= '</tfoot></table>
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
$namafile	= date('Y-m-d').'-'.$_REQUEST['nobill'].'-'.$userdata['NOMR'];
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

require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($report);
$dompdf->set_paper($type,$pos);
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents($filesave,$pdf);

//file_put_contents($filesave,$pdf);
?>