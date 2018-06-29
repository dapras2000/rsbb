<?php
include 'include/connect.php';
include 'include/function.php';
?>
<script>
jQuery(document).ready(function(){
	jQuery('.add').click(function(){
		var kode 	= jQuery(this).attr('id');
		var dokter	= jQuery('#dokter_'+kode).val();
		var ruang	= jQuery('#noruang').val();
		jQuery.post('<?php echo _BASE_;?>cart_ranap_savetmp.php',{kode:kode,dokter:dokter,ruang:ruang},function(data){
			jQuery('#cart_tindakan').load('<?php echo _BASE_;?>cart_ranap_loadtmp.php');	
		});
	});
});
</script>
<?php
if($_REQUEST['loadtindakan_ranap'] == 'true'){
	
	echo $sql = 'select * from m_tarif2012 where kelas = "'.$_REQUEST['kelas'].'"';
	$sql = mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		echo '<table width="400px">';
		echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
		while($data=mysql_fetch_array($sql)){
			$j	= str_replace('.','_',$data['kode_tindakan']);
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.curformat($data['tarif']).'</td><td>';
			$sqld	= mysql_query('select a.*, b.NAMADOKTER from m_dokter_pengganti a join m_dokter b on b.KDDOKTER = a.kddokter');
			if(mysql_num_rows($sqld) > 0){
				echo '<select name="dokter[]" class="dokter text" id="dokter_'.$j.'">';
				while($d = mysql_fetch_array($sqld)){
					echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
				}
				echo '</select>';
			}
			echo '</td><td><input type="button" name="add" value="add" class="text add" id="'.$j.'"></td></tr>';
		}
		echo '</table>';
	}
}
?>