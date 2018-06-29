<html>
<body>
<?php
include("../include/connect.php");
include("../include/function.php");

$myquery = "SELECT DISTINCT
				  view_orderresep.CARABAYAR,
				  view_orderresep.NOMR,
				  view_orderresep.NAMA,
				  view_orderresep.ALAMAT,
				  view_orderresep.TGLLAHIR,
				  view_orderresep.NAMADOKTER,
				  view_orderresep.KDPOLY,
				  view_orderresep.NAMAPOLY,
				  view_orderresep.NORESEP,
				  view_orderresep.TANGGAL,
				  view_orderresep.NAMAOBAT,
				  view_orderresep.NIP,
				  view_orderresep.IDXRESEP,
				  view_orderresep.KETERANGAN
				FROM
				  view_orderresep
					WHERE CONCAT(view_orderresep.NORESEP, MONTH(view_orderresep.TANGGAL), YEAR(view_orderresep.TANGGAL)) ='".$_GET['noresep']."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$nama=$userdata['NAMA'];
		$alamat=$userdata['ALAMAT'];
		$dokter=$userdata['NAMADOKTER'];
		$poly=$userdata['NAMAPOLY'];
		$tanggal=$userdata['TANGGAL'];
		$resep=$userdata['KETERANGAN'];
		$idx=$userdata['IDXRESEP'];
		$cbayar=$userdata['CARABAYAR'];
		$noresep=$userdata['NORESEP'];

/*$sqlresep = "SELECT 
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') AS expiry,
	      m_barang.satuan,
		  t_permintaan_apotek.jmlkeluar,
		  DATE_FORMAT(t_permintaan_apotek.tglkeluar, '%d -%m -%Y %H:%i:%s') AS tglkeluar,
		  t_permintaan_apotek.ATURAN
		FROM
		  t_permintaan_apotek
		  INNER JOIN m_barang ON (t_permintaan_apotek.kodebarang = m_barang.kode_barang)
		WHERE t_permintaan_apotek.IDXRESEP ='".$_GET['noresep']."'"; */
$tgl = date("d M Y");	
$a = datediff($userdata['TGLLAHIR'], date("Y/m/d"));

$sql_resep = "SELECT t_resep_detail.NAMA_OBAT, t_resep_detail.SEDIAAN, t_resep_detail.ATURAN_PAKAI, t_resep_detail.JUMLAH
  			FROM t_resep_detail
			WHERE CONCAT(t_resep_detail.NORESEP, MONTH(t_resep_detail.TANGGAL), YEAR(t_resep_detail.TANGGAL)) = '".$_GET['noresep']."'";
$get_resep = mysql_query($sql_resep);
if(!empty($userdata['KETERANGAN'])){
	$resep=$userdata['KETERANGAN'];
}else{
	$resep = "<p>";
	while($dat_resep = mysql_fetch_array($get_resep)){
		
		$resep = $resep ." ".$dat_resep['NAMA_OBAT']." 
		".$dat_resep['JUMLAH']." ".$dat_resep['SEDIAAN']." 
		".$dat_resep['ATURAN_PAKAI']."<br>";
		
	}
	$resep = $resep."</p>";
}
?>
<div id="print_selection" style="border:1px solid #666;width:600px" align="center">
<p>
<table width="553" border="0" cellspacing="0" >
  <tr>
    <td width="106" rowspan="5" align="center"><img src="../img/log.png" width="78" height="87" /></td>
    <td colspan="2"><div align="center"><?=strtoupper($header1)?></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><strong><?=strtoupper($header2)?></strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><?=$header3?></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><?=$header4?></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Ruang</td>
    <td width="169">&nbsp;</td>
    <td width="272"><div align="left">Depok, 
      <?=$tgl?>
    </div></td>
  </tr>
  <tr>
    <td>No Resep</td>
    <td><?=$noresep?></td>
    <td align="left" rowspan="3"><table width="200" border="1" align="left" cellspacing="0">
      <tr>
        <td width="25%"><div align="center">H</div></td>
        <td width="25%"><div align="center">T</div></td>
        <td width="25%"><div align="center">K</div></td>
        <td width="25%"><div align="center">P</div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>No RM</td>
    <td><?=$nomr?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>R1</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    

<?php        
   //$rowresep = mysql_query($sqlresep)or die(mysql_error()); 
   //$i = 1;
   //$nobatch = "";
   //while ($dataresep = mysql_fetch_array($rowresep)){
     echo "<p />";
     echo $resep;
  
//$i++; } ?>        
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama Pasien</td>
    <td><?=$nama?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Umur</td>
    <td><?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama Dokter</td>
    <td><?=$dokter?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">Dan bila aku sakit Dia -lah (Allah) yang menyembuhkan (QS Asy-Syuara Ayat 80)</div></td>
  </tr>
  <tr>
    <td colspan="3"><p>FS.04_</p></td>
  </tr>
</table>
</p>
</div>
</body>
</html>
<script language="javascript">
window.print();
</script>