<?php 
include '../include/connect.php';
include '../include/function.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('#simpan_racikan').click(function(){
		var dokter = jQuery('#dokter_set').val();
		var idx = jQuery('#txtIdxDaftar').val();
		var nama_racikan = jQuery('#nama_racikan_pop').val();
		var sediaan = jQuery('#sediaan_pop').val();
		var aturan = jQuery('#aturan_pop').val();
		var qty	= jQuery('#qty_pop').val();
		var total = jQuery('#total_racikan').val();
		jQuery.post('<?php echo _BASE_;?>apotek/simpan_obat_tmp_cartresep.php',{idx:idx,kode:nama_racikan,sediaan:sediaan,aturan:aturan,qty:qty,total:total,dokter:dokter},function(data){
			jQuery('#validbarang').load('<?php echo _BASE_;?>apotek/load_obat_tmp_cartresep.php?idxdaftar='+idx);
			if( jQuery('#aturan_text').css('display') == 'none' ){
				jQuery('#aturan_text').css('display','none');
			}
		});
		jQuery(this).trigger('close.facebox');
		jQuery('#nama_racikan option[value="'+nama_racikan+'"]').remove();
		jQuery('#jml_permintaan').val('');
	});
	
	jQuery('.batal_racik').click(function(){
		var idobat  = jQuery(this).attr('id');
		var idx = jQuery(this).attr('idx');
		jQuery.post('<?php echo _BASE_;?>apotek/delete_tmp_racikan_obat.php',{idobat:idobat},function(data){
			jQuery('#table_list_racikan').load('<?php echo _BASE_;?>apotek/load_obat_racikan_tmpracikan.php?txtIdxDaftar='+idx);
		});
	});
});
</script>
<?php
$sql = 'SELECT a.*, b.nama_obat
					FROM tmp_racikan_obat a
					JOIN m_obat b ON b.kode_obat = a.KODE_OBAT
				   	where a.IDXDAFTAR = '.$_REQUEST['txtIdxDaftar'].' and noracik = "'.$_REQUEST['noracik'].'"';
$sql = mysql_query($sql);
if(mysql_num_rows($sql) > 0){
	$i = 1;
	echo '<table width="100%">';
	echo '<tr>
		<th style="width:20px;">No</th>
		<th>Nama Obat</th>
		<th style="width:40px;">Qty</th>
		<th style="width:100px;">Harga</th>
		<th style="width:150px;">Subtotal</th>
		<th style="width:150px;">Aksi</th>
		</tr>';
	while($data = mysql_fetch_array($sql)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_obat'].'</td><td>'.$data['JUMLAH'].'</td><td align="right">'.curformat($data['HARGA_OBAT'],2).'</td><td align="right">'.curformat($data['JUMLAH'] * ($data['HARGA_OBAT']),2).'</td><td><input value="Batal"  type="button" idx="'.$_REQUEST['txtIdxDaftar'].'" id="'.$data['IDXRACIK'].'" class="batal_racik text"></td><tr>';
		$i++;
		$total 		= $total + ($data['JUMLAH'] * ($data['HARGA_OBAT']));
	}
	echo '<input type="hidden" value="'.$total.'" id="total_racikan">';
	echo '<tr><td colspan="4">Grand Total</td><td align="right">'.curformat($total,2).'</td><td></td><tr>';
	echo '<tr><td colspan="6"><input type="button" value="simpan" id="simpan_racikan" class="text"></td><tr>';
	echo '</table>';
	
}
?>