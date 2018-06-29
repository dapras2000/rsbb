<?php session_start();
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
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>PENGELUARAN BARANG LABORATORIUM</h3></div>

<form name="terimabarang" id="terimabarang" action="radiologi/orderbarang/addbarangpengeluaran.php" method="post" >
<fieldset class="fieldset">
      <legend>Pengeluaran Barang </legend>

<table class="tb" align="left">
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
 <td width="143">Nama Barang</td>
 <td width="307"><input type="text" name="nm_barang" id="nm_barang" onkeypress="autocomplete_barang_rad(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); " class="text" style="width:300px"/></td>
</tr>
<tr>
 <td>Kode Barang</td>
 <td><input type="text" name="kd_barang"  id="kd_barang" class="text" readonly="readonly"/></td>
</tr>
<tr>
 <td>No Batch</td>
 <td><input type="text" name="no_batch"  id="no_batch" class="text" onkeypress="autocomplete_barang_rad_nobatch(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); "/></td>
</tr>

<tr>
  <td>Jumlah </td>
  <td><input type="text" name="jml_barang" id="jml_barang" class="text" style="width:50px" /></td>
</tr>
<tr>
 
 <td height="26"><input type="submit" class="text" value="A d d" onclick="submitform (document.getElementById('terimabarang'),'radiologi/orderbarang/addbarangpengeluaran.php','validbarang',validatetask); 
 document.getElementById('kd_barang').value = ''; document.getElementById('nm_barang').value = '';
 document.getElementById('jml_barang').value = ''; document.getElementById('no_batch').value = '';
 return false;"/></td>
 <td></td>
</tr>
</table>
</fieldset>
<input type="hidden" name="idxorder" value="<?=$_GET['idxorder']?>" />
<input type="hidden" name="NIP" value="<?php echo $_SESSION['NIP'];?>" />
<input type="hidden" name="KDUNIT" value="<?php echo $kdunit;?>" />
</form>
	</div>
</div>
<div id="autocompletediv" class="autocomp"></div>
<div id="validbarang"></div>
