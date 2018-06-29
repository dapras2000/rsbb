<?
$sql_rad = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 1 AND paket = '1'";
$get_rad = mysql_query($sql_rad);

$sql_rad2 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 2 AND paket = '1'";
$get_rad2 = mysql_query($sql_rad2);

$sql_rad3 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 3 AND paket = '1'";
$get_rad3 = mysql_query($sql_rad3);

?>
<form name="rontagen" id="rontagen" action="vk/rad/valid_rontgen.php" method="post">
<table width="60%" >
<tr><td valign="top">
<table  border="0" cellspacing="0" >
<? while($dat_rad2 = mysql_fetch_array($get_rad2)){ ?>
  <tr>
    <td colspan="4"><strong><?=$dat_rad2['nama_rad']?></strong></td>
  </tr>
<?
$sql_rads2 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '".$dat_rad2['kd_rad']."'";
$get_rads2 = mysql_query($sql_rads2);
while($dat_rads2 = mysql_fetch_array($get_rads2)){
?>
  <tr>
    <td width="29">&nbsp;</td>
    <td width="167" colspan="3">
    <input type="checkbox" name="rad<?=$dat_rads2['kd_rad']?>" value="<?=$dat_rads2['kd_rad']?>" />&nbsp;<?=$dat_rads2['nama_rad']?></td>
  </tr>
<? } 
}
?>  
  </table>
</td>
<td valign="top">

<table width="200" border="0" cellspacing="0" >
<? while($dat_rad = mysql_fetch_array($get_rad)){ ?>
  <tr>
    <td colspan="4"><strong><?=$dat_rad['nama_rad']?></strong></td>
  </tr>
<?
$sql_rads = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '".$dat_rad['kd_rad']."'";
$get_rads = mysql_query($sql_rads);
while($dat_rads = mysql_fetch_array($get_rads)){
?>
  <tr>
    <td width="29">&nbsp;</td>
    <td width="167" colspan="3">
    <input type="checkbox" name="rad<?=$dat_rads['kd_rad']?>" value="<?=$dat_rads['kd_rad']?>" />&nbsp;<?=$dat_rads['nama_rad']?></td>
  </tr>
<? } 
}
?>  
  </table>
</td>
<!-- -->

<td valign="top">
<table  border="0" cellspacing="0" >
<? while($dat_rad3 = mysql_fetch_array($get_rad3)){ ?>
  <tr>
    <td colspan="4"><strong><?=$dat_rad3['nama_rad']?></strong></td>
  </tr>
<?
$sql_rads3 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '".$dat_rad3['kd_rad']."'";
$get_rads3 = mysql_query($sql_rads3);
while($dat_rads3 = mysql_fetch_array($get_rads3)){
?>
  <tr>
    <td width="29">&nbsp;</td>
    <td width="167" colspan="3">
      <input type="checkbox" name="rad<?=$dat_rads3['kd_rad']?>" value="<?=$dat_rads3['kd_rad']?>" />&nbsp;<?=$dat_rads3['nama_rad']?></td>
  </tr>
<? } 
}
?>  
  </table>
</td>

<!-- -->
</tr>
</table>
<div align="left" style="margin:5px; padding:5px;">
<table>
<tr>
                <td>Dengan Dignosa Klinik :</td>
                <td><input type="text" size="40" name="dd_klinik" id="dd_klinik" class="text" /></td>
</tr>
<tr><td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
<td colspan="2" >
<input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
<input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> >
<input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
<input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
<input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
<input type="submit" name="saved" class="text" value=" Simpan " onsubmit="newsubmitform (document.getElementById('rontagen'),'vk/rad/valid_rontgen.php','val_rontagen',validatetask); return false;"/>
</td>
</tr>
</table>
</div>
</form>