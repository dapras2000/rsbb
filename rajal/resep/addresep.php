<?
$sql_s_resep = "SELECT t_resep.NORESEP, t_resep_detail.NAMA_OBAT, t_resep_detail.SEDIAAN,  t_resep_detail.ATURAN_PAKAI,  t_resep_detail.JUMLAH	
				FROM t_resep 
				INNER JOIN t_resep_detail ON (t_resep.NORESEP = t_resep_detail.NORESEP)
				AND t_resep.TANGGAL = t_resep_detail.TANGGAL
				WHERE t_resep.IDXDAFTAR = ".$idxdaftar;
$get_s_resep = mysql_query($sql_s_resep);
if(mysql_num_rows($get_s_resep) > 0){
?>
<table class="tb" >
<tr><th>No Resep</th><th>Nama Obat</th><th>Sedaiaan</th><th>Aturan</th><th>Jumlah</th></tr>
<?
while($dat_s_resep = mysql_fetch_array($get_s_resep)){
?>
<tr>
   <td><?=$dat_s_resep['NORESEP']?></td>
   <td><?=$dat_s_resep['NAMA_OBAT']?></td>
   <td><?=$dat_s_resep['SEDIAAN']?></td>
   <td><?=$dat_s_resep['ATURAN_PAKAI']?></td>
   <td><?=$dat_s_resep['JUMLAH']?></td>
</tr>
<? } ?>
</table>
<? } ?>
<fieldset class="fieldset">
      <legend>Add Item Obat </legend>
<form name="addbarang" id="addbarang" method="post" action="rajal/resep/addobatresep.php" >
<table>
<tr><td width="92">&nbsp;</td><td width="342">&nbsp;</td></tr>
<tr><td>Nama Obat</td><td><input type="text" class="text" name="nm_barang"  id="nm_barang" style="width:300px" onkeypress="autocomplete_resep(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); " /></td></tr>
<tr><td>Sediaan</td><td>
	<select name="sediaan" >
        <option value="tablet" >tablet</option>
        <option value="sirup" >sirup</option>
        <option value="injeksi" >injeksi</option>
        <option value="supp" >supp</option>
        <option value="salep" >salep</option>
        <option value="infus" >infus</option>
        <option value="kapsul" >kapsul</option>
        <option value="drop" >drop</option>
	</select></td></tr>
<tr><td>Aturan Pakai</td>
 <td><select name="aturan" >
     <option value="-" > -- </option>
     <option value="3 x 1 tablet" >3 x 1 tablet</option>
     <option value="3 x 1 sendok takar" >3 x 1 sendok takar</option>
     <option value="3 x 1 sendok makan" >3 x 1 sendok makan</option>
     <option value="3 x 0.1 ml" >3 x 0.1 ml</option>
     <option value="3 x 0.2 ml" >3 x 0.2 ml</option>
     <option value="3 x 0.3 ml" >3 x 0.3 ml</option>
     <option value="3 x 0.4 ml" >3 x 0.4 ml</option>
     <option value="3 x 0.5 ml" >3 x 0.5 ml</option>
     <option value="3 x 0.6 ml" >3 x 0.6 ml</option>
     <option value="3 x 0.7 ml" >3 x 0.7 ml</option>
     <option value="3 x 0.8 ml" >3 x 0.8 ml</option>
     <option value="3 x 0.9 ml" >3 x 0.9 ml</option>
     <option value="3 x 2 tetes" >3 x 2 tetes</option>
  </select></td>
</tr>
  
  <tr>
  <td>Jumlah</td>
  <td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" style="width:50px" /></td>
  </tr> 
     <td height="21">&nbsp;</td>
       <td >&nbsp;</td>
     </tr> 
   </tr> 
  <tr>
    <td colspan="2" ><input type="submit" class="text" value="A d d" onclick="newsubmitform (document.getElementById('addbarang'),'rajal/resep/addobatresep.php','validbarang',validatetask); document.getElementById('nm_barang').value = '';   document.getElementById('jml_permintaan').value = '';   
return false;" /></td> 
  </tr>
 </table>
 
 <input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
</form>
</fieldset>
<div id="autocompletediv" class="autocomp"></div>
<div id="validbarang" ></div>
