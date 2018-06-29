
<div align="center">
    <div id="frame" style="width:50%">
    	<div id="frame_title">
    	  <h3>FORM INPUT JENIS MAKANAN</h3></div>
        <div style="margin:5px;">
		<div id="val"></div>
        	<form name="input_jenis_makanan" id="input_jenis_makanan" action="pantri/save_jenis_makanan.php" method="post">
            	<table width="90%" style="padding:10px;" title="Form Input Jenis Makanan" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28%">Jenis Makanan</td>
    <td width="43%"><input type="text" class="text" id="jns_makanan" name="jns_makanan" size="35"></td>
    </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input onClick="submitform(document.getElementById('input_jenis_makanan'),'pantri/save_jenis_makanan.php','val',validate); return false;" type="Submit" name="simpan" value=" Simpan " class="text"></td>
    </tr>
</table>
 </form>
        </div>
	</div>
</div>
