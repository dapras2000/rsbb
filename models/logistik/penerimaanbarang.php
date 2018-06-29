<form name="terimabarang" id="terimabarang" action="logistik/addbarangpenerimaan.php" method="post" >
<fieldset class="fieldset">
      <legend>Penerimaan Barang </legend>

<table>
<tr>
 <td>No</td>
 <td><input type="text" name="nobatch" class="text"/></td>
</tr>
<tr>
 <td>Terima Dari</td>
 <td><input type="text" name="nmsuplier" class="text" style="width:250px"/></td>
</tr>
<tr>
 <td>Jenis Penerimaan</td>
 <td><select name="jns" class="text" >
    <option value="1" >APBN</option>
    <option value="2" >APBD I</option>
    <option value="3" >APBD II</option>
    <option value="4" >LAIN-LAIN</option>
 </select></td>
</tr>
<tr>
 <td>Tanggal</td>
 <?php $tgl =  date("Y-m-d");?>
 <td><input type="text" name="tglterima" value="<?=$tgl?>" readonly="readonly" class="text"/></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>Group Barang</td>
 <td><select class="text" name="grpbarang" id="grpbarang" >
   <option value="1" >ATK</option>
   <option value="2" >Cetakan</option>
   <option value="3" >ART</option>
   <option value="4" >Alat Bersih dan Pembersih</option>
   <option value="5" >Lain - Lain</option>
</select></td>
</tr>
<tr>
 <td>Nama Barang</td>
 <td><input type="text" name="nm_barang" id="nm_barang" onkeypress="autocomplete_barang(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); " class="text" style="width:200px"/></td>
</tr>
<tr>
 <td>Kode Barang</td>
 <td><input type="text" name="kd_barang"  id="kd_barang" class="text" readonly="readonly"/></td>
</tr>
<tr>
 <td>Jumlah</td>
 <td><input type="text" name="jml_barang" id="jml_barang" class="text" value="1"/></td>
</tr>
<tr>
 <td></td>
 <td><input type="submit" class="text" value="Add" onclick="submitform (document.getElementById('terimabarang'),'logistik/addbarangpenerimaan.php','validbarang',validatetask); 
 document.getElementById('kd_barang').value = ''; document.getElementById('nm_barang').value = '';
 document.getElementById('jml_barang').value = '1';
 return false;"/></td>
</tr>
</table>
</fieldset>
</form>

<div id="autocompletediv" class="autocomp"></div>
<div id="validbarang"></div>
