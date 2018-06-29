<? 
session_start();
include("../include/connect.php"); 
?>

<?php
  $myquery = "SELECT a.nomr, a.kirimdari, a.dokterpengirim AS dokter_penanggungjawab, a.masukrs, a.noruang, a.nott, b.NAMA, b.ALAMAT, b.JENISKELAMIN, b.TGLLAHIR, c.NAMA AS CARABAYAR, a.id_admission, a.noruang, d.NAMA AS POLY, e.NAMADOKTER, f.kelas, f.nama AS nm_ruang, DATE_FORMAT(TGLLAHIR,'%d/%m/%Y') AS TGLLAHIR1, a.statusbayar
FROM t_admission a
JOIN m_pasien b ON a.nomr=b.NOMR
JOIN m_carabayar c ON a.statusbayar=c.KODE 
JOIN m_poly d ON d.KODE=a.kirimdari 
JOIN m_ruang f ON f.no=a.noruang
JOIN m_dokter e ON a.dokterpengirim=e.KDDOKTER 
WHERE a.id_admission='".$_GET["id_admission"]."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get);
		$id_admission	= $userdata['id_admission'];
		$nomr			= $userdata['nomr'];
		$noruang		= $userdata['noruang'];
		$kdpoly			= $userdata['kirimdari'];
		$kddokter		= $userdata['dokter_penanggungjawab'];
		$tglreg			= $userdata['TGLREG'];
		$kelas			= $userdata['kelas'];
		$masukrs		= $userdata['masukrs'];
		$jk				= $userdata['JENISKELAMIN'];

mysql_query("update t_billranap set NOMR='$nomr' where IDXDAFTAR='$_GET[id_admission]'");
mysql_query("update t_bayarranap set NOMR='$nomr' where IDXDAFTAR='$_GET[id_admission]'");
?>

<form action="ranap/save_perjalanan_penyakit.php" name="perjalanan_penyakit" method="post" id="perjalanan_penyakit">
<!--<input type="hidden" name="id_admission" value="<?php echo $_POST['id_admission'];?>" />
<input type="hidden" name="nomr" value="<?php echo $_POST['nomr'];?>" />
<input type="hidden" name="noruang" value="<?php echo $_POST['noruang'];?>" />-->

<input type="hidden" name="id_admission" value="<?php echo $id_admission;?>" />
<input type="hidden" name="nomr" value="<?php echo $nomr;?>" />
<input type="hidden" name="noruang" value="<?php echo $noruang;?>" />
<input type="hidden" name="kelas" value="<?php echo $kelas;?>" />
<input type="hidden" name="kddokter" value="<?php echo $kddokter;?>" />
<input type="hidden" name="kdpoly" value="<?php echo $kdpoly;?>" />
<input type="hidden" name="masukrs" value="<?php echo $masukrs;?>" />
<input type="hidden" name="jk" value="<?php echo $jk;?>" />
<table width="95%" class="tb" border="0">
  <tr>
    <td width="22%">Tanggal / Jam</td>
    <td width="78%"><strong><?php echo date("d/m/Y"); ?></strong></td>
  </tr>
  <tr>
    <td>Perjalanan Penyakit</td>
    <td><textarea name="perjalanan_penyakit" cols="65" rows="4" class="text" id="perjalanan_penyakit"></textarea></td>
  </tr>
  <tr>
    <td>Intruksi Dokter</td>
    <td><textarea name="intruksi_dokter" cols="65" rows="4" class="text" id="intruksi_dokter"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('perjalanan_penyakit'),'ranap/save_perjalanan_penyakit.php','valid_perjalanan_penyakit',validatetask); return false;"/>        
    </td>
  </tr>
</table>
</form>

<div id="valid_perjalanan_penyakit" >
<? include("save_perjalanan_penyakit.php"); ?>
</div>
<div id="autocompletediv" class="autocomp"></div>
<br />
<hr/>