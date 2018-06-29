<? include("include/connect.php");?>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">Form Daftar Operasi</h3></div>
<script language="JavaScript" type="text/JavaScript">
 
function showKab()
{
if (document.daftar.jenisanastesi.value == "UMUM")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='IV'>IV</option><option value='SUNGKUP MUKA'>SUNGKUP MUKA</option><option value='ETT/LMA'>ETT/LMA</option>";
   }
else if (document.daftar.jenisanastesi.value == "REGIONAL")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='SPINAL'>SPINAL</option><option value='EPIDURAL'>EPIDURAL</option>";
   }
else if (document.daftar.jenisanastesi.value == "BLOG PERIFER")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='BRAKHIAL'>BRAKHIAL</option><option value='AKSILAR'>AKSILAR</option><option value='FEMORAL'>FEMORAL</option><option value='LAIN-LAIN'>LAIN-LAIN</option>";
   }
else if (document.daftar.jenisanastesi.value == "LOKAL")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='NULL'>TIDAK ADA</option>";
   }

   
}
</script>

<? 
  $sql_operasi = "select * from t_operasi where idxdaftar = ".$_GET['idx']."
  					order by id_operasi desc limit 1";
  $get_operasi = mysql_query($sql_operasi);
  $dat_operasi = mysql_fetch_assoc($get_operasi);
?>
<form action="rajal/operasi/tambah_daftar_operasi.php" name="daftar" id="daftar" method="post">
<table width="95%" class="tb" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="221">Tanggal Rencana Operasi</td>
    <td colspan="2"><input type="text" class="text" name="tgl_operasi" id="tgl_operasi" size="20" value="<?=$dat_operasi['TGLORDER']?>" />
      <a href="javascript:showCal('Calendar9')"><img src="img/date.png" alt="" border="0" align="top" /></a> ex : 1999/09/29 </td>
    <td width="404">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td>Diagnosa</td>
    <td colspan="3"><label>
      <textarea name="diagnosa" id="diagnosa" cols="60" rows="5"><?=$dat_operasi['diagnosa']?></textarea>
      </label></td>
  </tr>
  <tr>
    <td>Jenis Operasi</td>
    <td width="266"><input type="radio" name="jenis_operasi" value="c" <?php if($dat_operasi['JNSOPERASI'] == 'c'): echo 'checked="checked"'; endif; ?> /> Cito
    				<input type="radio" name="jenis_operasi" value="e" <?php if($dat_operasi['JNSOPERASI'] != 'c'): echo 'checked="checked"'; endif; ?> /> Elektif</td>
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
alert('ORDER DATA PASIEN OPERASI TELAH TERSIMPAN!');
</script>
<?
}else {echo '';}
?>