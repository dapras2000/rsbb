<p>
  <?  include("../../include/connect.php");
	  $sql_lab = "SELECT t_orderlab.IDXORDERLAB,  
		  t_orderlab.KODE,
		  t_orderlab.HASIL_PERIKSA,
		  t_orderlab.NOMR,
		  t_orderlab.IDXDAFTAR,
		  t_orderlab.KETERANGAN,
		  t_orderlab.TGL_MULAI,
		  t_orderlab.TGL_SELESAI,
		  m_lab.nama_jasa,
		  t_orderlab.nilai_normal,
		  m_lab.unit
		FROM
		  t_orderlab
		INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
		WHERE  t_orderlab.IDXDAFTAR = ".$_GET['idx'];
	$get_lab = mysql_query($sql_lab);
	if(mysql_num_rows($get_lab)> 0){
	?>
	<table class="tb" width="95%">
		<tr><th>No</th><th width="20%">Pemeriksaan Lab</th><th width="30%">Hasil</th><th>Nilai Normal</th><th>Unit</th><th>&nbsp;</th></tr>
		<?php 
		$xc=1; 
		while($data_lab=mysql_fetch_array($get_lab)){
			echo '<tr><td>'.$xc.'</td> <td>'.$data_lab['nama_jasa'].'</td><td>'.$data_lab['HASIL_PERIKSA'].'</td><td>'.$data_lab['nilai_normal'].'</td><td>'.$data_lab['unit'].'</td><td><a href="rajal/lab/del_orderlab.php?link=51&nomr='.$_GET['nomr'].'&menu=3&idx='.$_GET['idx'].'&idxorder='.$data_lab['IDXORDERLAB'].'" class="text">BATAL</a></td></tr>';
			$xc++;
	  	}
	}
	?>
     </table>
</p>


<p>Paket Laboratorium &nbsp;</p>
<p>
  <div id="paketlab" >
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
			var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			jQuery(activeTab).fadeIn(); //Fade in the active content
			return false;
		});
	});
	
	</script>
    <style type="text/css">
ul.tabs {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs li {float: left;margin: 0;padding: 0;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs li a:hover {background: #ccc;}	
html ul.tabs li.active, html ul.tabs li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container {
	border: 1px solid #999;
	border-top: none;
	clear: both;
	float: left; 
	width: 100%;
	background: #fff;
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>
	<ul class="tabs">
    	<?php
		$sql=mysql_query('select * from m_tarifpenunjang_medis where kode_unit= "16"');
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			
			if(strlen($data['kode_gruptindakan']) == 5):
				echo '<li><a href="#'.$i.'">'.$data['nama_tindakan'].'</a></li>';
				$i++;
			endif;
		}
		?>
    </ul>
    
    <div class="tab_container">
    	<?php
		$sql2=mysql_query('select * from m_tarifpenunjang_medis where kode_unit= "16"');
			$i = 1;
			while($datas = mysql_fetch_array($sql2)){	
				if(strlen($datas['kode_gruptindakan']) == 5):
        			echo '<div id="'.$i.'" class="tab_content">';
						$sql_sub = mysql_query('select * from m_tarifpenunjang_medis where kode_gruptindakan = "'.$datas['kode_tindakan'].'"');
							 if(mysql_num_rows($sql_sub) > 0){
								 while($dsub = mysql_fetch_array($sql_sub)){
									 echo '<input type="checkbox" name="checkbox[]" value="'.$dsub['kode_tindakan'].'" id="'.$dsub['kode_tindakan'].'" class="checkbox_lab"> '.$dsub['nama_tindakan'].'<br>';
								 }
							 }
							 echo $datas['kode_tindakan'];
					echo '</div>';
					$i++;
				endif;
			}
		?>
    </div>
  	<?php
	/*
	
		
		echo '<div class="tab_container">';
				
							 
						echo '</div>';
					endif;
				}
		echo '</div>';
	*/
	?>
    <br clear="all" />
    <br clear="all" />
    <br clear="all" />
  </div>
</p>
