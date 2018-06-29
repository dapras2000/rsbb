<?php include '../include/connect.php'; ?>
<script>
jQuery(document).ready(function(){

	jQuery('.text').focus(function(){
		var row = jQuery(this).attr('row');
		jQuery('#row_'+row+' > td > input').css({'color':'#000','border':'#333 1px solid','cursor':'auto'});
	}).blur(function(){
		var rows = jQuery(this).attr('row');
		jQuery('#row_'+rows+' > td > input').css({'color':'#999','border':'#999 1px solid','cursor':'pointer'});
	});

	/*
	jQuery('.row').click(function(){
		var id 	= jQuery(this).attr('id');
		var oid = jQuery('#tmp').val();
		if(oid == ''){
			jQuery('#tmp').val(id);			
			jQuery('.row_'+id).css({'color':'#000','border':'#333 1px solid','cursor':'auto'});
		}else{
			if(id != oid){
				jQuery('#tmp').val(id);			
				jQuery('.row_'+id).css({'color':'#000','border':'#333 1px solid','cursor':'auto'});
				jQuery('.row_'+oid).css({'color':'#999','border':'#999 1px solid','cursor':'auto'});
			}
		}
		
	});*/
});
</script>
<style>
input.text{ color:#999; border:#999 1px solid; cursor:pointer;}
</style>
<div style="width:100%; overflow:scroll; height:500px;" class="divtab">
<table class="example" id="dnd-example" width="100%">
<thead>
	<tr>
    	<th>Nama Akun</th>
        <th>Tarif</th>
        <th>J Layanan</th>
        <th>J Sarana</th>
        <th>dr Spesialis</th>
        <th>dr Umum</th>
        <th>Manajemen Sp</th>
        <th>Pendukung Sp</th>
        <th>Asisten Sp</th>
        <th>Manajemen Um</th>
        <th>Pendukung Sp</th>
        <th>Asisten Sp</th>
        <th>Bidan</th>
        <th>Manajemen Bd</th>
        <th>Pendukung Bd</th>
        <th>Asisten Bd</th>
        <th>dr Operator</th>
        <th>dr Anastesi</th>
        <th>dr Anak</th>
        <th>Prwt Ok</th>
        <th>Prwt Perina</th>
        <th>Manajemen Ok</th>
        <th>Pendukung Ok</th>
        <th>Asisten Ok</th>
        <th>dr Radiologi</th>
        <th>dr Perujuk</th>
        <th>Prwt Rad</th>
        <th>Manajemen Rad</th>
        <th>Pendukung Rad</th>
        <th>Asisten Rad</th>
        <th>dr Perujuk Rad</th>
        <th>Petugas Rad</th>
        <th>dr Lab</th>
        <th>Petugas Lab</th>
        <th>Asisten Lab</th>
        <th>Manajemen Lab</th>
        <th>Pendukung Lab</th>
        <th>dr Perujuk Lab</th>
	</tr>
</thead>
<tbody>
	<?php
	require_once("m_jaspel2012.php");
	$objSetupTarif = new m_jaspel2012();
	$objSetupTarif->db_host=$hostname;
	$objSetupTarif->db_user=$username;
	$objSetupTarif->db_pass=$password;
	$objSetupTarif->db_database=$database; 	
	if(!$objSetupTarif->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}
	$allFields=$objSetupTarif->getAllFields(); 
	$i = 1;
	foreach($allFields as $data) {
		
		if($data['tarif'] == 0){
			echo '<tr><th colspan="38">'.$data['nama_tindakan'].'</th></tr>';
		}else{
		echo '<tr id="row_'.$i.'" class="row" svn="row_'.$i.'">
    	<td><input type="text" name="nama_tindakan[]" row="'.$i.'" class="nama_tindakan text row_'.$i.'" size="55" id="nm_'.$data['kode_tindakan'].'" value="'.$data['nama_tindakan'].'" readonly="readonly"></td>
        <td><input type="text" name="tarif[]" row="'.$i.'" class="tarif text row_'.$i.'" size="5" id="tarif_'.$data['kode_tindakan'].'" value="'.$data['tarif'].'" readonly="readonly"></td>
        <td><input type="text" name="jasa_pelayanan[]" row="'.$i.'" class="jasa_pelayanan text" size="5" id="jasa_pelayanan_'.$data['kode_tindakan'].'" value="'.$data['jasa_pelayanan'].'" readonly="readonly"></td>
        <td><input type="text" name="jasa_sarana[]" row="'.$i.'" class="jasa_sarana text" size="5" id="jasa_sarana_'.$data['kode_tindakan'].'" value="'.$data['jasa_sarana'].'" readonly="readonly"></td>
        <td><input type="text" name="dr_spesialis[]" row="'.$i.'" class="dr_spesialis text" size="5" id="dr_spesialis_'.$data['kode_tindakan'].'" value="'.$data['dr_spesialis'].'" readonly="readonly"></td>
        <td><input type="text" name="dr_umum[]" row="'.$i.'" class="dr_umum text" size="5" id="dr_umum_'.$data['kode_tindakan'].'" value="'.$data['dr_umum'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_sp[]" row="'.$i.'" class="manajemen_sp text" size="5" id="manajemen_sp_'.$data['kode_tindakan'].'" value="'.$data['manajemen_sp'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_sp[]" row="'.$i.'" class="pendukung_sp text" size="5" id="pendukung_sp_'.$data['kode_tindakan'].'" value="'.$data['pendukung_sp'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_sp[]" row="'.$i.'" class="asisten_sp text" size="5" id="asisten_sp_'.$data['kode_tindakan'].'" value="'.$data['asisten_sp'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_um[]" row="'.$i.'" class="manajemen_um text" size="5" id="manajemen_um_'.$data['kode_tindakan'].'" value="'.$data['manajemen_um'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_um[]" row="'.$i.'" class="pendukung_um text" size="5" id="pendukung_um_'.$data['kode_tindakan'].'" value="'.$data['pendukung_um'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_um[]" row="'.$i.'" class="asisten_um text" size="5" id="asisten_um_'.$data['kode_tindakan'].'" value="'.$data['asisten_um'].'" readonly="readonly"></td>
        <td><input type="text" name="bidan[]" row="'.$i.'" class="bidan text" size="5" id="bidan_'.$data['kode_tindakan'].'" value="'.$data['bidan'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_bd[]" row="'.$i.'" class="manajemen_bd text" size="5" id="manajemen_bd_'.$data['kode_tindakan'].'" value="'.$data['manajemen_bd'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_bd[]" row="'.$i.'" class="pendukung_bd text" size="5" id="pendukung_bd_'.$data['kode_tindakan'].'" value="'.$data['pendukung_bd'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_bd[]" row="'.$i.'" class="asisten_bd text" size="5" id="asisten_bd_'.$data['kode_tindakan'].'" value="'.$data['asisten_bd'].'" readonly="readonly"></td>
        <td><input type="text" name="drOperator[]" row="'.$i.'" class="drOperator text" size="5" id="drOperator_'.$data['kode_tindakan'].'" value="'.$data['drOperator'].'" readonly="readonly"></td>
        <td><input type="text" name="drAnastesi[]" row="'.$i.'" class="drAnastesi text" size="5" id="drAnastesi_'.$data['kode_tindakan'].'" value="'.$data['drAnastesi'].'" readonly="readonly"></td>
        <td><input type="text" name="drAnak[]" row="'.$i.'" class="drAnak text" size="5" id="drAnak_'.$data['kode_tindakan'].'" value="'.$data['drAnak'].'" readonly="readonly"></td>
        <td><input type="text" name="perawat_ok[]" row="'.$i.'" class="perawat_ok text" size="5" id="perawat_ok_'.$data['kode_tindakan'].'" value="'.$data['perawat_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="perawat_perina[]" row="'.$i.'" class="perawat_perina text" size="5" id="perawat_perina_'.$data['kode_tindakan'].'" value="'.$data['perawat_perina'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_ok[]" row="'.$i.'" class="manajemen_ok text" size="5" id="manajemen_ok_'.$data['kode_tindakan'].'" value="'.$data['manajemen_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_ok[]" row="'.$i.'" class="asisten_ok text" size="5" id="asisten_ok_'.$data['kode_tindakan'].'" value="'.$data['asisten_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_ok[]" row="'.$i.'" class="pendukung_ok text" size="5" id="pendukung_ok_'.$data['kode_tindakan'].'" value="'.$data['pendukung_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="drRadiologi[]" row="'.$i.'" class="drRadiologi text" size="5" id="drRadiologi_'.$data['kode_tindakan'].'" value="'.$data['drRadiologi'].'" readonly="readonly"></td>
        <td><input type="text" name="drPerujuk[]" row="'.$i.'" class="drPerujuk text" size="5" id="drPerujuk_'.$data['kode_tindakan'].'" value="'.$data['drPerujuk'].'" readonly="readonly"></td>
        <td><input type="text" name="perawat_rad[]" row="'.$i.'" class="perawat_rad text" size="5" id="perawat_rad_'.$data['kode_tindakan'].'" value="'.$data['perawat_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_rad[]" row="'.$i.'" class="manajemen_rad text" size="5" id="manajemen_rad_'.$data['kode_tindakan'].'" value="'.$data['manajemen_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_rad[]" row="'.$i.'" class="pendukung_rad text" size="5" id="pendukung_rad_'.$data['kode_tindakan'].'" value="'.$data['pendukung_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_rad[]" row="'.$i.'" class="asisten_rad text" size="5" id="asisten_rad_'.$data['kode_tindakan'].'" value="'.$data['asisten_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="drPerujuk_rad[]" row="'.$i.'" class="drPerujuk_rad text" size="5" id="drPerujuk_rad_'.$data['kode_tindakan'].'" value="'.$data['drPerujuk_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="petugas_rad[]" row="'.$i.'" class="petugas_rad text" size="5" id="petugas_rad_'.$data['kode_tindakan'].'" value="'.$data['petugas_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="drLab[]" row="'.$i.'" class="drLab text" size="5" id="drLab_'.$data['kode_tindakan'].'" value="'.$data['drLab'].'" readonly="readonly"></td>
        <td><input type="text" name="petugas_lab[]" row="'.$i.'" class="petugas_lab text" size="5" id="petugas_lab_'.$data['kode_tindakan'].'" value="'.$data['petugas_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_lab[]" row="'.$i.'" class="asisten_lab text" size="5" id="asisten_lab_'.$data['kode_tindakan'].'" value="'.$data['asisten_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_lab[]" row="'.$i.'" class="manajemen_lab text" size="5" id="manajemen_lab_'.$data['kode_tindakan'].'" value="'.$data['manajemen_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_lab[]" row="'.$i.'" class="pendukung_lab text" size="5" id="pendukung_lab_'.$data['kode_tindakan'].'" value="'.$data['pendukung_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="drPerujuk_lab[]" row="'.$i.'" class="drPerujuk_lab text" size="5" id="drPerujuk_lab_'.$data['kode_tindakan'].'" value="'.$data['drPerujuk_lab'].'" readonly="readonly"></td>
	</tr>';
	$i++;
		}
	}
	?>
</tbody>
</table> 
</div>