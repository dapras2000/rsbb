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
		jQuery.post('<?php echo _BASE_;?>lab/save_order_lab.php',jQuery('#order_lab').serialize(),function(data){
			if(!data){
				window.location ='<?php echo _BASE_;?>index.php?link=6order';
			}
		});
	});
	/*
	jQuery('.checkbox_lab').click(function(){
		var jenis = jQuery('#cito_status').val();
		var loc = jQuery(this).is(':checked');
		var dokter = jQuery('#kddokter_hidden').val();
		if(dokter == ''){
			alert('Dokter Belum di pilih');
			return false;
		}
		if(loc == true){
			var kd_tindakan	= jQuery(this).attr('id');
			jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kd_tindakan:kd_tindakan,tindakanlab:true,cito_status:jenis},function(data){
				jQuery('#listordersss').empty().append(data);
			});
		}else{
			var kd_tindakan	= jQuery(this).attr('id');
			jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kd_tindakan:kd_tindakan,rem_tindakanlab:true,cito_status:jenis},function(data){
				jQuery('#listordersss').empty().append(data);
			});
		}
	});
	
	jQuery('.cito').change(function(){
		var val = jQuery(this).val();
		var r	= confirm("Perubahan status cito akan menghapus tindakan yang sudah dipilih.");
		if(r==true){
			jQuery.get('<?php echo _BASE_;?>empty_tmp.php',function(data){
				jQuery('#listordersss').empty();
			});
			jQuery('.checkbox_lab').removeAttr('checked');
			jQuery('#cito_status').val(val);
		}
	});
	*/
	jQuery('.addlab').click(function(){
		var kode 	= jQuery(this).attr('id');
		var realkode= jQuery(this).attr('idval');
		var dokter 	= jQuery('#kddokter_hidden').val();
		var cito	= jQuery('#cito'+kode).is(':checked');
		if(dokter == ''){
			alert('Dokter Belum di pilih');
			return false;
		}
		if(cito == true){
			var faktor = "c";
		}else{
			var faktor = "e";
		}
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{tindakanlab:true,kd_tindakan:realkode,cito_status:faktor},function(data){
			jQuery('#listordersss').empty().append(data);
		});
	});
	jQuery('#simpan_dokter').click(function(){
		var dokter 	 = jQuery('#dokter_list').val();
		var nmdokter = jQuery('#dokter_list option[value="'+dokter+'"]').text();
		jQuery('#kddokter_hidden').val(dokter);
		jQuery('#dokter_list').css('display','none');
		jQuery('#simpan_dokter').css('display','none');
		jQuery('#text_set_dokter').text(nmdokter);
		//alert(dokter);
		//alert(nmdokter);
		
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
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:65px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>
<div align="center" style="width:390px; float:left; margin-right:10px;">
	<div id="frame" style="width:100%;">
		<div id="frame_title"><h3>DATA PASIEN LAB</h3></div>
		<div align="right" style="margin:5px;">
        	<?php
			mysql_query('delete from tmp_orderpenunjang where ip = "'.getRealIpAddr().'"');
			mysql_query('delete from tmp_cartbayar where ip = "'.getRealIpAddr().'"');
			
			$sql = 'SELECT a.nomr,a.noruang,a.nott,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.nama as nama_ruang,
DATE_FORMAT(a.masukrs,"%d/%m/%Y") AS tgl, a.dokter_penanggungjawab,a.statusbayar
FROM t_admission a 
JOIN m_pasien b ON b.NOMR = a.nomr
JOIN m_ruang c ON c.no = a.noruang
where a.nomr = "'.$_REQUEST['nomr'].'" and a.id_admission = "'.$_REQUEST['idx'].'"';
			$sql	= mysql_query($sql);				   
			$d	 = mysql_fetch_array($sql);
			?>
			<table width="100%" border="0" cellspacing="0" class="tb">
			<tr><td width="100px;">No RM</td><td ><?php echo $d['nomr']; ?></td></tr>
			<tr><td>Nama</td><td><?php echo $d['NAMA']; ?></td></tr>
            <tr><td>Alamat</td><td><?php echo $d['ALAMAT']; ?></td></tr>
            <tr><td>Tanggal Lahir</td><td><?php echo $d['TGLLAHIR']; ?></td></tr>
            <tr><td>Umur</td><td><?php
             $a = datediff($d['TGLLAHIR'],date('Y-m-d'));
		  echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td></tr>
            <tr><td>Jenis Kelamin</td><td><?php echo jeniskelamin($d['JENISKELAMIN']); ?></td></tr>
			<tr><td>Tanggal Daftar</td><td><?php echo $d['tgl'];?></td></tr>
            <tr><td>Ruang / Bed</td><td><?php echo $d['nama_ruang'].'/'.$d['nott'];?></td></tr>
            <tr><td>Dokter</td><td><span id="text_set_dokter"></span>
            <select name="dokter_list" id="dokter_list" class="text">
            	<?php
				$sql_dokter = mysql_query("SELECT DISTINCT NAMADOKTER, KDDOKTER FROM m_dokter GROUP BY NAMADOKTER ORDER BY NAMADOKTER ASC");
				while($da = mysql_fetch_array($sql_dokter)){
					if($d['dokter_penanggungjawab'] == $da['KDDOKTER']): $sel = 'selected="selected"'; else: $sel = ''; endif;
            		echo '<option value="'.$da['KDDOKTER'].'" '.$sel.'>'.$da['NAMADOKTER'].'</option>';
				}
				?>
            </select>&nbsp;&nbsp;<input type="button" name="simpan_dokter" value="Set Dokter" id="simpan_dokter" class="text" />
            </td></tr>
            <!--<tr><td>Jenis Pemeriksaan</td><td><input type="radio" name="chito" value="c" class="cito" /> Cito <input type="radio" name="chito" class="cito" value="e" checked="checked" /> Tidak Cito</td></tr>-->
            </table>
            <br clear="all" />
            <div id="listordersss"></div>
        </div>
	</div>
</div>
<div align="center" style="width:590px; float:left;">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>FORM ORDER LAB</h3></div>
        <div align="right" style="margin:5px;">
			<ul class="tabs">
    	<?php
		$sql=mysql_query('select * from m_tarif2012 where kode_unit= "16"');
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			if(strlen($data['kode_gruptindakan']) == 5):
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
        <input type="hidden" name="kddokter" id="kddokter_hidden"/>
        <input type="hidden" name="aps" value="0" />
        <input type="hidden" name="nomr" value="<?php echo $_REQUEST['nomr']; ?>" />
        <input type="hidden" name="idxdaftar" value="<?php echo $_REQUEST['idx']; ?>" />
        <input type="hidden" name="unit" value="19" />
        <input type="hidden" name="carabayar" value="<?php echo $d['statusbayar']; ?>" />
        <input type="hidden" name="rajal_status" value="0" />
        <input type="hidden" name="cito_status" id="cito_status" value="e" />
    	<div class="tab_container">
    	<?php
		$sql2=mysql_query('select * from m_tarif2012 where kode_unit= "16"');
			$i = 1;
			while($datas = mysql_fetch_array($sql2)){	
				if(strlen($datas['kode_gruptindakan']) == 5):
        			echo '<div id="'.$i.'" class="tab_content">';
						$sql_sub = mysql_query('select * from m_tarif2012 where kode_gruptindakan = "'.$datas['kode_tindakan'].'"');
							 if(mysql_num_rows($sql_sub) > 0){
								 echo '<table style="width:100%;">';
								 echo '<tr><th> Nama Pemeriksaan </th><th>Cito</th><th>Aksi</th></tr>';
								 $x = 0;
								 while($dsub = mysql_fetch_array($sql_sub)){
									 $last = checkLastLevel($dsub['kode_tindakan']);
									 if($last > 0){
										$ll = getLastLevel($dsub['kode_tindakan']);
										while($dll = mysql_fetch_array($ll)){

											echo '<tr><td>'.$dll['nama_tindakan'].'</td><td style="width:20%;">
											<input type="checkbox" name="checkbox[]" value="'.$dll['kode_tindakan'].'" id="cito'.str_replace('.','_',$dll['kode_tindakan']).'" class="checkbox_lab"></td><td><input type="button" class="text addlab" idval="'.$dll['kode_tindakan'].'" id="'.str_replace('.','_',$dll['kode_tindakan']).'" value="add"></td></tr>';	 
											$x++;
										}
									 }else{
										 echo '<tr><td>'.$dsub['nama_tindakan'].'</td><td style="width:20%;">
										 <input type="checkbox" name="checkbox[]" value="1.25" id="cito'.str_replace('.','_',$dsub['kode_tindakan']).'" class="checkbox_lab"></td><td><input type="button" class="text addlab" idval="'.$dsub['kode_tindakan'].'" id="'.str_replace('.','_',$dsub['kode_tindakan']).'" value="add"></td></tr>';
										#echo '<td style="width:20%;"><input type="checkbox" name="checkbox[]" value="'.$dsub['kode_tindakan'].'" id="'.$dsub['kode_tindakan'].'" class="checkbox_lab"> '.$dsub['nama_tindakan'].'</td>';	 
										$x++;
									 }
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