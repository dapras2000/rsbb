<? include("../../include/connect.php");?>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">Form Daftar Operasi</h3></div>
  <? 
  $sql_operasi = "select * from t_operasi where idxdaftar = ".$_GET['idx']." order by id_operasi desc limit 1";
  $get_operasi = mysql_query($sql_operasi);
  $dat_operasi = mysql_fetch_assoc($get_operasi);
?>
<form action="vk/operasi/tambah_daftar_operasi.php" name="daftar" id="daftar" method="post">
<table width="95%" class="tb" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="221">Tanggal Rencana Operasi</td>
    <td colspan="2"><input type="text" class="text" name="tgl_operasi" id="tgl_operasi" size="20" value="<?=$dat_operasi['TGLORDER']?>" />
      <a href="javascript:showCal('Calendar9')"><img src="img/date.png" alt="" border="0" align="top" /></a> ex : 1999/09/29 </td>
    <td width="404">&nbsp;<input type="hidden" name="id_operasi" value="<?=$dat_operasi['id_operasi']?>" /></td>
  </tr>
  <tr valign="top">
    <td>Diagnosa</td>
    <td colspan="3"><label>
      <textarea name="diagnosa" id="diagnosa" cols="60" rows="5"><?=$dat_operasi['diagnosa']?></textarea>
      </label></td>
  </tr>
  <tr>
    <td>Jns Operasi</td>
    <td><input type="checkbox" name="cito" value="c" <? if($dat_operasi['JNSOPERASI']=="c") echo "checked=checked"; ?> />&nbsp;Cito&nbsp;
      <input type="checkbox" name="elektif" value="e" <? if($dat_operasi['JNSOPERASI']=="e") echo "checked=checked"; ?> />
      Elektif</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="266">&nbsp;</td>
    <td width="131">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="hidden" name="idxdaftar" value="<?=$_GET['idx']?>" /> 	
      <input type="hidden" name="nomr" value="<?=$_GET['nomr']?>" /> 
      <input type="hidden" name="kdpoly" value="<?=$kdpoly?>" /> 	
      <input type="hidden" name="kddokter" value="<?=$kddokter?>" /> 	
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