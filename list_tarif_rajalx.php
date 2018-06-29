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
		var tarif	= jQuery(this).attr('tarif');
		var disc	= jQuery(this).attr('disc');
		jQuery.post('<?php echo _BASE_;?>cart_ranap_savetmp.php',{kode:kode,dokter:dokter,ruang:ruang,disc:disc,tarif:tarif},function(data){
			jQuery('#cart_tindakan').load('<?php echo _BASE_;?>cart_ranap_loadtmp.php');	
		});
	});
	
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
	
	jQuery('#simpan').click(function(){
		jQuery.post('<?php echo _BASE_;?>radiologi/save_order_rad.php',jQuery('#order_lab').serialize(),function(data){
			if(!data){
				window.location ='<?php echo _BASE_;?>index.php?link=7order';
			}
		});
	});
	
	jQuery('.checkbox_lab').click(function(){
		var loc = jQuery(this).is(':checked');
		if(loc == true){
			var kd_tindakan	= jQuery(this).attr('id');
			jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kd_tindakan:kd_tindakan,tindakanlab:true},function(data){
				jQuery('#listordersss').empty().append(data);
			});
		}else{
			var kd_tindakan	= jQuery(this).attr('id');
			jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kd_tindakan:kd_tindakan,rem_tindakanlab:true},function(data){
				jQuery('#listordersss').empty().append(data);
			});
		}
	});
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
<ul class="tabs">
<?php
$kode	= $_REQUEST['kode'];
$nomr	= $_REQUEST['nomr'];
$kelas	= $_REQUEST['kelas'];
$sql=mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$kode.'"');
$i = 1;
while($data = mysql_fetch_array($sql)){
	echo '<li><span id="#'.$i.'">'.$data['nama_tindakan'].'</span></li>';
	$i++;
}
?>
</ul>
<div class="tab_container">
<?php
$sql2=mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$kode.'"');
	$i = 1;
	while($datas = mysql_fetch_array($sql2)){
			echo '<div id="'.$i.'" class="tab_content">';
			// BERUBAH
				$sql_sub = 'select * from m_tarif2012 where kode_gruptindakan = "'.$datas['kode_tindakan'].'" and kelas ="'.$kelas.'"';
				$sql_sub = mysql_query($sql_sub);
					 if(mysql_num_rows($sql_sub) > 0){
						 echo '<table style="width:100%;"id="filterTab">';
						 echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
						 $x = 0;
						 while($dsub = mysql_fetch_array($sql_sub)){
							 $j	= str_replace('.','_',$dsub['kode_tindakan']);
							 echo '<tr><td>'.$dsub['nama_tindakan'].'</td>';
							 echo '<td>'.curformat($dsub['tarif']).'</td>';
							 echo '<td>';
								 	$sqld	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
									if(mysql_num_rows($sqld) > 0){
										echo '<select name="dokter[]" class="dokter text" id="dokter_'.$j.'">';
										while($d = mysql_fetch_array($sqld)){
											echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
										}
										echo '</select>';
									}
							 echo '</td>';
							 echo '<td><input type="button" name="add" value="add" tarif="'.$dsub['tarif'].'" disc="'.$disc.'" class="text add" id="'.$j.'" nomr="'.$nomr.'"></td>';
							 $x++;
							 echo '</tr>';	 
						 }
						 
						 echo '</table>';
					 }
			echo '</div>';
			$i++;
	}
?>                
</div>