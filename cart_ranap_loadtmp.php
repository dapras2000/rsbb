<?php
include 'include/connect.php';
include 'include/function.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('#simpan').click(function(){
		var nomr = jQuery('#nomr').val();
		var noruang = jQuery('#noruang').val();
		var idxdaftar = jQuery('#idxdaftar').val();
		var carabayar = jQuery('#carabayar').val();
		var nott	  = jQuery('#nott').val();
		
		jQuery.post('<?php echo _BASE_;?>cartbill_save_bayar_ranap.php',{nomr:nomr,noruang:noruang,idxdaftar:idxdaftar,carabayar:carabayar,nott:nott},function(data){
			//alert(data);
			window.location='<?php echo _BASE_;?>index.php?link=121&id_admission='+idxdaftar;
			//jQuery('#cart_tindakan').load('<?php echo _BASE_;?>index.php?link=121&id_admission='+idxdaftar');
		});
	});
	jQuery('.batal').click(function(){
		var id = jQuery(this).attr('id');
		jQuery.post('<?php echo _BASE_;?>cartbill_batal_bayar_ranap.php',{id:id},function(data){
			jQuery('#cart_tindakan').load('<?php echo _BASE_;?>cart_ranap_loadtmp.php');
		});
	});
});
</script>
<?php
$nomr	= $_REQUEST['nomr'];

$query	= mysql_query('select a.KODETARIF, a.QTY, a.IDXBAYAR, a.ID, a.POLY,c.NAMADOKTER, b.nama_tindakan, a.TARIF as harga, a.DISCOUNT,a.TOTTARIF, a.KDDOKTER from tmp_cartbayar a join m_tarif2012 b on b.kode_tindakan = a.KODETARIF join m_dokter c on c.KDDOKTER = a.KDDOKTER where a.IP = "'.getRealIpAddr().'"');
if(mysql_num_rows($query) > 0):
	$i = 1;
	$total	= 0;
	echo $nomr;
	echo '<table width="350px">';
	echo '<tr><th>No</th><th>Nama Jasa</th>';
	#echo '<th>Dokter</th>';
	echo '<th>Harga</th>';
	echo '<th>Qty</th>';
	#echo '<th>Subtotal</th>';
	echo '<th>Aksi</th></tr>';
	while($data = mysql_fetch_array($query)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_tindakan'].' <input type="hidden" name="nama" value="'.$data['KDDOKTER'].'" id="dokter'.str_replace('.','_',$data['KDDOKTER']).'"></td>';
		#echo '<td>'.$data['NAMADOKTER'].'</td>';
		echo '<td style="text-align:right;">'.curformat($data['harga'] + $data['ADMINISTRASI'] - $data['DISCOUNT']).'</td>';
		echo '<td style="text-align:center;">'.$data['QTY'].'</td>';
		#echo '<td style="text-align:right;">'.curformat($data['TOTTARIF']*$data['QTY']).'</td>';
		echo '<td><span class="batal text" id="'.$data['IDXBAYAR'].'">Batal</span></td></tr>';
		$i++;
		$total = $total + ($data['TOTTARIF'] * $data['QTY']);
	}
	echo '<tr class="footer"><td colspan="2" style="border-top:1px solid #000;">Total</td><td style="text-align:right; border-top:1px solid #000;">'.curformat($total).'</td><td>&nbsp;</td></tr>';
	echo '<tr><td colspan="6"><input type="button" name="submit" id="simpan" value="simpan" class="text"></td></tr>';
	echo '</table>';
endif;
?>