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
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("span").attr("id"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	jQuery('.add').click(function(){
		var id 	= jQuery(this).attr('id');
		var nomr= jQuery(this).attr('svn');
		var kode= jQuery(this).attr('kode');
		var poly= jQuery(this).attr('poly');
		var dokter	= jQuery('#dokter'+id).val();
		jQuery.post('<?php echo _BASE_;?>cartbill_save_tmp.php',{id:id,nomr:nomr,kode:kode,poly:poly,dokter:dokter},function(data){
			jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
		});
	});
	jQuery('#load_tmp_cartbayar').load('<?php echo _BASE_;?>tmp_cartbayar.php');
});
</script>
<style type="text/css">
ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs li a:hover {background: #ccc;}	
html ul.tabs li.active, html ul.tabs li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:60px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>
<div id="popup-windows">
<form id="form-popup">
<input type="hidden" name="aps" id="aps" value="<?php echo $_REQUEST['aps'];?>" />
<input type="hidden" name="nomr" id="nomr" value="<?php echo $_REQUEST['nomr'];?>" />
<input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $_REQUEST['idx'];?>" />
<input type="hidden" name="carabayar" id="carabayar" value="<?php echo $_REQUEST['carabayar'];?>" />
<input type="hidden" name="poly" id="poly" value="<?php echo $_REQUEST['poly'];?>" />
<input type="hidden" name="retribusi" id="retribusi" value="<?php echo $_REQUEST['retribusi'];?>" />
<h3>
<?php 
if($_REQUEST['poly'] == 18){
	echo 'Daftar Tindakan Poliklinik Gizi';
}else{
	echo getNamaPoly($_REQUEST['poly']); 
}

?>
</h3>
<?php
	mysql_query('delete from tmp_cartbayar where IP ="'.getRealIpAddr().'"');
	if($_REQUEST['poly'] == 0){
		$sql 	= mysql_query('select * from m_tarif2012 where kode_tindakan like "01.02.12.%"');
		$kdunit	= '0';
	}elseif($_REQUEST['poly'] == 9){
		$group	= $_REQUEST['group'];
		$tabs	= 0;
		if($group == '02.04'){
			$sql	= ('SELECT * FROM m_tarif2012 WHERE kode_unit ='.$_REQUEST['poly'].' AND kode_gruptindakan LIKE "'.$group.'"');
			$tabs	= 1;
		}else{
			$sql	= ('SELECT * FROM m_tarif2012 WHERE kode_unit ='.$_REQUEST['poly'].' AND kode_tindakan LIKE "'.$group.'%"');
		}
		$sql	= mysql_query($sql);
		$kdunit	= $_REQUEST['poly'];
	}elseif($_REQUEST['poly'] == 18){
		//print_r($_REQUEST);
		$sql	= mysql_query('SELECT * FROM m_tarif2012 WHERE kode_unit ='.$_REQUEST['poly'].' AND kode_tindakan LIKE "01.01.18.%"');
	}else{
		$sql 	= mysql_query('select * from m_tarif2012 where kode_unit ='.$_REQUEST['poly'].' and kode_tindakan like "01.02.%"');
		$kdunit	= $_REQUEST['poly'];
	}
	if($tabs == 0){
		?>
        <table width="600px" border="0" cellpadding="0" cellspacing="0" class="popup-table" style="float:left;" >
        <tr>
            <th style="width:20px;">No</th>
            <th>Jenis Tindakan</th>
            <th>Dokter</th>
            <th style="width:120px;">Tarif</th>
            <th style="width:70px;">Pilih</th>
        </tr>
        <?php
		if(mysql_num_rows($sql) > 0):
			$i = 1;
			while($data = mysql_fetch_array($sql)){
				echo'
				<tr>
					<td style="widtd:20px;">'.$i.'</td>
					<td>'.$data['nama_tindakan'].'</td>
					<td>';
					$s	='select distinct a.kddokter, b.NAMADOKTER from m_dokter_jaga a join m_dokter b where a.kddokter = b.KDDOKTER ';
					// and a.kdpoly = "'.$kdunit.'"
					$s	= mysql_query($s);
					if(mysql_num_rows($s) > 0){
						echo '<select name="dokter" id="dokter'.str_replace('.','_',$data['kode_tindakan']).'" class="text">';
							while($d = mysql_fetch_array($s)){
								echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
							}
						echo '</select>';
					}
					echo'</td><td style="widtd:120px; text-align:right;">Rp. '.curformat($data['tarif']).'</td>
					<td style="widtd:70px;"><input type="button" value="add" id="'.str_replace('.','_',$data['kode_tindakan']).'" svn="'.$_REQUEST['nomr'].'" kode="'.$data['kode_tindakan'].'" class="add" poly="'.$_REQUEST['poly'].'"></td>
				</tr>
				';
				$i++;
			}
			?></table><?php
		else:
			echo 'Tidak ada tindakan poly';
		endif;
	}else{
		echo '<div style="float:left; width:600px;">';
		echo '<ul class="tabs">';
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			echo '<li><span id="#'.$i.'">'.$data['nama_tindakan'].'</span></li>';
			$i++;
		}
		echo '</ul>';
		echo '<div class="tab_container">';
		$sql2=mysql_query('SELECT * FROM m_tarif2012 WHERE kode_unit ='.$_REQUEST['poly'].' AND kode_gruptindakan LIKE "'.$group.'"');
		$i = 1;
		while($datas = mysql_fetch_array($sql2)){
				echo '<div id="'.$i.'" class="tab_content">';
					$sql_sub = 'select * from m_tarif2012 where kode_gruptindakan = "'.$datas['kode_tindakan'].'"';
					$sql_sub = mysql_query($sql_sub);
						 if(mysql_num_rows($sql_sub) > 0){
							 echo '<table style="width:590px;" border="0" cellpadding="0" cellspacing="0" class="popup-table" >';
							 echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
							 $x = 0;
							 while($dsub = mysql_fetch_array($sql_sub)){
								 $j	= str_replace('.','_',$dsub['kode_tindakan']);
								 echo '<tr><td>'.$dsub['nama_tindakan'].'</td>';
								 echo '<td>'.curformat($dsub['tarif']).'</td>';
								 echo '<td>';
										$sqld	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
										if(mysql_num_rows($sqld) > 0){
											echo '<select name="dokter[]" class="dokter text" id="dokter'.$j.'">';
											while($d = mysql_fetch_array($sqld)){
												echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
											}
											echo '</select>';
										}
								 echo '</td>';
								 echo '<td><input type="button" value="add" id="'.str_replace('.','_',$dsub['kode_tindakan']).'" svn="'.$_REQUEST['nomr'].'" kode="'.$dsub['kode_tindakan'].'" class="add" poly="'.$_REQUEST['poly'].'"></td>';
								 $x++;
								 echo '</tr>';	 
							 }
							 
							 echo '</table>';
						 }
				echo '</div>';
				$i++;
		}
		echo '</div>';
		echo '</div>';
	}
?>

<div id="load_tmp_cartbayar" style="width:340px; float:right;">
</div>
<br clear="all">
</form>
</div>
</body>
</html>