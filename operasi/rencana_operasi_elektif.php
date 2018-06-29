<div align="center">
  <div id="frame">
  <div id="frame_title">
    <h3 align="left">Rencana Operasi Elekfif</h3>
  </div>

<form action="operasi/tambah_rencana_elektif.php" name="daftar" id="daftar" method="post">
<table width="95%" class="tb" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="221">NOMR </td>
    <td colspan="3"><label>
      <input name="nomroperasi" type="text" id="nomroperasi" size="50" />
    (autocomplete)</label></td>
    </tr>
  <tr>
    <td>Tanggal Operasi</td>
    <td colspan="2"><input type="text" class="text" name="tgl_operasi" id="tgl_operasi" size="20" />
      <a href="javascript:showCal('Calendar9')"><img src="img/date.png" alt="" border="0" align="top" /></a> ex : 1999/09/29 </td>
    <td width="404">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td>Diagnosa</td>
    <td><label>
      <textarea name="diagnosa" id="diagnosa" cols="40" rows="3"></textarea>
      </label>
      <input name="tindakan" type="hidden" id="tindakan" value="NULL" />
      <input name="jamselesai" type="hidden" id="jamselesai" value="NULL" /></td>
    <td><div align="right">Dokter Operator</div></td>
    <td><select class="text" name="dokteroperator" id="dokteroperator">
      <? include("../include/connect.php");
	  $q="select a.namadokter from m_dokter a, m_poly b where a.kdpoly=b.kode and b.nama='BEDAH'";
	  $h=mysql_query($q);
	  
	  while($b=mysql_fetch_array($h))
	  {
	  ?>
      <option value="<?=$b[0];?>">
      <?=$b[0];?>
      </option>
      <? }?>
    </select></td>
  </tr>
  <tr>
    <td valign="top">Keterangan Pasien</td>
    <td width="266"><label>
      <textarea name="keterangan" id="keterangan" cols="40" rows="3"></textarea>
    </label></td>
    <td width="131" valign="top"><div align="right">Dokter Anastesi
    </div>
      <label></label><div align="right"></div></td>
    <td valign="top"><select class="text" name="dokteranastesi" id="dokteranastesi">
      <? 
	  $q1="select a.namadokter from m_dokter a, m_poly b where a.kdpoly=b.kode and b.nama='ANESTESI'";
	  $h1=mysql_query($q1);
	  
	  while($b1=mysql_fetch_array($h1))
	  {
	  ?>
      <option value="<?=$b1[0];?>">
      <?=$b1[0];?>
      </option>
      <? }?>
    </select></td>
  </tr>
  <tr>
    <td colspan="4"><label></label>
      <label></label></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="Submit" id="Submit" class="text" value="SIMPAN RENCANA ELEKTIF" />
    </label>
	
</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
</form>
<table cellpadding="2" cellspacing="2" width="95%">
<tr>
  <td>
  <? @include('list_rencana_operasi_elektif.php');?>
  </td>
  </tr>
</table>
</div>
</div>
<?
if($_GET['psn']=='sukses')
{
?>
<script language="javascript">
alert('RENCANA OPERASI ELEKTIF BERHASIL TERSIMPAN!');
</script>
<?
}else {echo '';}
?>