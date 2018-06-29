<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>Laporan Harian</h3></div>

<fieldset >
<legend>Filter Laporan Harian</legend>
<form name="formsearch" id="filterlap" method="get" >
<input type="hidden" name="link" value="g01" />
<table class="tb" align="left">
         <tr>
         <td>Tanggal</td>
          <td><input type="text" name="tgl_pesan" id="tgl_pesan" class="text"
			value = "<?php if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif; ?>"
			/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
</tr>

 <tr>
   <td>Group Barang</td>
   <td><select name="group" id="group" class="text">
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
   <td><input type="text" name="nm_barang" class="text" /></td>
 </tr>
  <tr>
   <td>&nbsp;</td>
   <td><input type="submit" value="Open" class="text" /></td>
 </tr>
</table>
</form>
</fieldset >
</div></div>