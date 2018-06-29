<script src="js/jquery-1.7.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
function hitung() {
var jml = $("#jml").val();
var hrg_sat = $("#hrg_sat").val();
if(jml>0 && hrg_sat>0){
var jml_hrg = parseInt(jml)*parseInt(hrg_sat);
$("#jml_hrg_inp").val(jml_hrg);
$("#jml_hrg").val(jml_hrg);
}else{
$("#jml_hrg_inp").val('');
$("#jml_hrg").val('');
}
}

$("#jml").keyup(function(){
hitung();
});

$("#hrg_sat").keyup(function(){
hitung();
});
});
</script>

<script src="js/jquery.autocomplete.js"></script>
<script type="text/javascript">
/*jQuery(document).ready(function() {
	//jQuery("#jns_brg").autocomplete("pantri/include/auto.php",{width:260});
	//jQuery("#satuan").val();
});*/
</script>
<?php
$start	= 'CURDATE()';
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
$waktu	= ' and (r.tanggal between '.$start.')';
?>
<div align="center">
    <div id="frame" style="width:50%">
    	<div id="frame_title">
    	  <h3>FORM INPUT PEMBELIAN MAKANAN</h3></div>
        <div style="margin:5px;">
		<div id="val"></div>
        	<form name="input_bahan_makanan" id="input_bahan_makanan" action="pantri/save_bahan_makanan.php" method="post">
            	<table width="90%" style="padding:10px;" title="Form Input Bahan Makanan" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td>Tanggal</td>
	<td><input type="text" size="10" class="text" id="tgl_rencana" name="tgl_rencana" value="<?php if($_REQUEST['start'] != ''): echo $_REQUEST['start']; else: echo date('Y-m-d'); endif;?>" /><a href="javascript:showCal('tgl_pantri')"><img align="top" src="img/date.png" border="0" /></a></td>
	</tr>
	<tr>
    <td width="28%">Jenis Barang</td>
	
	<td>
		<input type="text" name="nm_barang" id="nm_barang" class="text" style="width:200px"
		onkeypress="autocomplete_pantri(this.value, event)" 
		onblur="document.getElementById('autocomplete_pantri'); Efect.appear('autocompletediv');"/>
	</td>
		
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
    <td>Jumlah</td>
    <td><input type="text" class="text" id="jml" name="jml" size="35"></td>
    </tr>
	<tr>
    <td>Harga Satuan</td>
    <td align="left"><input type="text" class="text" id="hrg_sat" name="hrg_sat" size="35"  readonly="readonly"/></td>
  </tr>
  <tr>
    <td valign="top">Jumlah Harga</td>
	<td><input type="text" name="jml_hrg" id="jml_hrg" size="20"  value="0" readonly="readonly" >	
</td>
    </tr> 
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input onClick="submitform(document.getElementById('input_bahan_makanan'),'pantri/save_bahan_makanan.php','val',validatetask'); document.getElementById('nm_barang').value = ''; document.getElementById('satuan').value = ''; document.getElementById('jml').value = ''; document.getElementById('hrg_sat').value = ''; document.getElementById('jml_hrg').value = ''; return false;" type="Submit" name="simpan" value=" Simpan " class="text"/>
	</td>
    </tr>
</table>
 </form>
	  <div id="autocomplete_pantri" class="autocomp"></div>
        <div id="validbarang"></div>
        </div>
	</div>
</div>