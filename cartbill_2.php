<?php
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
body{background-color:#666; background:url("img/bg_container_master.png") repeat-x scroll 0 0 transparent;}
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
		jQuery.post('<?php echo _BASE_;?>cartbill_save_tmp.php',{id:id,nomr:nomr,kode:kode},function(data){
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
<input type="hidden" name="poly" id="poly" value="<?php echo $_REQUEST['poly'];?>" />
<input type="hidden" name="retribusi" id="retribusi" value="<?php echo $_REQUEST['retribusi'];?>" />
<table width="600px" border="0" cellpadding="0" cellspacing="0" class="popup-table" style="float:left;" >
<tr>
    <th style="width:20px;">No</th>
    <th>Jenis Tindakan</th>
    <th>Dokter</th>
    <th style="width:120px;">Tarif</th>
    <th style="width:70px;">Pilih</th>
</tr>
<?php
	mysql_query('delete from tmp_cartbayar where IP ="'.getRealIpAddr().'"');
	$dokter	= mysql_query('select * from m_dokter where KDPOLY = '.$_REQUEST['poly']);
	#$sql	= 'SELECT * FROM m_tarif WHERE group_jasa LIKE "'.$_REQUEST['retribusi'].'%" ORDER BY kode ASC, ORDER BY kode_jasa asc';
	$t		= 'tarif';
	$sql	= 'SELECT nama_jasa,'.$t.' as harga,id,kode FROM m_tarif WHERE group_jasa LIKE "'.$_REQUEST['retribusi'].'%" and parentid = 0 order by kode asc';
    $result = mysql_query($sql);
	$i 		= 1;
    while ($data = mysql_fetch_array($result)){
		// CEK PARENT ID LEVEL 2
		$sql_2	= 'SELECT nama_jasa,'.$t.' as harga,id,kode FROM m_tarif WHERE group_jasa LIKE "'.$_REQUEST['retribusi'].'%" and parentid = '.$data['id'].' order by kode asc';
		$result_2 = mysql_query($sql_2);
		if(mysql_num_rows($result_2) > 0):
			echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td colspan="4"><strong>'.$data['nama_jasa'].'</strong></td>';
			echo '</tr>';	
			while ($data_2 = mysql_fetch_array($result_2)){
				$sql_3	= 'SELECT nama_jasa,'.$t.' as harga,id,kode FROM m_tarif WHERE group_jasa LIKE "'.$_REQUEST['retribusi'].'%" and parentid = '.$data_2['id'].' order by kode asc';
				$result_3 = mysql_query($sql_3);
				if(mysql_num_rows($result_3) > 0):
					echo '<tr>';
						echo '<td></td>';
						echo '<td colspan="4">&nbsp;&nbsp;<strong>'.$data_2['nama_jasa'].'</strong></td>';
					echo '</tr>';
					while ($data_3 = mysql_fetch_array($result_3)){
						$dokter	= mysql_query('select * from m_dokter where KDPOLY = '.$_REQUEST['poly']);
						echo '<tr>';
							echo '<td></td>';
							echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.$data_3['nama_jasa'].'</td>';
							echo '<td>';
								echo '<select name="dokter" id="dokter_'.$data_3['kode'].'" class="selectbox">';
								while ($s_dok = mysql_fetch_array($dokter)){
									echo '<option value="'.$s_dok['KDDOKTER'].'">'.$s_dok['NAMADOKTER'].'</option>';
								}
								echo '</select>';
							echo '</td>';
							#echo '<td></td>';
							echo '<td style="text-align:right;">'.curformat($data_3['harga'],2).'</td>';
							echo '<td style="text-align:center;"><span class="add" id="'.$data_3['id'].'" svn="'.$_REQUEST['nomr'].'" kode="'.$data_3['kode'].'"> ADD </span></td>';
						echo '</tr>';
					}
				else:
					$dokter	= mysql_query('select * from m_dokter where KDPOLY = '.$_REQUEST['poly']);
					echo '<tr>';
						echo '<td></td>';
						echo '<td>&nbsp;&nbsp;'.$data_2['nama_jasa'].'</td>';
						#echo '<td></td>';
						echo '<td>';
								echo '<select name="dokter" id="dokter_'.$data_2['kode'].'" class="selectbox">';
								while ($s_dok = mysql_fetch_array($dokter)){
									echo '<option value="'.$s_dok['KDDOKTER'].'">'.$s_dok['NAMADOKTER'].'</option>';
								}
								echo '</select>';
							echo '</td>';
						echo '<td style="text-align:right;">'.curformat($data_2['harga'],2).'</td>';
						echo '<td style="text-align:center;"><span class="add" id="'.$data_2['id'].'" svn="'.$_REQUEST['nomr'].'" kode="'.$data_2['kode'].'"> ADD </span></td>';
					echo '</tr>';
				endif;
			}
		else:
			$dokter	= mysql_query('select * from m_dokter where KDPOLY = '.$_REQUEST['poly']);
			echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.$data['nama_jasa'].'</td>';
				#echo '<td></td>';
				echo '<td>';
					echo '<select name="dokter" id="dokter_'.$data['kode'].'" class="selectbox">';
					while ($s_dok = mysql_fetch_array($dokter)){
						echo '<option value="'.$s_dok['KDDOKTER'].'">'.$s_dok['NAMADOKTER'].'</option>';
					}
					echo '</select>';
				echo '</td>';
				echo '<td style="text-align:right;">'.curformat($data['harga'],2).'</td>';
				echo '<td style="text-align:center;"><span class="add" id="'.$data['id'].'" svn="'.$_REQUEST['nomr'].'" kode="'.$data['kode'].'"> ADD </span></td>';
			echo '</tr>';	
		endif;
		$i++;
	}
?>
</table>
<div id="load_tmp_cartbayar" style="width:340px; float:right;">
</div>
<br clear="all">
</form>
</div>
</body>
</html>