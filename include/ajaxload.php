<SCRIPT LANGUAGE="JavaScript">
jQuery(document).ready(function(){
	jQuery("#KOTA").change(function(){
		var selectValues = jQuery("#KOTA").val();
		var kecHidden = jQuery("#KECAMATANHIDDEN").val();
		jQuery.post('./include/ajaxload.php',{kdkota:selectValues,load_kecamatan:'true'},function(data){
			jQuery('#kecamatanpilih').html(data);
			jQuery('#KDKECAMATAN').val(kecHidden).change();
			jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
		});
	});
	
	jQuery("#KDKECAMATAN").change(function(){
		var selectValues = jQuery("#KDKECAMATAN").val();
		var kelHidden = jQuery("#KELURAHANHIDDEN").val();
		jQuery.post('./include/ajaxload.php',{kdkecamatan:selectValues,load_kelurahan:'true'},function(data){
			jQuery('#kelurahanpilih').html(data);
			jQuery('#KELURAHAN').val(kelHidden);
		});
	});
	
	jQuery("#ID_DIAGNOSIS").change(function(){
		var selectValues = jQuery("#ID_DIAGNOSIS").val();
		//var kecHidden = jQuery("#KECAMATANHIDDEN").val();
		jQuery.post('./include/ajaxload.php',{id_diagnosis:selectValues,load_sub_var1:'true'},function(data){
			jQuery('#dafgejalapilih').html(data);
		});
		jQuery.post('./include/ajaxload.php',{id_diagnosis:selectValues,load_sub_var2:'true'},function(data){
			jQuery('#dafetiologipilih').html(data);
		});
		jQuery.post('./include/ajaxload.php',{id_diagnosis:selectValues,load_sub_var3:'true'},function(data){
			jQuery('#dafoutcomepilih').html(data);
		});
		jQuery.post('./include/ajaxload.php',{id_diagnosis:selectValues,load_sub_var4:'true'},function(data){
			jQuery('#dafintervensipilih').html(data);
		});
	});
});
</SCRIPT>
<? session_start();
include("connect.php");
if($_REQUEST['dokterjaga'] != ''){
	$kdpoly		= $_REQUEST['kdpoly'];
	$kddokter	= $_REQUEST['kddokter'];
	$kddokter2	= $_REQUEST['kddokter2'];
	$sql	= mysql_query('select * from m_dokter_jaga where kdpoly = '.$kdpoly);
	if(mysql_num_rows($sql) > 0){
			$update	= mysql_query('update m_dokter_jaga set kddokter = '.$kddokter.' where kdpoly ='.$kdpoly) or die(mysql_error());
	}else{
			$insert	= mysql_query('insert into m_dokter_jaga set kdpoly ='.$kdpoly.', kddokter = '.$kddokter) or die(mysql_error());
	}
}
if($_REQUEST['load_dokterjaga'] != ''){
	$kdpoly	= $_REQUEST['kdpoly'];
	$sql	= mysql_query('select a.kddokter as KDDOKTER, b.NAMADOKTER from m_dokter_jaga a join m_dokter b on a.KDDOKTER = b.kddokter where a.kdpoly = "'.$kdpoly.'"');
#$sql	= mysql_query('select KDDOKTER, NAMADOKTER from m_dokter where KDPOLY = "'.$kdpoly.'"');
	if(mysql_num_rows($sql) > 0){
		#$data	= mysql_fetch_array($sql);
		echo '<select name="KDDOKTER" class="text">';
			while($data = mysql_fetch_array($sql)){	
				echo '<option value="'.$data['KDDOKTER'].'">'.$data['NAMADOKTER'].'</option>';
			
			}
		echo '</select>';
		
	}else{
		echo 'Tidak ada dokter jaga di poli tersebut';
	}
}
if($_REQUEST['load_payplan'] != ''){
	$payplan	= $_REQUEST['payplan'];
	$sql	= mysql_query('select KODE, NAMA from m_carabayar where KODE > 1');
	if(mysql_num_rows($sql) > 0){
		#$data	= mysql_fetch_array($sql);
		echo '<select name="CARABAYAR" id="CARABAYAR" class="text"><option value="0"> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				echo '<option value="'.$data['KODE'].'">'.$data['NAMA'].'</option>';
			}
		echo '</select>';
	}else{
		echo '-';
	}
}

# INSERT DOKTER JAGA BARU
if($_REQUEST['adddokterjaga'] != ''){
	$poly	= $_REQUEST['poly'];
	$dokter	= $_REQUEST['dokter'];
	$q	= mysql_query('select * from m_dokter_jaga where kdpoly = "'.$poly.'" AND kddokter ="'.$dokter.'"');
	if(mysql_num_rows($q) > 0):
		echo 'error';
	else:
		$sql	= mysql_query('insert into m_dokter_jaga set kdpoly = "'.$poly.'", kddokter = "'.$dokter.'"');
	endif;
}
# LOAD LIST DOKTER JAGA
if($_REQUEST['loaddokterjaga'] != ''){
	include 'connect.php';
	$kdpoly	= $_GET['loaddokterjaga'];
	$sql	= mysql_query('select a.kdpoly,a.kddokter,a.id,b.NAMADOKTER from m_dokter_jaga a join m_dokter b on b.KDDOKTER = a.kddokter  where a.kdpoly = '.$kdpoly);
#$sql	= mysql_query('select kdpoly,kddokter,NAMADOKTER from m_dokter where kdpoly = '.$kdpoly);
	if(mysql_num_rows($sql) > 0){
			echo '<script>';											
			echo 'jQuery(document).ready(function(){
			jQuery(".hapus").click(function(){
		var id 	= jQuery(this).attr("id");
		var poly= jQuery(this).attr("poly");
		jQuery.post("'._BASE_.'include/ajaxload.php",{id:id,removedokterjaga:true},function(data){
			jQuery("#listdokter_"+poly).load("'._BASE_.'include/ajaxload.php?loaddokterjaga="+poly);
		});						
	});});';
			echo '</script>';
		while($data	= mysql_fetch_array($sql)){
			echo '<div class="namadokter">'.$data['NAMADOKTER'].'</div> <span id="'.$data['id'].'" poly="'.$dpoly['kode'].'" class="hapus text">Hapus</span> <br clear="all">';
		}
	}
}
# HAPUS DOKTER JGA
if($_REQUEST['removedokterjaga'] == true){
	mysql_query('delete from m_dokter_jaga where id = "'.$_REQUEST[id].'"');
}

if($_REQUEST['tindakanlab'] == 'true'){
	include 'connect.php';
	include 'function.php';
	$jenis		= $_REQUEST['cito_status'];
	if($jenis == "c"){
		$faktor = 1.25;
	}else{
		$faktor = 1;
	}
	mysql_query('insert into tmp_orderpenunjang (kode_tindakan,nama_tindakan,qty,tarif,ip,jenis,jasa_sarana,jasa_pelayanan) select a.kode_tindakan, a.nama_tindakan, 1, a.tarif * '.$faktor.',"'.getRealIpAddr().'","'.$jenis.'", a.jasa_sarana * '.$faktor.', a.jasa_pelayanan * '.$faktor.' from m_tarif2012 a where a.kode_tindakan = "'.$_REQUEST['kd_tindakan'].'"');
	
	$sql = mysql_query('select a.id, a.nama_tindakan, a.qty, a.tarif from tmp_orderpenunjang a where a.ip = "'.getRealIpAddr().'"');
	if(mysql_num_rows($sql) > 0){
		$t	= 0;
		?>
        <script>
		jQuery(document).ready(function(){
			jQuery('.remove_tindakan').click(function(){
				var id = jQuery(this).attr('id');
				jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{id:id,removesingle_radiologi:true},function(data){
					jQuery('#listordersss').empty().html(data);
				});
			});
		});
		</script>
        <?php
		echo '<table style="width:100%;">';
		echo '<tr><th>Nama Pemeriksaan</th><th>Qty</th><th>Tarif</th>';
		//if($_SESSION['KDUNIT'] == 17):
			echo '<th>Aksi</th>';
		//endif;
		echo '</tr>';
		while($data = mysql_fetch_array($sql)){
			$t = $t + $data['tarif'];
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.$data['qty'].'</td><td align="right">'.curformat($data['tarif']).'</td>';
			//if($_SESSION['KDUNIT'] == 17):
				echo '<td><span class="remove_tindakan text" style="cursor:pointer;" id="'.$data['id'].'">Batal</span></td>';
			//endif;
			echo '</tr>';													
		}
		echo '<tr><td colspan="2" style="border-top:1px solid #000; text-align:center;">Total</td><td style="border-top:1px solid #000; text-align:right;">'.curformat($t).'</td></tr>';
		echo '</table>';
	}
}

if($_REQUEST['removesingle_radiologi'] == true){
	include 'connect.php';
	include 'function.php';
	mysql_query('DELETE FROM tmp_orderpenunjang where id = "'.$_REQUEST['id'].'" AND ip = "'.getRealIpAddr().'"');
	$sql = mysql_query('select a.id, a.nama_tindakan, a.qty, a.tarif from tmp_orderpenunjang a where a.ip = "'.getRealIpAddr().'"');
	if(mysql_num_rows($sql) > 0){
		$t	= 0;
		?>
        <script>
		jQuery(document).ready(function(){
			jQuery('.remove_tindakan').click(function(){
				var id = jQuery(this).attr('id');
				jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{id:id,removesingle_radiologi:true},function(data){
					jQuery('#listordersss').empty().html(data);
				});
			});
		});
		</script>
        <?php
		echo '<table style="width:100%;">';
		echo '<tr><th>Nama Pemeriksaan</th><th>Qty</th><th>Tarif</th>';
		//if($_SESSION['KDUNIT'] == 17):
			echo '<th>Aksi</th>';
		//endif;
		echo '</tr>';
		while($data = mysql_fetch_array($sql)){
			$t = $t + $data['tarif'];
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.$data['qty'].'</td><td align="right">'.curformat($data['tarif']).'</td>';
			//if($_SESSION['KDUNIT'] == 17):
				echo '<td><span class="remove_tindakan text" style="cursor:pointer;" id="'.$data['id'].'">Batal</span></td>';
			//endif;
			echo '</tr>';													
		}
		echo '<tr><td colspan="2" style="border-top:1px solid #000; text-align:center;">Total</td><td style="border-top:1px solid #000; text-align:right;">'.curformat($t).'</td></tr>';
		echo '</table>';
	}
}

if($_REQUEST['rem_tindakanlab'] == 'true'){
	include 'connect.php';
	include 'function.php';
	$jenis		= $_REQUEST['cito_status'];
	if($jenis == "c"){
		$faktor = 1.25;
	}else{
		$faktor = 1;
	}
	mysql_query('DELETE FROM tmp_orderpenunjang where kode_tindakan = "'.$_REQUEST['kd_tindakan'].'" AND ip = "'.getRealIpAddr().'"');
	$sql = mysql_query('select a.nama_tindakan, a.qty, a.tarif from tmp_orderpenunjang a where a.ip = "'.getRealIpAddr().'"');
	if(mysql_num_rows($sql) > 0){
		$t	= 0;
		echo '<table style="width:100%;">';
		echo '<tr><th>Nama Pemeriksaan</th><th>Qty</th><th>Tarif</th></tr>';
		while($data = mysql_fetch_array($sql)){
			$t = $t + $data['tarif'] * $faktor;
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.$data['qty'].'</td><td align="right">'.curformat($data['tarif'] * $faktor).'</td></tr>';													
		}
		echo '<tr><td colspan="2" style="border-top:1px solid #000; text-align:center;">Total</td><td style="border-top:1px solid #000; text-align:right;">'.curformat($t).'</td></tr>';
		echo '</table>';
	}
}

if($_REQUEST['view_detail_bill'] == 'true'){
	include 'connect.php';
	include 'function.php';
	if($_REQUEST['kode_tarif'] == 07){
		$sql = mysql_query('SELECT a.*,
							CASE SUBSTR(a.kode_obat,1,3) WHEN "07." THEN (SELECT c.nama_tindakan FROM m_tarif2012 c WHERE a.kode_obat = c.kode_tindakan)
							ELSE ( SELECT c.nama_obat FROM m_obat c WHERE a.kode_obat = c.kode_obat ) END AS nama_obat
							FROM t_billobat_rajal a 
						   where a.nobill = "'.$_REQUEST['nobill'].'"');
		if(mysql_num_rows($sql) > 0){
			echo '<table style="width:100%;">';
			echo '<tr><th>Nama Pemeriksaan</th><th style="width:50px;">Qty</th><th style="width:100px;">Tarif</th></tr>';
			while($data = mysql_fetch_array($sql)){
				echo '<tr><td>'.$data['nama_obat'].'</td><td>'.$data['qty'].'</td><td align="right">'.curformat($data['harga']).'</td></tr>';
			}
			echo '</table>';
		}
	}else{
		$sql = mysql_query('select a.*,b.* from t_billrajal a inner join m_tarif2012 b on b.kode_tindakan = a.KODETARIF where a.nobill = "'.$_REQUEST['nobill'].'" and a.KODETARIF not like "07"');
		if(mysql_num_rows($sql) > 0){
			echo '<table style="width:100%;">';
			echo '<tr><th>Nama Pemeriksaan</th><th style="width:50px;">Qty</th><th style="width:100px;">Tarif</th></tr>';
			while($data = mysql_fetch_array($sql)){
				?>
				<tr><td><?php echo $data['nama_tindakan']; ?></td><td><?php echo $data['QTY']; ?></td><td align="right"><?php echo curformat($data['TARIFRS']); ?></td>
				<td> <input type="button" name="Cancel" value="Batal" idxdaftar="<?php echo $data['IDXDAFTAR'];?>" kode=<?php echo $data['kode_tindakan']; ?> id="cancel_<?php echo $data['IDXBILL']; ?>" rel=<?php echo $data['IDXBILL']; ?> svn=<?php echo $data['IDXBILL']; ?> class="text cancel_btn" /></td></td>
				</tr>
				<?php
			}
			echo '</table>';
		}
	}
}
?>
 <script>
		jQuery('.cancel_btn').click(function(){
		var nobill = jQuery(this).attr('svn');
		var nomr		= jQuery('#nomr').val();
		var kode	= jQuery(this).attr('kode');
		var idxdaftar = jQuery(this).attr('idxdaftar');
		//cancel
		alert ('Anda yakin akan membatalkan?');
		jQuery.post('<?php echo _BASE_;?>cartbill_batal_tindakan.php',{nobill:nobill,nomr:nomr,kode:kode,idxdaftar:idxdaftar},function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			w.document.write(jQuery('#tmp_print').html());
			w.print();
			w.close();
			location.reload();
		});
	});
		</script>

<?php

if($_REQUEST['loadkelas'] == 'true'){
	include 'connect.php';
	if($_REQUEST['kode'] == '03.01'){
		$kode_tindakan = '03.01.01';
		$sql	= 'select * from m_tarif2012 where kode_gruptindakan = "'.$kode_tindakan.'" and kelas = "'.$_REQUEST['kelas'].'"';
		$sql	= mysql_query($sql);
		if(mysql_num_rows($sql) > 0){
			echo '<option value=""> Pilih Kelas </option>';
			while($data= mysql_fetch_array($sql)){
				echo '<option value="'.$data['kode_tindakan'].'">'.$data['nama_tindakan'].'</option>';
			}
		}
	}elseif($_REQUEST['kode'] == '03.02'){
		
	}else{
		$sql	= mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$_REQUEST['kode'].'"');
		if(mysql_num_rows($sql) > 0){
			echo '<option value=""> Pilih Kelas </option>';
			while($data= mysql_fetch_array($sql)){
				echo '<option value="'.$data['kode_tindakan'].'">'.$data['nama_tindakan'].'</option>';
			}
		}
	}
}

if($_REQUEST['loadDetailPasien'] == 'true'){
	include 'connect.php';
	$sql	= mysql_query('select * from m_pasien where nomr = "'.$_REQUEST['nomr'].'"');
	$data	= mysql_fetch_row($sql);
	$data	= implode('|',$data);
	echo $data;
}

if($_REQUEST['form_edit_pembayaran'] == 'true'){
	include 'connect.php';
	$sql	= mysql_query('select * from m_carabayar order by ORDERS');
	echo '<select name="carabayar_update[]">';
	while($data	= mysql_fetch_array($sql)){
		if($data['KODE'] == $_REQUEST['old']): $sel = 'selected="selected"'; else: $sel = ''; endif;
		echo '<option value="'.$data['KODE'].'" '.$sel.'>'.$data['NAMA'].'</option>';
	}
	echo '</select>';
}

if($_REQUEST['load_kota'] != ''){
	$kdprov	= $_REQUEST['kdprov'];
	$sql	= mysql_query('select * from m_kota where idprovinsi = "'.$kdprov.'" order by idkota ASC');
	if(mysql_num_rows($sql) > 0){
		echo '<select name="KOTA" class="text required" title="*" id="KOTA"><option value="0"> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				if($_REQUEST['kdkota'] == $data['idkota']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$data['idkota'].'" '.$sel.' > '.$data['namakota'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada kota di provinsi tersebut';
	}
}

if($_REQUEST['load_kecamatan'] != ''){
	$kdkota	= $_REQUEST['kdkota'];
	$sql	= mysql_query('select * from m_kecamatan where idkota = "'.$kdkota.'" order by idkecamatan ASC');
	if(mysql_num_rows($sql) > 0){
		echo '<select name="KDKECAMATAN" class="text required" title="*" id="KDKECAMATAN"><option value="0"> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				echo'<option value="'.$data['idkecamatan'].'">'.$data['namakecamatan'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada kecamatan di kota tersebut';
	}
}

if($_REQUEST['load_kelurahan'] != ''){
	$kdkecamatan	= $_REQUEST['kdkecamatan'];
	$sql	= mysql_query('select * from m_kelurahan where idkecamatan = "'.$kdkecamatan.'" order by idkelurahan ASC');
	if(mysql_num_rows($sql) > 0){
		echo '<select name="KELURAHAN" class="text required" title="*" id="KELURAHAN"><option value="0"> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				echo'<option value="'.$data['idkelurahan'].'">'.$data['namakelurahan'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada kelurahan di kecamatan tersebut';
	}
}

if($_REQUEST['dokterpraktek'] != ''){
	$kdpoly		= $_REQUEST['kdpoly'];
	$kddokter	= $_REQUEST['kddokter'];
	$kddokter2	= $_REQUEST['kddokter2'];
	$sql	= mysql_query('select * from m_dokter_praktek where kdpoly = '.$kdpoly);
	if(mysql_num_rows($sql) > 0){
			$update	= mysql_query('update m_dokter_praktek set kddokter = '.$kddokter.' where kdpoly ='.$kdpoly) or die(mysql_error());
	}else{
			$insert	= mysql_query('insert into m_dokter_praktek set kdpoly ='.$kdpoly.', kddokter = '.$kddokter) or die(mysql_error());
	}
}

if($_REQUEST['add_dokterprak'] != ''){
	$poly	= $_REQUEST['poly'];
	$dokter	= $_REQUEST['dokter'];
	$jadwal	= $_REQUEST['jadwal'];
	$start	= $_REQUEST['start'];
	$end	= $_REQUEST['end'];
	$q	= mysql_query('select * from m_dokter_praktek where KDPOLY = "'.$poly.'" AND KDDOKTER ="'.$dokter.'" AND JADWAL ="'.$jadwal.'"');
	if(mysql_num_rows($q) > 0):
		echo 'error';
	else:
$sql	= mysql_query('insert into m_dokter_praktek set kdpoly = "'.$poly.'", kddokter = "'.$dokter.'", jadwal = "'.$jadwal.'", dari_jam = "'.$start.'", sampai_jam = "'.$end.'"');
	endif;
}

if($_REQUEST['loaddokter'] != ''){
	include 'connect.php';
	$kdpoly	= $_GET['loaddokter'];
	$sql	= mysql_query('select a.kdpoly,a.kddokter,a.id, b.NAMADOKTER from m_dokter_prakter a join m_dokter b on b.KDDOKTER = a.kddokter  where a.kdpoly = '.$kdpoly);
	if(mysql_num_rows($sql) > 0){
			echo '<script>';											
			echo 'jQuery(document).ready(function(){
			jQuery(".hapus").click(function(){
		var id 	= jQuery(this).attr("id");
		var poly= jQuery(this).attr("poly");
		jQuery.post("'._BASE_.'include/ajaxload.php",{id:id,removedokter:true},function(data){
			jQuery("#listdokter_prak"+poly).load("'._BASE_.'include/ajaxload.php?loaddokter="+poly);
		});
	});
	jQuery(".edit").click(function(){
		var id 	= jQuery(this).attr("id");
		var poly= jQuery(this).attr("poly");
		var dokter= jQuery(this).attr("dokter");
		jQuery.post("'._BASE_.'include/ajaxload.php",{id:id,editdokter:true},function(data){
			jQuery("#listdokter_prak"+poly).load("'._BASE_.'include/ajaxload.php?loaddokter="+poly);
		});
	});
	});';
			echo '</script>';
		while($data	= mysql_fetch_array($sql)){
			echo '<div class="namadokter">'.$data['NAMADOKTER'].'</div> <span id="'.$data['id'].'" poly="'.$dpoly['kode'].'" </span><br clear="all">';
		}
	}
}

if($_REQUEST['removedokter'] == true){
	mysql_query('delete from m_dokter_praktek where id = "'.$_REQUEST[id].'"');
}

if($_REQUEST['editdokter'] == true){
//	mysql_query('update m_dokter_praktek set kddokter = '.$kddokter.' where kdpoly ='.$kdpoly) or die(mysql_error());
	//mysql_query('update m_dokter_praktek set id = "'.$_REQUEST[id].'"');
	$kode = $_REQUEST['kode'];
	$poly	= $_REQUEST['poly'];
	$dokter	= $_REQUEST['dokter'];
	$jadwal	= $_REQUEST['jadwal'];
	$start	= $_REQUEST['start'];
	$end	= $_REQUEST['end'];
	$q	= mysql_query('select * from m_dokter_praktek where KDPOLY = "'.$poly.'" AND KDDOKTER ="'.$dokter.'" AND JADWAL ="'.$jadwal.'" and id not in '.$kode);
	if(mysql_num_rows($q) > 0):
		echo 'error';
	else:
$sql	= mysql_query('update m_dokter_praktek set kdpoly = "'.$poly.'", kddokter = "'.$dokter.'", jadwal = "'.$jadwal.'", dari_jam = "'.$start.'", sampai_jam = "'.$end.'" where id = "'.$kode.'"');
	endif;
}

if($_REQUEST['load_diagnosis'] != ''){
	$iddomain	= $_REQUEST['iddomain'];
	$sql	= mysql_query('select * from m_diagnosis_kep where id_domain = "'.$iddomain.'" order by id_diagnosis ASC');
	if(mysql_num_rows($sql) > 0){
		echo '<select name="ID_DIAGNOSIS" class="text required" title="*" id="ID_DIAGNOSIS"><option value="0"> --pilih-- </option>';
			while($data = mysql_fetch_array($sql)){	
				if($_REQUEST['id_diagnosis'] == $data['id_diagnosis']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$data['id_diagnosis'].'" '.$sel.' > '.$data['kode_diagnosis'].' - '.$data['nama_diagnosis'].'</option>';
			}
		echo '</select>';
	}else{
		echo 'Tidak ada diagnosis di domain tersebut';
	}
}

if($_REQUEST['load_sub_var1'] != ''){
	$id_diagnosis	= $_REQUEST['id_diagnosis'];
	$sql	= mysql_query('select * from m_sub_var1_diagnosa_kep where id_diagnosis = "'.$id_diagnosis.'" order by id_sub_var1 ASC');
	if(mysql_num_rows($sql) > 0){
		//$val_1 = split(",",$data['sub_var1']); $i = 0;
		while($ds = mysql_fetch_array($sql)){	
			echo '<input type="checkbox" name="SUB_VAR1[]" value="'.$ds['id_sub_var1'].'" ';
			//if($val_1[$i]==$ds['id_sub_var1']){echo "Checked"; $i++;} 
			echo '> '.$ds['nama_sub_var1'].' <br>';
		}
	}else{
		echo 'Tidak ada daftar gejala - batasan karakteristik di diagnosis tersebut';
	}
}

if($_REQUEST['load_sub_var2'] != ''){
	$id_diagnosis = $_REQUEST['id_diagnosis'];
	$sql	= mysql_query('select * from m_sub_var2_diagnosa_kep where id_diagnosis = "'.$id_diagnosis.'" order by id_sub_var2 ASC');
	if(mysql_num_rows($sql) > 0){
		//$val_2 = split(",",$data['sub_var2']); $i = 0;
		while($ds = mysql_fetch_array($sql)){	
			echo '<input type="checkbox" name="SUB_VAR2[]" value="'.$ds['id_sub_var2'].'" ';
			//if($val_2[$i]==$ds['id_sub_var2']){echo "Checked"; $i++;} 
			echo '> '.$ds['nama_sub_var2'].' <br>';
		}
	}else{
		echo 'Tidak ada daftar etiologi - faktor resiko di diagnosis tersebut';
	}
}

if($_REQUEST['load_sub_var3'] != ''){
	$id_diagnosis = $_REQUEST['id_diagnosis'];
	$sql	= mysql_query('select * from m_sub_var3_diagnosa_kep where id_diagnosis = "'.$id_diagnosis.'" order by id_sub_var3 ASC');
	if(mysql_num_rows($sql) > 0){
		//$val_3 = split(",",$data['sub_var3']); $i = 0;
		while($ds = mysql_fetch_array($sql)){	
			echo '<input type="checkbox" name="SUB_VAR3[]" value="'.$ds['id_sub_var3'].'" ';
			//if($val_3[$i]==$ds['id_sub_var3']){echo "Checked"; $i++;} 
			echo '> '.$ds['nama_sub_var3'].' <br>';
		}
	}else{
		echo 'Tidak ada daftar tujuan - outcome (NOC) di diagnosis tersebut';
	}
}

if($_REQUEST['load_sub_var4'] != ''){
	$id_diagnosis	= $_REQUEST['id_diagnosis'];
	$sql	= mysql_query('select * from m_sub_var4_diagnosa_kep where id_diagnosis = "'.$id_diagnosis.'" order by id_sub_var4 ASC');
	if(mysql_num_rows($sql) > 0){
		//$val_4 = split(",",$data['sub_var4']); $i = 0;
		while($ds = mysql_fetch_array($sql)){	
			echo '<input type="checkbox" name="SUB_VAR4[]" value="'.$ds['id_sub_var4'].'" ';
			//if($val_4[$i]==$ds['id_sub_var4']){echo "Checked"; $i++;} 
			echo '> '.$ds['nama_sub_var4'].' <br>';
		}
	}else{
		echo 'Tidak ada daftar intervensi (NIC) di diagnosis tersebut';
	}
}