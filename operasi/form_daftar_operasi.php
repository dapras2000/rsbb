<?php
$sql_operasi = "SELECT a.*, b.NAMA as NAMAPASIEN,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.KDCARABAYAR, c.KDRUJUK as RUJUK
FROM t_operasi a
JOIN m_pasien b ON a.nomr = b.NOMR
JOIN t_pendaftaran c ON c.IDXDAFTAR = a.IDXDAFTAR
where id_operasi = ".$_GET['idx'];
$get_operasi = mysql_query($sql_operasi);		 
$dat_operasi = mysql_fetch_assoc($get_operasi);
?>

<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title"><h3 align="left">Form Daftar Operasi</h3></div>
<script language="JavaScript" type="text/JavaScript">
jQuery(document).ready(function(){
	jQuery("#daftar").validate();
});
</script>
<style>
input.error{border:2px solid #F00;}
</style>

<form action="operasi/tambah_daftar_operasi.php" name="daftar" id="daftar" method="post">
<table width="95%" class="tb" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="221">NOMR</td>
    <td width="266"><label>
    <input name="nomroperasi" class="text" type="text" id="nomroperasi" value="<? echo $dat_operasi['nomr']; ?>" size="10" readonly="readonly" />
    </label></td>
    <td width="131">&nbsp;</td>
    <td width="404">&nbsp;</td>
  </tr>
  <tr>
    <td>Nama Pasien</td>
    <td colspan="2"><?=$dat_operasi['NAMAPASIEN']?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td colspan="2"><?=$dat_operasi['ALAMAT']?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td colspan="2"><? if($dat_operasi['JENISKELAMIN']=="L") { echo "Laki-laki"; }else{ echo "Perempuan"; }?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Umur</td>
    <td colspan="2"><?php
		  $a = datediff($dat_operasi['TGLLAHIR'], $dat_operasi['TGLORDER']);
		  echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tanggal Operasi</td>
    <td colspan="2"><input type="text" class="text required" name="tgl_operasi" id="tgl_operasi" title="*" size="20" value="<?=$dat_operasi['tanggal']?>" />
      <a href="javascript:showCal('Calendar9')"><img src="img/date.png" alt="" border="0" align="top" /></a> ex : 1999/09/29 </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Jam Mulai Operasi</td>
    <td><label>
      <input name="jammulai"  class="text required" title="*" type="text" id="jammulai" size="10" value="<?=$dat_operasi['jammulai']?>" />
    (contoh : 10:00)</label></td>
    <td>&nbsp;</td>
    <td><label></label></td>
  </tr>
  
  <tr valign="top">
    <td>Diagnosa</td>
    <td colspan="3"><label>
      <textarea name="diagnosa" id="diagnosa" cols="60" rows="5"><?=$dat_operasi['diagnosa']?></textarea>
      </label>
    </tr>
	
 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="hidden" name="idxdaftar" value="<?=$dat_operasi['IDXDAFTAR']?>" /> 	
      <input type="hidden" name="idorder" value="<?=$_GET['idx']?>" /> 	
      <input type="hidden" name="kdcarabayar" value="<?=$dat_operasi['KDCARABAYAR']?>" />
      <input type="hidden" name="kdunit" value="<?=$dat_operasi['KDUNIT']?>" />
      <input type="hidden" name="kddokter" value="<?=$dat_operasi['DRPENGIRIM']?>" />
      <input type="hidden" name="rujuk" value="<?=$dat_operasi['RUJUK']?>" />
      <input type="submit" name="Submit" id="Submit" class="text" value="DAFTAR OPERASI" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
</div>
</div>
<?
if($_GET['psn']=='sukses')
{
?>
<script language="javascript">
alert('ORDER DATA PASIEN TELAH TERSIMPAN!');
</script>
<?
}else {echo '';}
?>