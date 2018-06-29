<?php
include("farmasi.php");
 $myquery = "SELECT 
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nip=$userdata['NIP'];
		$kdunit=$userdata['KDUNIT'];
		$bagian=$userdata['DEPARTEMEN'];
?>
<form name="terimabarang" id="terimabarang" action="orderbarang/addbarangpenerimaan.php" method="post" >
<fieldset class="fieldset">
      <legend>Penerimaan Barang </legend>

<table>
<tr>
 <td>Tgl Penerimaan</td>
 <?php $tgl =  date("Y-m-d");?>
 <td><input type="text" name="tglterima" value="<?=$tgl?>" readonly="readonly" class="text"/></td>
</tr>
<tr>
     <td colspan="2" width="225">Dari &nbsp;
       <input type="radio" class="text" name="r_barang" id="gudang" value="G" 
       onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?gudang=gudang'); document.getElementById('gudang').checked(); return false;" />
       Gudang Farmasi
       <input type="radio" class="text" name="r_barang" id="logistik"  value="L" onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?logistik=logistik'); document.getElementById('logistik').checked(); return false;"/>
       Gudang Umum
     </td>
  </tr>
   <tr>
     <td>Group Barang</td>
     <td><div id="grpbarangx"><select name="grpbarang" class="text">
     <option > -- </option>
     </select></div></td>
  </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr><tr>
 <td>Nama Obat</td>
 <td><input type="text" name="nm_barang" id="nm_barang" onkeypress="autocomplete_barang(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); " class="text" style="width:200px"/></td>
</tr>
<tr>
 <td>Kode Obat</td>
 <td><input type="text" name="kd_barang"  id="kd_barang" class="text" readonly="readonly"/></td>
</tr>
<tr>
 <td>No Batch</td>
 <td><input type="text" name="no_batch"  id="no_batch" class="text" readonly="readonly"/></td>
</tr>
<tr>
 <td>Tgl Kadaluarsa</td>
 <td><input type="text" name="tgl_kadaluarsa"  id="tgl_kadaluarsa" class="text" readonly="readonly"/></td>
</tr>

<tr>
 <td>Jumlah Penerimaan</td>
 <td><input type="text" name="jml_barang" id="jml_barang" class="text" /></td>
</tr>
<tr>
 
 <td><input type="submit" class="text" value="A d d" onclick="submitform (document.getElementById('terimabarang'),'orderbarang/addbarangpenerimaan.php','validbarang',validatetask); 
 document.getElementById('kd_barang').value = ''; document.getElementById('nm_barang').value = '';
 document.getElementById('jml_barang').value = ''; document.getElementById('no_batch').value = '';document.getElementById('tgl_kadaluarsa').value = '';
 return false;"/></td>
 <td></td>
</tr>
</table>
</fieldset>
<input type="hidden" name="NIP" value="<?php echo $nip;?>" />
<input type="hidden" name="KDUNIT" value="<?php echo $kdunit;?>" />
</form>

<div id="autocompletediv" class="autocomp"></div>
<div id="validbarang"></div>
