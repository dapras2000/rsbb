<?php session_start();
include 'include/connect.php';
include 'include/function.php';
?>
<html>
<head>
</head>
<style type="text/css">
#popup-windows {font-size:10px; font-family:Verdana,Geneva,sans-serif;}
.popup-table{ border:1px solid #999; border-collapse:0px; border-spacing:0px;}
.popup-table th{background:#069; padding:3px; font-size:11px; color:#FFF; font-weight:bold;}
.popup-table td{padding:3px; font-size:11px;}
.add, .batal, .simpan{cursor:pointer; border:1px solid #000; padding:2px 3px; background:#FF6; font-size:10px;}
.popup-table tr.footer td{border-top:1px solid #666; font-weight:bold;}
.selectbox{ font-size:10px;}
.text { border:1px solid #000; font-size:11px;}
.text:focus { background:#FF6;}
</style>
<body>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jqclock_201.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	jQuery.noConflict();
</script>
<script>
jQuery(document).ready(function(){
	jQuery('.add').click(function(){
		var id 	= jQuery(this).attr('id');
		var nomr= jQuery(this).attr('svn');
		var kode= jQuery(this).attr('kode');
		var poly= jQuery(this).attr('poly');
		var cito	= jQuery('#cito'+id).is(':checked');
		var dokter	= jQuery('#dokter'+id).val();
		if(cito){
			var faktor = "c";
		}else{
			var faktor = "e";
		}
		jQuery.post('<?php echo _BASE_;?>cartbill_save_tmp.php',{id:id,nomr:nomr,kode:kode,poly:poly,dokter:dokter,cito:faktor},function(data){
			jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
		});
	});
	jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
});
</script>
<div id="popup-windows">
<form id="form-popup">
<input type="hidden" name="nomr" id="nomr" value="<?php echo $_REQUEST['nomr'];?>" />
<input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $_REQUEST['idx'];?>" />
<input type="hidden" name="carabayar" id="carabayar" value="<?php echo $_REQUEST['carabayar'];?>" />
<input type="hidden" name="kddokter" id="kddokter" value="<?php echo $_REQUEST['kddokter'];?>" />
<input type="hidden" name="poly" id="poly" value="<?php echo $_REQUEST['poly'];?>" />
<input type="hidden" name="retribusi" id="retribusi" value="<?php echo $_REQUEST['retribusi'];?>" />
<h3><?php echo getNamaPoly($_REQUEST['poly']);?></h3>
<table width="600px" border="0" cellpadding="0" cellspacing="0" class="popup-table" style="float:left;" >
<tr>
    <th style="width:20px;">No</th>
    <th>Jenis Tindakan</th>
    <th>Dokter</th>
    <?php 
	if($_SESSION['KDUNIT'] == 10){
		echo '<th>Cito</th>';
	}
	?>
    <th style="width:120px;">Tarif</th>
    <th style="width:70px;">Pilih</th>
</tr>
<?php
	mysql_query('delete from tmp_cartbayar where IP ="'.getRealIpAddr().'"');
	if($_REQUEST['poly'] != '0'){
		$sql 	= mysql_query('select kode_tindakan, nama_tindakan, tarif 
							  from m_tarif2012 
							  inner join m_ruang on m_ruang.kelas = m_tarif2012.kelas 
							  and m_ruang.nama = "VK" and kode_profesi is null 
							  and kode_unit = "'.$_REQUEST['poly'].'"');
	}else{
		$sql 	= mysql_query('select * from m_tarif2012 where kode_tindakan like "01.02.12.%"'); 	
	}
	if(mysql_num_rows($sql) > 0):
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			if($data['tarif'] > 0){
			$s	='select distinct a.kddokter, b.NAMADOKTER from m_dokter_jaga a join m_dokter b where a.kddokter = b.KDDOKTER and a.kdpoly = "10"';
			$s	= mysql_query($s);
			echo'
			<tr>
				<td style="widtd:20px;">'.$i.'</td>
				<td>'.$data['nama_tindakan'].'</td>
				<td>';
				if(mysql_num_rows($s) > 0){
					echo '<select name="dokter" id="dokter'.str_replace('.','_',$data['kode_tindakan']).'" class="text">';
						while($d = mysql_fetch_array($s)){
							echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
						}
					echo '</select>';
				}
				echo '</td>';
				if($_SESSION['KDUNIT'] == 10){
					echo'<td><input type="checkbox" id="cito'.str_replace('.','_',$data['kode_tindakan']).'" class="cito" ></td>';
				}
				echo '<td style="widtd:120px; text-align:right;">Rp. '.curformat($data['tarif']).'</td>
				<td style="widtd:70px;"><input type="button" value="add" id="'.str_replace('.','_',$data['kode_tindakan']).'" svn="'.$_REQUEST['nomr'].'" kode="'.$data['kode_tindakan'].'" class="add" poly="'.$_REQUEST['poly'].'" dokter="'.$_REQUEST['kddokter'].'"></td>
			</tr>
			';
			}
			$i++;
		}
	else:
		echo 'Tidak ada tindakan poly';
	endif;
?>
</table>
<div id="load_tmp_cartbayar" style="width:340px; float:right;">
</div>
<br clear="all">
</form>
</div>
</body>
</html>