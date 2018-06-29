<?php include("farmasi.php"); ?>
<div id="lapbarang" >
<div align="center">
        <div id="frame" style="width:100%;">
            <div id="frame_title"><h3>LAPORAN HARIAN</h3></div>
            <div align="left" style="margin: 5px;" >
<fieldset >
<form name="formsearch" id="filterlap" method="get" >
<input type="hidden" name="link" value="f12" />
<table class="tb" align="left">
<tr>
     <td colspan="2" width="225">
       <input type="radio" class="text" name="r_barang" id="gudang" value="1" 
       onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?gudang=gudang'); document.getElementById('gudang').checked(); return false;" />
       Farmasi
       <input type="radio" class="text" name="r_barang" id="logistik"  value="0" onclick="javascript: MyAjaxRequest('grpbarangx','orderbarang/changegroup.php?logistik=logistik'); document.getElementById('logistik').checked(); return false;"/>
       Umum
     </td>
  </tr>
   <tr>
     <td>Group Barang</td>
     <td><div id="grpbarangx"><select name="grpbarang" class="text">
     <option > -- </option>
     </select></div></td>
  </tr>
         <tr>
         <td>Tanggal</td>
          <td><input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" 
		  value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif;?>"/> 
		  <a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
</tr>
 <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
 </tr>
 <tr>
    <td>Nama Barang</td>
    <td><input type="text" name="nm_barang" /></td>
 </tr>

  <tr>
   <td><input type="submit" value="Open" class="text" /></td>
   <td></td>
 </tr>
</table>
</form>
</fieldset >
	</div>
</div>
</div>
</div>