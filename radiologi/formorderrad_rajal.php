<?php 
include("../include/connect.php");
include '../include/function.php';?>
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
		jQuery.post('<?php echo _BASE_;?>radiologi/save_order_rad.php',jQuery('#order_lab').serialize(),function(data){
			if(!data){
				window.location ='<?php echo _BASE_;?>index.php?link=7order';
			}
		});
	});
	
	jQuery('.checkbox_lab').click(function(){
		var loc = jQuery(this).is(':checked');
		var dokter = jQuery('#kddokter_hidden').val();
		if(dokter == ''){
			alert('Dokter Belum di pilih');
			return false;
		}
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
	jQuery('.addtindakan').click(function(){
		var kd_tindakan	= jQuery(this).attr('id');
		var dokter = jQuery('#kddokter_hidden').val();
		if(dokter == ''){
			alert('Dokter Belum di pilih');
			return false;
		}
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kd_tindakan:kd_tindakan,tindakanlab:true},function(data){
				jQuery('#listordersss').empty().html(data);
			});
	});
	
	jQuery('#simpan_dokter').click(function(){
		var dokter 	 = jQuery('#dokter_list').val();
		var nmdokter = jQuery('#dokter_list option[value="'+dokter+'"]').text();
		jQuery('#kddokter_hidden').val(dokter);
		jQuery('#dokter_list').css('display','none');
		jQuery('#simpan_dokter').css('display','none');
		jQuery('#text_set_dokter').text(nmdokter);
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
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>
<div align="center" style="width:390px; float:left; margin-right:10px;">
	<div id="frame" style="width:100%;">
		<div id="frame_title"><h3>DATA PASIEN RADIOLOGI</h3></div>
		<div align="right" style="margin:5px;">
        	<?php
			mysql_query('delete from tmp_orderpenunjang where ip = "'.getRealIpAddr().'"');
			mysql_query('delete from tmp_cartbayar where ip = "'.getRealIpAddr().'"');
			$sql = 'SELECT a.IDXDAFTAR, a.TGLREG as tgl, a.NOMR, a.KDPOLY, a.KDDOKTER, a.KDCARABAYAR, b.NAMA, b.ALAMAT, b.TGLLAHIR, b.JENISKELAMIN, c.nama AS poly, d.NAMADOKTER AS dokter, e.NAMA AS carabayar
FROM t_pendaftaran a
JOIN m_pasien b ON b.NOMR = a.NOMR
JOIN m_poly c ON c.kode = a.KDPOLY
JOIN m_dokter d ON d.KDDOKTER = a.KDDOKTER
JOIN m_carabayar e ON e.KODE = a.KDCARABAYAR
where a.NOMR = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR = "'.$_REQUEST['idx'].'"';

			$sql	= mysql_query($sql);				   
			$d	 = mysql_fetch_array($sql);
			?>
			<table width="100%" border="0" cellspacing="0" class="tb">
			<tr><td width="100px;">No RM</td><td ><?php echo $d['NOMR']; ?></td></tr>
			<tr><td>Nama</td><td><?php echo $d['NAMA']; ?></td></tr>
            <tr><td>Alamat</td><td><?php echo $d['ALAMAT']; ?></td></tr>
            <tr><td>Tanggal Lahir</td><td><?php echo $d['TGLLAHIR']; ?></td></tr>
            <tr><td>Umur</td><td><?php
             $a = datediff($d['TGLLAHIR'],date('Y-m-d'));
		  echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td></tr>
            <tr><td>Jenis Kelamin</td><td><?php echo jeniskelamin($d['JENISKELAMIN']); ?></td></tr>
			<tr><td>Tanggal Daftar</td><td><?php echo $d['tgl'];?></td></tr>
            <tr><td>Poly / Dokter</td><td><?php echo $d['poly'].' / '.$d['dokter'];?></td></tr>
            <tr><td>Dokter</td><td><span id="text_set_dokter"></span>
            <select name="dokter_list" id="dokter_list" class="text">
            	<?php
				$sql_dokter = mysql_query('SELECT a.*, b.NAMADOKTER AS dokter
FROM m_dokter_jaga a
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = '.$d['KDPOLY']);
				while($da = mysql_fetch_array($sql_dokter)){
					if($d['KDDOKTER'] == $da['kddokter']): $sel = 'selected="selected"'; else: $sel = ''; endif;
            		echo '<option value="'.$da['kddokter'].'" '.$sel.'>'.$da['dokter'].'</option>';
				}
				?>
            </select>&nbsp;&nbsp;<input type="button" name="simpan_dokter" value="Set Dokter" id="simpan_dokter" class="text" />
            </td></tr>
            </table>
            <br clear="all" />
            <div id="listordersss"></div>
        </div>
	</div>
</div>
<div align="center" style="width:590px; float:left;">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>FORM ORDER RADIOLOGI</h3></div>
        <div align="right" style="margin:5px;">
			<ul class="tabs">
    	<?php
		$sql=mysql_query('select * from m_tarif2012 where kode_unit= "17"');
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			if(strlen($data['kode_gruptindakan']) == 2):
				echo '<li><span id="#'.$i.'">'.$data['nama_tindakan'].'</span></li>';
				$i++;
			endif;
		}
		?>
    	</ul>
        	<form id="order_lab">
        <?php
		$poly_ruang = '';
        $sql_rajal	= mysql_query('select * from tmp_cartorderlab where NOMR = "'.$_REQUEST['nomr'].'" and IDXDAFTAR = "'.$_REQUEST['idx'].'"');
        $ddaftar	= mysql_fetch_array($sql_rajal);
		if($ddaftar['RAJAL'] == 0){
			$sql = mysql_query('select * from t_admission where nomr = "'.$_REQUEST['nomr'].'" and id_admission = "'.$_REQUEST['idx'].'"');
			$dsql = mysql_fetch_array($sql);
			$poly_ruang = $dsql['noruang'];
		}
        ?>
        <input type="hidden" name="ruang" value="<?php echo $d['noruang']; ?>" />
        <input type="hidden" name="nott" value="<?php echo $d['nott']; ?>" />
        <input type="hidden" name="kddokter" id="kddokter_hidden" />
        <input type="hidden" name="aps" value="0" />
        <input type="hidden" name="nomr" value="<?php echo $_REQUEST['nomr']; ?>" />
        <input type="hidden" name="idxdaftar" value="<?php echo $_REQUEST['idx']; ?>" />
        <input type="hidden" name="unit" value="<?php echo $d['KDPOLY'];?>" />
        <input type="hidden" name="carabayar" value="<?php echo $d['KDCARABAYAR']; ?>" />
        <input type="hidden" name="rajal_status" value="0" />
    	<div class="tab_container">
    	<?php
		$sql2=mysql_query('select * from m_tarif2012 where kode_unit= "17"');
			$i = 1;
			while($datas = mysql_fetch_array($sql2)){	
				if(strlen($datas['kode_gruptindakan']) == 2):
        			echo '<div id="'.$i.'" class="tab_content" style="height: 250px;
    overflow-x: hidden;
    overflow-y: scroll;">';
						$sql_sub = mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$datas['kode_tindakan'].'" order by nama_tindakan asc');
							 if(mysql_num_rows($sql_sub) > 0){
								 echo '<table style="width:100%;">';
								 echo '<tr><th>No</th><th>Nama Tindakan</th><th>Tarif</th><th>Aksi</th></tr>';
								 $x = 1;
								 while($dsub = mysql_fetch_array($sql_sub)){
									 echo '<tr><td>'.$x.'</td><td>'.$dsub['nama_tindakan'].'</td><td align="right">'.curformat($dsub['tarif']).'</td><td><input type="button" name="add" value="add" id="'.$dsub['kode_tindakan'].'" class="text addtindakan"></td></tr>';
									 /*
									 if($x == 5){
										 echo '</tr><tr>';
										 $x = 0;
									 }
									 $last = checkLastLevel($dsub['kode_tindakan']);
									 if($last > 0){
										$ll = getLastLevel($dsub['kode_tindakan']);
										while($dll = mysql_fetch_array($ll)){
											if($x == 5){
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
									 */
									 $x++;
								 }
								 #echo '</tr>';
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
	</div>
	<br clear="all" />
</div>