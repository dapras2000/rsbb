



$report		= '<div style="width:600px;">
	<div align="left" style="clear:both; width:100%">
    <table width="100%" border="0" style="font-family:Arial, Helvetica, sans-serif;">
  	<tr>
    <td width="500px" valign="top">
        <div style="letter-spacing:-1px; font-size:14px; font:bold;"><?=strtoupper($header1)?></div>
        <div style="letter-spacing:1px; font-size:14px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
		<div style="font-size:11px;"><?=$header3?><br /><?=$header4?></div>
	</td>
	<td valign="bottom">
        <table width="100%" border="0" style="font-size:12px;">
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td colspan="3">Kepada Yth.</td></tr>
        <tr><td width="150px">Nama Pasien</td><td width="10px">:</td><td>'.$userdata['NAMA'].'</td></tr>
        <tr><td>No RM</td><td>:</td><td>'.$userdata['NOMR'].'</td></tr>
        <tr><td>Tanggal Pembayaran</td><td>:</td><td>'.date("d/m/Y").'</td></tr>
        </table>    
    </td></tr>
  	</table>
</div><br />';



$report		.= '<div align="center" style="font-size:12px;"><strong>Kwitansi Pembayaran Rawat Jalan</strong></div>
<div align="left" style="padding-left:10px;">No Transaksi : '.$_GET["idxb"].'</div>
<table border="0" cellpadding="0" cellspacing="0" class="tb" width="100%">
<tr><th style="width:100px; text-align:center;">Kode Jasa</th><th>Nama Jasa</th><th style="width:50px; text-align:center;">Quantity</th><th style="width:50px; text-align:right;" colspan="2">Tarif</th></tr>';

  $sql = "SELECT a.kode, a.nama_jasa, b.qty, b.TARIFRS FROM m_tarif a, t_billrajal b WHERE a.kode=b.KODETARIF AND b.NOBILL='".$_GET["idxb"]."'";
  $qry = mysql_query($sql)or die(mysql_error());
  $total	= 0;
  	while($data = mysql_fetch_array($qry)){
		$count++;
		if ($count % 2) { $report		.= '<tr class ="tr1">'; }else {	$report		.= '<tr class ="tr2">';}
			$report		.= '<td>'.$data['kode'].'</td>
			<td>'.$data['nama_jasa'].'</td>
			<td align="center">'.$data['qty'].'</td>
			<td align="right">Rp. '.curformat($data['TARIFRS'],2).'</td>
			</tr>';
		$total = $total + ($data['TARIFRS'] * $data['qty']);
	}
	#if ($count + 1 % 2) { echo '<tr class ="tr1">';	}else {	echo '<tr class ="tr2">';}
	
    $report		.= '<tr><td colspan="3" align="right"><strong>Total Yang Harus Dibayar</strong></td><td align="right"><strong>Rp. '.curformat($total,2).'</strong></td>
    </tr>
  </table>
<br />
<div align="left" style="padding-left:10px;">Terbilang : <i>'.terbilang($total).'</i></div>';

$report		.= '<div>
<table border="0" cellpadding="1" cellspacing="1" class="tb" style="font-size:9px; width:100%;">
    <tr><td width="300px">&nbsp;</td><td width="200px" align="center">Hormat Kami</td><td>&nbsp;</td></tr>
    <tr><td>Catatan :</td><td align="center">an. Kasir</td><td align="center">an. Pasien</td></tr>
    <tr><td>Lembar 1 : Pasien / Penjamin</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr><td>Lembar 2 : Kasir</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr><td>Lembar 3 : Keuangan</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr>
    <tr><td>&nbsp;</td><td align="center">( '.$_SESSION["NIP"].' )</td><td align="center">( '.$userdata['NAMA'].' )</td></tr>
</table>
<div align="left" style="padding-left:10px;"><i>Dicetak oleh [ '.$_SESSION['NIP'].' ] sebanyak [ 5 ]</i> &nbsp;&nbsp;&nbsp;tanggal : '.date("d/m/Y H:i:s").'</div>
</div>
</div>';

require_once("dompdf/dompdf_config.inc.php");

#  if ( get_magic_quotes_gpc() )
#    $report = stripslashes($report);
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($report);
  $dompdf->set_paper("A5","landscape");
  $dompdf->render();
  $dompdf->stream(date('Y-m-d').".pdf");

