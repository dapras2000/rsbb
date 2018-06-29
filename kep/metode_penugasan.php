<?php 
include("../include/connect.php");
include '../include/function.php';
if ($_GET[idel]==''){
$sql	= mysql_query("select * from m_penugasan_perawat where id='$_GET[id]'");
$data	= mysql_fetch_array($sql);
}
else if ($_GET[idel]==1){
mysql_query("delete from m_penugasan_perawat where id='$_GET[id]'");};
?>
<script>
jQuery('#tgl').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Format Tanggal Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#cari').validate();
	jQuery("#tgl").mask("9999/99/99");
});
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
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>METODE PENUGASAN</h3></div>
        <div align="right" style="margin:5px;">
		<ul class="tabs">
    		
        <li><span id="#101">Tim</span></li>
			
        <li><span id="#102">Moduler</span></li>
			
        <li><span id="#103">Primer</span></li>
			
        <li><span id="#104">Manajemen Kasus</span></li>
    	</ul>
		<form name="myform" id="myform" action="./kep/edit_penugasan.php" method="post">
        <div class="tab_container">
			<div id="101" class="tab_content">
				<table width="100%" border="0" cellpadding="3" cellspacing="0">
				 <tr>
                <td width="200"><label for="tgl" id="tgl_label">&nbsp&nbsp&nbsp TGL</label></td>
                <td>	<input type="text" class="text required" value="<? if($data['TANGGAL'] !=""): echo $data['TANGGAL']; else: echo date('Y/m/d'); endif;?>" name="tgl" size="20" id="TGLLAHIR" onblur="calage(this.value,'umur');"/>
									<a href="javascript:showCal('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29</td>
          
		    </tr>
					<tr>
						<td width="15%">&nbsp&nbsp&nbsp Ketua Tim</td>
						<td colspan="2">
							<select name="KETUATIM" id="KETUATIM">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['KETUATIM']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Anggota Tim</td>
						<td colspan="2">1.&nbsp;<input type="hidden" name="id" value="<? echo"$data[id]"; ?>">
							<select name="ANGGOTATIM" id="ANGGOTATIM">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['ANGGOTATIM']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>&nbsp;|
							2.&nbsp;
							<select name="ANGGOTATIM2" id="ANGGOTATIM2">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['ANGGOTATIM2']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>&nbsp;|
							3.&nbsp;
							<select name="ANGGOTATIM3" id="ANGGOTATIM3">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['ANGGOTATIM3']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>&nbsp;|
							4.&nbsp;
							<select name="ANGGOTATIM4" id="ANGGOTATIM4">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['ANGGOTATIM4']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>&nbsp;|
							5.&nbsp;
							<select name="ANGGOTATIM5" id="ANGGOTATIM5">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['ANGGOTATIM5']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Pembagian pasien</td>
						<td colspan="2">
							<select name="PEMBAGIAN1" id="PEMBAGIAN1">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['PEMBAGIAN1']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
						
					</tr>
				</table>
							
			</div>
			<div id="102" class="tab_content">
				<table width="100%" border="0" cellpadding="3" cellspacing="0">
					
						 <tr>
                <td width="200"><label for="tgl" id="tgl_label">&nbsp&nbsp&nbsp TGL</label></td>
                <td><input type="text" name="tgl2" class="required" id="tgl_penugasan_modular2" width="15"  value=<? echo''.$data['TANGGAL'].''; ?>> <b>(format:dd-mm-YYYY)</b></td>
            </tr>
					<tr>
						<td width="15%">&nbsp&nbsp&nbsp Perawat Primer</td>
						<td colspan="2">
							<select  name="MODULER1" id="MODULER1">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['MODULER1']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Perawat Associate</td>
						<td colspan="2">
							<select name="MODULER2" id="MODULER2">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['MODULER2']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Pembagian pasien</td>
						<td colspan="2">
							<select name="PEMBAGIAN2" id="PEMBAGIAN2">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['PEMBAGIAN2']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div id="103" class="tab_content">
				<table width="100%" border="0" cellpadding="3" cellspacing="0">
					 <tr>
                <td width="200"><label for="tgl" id="tgl_label">&nbsp&nbsp&nbsp TGL</label></td>
                <td><input type="text" name="tgl3" class="required" id="tgl_penugasan_modular3" width="15"  value=<? echo''.$data['TANGGAL'].''; ?>> <b>(format:dd-mm-YYYY)</b></td>
            </tr>
					<tr>
						<td width="15%">&nbsp&nbsp&nbsp Perawat Primer</td>
						<td colspan="2">
							<select name="PRIMER1" id="PRIMER1">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['PRIMER1']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Perawat Associate</td>
						<td colspan="2">
							<select name="PRIMER2" id="PRIMER2">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['PRIMER2']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Pembagian pasien</td>
						<td colspan="2">
							<select name="PEMBAGIAN3" id="PEMBAGIAN3">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['PEMBAGIAN3']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div id="104" class="tab_content">
				<table width="100%" border="0" cellpadding="3" cellspacing="0">
						 <tr>
                <td width="200"><label for="tgl" id="tgl_label">&nbsp&nbsp&nbsp TGL</label></td>
                <td><input type="text" name="tgl4" class="required" id="tgl_penugasan_modular4" width="15"  value=<? echo''.$data['TANGGAL'].''; ?>> <b>(format:dd-mm-YYYY)</b></td>
            </tr>
					<tr>
						<td width="15%">&nbsp&nbsp&nbsp CCM (Clinical Case Manager)</td>
						<td colspan="2">
							<select name="CCM" id="CCM">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['CCM']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp&nbsp&nbsp Pembagian pasien</td>
						<td colspan="2">
							<select name="PEMBAGIAN4" id="PEMBAGIAN4">
        						<option value=""> -- Pilih Perawat -- </option>
                                <?php 
									$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
									while($dd = mysql_fetch_array($sql_dokter)){
										if($data['PEMBAGIAN4']==$dd['IDPERAWAT']){
											echo '<option value="'.$dd['IDPERAWAT'].'" selected=Selected>'.$dd['NAMA'].'</option>';
										}else{
											echo '<option value="'.$dd['IDPERAWAT'].'">'.$dd['NAMA'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
				</table>
			</div>
    	</div>
    	<br clear="all" />
    	<input type="submit" name="simpan" value="S I M P A N" id="simpan" class="text" />
		
    	</form>
		</div>
	</div>
	<div><? include"penugasan_perawat_primer_table.php"; ?></div>
	<br clear="all" />
</div>