<?php
include 'include/connect.php';
include 'include/function.php';
?>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function(){
	jQuery('.batal').click(function(){
		var idxbayar	= jQuery(this).attr('id');
		jQuery.post('<?php echo _BASE_;?>cartbill_cancel_tmp.php',{idxbayar:idxbayar},function(data){
			jQuery('#load_tmp_cartbayar').empty().html(data);																	   
		});
	});							
});
</script>
<?PHP
mysql_query('delete from tmp_cartbayar where IDXBAYAR = '.$_REQUEST['idxbayar']);
$t	= 'tarif';
$query	= mysql_query('select tmp_cartbayar.KODETARIF,QTY,tmp_cartbayar.ID, m_tarif.nama_jasa, m_tarif.'.$t.' as harga from tmp_cartbayar join m_tarif on tmp_cartbayar.ID = m_tarif.id where tmp_cartbayar.IP="'.getRealIpAddr().'"');
if(mysql_num_rows($query) > 0):
	$i = 1;
	$total	= 0;
	while($data = mysql_fetch_array($query)){
		echo '<tr><td>'.$i.'</td><td>'.$data['nama_jasa'].'</td><td style="text-align:right;">'.curformat($data['harga'],2).'</td><td style="text-align:center;">'.$data['QTY'].'</td><td><span class="batal" id="'.$data['IDXBAYAR'].'">Batal</span></td></tr>';
		$i++;
		$total = $total + ($data['harga'] * $data['QTY']);
	}
	echo '<tr class="footer"><td colspan="2">Total</td><td style="text-align:right;">'.curformat($total,2).'</td><td>&nbsp;</td></tr>';
endif;
	 # mysql_query("INSERT INTO tmp_carttindakan_medis (KODETARIF,IP,KDDOKTER,TARIF) VALUES('".$_POST["kode"]."','".getRealIpAddr()."',".$_POST["dokter"].",".$_POST["tarif"].")");

	 #mysql_query("INSERT INTO tmp_carttindakan_medis (KODETARIF,IP,KDDOKTER,TARIF) VALUES('".$_POST["kode"]."','".getRealIpAddr()."',".$_POST["dokter"].",".$_POST["tarif"].")");	
?>