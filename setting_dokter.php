<?php 
include("include/connect.php");
require_once('ps_pagebill.php');
?>
<script>
jQuery(document).ready(function(){
	jQuery('.loader').hide();
	jQuery('.button').click(function(){
		var kdpoly	= jQuery(this).attr('svn');
		var kddokter= jQuery('#dokter_'+kdpoly).val();
		var kddokter2= jQuery('#dokter2_'+kdpoly).val();
		jQuery('#loader_'+kdpoly).show();
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{kdpoly:kdpoly,kddokter:kddokter,kddokter2:kddokter2,dokterjaga:'true'},function(data){
			//location.reload();
			jQuery('#btn_'+kdpoly).val('U P D A T E').css({'background':'#ff9900'});
			jQuery('#loader_'+kdpoly).hide();
		});
	});
	jQuery('.buttonadd').click(function(){
		var kdpoly	= jQuery(this).attr('svn');
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{kdpoly:kdpoly,adddokterjaga:'true'},function(data){
			//location.reload();
			jQuery('#btn_'+kdpoly).val('U P D A T E').css({'background':'#ff9900'});
			jQuery('#loader_'+kdpoly).hide();
		});
	});
	jQuery('#addnew').click(function(){
		var poly 	= jQuery('#namapoly').val();
		var dokter	= jQuery('#namadokter').val();
		if(poly == ''){
			alert('Poly Belum dipilih');
			return false;
		}
		if(dokter == ''){
			alert('Dokter Belum dipilih');
			return false;
		}
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{poly:poly,dokter:dokter,adddokterjaga:true},function(data){
			if(data == 'error'){
				alert('Tidak bisa mendaftarkan satu dokter dalam poliklinik yang sama');
				return false;
			}else{
				jQuery('#listdokter_'+poly).load('<?php echo _BASE_;?>include/ajaxload.php?loaddokterjaga='+poly);
			}
		});
	});
	jQuery('.hapus').click(function(){
		var id 	= jQuery(this).attr('id');
		var poly= jQuery(this).attr('poly');
		jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php',{id:id,removedokterjaga:true},function(data){
			jQuery('#listdokter_'+poly).load('<?php echo _BASE_;?>include/ajaxload.php?loaddokterjaga='+poly);
		});						
	});
});
</script>
<style type="text/css">
.loader{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
.hapus{cursor:pointer;}
.listdokter{height:20px;}
.listpoly{border-bottom:1px solid #000;}
.namadokter{float:left; height:20px; margin-right:20px;}
</style>
<div align="center">
    <div id="frame">
    	<div id="frame_title">
			<h3>Pengaturan Dokter Jaga TGL <?php echo date('d/m/Y'); ?></h3>
    	</div>
        <table width="70%" style="float:left;">
        <tr><th>Nama Poly</th><th>Nama Dokter Jaga</th></tr>
        <?php
		$sql	= mysql_query('select * from m_poly');
		while($dpoly = mysql_fetch_array($sql)){
			echo '<tr>';
				echo '<td class="listpoly">'.$dpoly['nama'].'</td>';
				echo '<td class="listpoly"><div class="listdokter" id="listdokter_'.$dpoly['kode'].'" style="display:block;">';
				$sql_3	= mysql_query('select a.kddokter,a.kdpoly, b.NAMADOKTER, a.id from m_dokter_jaga a join m_dokter b on a.kddokter = b.KDDOKTER where a.kdpoly = '.$dpoly['kode'].'');
				if(mysql_num_rows($sql_3) > 0):
					while($ddok	= mysql_fetch_array($sql_3)){
						#$dokterjaga[]	= $ddok['NAMADOKTER'];
						echo '<div class="namadokter">'.$ddok['NAMADOKTER'].'</div> <span id="'.$ddok['id'].'" poly="'.$dpoly['kode'].'" class="hapus text">Hapus</span> <br clear="all">';
					}
					#echo implode('<br>',$dokterjaga);
				endif;
				echo '</div></td>';
			echo '</tr>';
		}
		?>
        </table>
        <table width="30%" style="float:right;">
        <tr><th colspan="2"> Tambah Dokter Jaga </th></tr>
        <tr><td>Nama Poly</td><td><select name="nama_poly" id="namapoly">
        							<option value=""> -- Pilih Poliklinik -- </option>
        							<?php 
									$sql_poly	= mysql_query('select * from m_poly');
									while($dp = mysql_fetch_array($sql_poly)){
										echo '<option value="'.$dp['kode'].'">'.$dp['nama'].'</option>';
									}
									?>
        						   </select></td></tr>
		<tr><td>Dokter Jaga</td><td><select name="nama_dokter" id="namadokter">
        							<option value=""> -- Pilih Dokter -- </option>
                                    <?php 
									$sql_dokter	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										echo '<option value="'.$dd['KDDOKTER'].'">'.$dd['NAMADOKTER'].'</option>';
									}
									?>
        							
        						   </select></td></tr>
		<tr><td colspan="2"><input type="button" name="tambah" value="T A M B A H" id="addnew" class="text" /></td></tr>
		</table>
        <br clear="all" />
	</div>
</div>
