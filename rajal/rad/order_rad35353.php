<?php  
	include("include/connect.php");
?>
<script>
jQuery(document).ready(function(){
	jQuery('#orderlab').click(function(){
		jQuery.post('<?php echo _BASE_;?>rajal/rad/register_rad.php',jQuery('#form_orderlab').serialize(),function(data){
			//alert(data);
			if(!data){
				jQuery('#paketlab').append('<h1>Pasien Sudah di Daftarkan di Radiologi</h1>');
				jQuery('#orderlab').attr('disabled','disabled');
			}
		});
	});
	
});
</script>
  <div id="paketlab">
  	<form id="form_orderlab" action="#">
    	<?php
		$sql_rajal	= mysql_query('select * from t_pendaftaran where NOMR = "'.$_REQUEST['nomr'].'" and IDXDAFTAR = "'.$_REQUEST['idx'].'"');
		$ddaftar	= mysql_fetch_array($sql_rajal);
		?>
        <br />
    	<input type="hidden" name="nomr" value="<?php echo $_REQUEST['nomr']; ?>" />
        <input type="hidden" name="idxdaftar" value="<?php echo $_REQUEST['idx']; ?>" />
        <input type="hidden" name="kddokter" value="<?php echo $ddaftar['KDDOKTER']; ?>" />
        <input type="hidden" name="carabayar" value="<?php echo $ddaftar['KDCARABAYAR']; ?>" />
        
		Diagnosa Klinik : <input type="text" name="diagnosa" id="diagnosa" size="100" class="text" style="height:30px;" />
        <?php
		$sql_tmp = mysql_query('select * from tmp_cartorderrad where NOMR = "'.$_REQUEST['nomr'].'" and IDXDAFTAR = "'.$_REQUEST['idx'].'" and TGLDAFTAR = "'.date('Y-m-d').'"');
		$d	= mysql_num_rows($sql_tmp);
		if($d > 0){
			$dis = 'disabled="disabled"';
			$r	 = '<h1>Pasien Sudah di Daftarkan di Radiologi</h1>';
		}else{
			$dis = '';
			$r	 = '';
		}
		?><br /><br />
  		<input type="button" class="text" name="daftarlab" value="DAFTAR RADIOLOGI" id="orderlab" <?php echo $dis; ?>  />
        <br /><br />
        <?php echo $r; ?>
    </form>
  </div>
