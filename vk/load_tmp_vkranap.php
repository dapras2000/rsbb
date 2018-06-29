<?php
include '../include/connect.php';
include '../include/function.php';
?>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function(){
	jQuery('.batal').click(function(){
		var idxbayar	= jQuery(this).attr('id');
		jQuery.post('<?php echo _BASE_;?>vk/cancel_tmp_vkranap.php',{idxbayar:idxbayar},function(data){
			jQuery('#list_tindakan').load('<?php echo _BASE_;?>vk/load_tmp_vkranap.php');
		});
	});
	jQuery('#simpan').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#carabayar').val();
		var ruang		= jQuery('#ruang').val();
		var nott		= jQuery('#nott').val();
		jQuery.post('<?php echo _BASE_;?>vk/save_tmp_to_cart_vkranap.php',{nomr:nomr,idxdaftar:idxdaftar,carabayar:carabayar,ruang:ruang,nott:nott},function(data){
			//jQuery('#list_tindakan').load('<?php echo _BASE_;?>vk/load_tmp_vkranap.php');
			alert('Data Berhasil di SImpan');
			window.location='<?php echo _BASE_;?>?link=5vkranap&nomr='+nomr+'&idx='+idxdaftar;
			//window.close();
			//if (window.opener && !window.opener.closed) {
			//	window.opener.location.reload();
			//}
		});
	});
});
</script>
<?php
$query	= mysql_query('select a.KODETARIF, a.QTY, a.IDXBAYAR, a.ID, a.POLY, b.nama_tindakan, a.tarif as harga 
					  from tmp_cartbayar a 
					  join m_tarif2012 b on b.kode_tindakan = a.KODETARIF 
					  where a.IP = "'.getRealIpAddr().'"');
if(mysql_num_rows($query) > 0):
	$i = 1;
	$total	= 0;
	echo '<table width="340px" style="float:right;" class="popup-table">';
	echo '<tr><th>No</th><th>Nama Tindakan</th><th>Harga</th><th>Qty</th><th>Aksi</th></tr>';
	echo '<tbody>';
	while($data = mysql_fetch_array($query)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_tindakan'].'</td><td style="text-align:right;">'.curformat($data['harga'],2).'</td><td style="text-align:center;">'.$data['QTY'].'</td><td><span class="batal" id="'.$data['IDXBAYAR'].'">Batal</span></td></tr>';
		$i++;
		$total = $total + ($data['harga'] * $data['QTY']);
	}
	echo '<tr class="footer"><td colspan="2">Total</td><td style="text-align:right;">'.curformat($total).'</td><td>&nbsp;</td></tr>';
	echo '</tbody>';
	echo '<tr><td colspan="4"><span class="simpan" id="simpan">SIMPAN</span></td></tr>';
	echo '</table>';
endif;
?>