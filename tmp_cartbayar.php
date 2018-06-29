<?php
include 'include/connect.php';
include 'include/function.php';
?>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function(){
	jQuery('.batal').click(function(){
		var idxbayar	= jQuery(this).attr('id');
		jQuery.post('<?php echo _BASE_;?>cartbill_cancel_tmp.php',{idxbayar:idxbayar},function(data){
			jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
		});
	});
	jQuery('#simpan').click(function(){
		var nomr		= jQuery('#nomr').val();
		var idxdaftar	= jQuery('#idxdaftar').val();
		var carabayar	= jQuery('#carabayar').val();
		var poly		= jQuery('#poly').val();
		var retribusi	= jQuery('#retribusi').val();
		var kddokter	= jQuery('#kddokter').val();
		var aps			= jQuery('#aps').val();
		if(aps == 1){
			var file = 'cartbill_save_bayar_aps.php'
		}else{
			var file = 'cartbill_save_bayar.php'
		}
		jQuery.post('<?php echo _BASE_;?>'+file,{nomr:nomr,idxdaftar:idxdaftar,carabayar:carabayar,poly:poly,kddokter:kddokter},function(data){
			
			window.close();
			if (window.opener && !window.opener.closed) {
				window.opener.location.reload();
			}
		});
	});
});
</script>
<?php
$query	= 'select a.KODETARIF, a.QTY, a.IDXBAYAR, a.ID, a.POLY, b.nama_tindakan, a.tarif as harga from tmp_cartbayar a join m_tarif2012 b on b.kode_tindakan = a.KODETARIF where a.IP = "'.getRealIpAddr().'"';
$query = mysql_query($query);
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