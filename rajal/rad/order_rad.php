<?php
	include("../../include/connect.php");
	include '../../include/function.php';
?>
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
	
	jQuery('#simpan').click(function(){
		
		jQuery.post('<?php echo _BASE_;?>radiologi/save_order_rad.php',jQuery('#order_rad').serialize(),function(data){
			if(!data){
				/*var nomr = document.getElementById("nomr").value;
				var idxdaftar = document.getElementById("idxdaftar").value;
				var x = confirm('Order Pemeriksaan Radiologi Sudah di Prosess.','Warning');
				if(x){
					window.location ='<?php echo _BASE_;?>index.php?link=51&nomr='+nomr+'&menu=3&idx='+idxdaftar;
				}*/
				alert('Order Pemeriksaan Radiologi Sudah di Prosess.');
			}else{
				/*var nomr = document.getElementById("nomr").value;
				var idxdaftar = document.getElementById("idxdaftar").value;
				var x = confirm('Order Pemeriksaan Radiologi Gagal.','Warning');
				if(x){
					window.location ='<?php echo _BASE_;?>index.php?link=51&nomr='+nomr+'&menu=3&idx='+idxdaftar;
				}*/
				alert('Prosess Order Pemeriksaan Radiologi Gagal.')
			}
		});
		
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
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:15px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>

<div align="center" style="width:100%;">
        <div id="frame_title"><h3>FORM ORDER RADIOLOGI</h3></div>
        <div align="right" style="margin:5px;">
			<ul class="tabs">
    	<?php
		$sql=mysql_query('select * from m_tarif2012 where kode_unit= "17"');
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			if(strlen($data['kode_gruptindakan']) == 2):
				echo '<li><span id="#0'.$i.'">'.$data['nama_tindakan'].'</span></li>';
				$i++;
			endif;
		}
		?>
    	</ul>
        	<form id="order_rad">
        <?php
		
		$sql_pendafataran	= mysql_query('SELECT * FROM t_pendaftaran WHERE NOMR = '.$_REQUEST['nomr'].' AND IDXDAFTAR = '.$_REQUEST['idx']);
		$daftar	= mysql_fetch_array($sql_pendafataran);
		$poly_ruang = $daftar['KDPOLY'];
		$nott	= '';
        ?>
        <input type="hidden" name="ruang" value="<?php echo $poly_ruang; ?>" />
        <input type="hidden" name="nott" value="<?php echo $nott; ?>" />
        <input type="hidden" name="aps" value="0" />
        <input type="hidden" name="nomr"  id="nomr" value="<?php echo $_REQUEST['nomr']; ?>" />
        <input type="hidden" name="idxdaftar" id="idxdaftar" value="<?php echo $_REQUEST['idx']; ?>" />
        <input type="hidden" name="kddokter" value="<?php echo $daftar['KDDOKTER']; ?>" />
        <input type="hidden" name="unit" value="<?php echo $_SESSION['KDUNIT']; ?>" />
        <input type="hidden" name="carabayar" value="<?php echo $daftar['KDCARABAYAR']; ?>" />
        <input type="hidden" name="rajal_status" value="1" />
    	<div class="tab_container">
    	<?php
		$sql2=mysql_query('select * from m_tarif2012 where kode_unit= "17"');
			$i = 1;
			while($datas = mysql_fetch_array($sql2)){	
				if(strlen($datas['kode_gruptindakan']) == 2):
        			echo '<div id="0'.$i.'" class="tab_content">';
						$sql_sub = mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$datas['kode_tindakan'].'"');
							 if(mysql_num_rows($sql_sub) > 0){
								 echo '<table style="width:100%;">';
								 echo '<tr>';
								 $x = 0;
								 while($dsub = mysql_fetch_array($sql_sub)){
									 if($x == 2){
										 echo '</tr><tr>';
										 $x = 0;
									 }
									 $last = checkLastLevel($dsub['kode_tindakan']);
									 if($last > 0){
										$ll = getLastLevel($dsub['kode_tindakan']);
										while($dll = mysql_fetch_array($ll)){
											if($x == 2){
												 echo '</tr><tr>';
												 $x = 0;
											 }
											echo '<td style="width:20%;"><input type="checkbox" name="checkbox[]" value="'.$dll['kode_tindakan'].'" id="'.$dll['kode_tindakan'].'" class="checkbox_lab"> '.$dll['nama_tindakan'].'</td>';	 
											$x++;
										}
									 }else{
										echo '<td style="width:20%;"><input type="checkbox" name="checkbox[]" value="'.$dsub['kode_tindakan'].'" id="'.$dsub['kode_tindakan'].'" class="checkbox_lab"> '.$dsub['nama_tindakan'].'</td>';	 
										$x++;
									 }
								 }
								 echo '</tr>';
								 echo '</table>';
							 }
					echo '</div>';
					$i++;
				endif;
			}
		?>
    	</div>
    	<br clear="all" />
    	<input type="button" name="simpan" value="S I M P A N" id="simpan" class="text" />
    	</form>
		</div>
	<br clear="all" />
</div>