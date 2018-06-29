<div align="center">
  <div id="frame">
  <div id="frame_title">
    <h3 align="left">Form Daftar Operasi Cito/Kuret</h3></div>
<script language="JavaScript" type="text/JavaScript">
 
function showKab()
{
if (document.daftar.jenisanastesi.value == "UMUM")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='IV'>IV</option><option value='SUNGKUP MUKA'>SUNGKUP MUKA</option><option value='ETT/LMA'>ETT/LMA</option>";
   }
else if (document.daftar.jenisanastesi.value == "REGIONAL")
   {
     document.getElementById('metodeanastesi').innerHTML="<option value='SPINAL'>LOKAL</option><option value='EPIDURAL'>EPIDURAL</option>";
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

<form action="vk/tambah_daftar_operasi_cito.php" name="daftar" id="daftar" method="post">
<table width="95%" class="tb" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="221">NOMR</td>
    <td width="266"><label>
    <input name="nomroperasi" class="text" type="text" id="nomroperasi" value="<? echo $_GET['nomr']; ?>" size="10" />
    </label></td>
    <td width="131">&nbsp;</td>
    <td width="404">&nbsp;</td>
  </tr>
  <tr>
    <td>CARA BAYAR</td>
    <td colspan="2"><label>
    <? include("../include/connect.php");
	  $q1="select kode,nama from m_carabayar";
	  $h1=mysql_query($q1);
	  ?>
	  
    
      <select name="carabayar" class="text" id="carabayar">
       <? while($b1=mysql_fetch_array($h1))
	  	{
		echo "<option value=".$b1[1].">".$b1[1]."</option>";
		}
		?>
      
      
      </select>
    </label><input type="hidden" value="<? echo $_GET['idx']; ?>" name="idx" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tanggal Operasi</td>
    <td colspan="2"><input type="text" class="text" name="tgl_operasi" id="tgl_operasi" size="20" />
      <a href="javascript:showCal('Calendar9')"><img src="img/date.png" alt="" border="0" align="top" /></a> ex : 1999/09/29 </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Jam Mulai Operasi</td>
    <td><label>
      <input name="jammulai"  class="text" type="text" id="jammulai" value="" size="10" />
    (contoh : 10:00)</label></td>
    <td>&nbsp;</td>
    <td><label></label></td>
  </tr>
  <tr valign="top">
    <td>Diagnosa</td>
    <td colspan="3"><label>
      <textarea name="diagnosa" id="diagnosa" cols="40" rows="5"></textarea>
      </label>
      <input name="tindakan" type="hidden" id="tindakan" value="NULL" />
      <input name="jamselesai" type="hidden" id="jamselesai" value="NULL" /></td>
  </tr>
  <tr>
    <td><label></label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><label></label>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Dokter Operator</td>
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
          <td>Asisten Operator </td>
          <td><input name="asistenoperator" class="text" type="text" id="asistenoperator" value="" /></td>
          <td>Perawat Instrumen </td>
          <td><input name="perawatinstrumen" class="text" type="text" id="perawatinstrumen" value="" /></td>
        </tr>
        <tr>
          <td>Dokter Anastesi
            <label> </label></td>
          <td><select class="text" name="dokteranastesi" id="dokteranastesi">
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
          <td>Asisten Anastesi
            <label></label></td>
          <td><label>
            <input name="asistenanastesi" class="text" type="text" id="asistenanastesi" value="" />
          </label></td>
          <td>Perawat Sirkuler </td>
          <td><input name="perawatsirkuler" class="text" type="text" id="perawatsirkuler" value="" /></td>
        </tr>
        <tr>
          <td>Dokter Anak
            <label> </label></td>
          <td><select class="text" name="dokteranak" id="dokteranak">
              <? 
	  $q2="select a.namadokter from m_dokter a, m_poly b where a.kdpoly=b.kode and b.nama='ANAK'";
	  $h2=mysql_query($q2);
	  
	  while($b2=mysql_fetch_array($h2))
	  {
	  ?>
              <option value="<?=$b2[0];?>">
              <?=$b2[0];?>
              </option>
              <? }?>
          </select></td>
          <td>Asisten Anak
            <label></label></td>
          <td><label>
            <input name="asistenanak" class="text" type="text" id="asistenanak" value="" />
          </label></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <label></label></td>
    </tr>
  <tr>
    <td>Jenis Operasi</td>
    <td><input type="radio" name="j_operasi" value="1" checked="checked" />Cito</td>
    <td><input type="radio" name="j_operasi" value="2"  />Kuret</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><label></label>
      <label></label></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="hidden" name="idxdaftar"  value="<?=$_GET['idx']?>" />
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