<?
$sql_rad = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 1";
$get_rad = mysql_query($sql_rad);

$sql_rad2 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 2";
$get_rad2 = mysql_query($sql_rad2);

?>
<form name="rontagen" id="rontagen" action="ugd/valid_rontgen.php" method="post">
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
    <? 
	   $sql_cek = "SELECT IDXORDERRAD FROM t_radiologi WHERE JENISPHOTO = '".$dat_rads2['kd_rad']."'
	   				AND IDXDAFTAR = ".$idxdaftar;
	   $get_cek = mysql_query($sql_cek);
	   $dat_cek = mysql_fetch_assoc($get_cek);
	   $cek = $dat_cek['IDXORDERRAD'];
	?>
    <input type="checkbox" name="rad<?=$dat_rads2['kd_rad']?>" value="<?=$dat_rads2['kd_rad']?>" 
    <? if($cek != "") echo "checked=checked"; ?>/>&nbsp;<?=$dat_rads2['nama_rad']?></td>
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
    <? 
	   $sql_cek2 = "SELECT IDXORDERRAD FROM t_radiologi WHERE JENISPHOTO = '".$dat_rads['kd_rad']."'
	   				AND IDXDAFTAR = ".$idxdaftar;
	   $get_cek2 = mysql_query($sql_cek2);
	   $dat_cek2 = mysql_fetch_assoc($get_cek2);
	   $cek2 = $dat_cek2['IDXORDERRAD'];
	?>
    <input type="checkbox" name="rad<?=$dat_rads['kd_rad']?>" value="<?=$dat_rads['kd_rad']?>" 
    <? if($cek2 != "") echo "checked=checked"; ?> />&nbsp;<?=$dat_rads['nama_rad']?></td>
  </tr>
<? } 
}
?>  
  </table>
</td>
</tr>
</table>
<div align="left" style="margin:5px; padding:5px;">
<? 
	   $sql_diag = "SELECT DIAGNOSA FROM t_radiologi WHERE IDXDAFTAR = ".$idxdaftar;
	   $get_diag = mysql_query($sql_diag);
	   $dat_diag = mysql_fetch_assoc($get_diag);
	   $diag = $dat_diag['DIAGNOSA'];
	?>
<table>
<tr>
                <td>Dengan Dignosa Klinik :</td>
                <td><input type="text" size="40" name="dd_klinik" id="dd_klinik" class="text" value="<?=$diag?>" /></td>
</tr>
<tr>
<td colspan="2" >
<input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
<input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
<input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> >
<input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
<input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
<input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
<input type="submit" name="saved" class="text" value=" Simpan " onsubmit="newsubmitform (document.getElementById('rontagen'),'ugd/valid_rontgen.php','val_rontagen',validatetask); return false;"/>
</td>
</tr>
</table>
</div>
</form>