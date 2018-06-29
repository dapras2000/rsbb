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
	
	jQuery('.add').click(function(){
		var kode = jQuery(this).attr('id');
		var id_operasi	= jQuery('#idoperasi').val();
		var ruang	= jQuery('#ruang').val();
		var nomr	= jQuery(this).attr('nomr');
		var idx		= jQuery(this).attr('idx');
		var jenis 	= jQuery(this).attr('jenis');
		
		//var cito	= jQuery('#cito_'+kode).is(':checked');
		if(jQuery('#cito_'+kode).is(':checked')){
			var faktor = jQuery('#cito_'+kode).val();
		}else{
			var faktor = 1;
		}
		
		if( jQuery('#dokter_pelaksana_'+kode).val() == ''){
			alert('Dokter Pelaksana Belum dipilih');
			return false;
		}
		var dokter = jQuery('#dokter_pelaksana_'+kode).val();
		
		jQuery.post('<?php echo _BASE_;?>operasi/simpan_tindakan_operasi.php',{kode:kode,id_operasi:id_operasi,ruang:ruang,idx:idx,nomr:nomr,jenis:jenis, faktor:faktor, dokter:dokter},function(data){
			jQuery('#listordersss').load('<?php echo _BASE_;?>operasi/list_tindakan_operasi.php?nomr='+nomr+'&idx='+idx);
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
.tab_container {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:25px;}
.tab_content {padding: 5px;font-size: 11px; text-align:left;}
</style>
<div align="center" style="width:390px; float:left; margin-right:10px;">
	<div id="frame" style="width:100%;">
		<div id="frame_title"><h3>DATA PASIEN OPERASI</h3></div>
		<div align="right" style="margin:5px;">
        	<?php
			mysql_query('delete from tmp_cartbayar where IP = "'.getRealIpAddr().'"');
			mysql_query('delete from t_operasi_tindakan_medis where idoperasi = "'.$_REQUEST['idoperasi'].'"');
			
			$sql 	= 'SELECT a.nomr, b.NAMA, b.ALAMAT, b.TGLLAHIR,b.JENISKELAMIN, d.nama as nama_ruang, c.nott, a.tanggal as tgl_operasi,a.id_operasi, c.noruang, c.statusbayar as carabayar, a.IDXDAFTAR as idxdaftar, a.JNSOPERASI
FROM t_operasi a 
JOIN m_pasien b ON b.NOMR = a.nomr 
JOIN t_admission c ON c.id_admission = a.IDXDAFTAR
JOIN m_ruang d ON d.no = c.noruang
			where a.nomr = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR = "'.$_REQUEST['idx'].'"';
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
			<tr><td>Tanggal Operasi</td><td><?php echo $d['tgl_operasi']; if($d['JNSOPERASI'] == 'c'): echo '&nbsp;&nbsp;&nbsp;( Cito )'; endif; ?></td></tr>
            <tr><td>Ruang</td><td><?php echo $d['nama_ruang'].'/'.$d['nott'];?></td></tr>
            
            </table>
            <br clear="all" />
            <div id="listordersss"></div>
        </div>
	</div>
</div>
<div align="center" style="width:590px; float:left;">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>FORM ORDER TINDAKAN OPERASI</h3></div>
        <div align="right" style="margin:5px;">
			<ul class="tabs">
    	<?php
		$sql=mysql_query('SELECT * FROM m_tarif2012 WHERE kode_lampiran = "08" AND kode_gruptindakan = "08"');
		$i = 1;
		while($data = mysql_fetch_array($sql)){
			echo '<li><span id="#'.$i.'">'.$data['nama_tindakan'].'</span></li>';
			$i++;
		}
		?>
    	</ul>
        	
    	<div class="tab_container">
    	<?php
		$q	= "SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
					JOIN m_dokter b ON a.kddokter = b.kddokter
					WHERE a.kdpoly = 4 ORDER BY NAMADOKTER ASC";
		$h	= mysql_query($q);
		$vb = '';
		while($b=mysql_fetch_array($h)){
			if($dat_operasi['kode_dokteroperator'] == $b['kddokter']): $sel_operator = 'selected="selected"'; else: $sel_operator = ''; endif;
			$vb .= '<option value="'.$b['kddokter'].'" '.$sel_operator.'>'.$b['NAMADOKTER'].'</option>';
		}
			
		$sql2=mysql_query('SELECT * FROM m_tarif2012 WHERE kode_lampiran = "08" AND kode_gruptindakan = "08"');
			$i = 1;
			while($datas = mysql_fetch_array($sql2)){
        			echo '<div id="'.$i.'" class="tab_content">';
						$kelas 	= $_REQUEST['kelas']; 
						if($kelas == 'P3'){
							$kelas = 'III';
						}elseif($kelas == "P2"){
							$kelas = 'II';
						}
						$sql_sub = 'select * from m_tarif2012 where kode_gruptindakan like "'.$datas['kode_tindakan'].'%"';
						$sql_sub = mysql_query($sql_sub);
							 if(mysql_num_rows($sql_sub) > 0){
								 echo '<table style="width:100%;">';
								 echo '<tr><th>Nama Tindakan</th><th>Cito</th><th>Pelaksana</th><th>Aksi</th></tr>';
								 while($dsub = mysql_fetch_array($sql_sub)){
									  if($dsub['tarif'] > 0){
										 echo '<tr><td>'.$dsub['nama_tindakan'].'</td>
										 <td><input type="checkbox" value="1.25" name="cito" id="cito_'.str_replace('.','_',$dsub['kode_tindakan']).'"></td>';
										 echo '<td><select class="text" name="dokter_pelaksana" id="dokter_pelaksana_'.str_replace('.','_',$dsub['kode_tindakan']).'">';
										 echo '<option value=""> Pilih Dokter Operator </option>';
										 echo $vb;
										 echo '</select>';
										 echo '</td>';
											 
										 echo '<td>
<input type="button" class="text add" value="add" id="'.str_replace('.','_',$dsub['kode_tindakan']).'" nomr="'.$d['nomr'].'" idx="'.$d['idxdaftar'].'" /></tr>';
									 }else{
										 echo '<tr><td colspan="2" style="font-weight:bold;">'.$dsub['nama_tindakan'].'</td></tr>';
									 }
								 }
								 echo '</tr>';
								 echo '</table>';
							 }
					echo '</div>';
					$i++;
			}
		?>
    	</div>
    	<br clear="all" />
    	<!--<input type="button" name="simpan" value="S I M P A N" id="simpan" class="text" />-->
		</div>
	</div>
	<br clear="all" />
</div>