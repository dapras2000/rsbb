<?php
include '../include/connect.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('.footer').empty().append('<input type="button" name="close" id="close" class="button text" value="Close" />');
	jQuery('#close').click(function(){
		jQuery(this).trigger('close.facebox');
	});
	jQuery('#nama_obat_racik').autocomplete('<?php echo _BASE_; ?>apotek/autocomplete_obat.php',{
			width: 450,
			multiple: false,
			matchContains: true
	}).result(function(event, data, formatted) {
		if(data){
			jQuery('#kode_obat_racik').val(data[1]);	
			jQuery('#harga_obat_racik').val(data[2]);
			jQuery('#stock_obat_racik').val(data[4]);				
		}else{
			jQuery("#kode_obat_racik").val('');
			jQuery('#harga_obat_racik').val(0);	
			jQuery("#stock_obat_racik").val('');
		}
	});
	jQuery('#add_obat_racik').click(function(){
		var idx = jQuery('#txtIdxDaftar').val();
		var xx  = jQuery('#noracikan').val();
		var kode_obat_racik  = jQuery('#kode_obat_racik').val();
		var obat_racik = jQuery('#jml_obat_racik').val();
				if(obat_racik > parseInt(jQuery('#stock_obat_racik').val())){
				alert('Stok obat '+jQuery('#stock_obat_racik').val()+', tidak mencukupi');
				return false;
				}
		jQuery.post('<?php echo _BASE_;?>apotek/simpan_obat_racikan_tmpracikan.php?kode_obat_racik='+kode_obat_racik,jQuery('#obat_racikan').serialize(),function(data){
			jQuery('#table_list_racikan').load('<?php echo _BASE_;?>apotek/load_obat_racikan_tmpracikan.php?txtIdxDaftar='+idx+'&noracik='+xx);
			jQuery('#nama_obat_racik').val('');
			jQuery('#kode_obat_racik').val('');
			jQuery('#harga_obat_racik').val('');
			jQuery('#jml_obat_racik').val('');
			//jQuery('#nama_racikan option[value='+xx+']').remove();
			
		});
	});
	var idx = jQuery('#txtIdxDaftar').val();
	var xx = jQuery('#noracikan').val();
	jQuery('#table_list_racikan').load('<?php echo _BASE_;?>apotek/load_obat_racikan_tmpracikan.php?txtIdxDaftar='+idx+'&noracik='+xx);
});
</script>
<?php
$racikan	= $_REQUEST['nama_racikan'];
$sediaan	= $_REQUEST['sediaan'];
$aturan		= $_REQUEST['aturan'];
if($aturan == '...'){
	$aturan = $_REQUEST['aturan_text'];
}
$qty		= $_REQUEST['jml_permintaan'];
$idx		= $_REQUEST['txtIdxDaftar'];
?>
<h1> Form Obat Racikan</h1>
<table width="800px">
<tr><td>Nama Racikan</td><td><?php echo $racikan;?></td></tr>
<tr><td>Sediaan</td><td><?php echo $sediaan;?></td></tr>
<tr><td>Aturan Pakai</td><td><?php echo $aturan;?></td></tr>
<tr><td>Qty</td><td><?php echo $qty;?></td></tr>
</table>
<br />
<hr />
<br />
<form id="obat_racikan">
<input type="hidden" name="noracikan" id="noracikan" value="<?php echo $racikan;?>" />
<input type="hidden" name="nama_racikan_pop" id="nama_racikan_pop" value="<?php echo $racikan?>" />
<input type="hidden" name="sediaan_pop" id="sediaan_pop" value="<?php echo $sediaan?>" />
<input type="hidden" name="aturan_pop" id="aturan_pop" value="<?php echo $aturan?>" />
<input type="hidden" name="qty_pop" id="qty_pop" value="<?php echo $qty?>" />
<input type="hidden" name="txtIdxDaftar" id="txtIdxDaftar" value="<?php echo $idx;?>" />
<table width="800px">
<tr>
	<td>Nama Obat</td><td><input type="text" name="nama_obat_racik" size="50" id="nama_obat_racik"  class="text"/>
    					  <input type="text" name="kode_obat_racik" id="kode_obat_racik" />
                          <input type="hidden" name="harga_obat_racik" id="harga_obat_racik" />
                          </td>
    <td>Qty</td><td><input type="text" name="jml_obat_racik" id="jml_obat_racik" class="text" size="5"/><input type="hidden" name="stock_obat_racik" id="stock_obat_racik" /></td>
    <td><input type="button" name="add" value="Tambah Obat Racik" id="add_obat_racik" class="text" /></td>
</tr>
</table>
</form>
<br />
<hr />
<br />
<div id="table_list_racikan"></div>