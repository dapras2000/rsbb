<SCRIPT LANGUAGE="JavaScript">
jQuery(document).ready(function(){
	jQuery("#GRUP").change(function(){
		var selectValues = jQuery("#GRUP").val();
		var tindakanHidden = jQuery("#TINDAKANHIDDEN").val();
		jQuery.post('./include/jaspel_tarif_load.php',{kdgrup:selectValues,load_tindakan:'true'},function(data){
			jQuery('#tindakanpilih').html(data);
			jQuery('#KDTINDAKAN').val(tindakanHidden).change();
			jQuery('#subtindakanpilih').html("<select name=\"subtindakan\" class=\"text required\" title=\"*\" id=\"subtindakan\"><option value=\"\"> --pilih-- </option></select>");
		});
	});

	jQuery("#KDTINDAKAN").change(function(){
		var selectValues = jQuery("#KDTINDAKAN").val();
		var subtindakanHidden = jQuery("#SUBTINDAKANHIDDEN").val();
		jQuery.post('./include/jaspel_tarif_load.php',{kdtindakan:selectValues,load_subtindakan:'true'},function(data){
			jQuery('#subtindakanpilih').html(data);
			jQuery('#SUBTINDAKAN').val(subtindakanHidden).change();
			jQuery('#sub2tindakanpilih').html("<select name=\"sub2tindakan\" class=\"text required\" title=\"*\" id=\"sub2tindakan\"><option value=\"\"> --pilih-- </option></select>");
		});
	});
	jQuery("#SUBTINDAKAN").change(function(){
		var selectValues = jQuery("#SUBTINDAKAN").val();
		var sub2tindakanHidden = jQuery("#SUB2TINDAKANHIDDEN").val();
		jQuery.post('./include/jaspel_tarif_load.php',{kdsubtindakan:selectValues,load_sub2tindakan:'true'},function(data){
			jQuery('#sub2tindakanpilih').html(data);
			jQuery('#SUB2TINDAKAN').val(sub2tindakanHidden);
		});
	});

});
</SCRIPT>
<? 
include ("../../../include/connect.php");


if($_REQUEST['load_grup'] != ''){
	$kolamp	= $_REQUEST['kolamp'];
	if ($kolamp == "08"){
		$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "8" and kode_lampiran = "'.$kolamp.'" 
                                    and CHAR_LENGTH( kode_gruptindakan ) != "5"
                               UNION ALL 
                               SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "5" and kode_lampiran = "'.$kolamp.'" 
                              		and CHAR_LENGTH( kode_gruptindakan ) != "8"
                               ');
	}if ($kolamp == "05") {
		$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "5" and kode_tindakan != "05.01" and kode_lampiran = "'.$kolamp.'"');
	}else{
		$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "5" and kode_lampiran = "'.$kolamp.'"');
	
	}
	if(mysql_num_rows($sql) > 0){
		echo '<select name="GRUP" class="text required" title="*" id="GRUP" style = "width:25;" required><option value=""> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				if($_REQUEST['GRUP'] == $data['kode_tindakan']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$data['kode_tindakan'].'" '.$sel.' > '.$data['kode_tindakan'].' | '.$data['nama_tindakan'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada kode grup di kode lampiran tersebut';
	}
}

if($_REQUEST['load_tindakan'] != ''){
	$kdgrup	= $_REQUEST['kdgrup'];
	if (substr($kdgrup,0,2) == "05"){
		$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "9" and kode_gruptindakan = "'.$kdgrup.'"');
	
	}else {
		$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "8" and kode_gruptindakan = "'.$kdgrup.'"');
	}
	if(mysql_num_rows($sql) > 0){
		echo '<select name="KDTINDAKAN" class="text required" title="*" id="KDTINDAKAN"><option value=""> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				echo'<option value="'.$data['kode_tindakan'].'">'.$data['kode_tindakan'].' | '.$data['nama_tindakan'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada data di kode tersebut';
	}
}

if($_REQUEST['load_subtindakan'] != ''){
	$kdtindakan	= $_REQUEST['kdtindakan'];
	
	$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "11" and kode_gruptindakan = "'.$kdtindakan.'"');
	if(mysql_num_rows($sql) > 0){

		echo '<select name="SUBTINDAKAN" class="text required" title="*" id="SUBTINDAKAN"><option value=""> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				echo'<option value="'.$data['kode_tindakan'].'">'.$data['kode_tindakan'].' | '.$data['nama_tindakan'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada data di kode tersebut';
	}
}

if($_REQUEST['load_sub2tindakan'] != ''){
	$kdsubtindakan	= $_REQUEST['kdtindakan'];
	$sql	= mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "11" and kode_gruptindakan = "'.$kdtindakan.'"');
	if(mysql_num_rows($sql) > 0){
		echo '<select name="SUB2TINDAKAN" class="text required" title="*" id="SUB2TINDAKAN"><option value=""> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				echo'<option value="'.$data['kode_tindakan'].'">'.$data['nama_tindakan'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada data di kode tersebut';
	}
}