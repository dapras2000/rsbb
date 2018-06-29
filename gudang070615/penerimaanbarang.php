<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>PENERIMAAN BARANG</h3></div>
<div align="left" style="margin:5px;">
<?php
include('../include/function.php');
$ip = getRealIpAddr();
mysql_query('delete from temp_cartbarang_penerimaan where IP = "'.$ip.'"');
?>
<form name="terimabarang" id="terimabarang" action="gudang/addbarangpenerimaan.php" method="post" >
<fieldset class="fieldset">
<table class="tb" align="left">
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
 <td>Keterangan</td>
 <td><input type="text" name="ket" class="text" style="width:275px" /></td>
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
 <td>
 <? if($_SESSION['KDUNIT']=="12"){ ?>
 <input type="hidden" name="farmasi" id="farmasi" value="1"  />
 <? }else if($_SESSION['KDUNIT']=="13"){ ?>
 <input type="hidden" name="farmasi" id="farmasi" value="0"  />
 <? } ?>
 <select class="text" name="grpbarang" id="grpbarang" >
   <? if($_SESSION['KDUNIT']=="12"){ ?>
   <option value="1" >Obat</option>
   <option value="2" >Alat Kesehatan Pakai Habis</option>
   <option value="3" >Bahan Radiologi</option>
   <option value="4" >Gas</option>
   <option value="5" >Reagensia</option>
   <? }else if($_SESSION['KDUNIT']=="13"){ ?>
   <option value="1" >ATK</option>
   <option value="2" >Cetakan</option>
   <option value="3" >ART</option>
   <option value="4" >Alat Bersih dan Pembersih</option>
   <option value="5" >Lain - Lain</option>
   <? } ?>
</select></td>
</tr>
<tr>
 <td>Nama Barang</td>
 <td><input name="nm_barang" type="text" class="text" id="nm_barang" size="50" onkeypress="autocomplete_gudang(this.value, event)" onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv');" /></td>
</tr>
<tr>
 <td>Kode Barang</td>
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
 <td>Jumlah</td>
 <td><input type="text" name="jml_barang" id="jml_barang" class="text" /></td>
</tr>
<tr>
 <td height="26"></td>
 <td><input type="submit" class="text" value="Add" onclick="submitform (document.getElementById('terimabarang'),'gudang/addbarangpenerimaan.php','validbarang',validatetask); 
 document.getElementById('kd_barang').value = ''; document.getElementById('nm_barang').value = '';
 document.getElementById('jml_barang').value = ''; document.getElementById('tgl_kadaluarsa').value = '';
 document.getElementById('no_batch').value = ''; return false;"/></td>
</tr>
</table>
</fieldset>
</form>
<div id="autocompletediv" class="autocomp" align="left"></div>
<div id="validbarang"></div>
</div>
</div>
</div>