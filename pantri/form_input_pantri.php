<div align="center">
    <div id="frame" style="width:50%">
    	<div id="frame_title">
    	  <h3>FORM INPUT MAKANAN</h3></div>
        <div style="margin:5px;">
		<div id="val"></div>
        	<form name="input_makanan" id="input_makanan" action="pantri/valid_process.php" method="post">
            	<table width="90%" style="padding:10px;" title="Form Input Makanan" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28%">Nama Makanan</td>
    <td width="43%"><input type="text" class="text" id="nama" name="nama" size="35"></td>
    </tr>
  <tr>
    <td valign="top">Spesifikasi</td>
	<td colspan="2"><textarea name="spek" cols="60" rows="10" class="text" value=""></textarea></td>
	<!--<td><input type="text" class="text" id="spek" name="spek" size="35"></td>-->
    </tr>
  <tr>
    <td>Merk</td>
    <td><input type="text" class="text" id="merk" name="merk" size="35"></td>
    </tr>
  <tr>
    <td>Satuan</td>
    <td><select id="satuan" name="satuan">
		<option value=""></option>
		<option value="Kg">Kg</option>
		<option value="Pasang">Pasang</option>
		<option value="Bh">Bh</option>
		<option value="Bks">Bks</option>
		<option value="Btr">Btr</option>
		<option value="Piring">Piring</option>
		<option value="Biji">Biji</option>
		<option value="Ikat">Ikat</option>
		<option value="Sisir">Sisir</option>
		<option value="Btl">Btl</option>
		<option value="Pack">Pack</option>
		<option value="Sch">Sch</option>
		<option value="Boks">Boks</option>
		<option value="Galon">Galon</option>
		<option value="Klg">Klg</option>
		<option value="Ktk">Ktk</option>
		<option value="Tpls">Tpls</option>
		<option value="Cup">Cup</option>
		<option value="Drg">drg</option>
		<option value="Roll">Roll</option>
		<option value="Tbg">Tbg</option>
		<option value="Plastik">Plastik</option>
		<option value="Lusin">Lusin</option>
		<option value="Gelas">Gelas</option>
	</select>
    </td>
    </tr>
  <tr>
    <td>Harga</td>
    <td align="left"><input type="text" class="text" id="harga" name="harga" size="35" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input onClick="submitform(document.getElementById('input_makanan'),'pantri/valid_process.php','val',validate); return false;" type="Submit" name="simpan" value=" Simpan " class="text"></td>
    </tr>
</table>
 </form>
        </div>
	</div>
</div>