<?php
include 'include/connect.php';
include 'include/function.php';
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
	
	jQuery('.add').click(function(){
		var kode 	= jQuery(this).attr('id');
		var dokter	= jQuery('#dokter_'+kode).val();
		var ruang	= jQuery('#noruang').val();
		var tarif	= jQuery(this).attr('tarif');
		var disc	= jQuery(this).attr('disc');
		var adm		= jQuery(this).attr('adm');
		var nomr	= jQuery(this).attr('nomr');
		jQuery.post('<?php echo _BASE_;?>cart_ranap_savetmp.php',{kode:kode,dokter:dokter,ruang:ruang,disc:disc,adm:adm,tarif:tarif,nomr:nomr},function(data){
			jQuery('#cart_tindakan').load('<?php echo _BASE_;?>cart_ranap_loadtmp.php');	
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
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:30px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>

<?php
$kode	= $_REQUEST['kode'];
$nomr	= $_REQUEST['nomr'];
#echo $nomr;
if($kode == '03.01'){
	$kode_tindakan 	= '03.01.01'; 
	$kelas			= $_REQUEST['kelas'];
	$sql	= 'select * from m_tarif2012 where kode_gruptindakan = "'.$kode_tindakan.'" and kelas = "'.$kelas.'"';
	$sql	= mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		echo '<table width="100%" id="filterTab">';
		echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
		while($data=mysql_fetch_array($sql)){
			$j	= str_replace('.','_',$data['kode_tindakan']);
			$trif = $data['tarif'];
			$adm = 0;
			if($kelas == 'P3'){
				$sql_check	= 'SELECT a.PARENT_NOMR, b.noruang, c.nama, b.nott, c.kelas
				FROM m_pasien a 
				JOIN t_admission b ON b.nomr = a.PARENT_NOMR
				JOIN m_ruang c ON c.no = b.noruang
				WHERE a.NOMR = "'.$nomr.'"';
				#$ssql	= 'SELECT a.nomr, a.noruang, r.kelas, t.tarif
				#FROM t_admission a 
				#JOIN m_ruang r ON r.no = a.noruang
				#JOIN m_tarif2012 t ON t.kelas = r.kelas
				#WHERE a.nomr = "'.$nomr.'" AND t.kode_gruptindakan = "03.01.01" and a.keluarrs is null';
				$sqlparent = mysql_query($sql_check);
				if(mysql_num_rows($sqlparent) > 0){
					$trif 		= $data['tarif'] * 0.5;
					$disc		= $data['tarif'] - $trif;
				}else{
					echo 'Orang Tua Pasien Tidak Terdaftar';
					$trif = $data['tarif'];
				}
			}
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.curformat($trif).'</td><td>';
			$sqld	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
			if(mysql_num_rows($sqld) > 0){
				echo '<select name="dokter[]" class="dokter text" id="dokter_'.$j.'">';
				while($d = mysql_fetch_array($sqld)){
					echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
				}
				echo '</select>';
			}
			echo '</td><td><input type="button" name="add" value="add" tarif="'.$data['tarif'].'" disc="'.$disc.'" adm="'.$adm.'" class="text add" id="'.$j.'" nomr="'.$nomr.'"></td></tr>';
		}
		echo '</table>';
	}
}elseif($kode == '03.02'){
	$kode_tindakan 	= '03.02.01'; 
	$kelas			= $_REQUEST['kelas'];
	$profesi		= getProfesiDoktor($_REQUEST['dokter']);
	#$sql	= 'select * from m_tarif2012 where kode_gruptindakan = "'.$kode_tindakan.'" and kelas = "'.$kelas.'" and kode_profesi = "'.$profesi.'"';
	$sql	= 'select * from m_tarif2012 where kode_gruptindakan = "'.$kode_tindakan.'" and kelas = "'.$kelas.'"';
	$sql	= mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		echo '<table width="100%" id="filterTab">';
		echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
		while($data=mysql_fetch_array($sql)){
			$j	= str_replace('.','_',$data['kode_tindakan']);
			#$adm=$data['tarif']*0.05;
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.curformat($data['tarif']).'</td><td>';
			#$sqld	= mysql_query('select a.*, b.NAMADOKTER from m_dokter_pengganti a join m_dokter b on b.KDDOKTER = a.kddokter');
			$sqld	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter where KDPROFESI = "'.$data['kode_profesi'].'" GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
			if(mysql_num_rows($sqld) > 0){
				echo '<select name="dokter[]" class="dokter text" id="dokter_'.$j.'">';
				while($d = mysql_fetch_array($sqld)){
					if($_REQUEST['dokter'] == $d['kddokter']): $sel = 'selected = "selected"'; else: $sel = ''; endif;
					echo '<option value="'.$d['kddokter'].'" '.$sel.'>'.$d['NAMADOKTER'].'</option>';
				}
				echo '</select>';
			}
			echo '</td><td><input type="button" name="add" value="add" tarif="'.$data['tarif'].'" disc="0" adm="'.$adm.'" class="text add" id="'.$j.'" nomr="'.$nomr.'"></td></tr>';
		}
		echo '</table>';
	}
}elseif($kode == '03.03'){
	$kelas			= $_REQUEST['kelas'];
	$kode_tindakan	= '03.03.01';
	$profesi		= getProfesiDoktor($_REQUEST['dokter']);
	$sql			= 'select * from m_tarif2012 where kode_gruptindakan = "'.$kode_tindakan.'" and kelas = "'.$kelas.'"';
	$sql			= mysql_query($sql);
	if(mysql_num_rows($sql) > 0){
		echo '<table width="100%" id="filterTab">';
		echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
		while($data=mysql_fetch_array($sql)){
			$j	= str_replace('.','_',$data['kode_tindakan']);
			$adm=0;
			echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.curformat($data['tarif']).'</td><td>';
			#$sqld	= mysql_query('select a.*, b.NAMADOKTER from m_dokter_pengganti a join m_dokter b on b.KDDOKTER = a.kddokter');
			$sqld	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
			if(mysql_num_rows($sqld) > 0){
				echo '<select name="dokter[]" class="dokter text" id="dokter_'.$j.'">';
				while($d = mysql_fetch_array($sqld)){
					echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
				}
				echo '</select>';
			}
			echo '</td><td><input type="button" name="add" value="add" tarif="'.$data['tarif'].'" disc="0" adm="'.$adm.'" class="text add" id="'.$j.'" nomr="'.$nomr.'"></td></tr>';
		}
		echo '</table>';
	}
	
}elseif($kode == '03.05'){
	$kelas			= $_REQUEST['kelas'];
	echo '<ul class="tabs">';
    $sql=mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$kode.'"');
    $i = 1;
    while($data = mysql_fetch_array($sql)){
	$adm=0;
        echo '<li><span id="#'.$i.'">'.$data['nama_tindakan'].'</span></li>';
        $i++;
    }
    echo '</ul>';
	
	echo '<div class="tab_container">';
	$sql2=mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$kode.'"');
	$i = 1;
	while($datas = mysql_fetch_array($sql2)){
		echo '<div id="'.$i.'" class="tab_content">';
			$sql = 'select * from m_tarif2012 where kode_gruptindakan = "'.$datas['kode_tindakan'].'" and kelas = "'.$kelas.'"';
			$sql = mysql_query($sql);
			if(mysql_num_rows($sql) > 0){
			
				echo '<table width="100%" id="filterTab">';
				echo '<tr><th>Nama Tindakan</th><th>Tarif</th><th>Dokter</th><th>Aksi</th></tr>';
				while($data=mysql_fetch_array($sql)){
				$adm=0;
					$j	= str_replace('.','_',$data['kode_tindakan']);
					echo '<tr><td>'.$data['nama_tindakan'].'</td><td>'.curformat($data['tarif']).'</td><td>';
		
					$sqld	= mysql_query('SELECT DISTINCT NAMADOKTER, KDDOKTER as kddokter FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC');
					if(mysql_num_rows($sqld) > 0){
						echo '<select name="dokter[]" class="dokter text" id="dokter_'.$j.'">';
						while($d = mysql_fetch_array($sqld)){
							echo '<option value="'.$d['kddokter'].'">'.$d['NAMADOKTER'].'</option>';
						}
						echo '</select>';
					}
					echo '</td><td><input type="button" name="add" value="add" tarif="'.$data['tarif'].'" disc="0" adm="'.$adm.'" class="text add" id="'.$j.'" nomr="'.$nomr.'"></td></tr>';
				}
				echo '</table>';
			}
		echo '</div>';
		$i++;
	}
	echo '</div>';
}
?>