<html>
<body>
<? 
include("../include/connect.php");
include("../include/function.php");

$sql_resep = "SELECT 
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') AS expiry,
	      m_barang.satuan,
		  t_permintaan_apotek.jmlkeluar,
		  DATE_FORMAT(t_permintaan_apotek.tglkeluar, '%d -%m -%Y %H:%i:%s') AS tglkeluar,
		  t_permintaan_apotek.ATURAN,
		  t_permintaan_apotek.non_generik,
		  t_permintaan_apotek.nama_generik,
		  t_permintaan_apotek.obat_luar,
		  DATE_FORMAT(now(), '%d -%m -%Y') AS skr,
		  m_pasien.NAMA, 
		  m_pasien.NOMR
		FROM
		  t_permintaan_apotek
		  LEFT JOIN m_barang ON (t_permintaan_apotek.kodebarang = m_barang.kode_barang)
		  INNER JOIN t_resep ON (t_resep.IDXRESEP = t_permintaan_apotek.IDXRESEP)
          INNER JOIN m_pasien ON (t_resep.NOMR = m_pasien.NOMR)
		WHERE t_permintaan_apotek.IDXRESEP ='".$_GET['noresep']."'";
$get_resep = mysql_query($sql_resep);
?>
<div id="print_selection" >
<?
while($dat_resep = mysql_fetch_array($get_resep)){
?>
<div style="border:1px solid #666;width:600px" align="center">		
<table class="tb" >
  <tr>
    <td width="67">&nbsp;</td>
    <td width="79">&nbsp;</td>
    <td width="131">Tanggal&nbsp;<?=$dat_resep['skr']?></td>
  </tr>
   <tr>
    <td colspan="2"><?=$dat_resep['NAMA']?></td>
    <td>No RM :&nbsp;<?=$dat_resep['NOMR']?></td>
   </tr>
    <tr>
      <td colspan="3"><?=$dat_resep['nama_barang']?></td>
    </tr>
    <tr>
    <td colspan="2"><?=$dat_resep['ATURAN']?></td>
    <td><? if($dat_resep['obat_luar']=="1") echo "Obat Luar"; ?></td>
    </tr> 
</table>
</div>
<br>
<?
}
?>
</div>
</body>
</html>
<script language="javascript">
window.print();
</script>