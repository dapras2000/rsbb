<?php 
include("../include/connect.php");
include '../include/function.php';
require_once('./ps_pagination_x.php');?>
<script>
/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
	Version: 1.3
*/
(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery)

jQuery(document).ready(function(){
	jQuery('#TGLLAHIR').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Jadwal Supervisi Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#myform').validate();
	jQuery("#TGLLAHIR").mask("9999/99/99");
	
	jQuery('#TGLREG').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Jadwal Supervisi Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#cari').validate();
	jQuery("#TGLREG").mask("9999/99/99");	
	
	jQuery('#tgl_pesan').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Jadwal Supervisi Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#formsearch').validate();
	jQuery("#tgl_pesan").mask("9999/99/99");	
	
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
	
	jQuery(".tab_content2").hide(); //Hide all content
	jQuery("ul.tabs2 li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content2:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs2 li").click(function() {
		jQuery("ul.tabs2 li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content2").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("span").attr("id"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	/*jQuery('#simpan').click(function(){
		jQuery.post('<?php echo _BASE_;?>lab/save_order_lab.php',jQuery('#order_lab').serialize(),function(data){
			if(!data){
				window.location ='<?php echo _BASE_;?>index.php?link=6order';
			}
		});
	});*/
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

ul.tabs2 {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs2 li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs2 li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs2 li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs2 li a:hover {background: #ccc;}	
html ul.tabs2 li.active, html ul.tabs2 li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container2 {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:5px;}
.tab_content2 {padding: 5px;font-size: 11px; text-align:left;}
</style>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>SUPERVISI</h3></div>
        <div align="right" style="margin:5px;">
		<ul class="tabs">
    		
        <li><span id="#101">Supervisi di dalam jam kerja</span></li>
			
        <li><span id="#102">Supervisi di luar jam kerja</span></li>
    	</ul>
        <!--<form name="myform2" id="myform2" action="./kep/_perawat.php?edit=<?echo $edit;?>" method="post">-->
        <div class="tab_container">
			<div id="101" class="tab_content">
				<ul class="tabs2">
					
            <li><span id="#201">Supervisi kualitas asuhan keperawatan</span></li>
					
            <li><span id="#202">Supervisi Manajemen Pelayanan Keperawatan</span></li>
				</ul>				
				<div class="tab_container2">
					<div id="201" class="tab_content2">
						<form name="myform" id="myform" action="./kep/add_supervisi.php?edit=kualitas" method="post">
						<table width="95%" style="margin:10px;" border="0" cellpadding="3" cellspacing="0">
							<tr>
								<td width="15%">metode supervisi</td>
								<td width="15%" colspan="1"><input class="text" type="text" value="<?=$data['METSUP']?>" name="METSUP" size="25" id="METSUP" /></td>
							</tr>
							<tr>
								<td>jadwal supervisi</td>
								<td colspan="2">
									<input type="text" class="text required" value="<? if($data['JADSUP'] !=""): echo $data['JADSUP']; else: echo date('Y/m/d'); endif;?>" name="TGLLAHIR" size="20" id="TGLLAHIR" onblur="calage(this.value,'umur');"/>
									<a href="javascript:showCal('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29
								</td>
							</tr>
							<tr>
								<td width="15%">topik supervisi</td>
								<td colspan="2"><input class="text" type="text" value="<?=$data['TOPSUP']?>" name="TOPSUP" size="25" id="TOPSUP" /></td>
							</tr>
							<tr>
								<td>supervisor</td>
								<td colspan="2">
									<select name="SUP" id="SUP">
										<option value=""> -- Pilih Supervisor -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE jabfung = "11" ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['SUP']==$dd['IDPERAWAT']){
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
								<td>perawat yang disupervisi</td>
								<td colspan="2">
									<select name="YGSUP" id="YGSUP">
										<option value=""> -- Pilih Perawat -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE jabfung in ("1","2","3","4","5","6","7","8") ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['YGSUP']==$dd['IDPERAWAT']){
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
								<td width="15%">hasil supervisi</td>
								<td colspan="1"><input class="text" type="text" value="<?=$data['HASSUP']?>" name="HASSUP" size="25" id="HASSUP" /></td>
								<td><input type="submit" name="simpan" value="T A M B A H" id="simpan" class="text" /></td>
							</tr>
						</table>
						</form>
							<?$sql="SELECT a.* FROM m_supvis a WHERE a.KODESUP = 'K'";
								$sql1="SELECT count(*) FROM m_supvis a WHERE a.KODESUP = 'K'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">no</th>
										<th width="15%">metode supervisi</th>
										<th width="10%">jadwal supervisi</th>
										<th width="15%">topik supervisi</th>
										<th width="15%">supervisor</th>
										<th width="15%">perawat yang disupervisi</th>
										<th width="15%">hasil supervisi</th>
									</tr><?
									while($data = mysql_fetch_array($rs)) {?>
									<tr <?   echo "class =";
										$count++;
										if ($count % 2) {
											echo "tr1";
										}
										else {
											echo "tr2";
										}
											?>>
										<td align="center"><? echo $page;?></td>
										<td><? echo $data['METSUP']; ?></td>
										<td><? echo $data['JADSUP']; ?></td>
										<td><? echo $data['TOPSUP']; ?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['SUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['YGSUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><? echo $data['HASSUP']; ?></td>
									</tr>
										<?$page++;	}

									//Display the full navigation in one go
									//echo $pager->renderFullNav();

									//Or you can display the inidividual links
									echo "<div style='padding:5px;' align=\"center\"><br />";

									//Display the link to first page: First
									echo $pager->renderFirst()." | ";

									//Display the link to previous page: <<
									echo $pager->renderPrev()." | ";

									//Display page links: 1 2 3
									echo $pager->renderNav()." | ";

									//Display the link to next page: >>
									echo $pager->renderNext()." | ";

									//Display the link to last page: Last
									echo $pager->renderLast();

									echo "</div>";
									?>
								</table>
								<?php

								//Display the full navigation in one go
								//echo $pager->renderFullNav();

								//Or you can display the inidividual links
								echo "<div style='padding:5px;' align=\"center\"><br />";

								//Display the link to first page: First
								echo $pager->renderFirst()." | ";

								//Display the link to previous page: <<
								echo $pager->renderPrev()." | ";

								//Display page links: 1 2 3
								echo $pager->renderNav()." | ";

								//Display the link to next page: >>
								echo $pager->renderNext()." | ";

								//Display the link to last page: Last
								echo $pager->renderLast();

								echo "</div>";
								?>
					</div>
					<div id="202" class="tab_content2">
						&nbsp&nbsp <b>Supervisor</b> <br><br>
						<form name="cari" id="cari" action="./kep/add_supervisi.php?edit=manajemen" method="post">
						<table width="95%" style="margin:10px;" border="0" cellpadding="3" cellspacing="0">
							<tr>
								<td width="15%">Kepala Ruangan</td>
								<td width="15%" colspan="1">
									<select name="KEPRU" id="KEPRU">
										<option value=""> -- Pilih Kepala Ruangan -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['KEPRU']==$dd['IDPERAWAT']){
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
								<td>Koordinator Keperawatan</td>
								<td colspan="2">
									<select name="KEPKEP" id="KEPKEP">
										<option value=""> -- Pilih Koordinator Keperawatan -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['KEPKEP']==$dd['IDPERAWAT']){
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
								<td>Kepala Seksi</td>
								<td colspan="2">
									<select name="KEPSEK" id="KEPSEK">
										<option value=""> -- Pilih Kepala Seksi -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['KEPSEK']==$dd['IDPERAWAT']){
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
								<td>Kepala Bidang</td>
								<td colspan="2">
									<select name="METSUP" id="METSUP">
										<option value=""> -- Pilih Kepala Bidang -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['METSUP']==$dd['IDPERAWAT']){
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
								<td>Kepala Instalasi</td>
								<td colspan="2">
									<select name="SUP" id="SUP">
										<option value=""> -- Pilih Kepala Instalasi -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['SUP']==$dd['IDPERAWAT']){
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
								<td>jadwal supervisi</td>
								<td colspan="2">
									<input type="text" class="text required" value="<?if($data['JADSUP'] !=""): echo $data['JADSUP']; else: echo date('Y/m/d'); endif; ?>" name="TGLREG" size="20" id="TGLREG" onblur="calage(this.value,'umur');"/>
									<a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29
								</td>
							</tr>
							<tr>
								<td width="15%">topik supervisi</td>
								<td colspan="2"><input class="text" type="text" value="<?=$data['TOPSUP']?>" name="TOPSUP" size="25" id="TOPSUP" /></td>
							</tr>
							<tr>
								<td>yang disupervisi</td>
								<td colspan="2">
									<select name="YGSUP" id="YGSUP">
										<option value=""> -- Pilih Perawat -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE jabfung in ("1","2","3","4","5","6","7","8") ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['YGSUP']==$dd['IDPERAWAT']){
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
								<td width="15%">hasil supervisi</td>
								<td colspan="1"><input class="text" type="text" value="<?=$data['HASSUP']?>" name="HASSUP" size="25" id="HASSUP" /></td>
								<td><input type="submit" name="simpan" value="T A M B A H" id="simpan" class="text" /></td>
							</tr>
						</table>
						</form>
							<?$sql="SELECT a.* FROM m_supvis a WHERE a.KODESUP = 'M'";
								$sql1="SELECT count(*) FROM m_supvis a WHERE a.KODESUP = 'M'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">no</th>
										<th width="10%">kepala ruangan</th>
										<th width="10%">koordinator keperawatan</th>
										<th width="10%">kepala seksi</th>
										<th width="10%">kepala bidang</th>
										<th width="10%">kepala instalasi</th>
										<th width="10%">jadwal supervisi</th>
										<th width="10%">topik supervisi</th>
										<th width="10%">yang disupervisi</th>
										<th width="10%">hasil supervisi</th>
									</tr><?
									while($data = mysql_fetch_array($rs)) {?>
									<tr <?   echo "class =";
										$count++;
										if ($count % 2) {
											echo "tr1";
										}
										else {
											echo "tr2";
										}
											?>>
										<td align="center"><? echo $page;?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['KEPRU'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['KEPKEP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['KEPSEK'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['METSUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['SUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><? echo $data['JADSUP']; ?></td>
										<td><? echo $data['TOPSUP']; ?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['YGSUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><? echo $data['HASSUP']; ?></td>
									</tr>
										<?$page++;	}

									//Display the full navigation in one go
									//echo $pager->renderFullNav();

									//Or you can display the inidividual links
									echo "<div style='padding:5px;' align=\"center\"><br />";

									//Display the link to first page: First
									echo $pager->renderFirst()." | ";

									//Display the link to previous page: <<
									echo $pager->renderPrev()." | ";

									//Display page links: 1 2 3
									echo $pager->renderNav()." | ";

									//Display the link to next page: >>
									echo $pager->renderNext()." | ";

									//Display the link to last page: Last
									echo $pager->renderLast();

									echo "</div>";
									?>
								</table>
								<?php

								//Display the full navigation in one go
								//echo $pager->renderFullNav();

								//Or you can display the inidividual links
								echo "<div style='padding:5px;' align=\"center\"><br />";

								//Display the link to first page: First
								echo $pager->renderFirst()." | ";

								//Display the link to previous page: <<
								echo $pager->renderPrev()." | ";

								//Display page links: 1 2 3
								echo $pager->renderNav()." | ";

								//Display the link to next page: >>
								echo $pager->renderNext()." | ";

								//Display the link to last page: Last
								echo $pager->renderLast();

								echo "</div>";
								?>
					</div>
				</div>
			</div>
			<div id="102" class="tab_content">
				&nbsp&nbsp <b>Supervisor</b> <br><br>
						<form name="formsearch" id="formsearch" action="./kep/add_supervisi.php?edit=luar" method="post">
						<table width="95%" style="margin:10px;" border="0" cellpadding="3" cellspacing="0">
							<tr>
								<td width="15%">petugas pengawas keperawatan</td>
								<td width="15%" colspan="1">
									<select name="SUP" id="SUP">
										<option value=""> -- Pilih Pengawas Keperawatan -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['SUP']==$dd['IDPERAWAT']){
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
								<td>jadwal supervisi</td>
								<td colspan="2">
									<input type="text" class="text required" value="<? if($data['JADSUP'] !=""): echo $data['JADSUP']; else: echo date('Y/m/d'); endif;  ?>" name="tgl_pesan" size="20" id="tgl_pesan" onblur="calage(this.value,'umur');"/>
									<a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29
								</td>
							</tr>
							<tr>
								<td width="15%">topik supervisi</td>
								<td colspan="2"><input class="text" type="text" value="<?=$data['TOPSUP']?>" name="TOPSUP" size="25" id="TOPSUP" /></td>
							</tr>
							<tr>
								<td>yang disupervisi</td>
								<td colspan="2">
									<select name="YGSUP" id="YGSUP">
										<option value=""> -- Pilih Perawat -- </option>
										<?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE jabfung in ("1","2","3","4","5","6","7","8") ORDER BY NAMA ASC');
											while($dd = mysql_fetch_array($sql_dokter)){
												if($data['YGSUP']==$dd['IDPERAWAT']){
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
								<td width="15%">hasil supervisi</td>
								<td colspan="1"><input class="text" type="text" value="<?=$data['HASSUP']?>" name="HASSUP" size="25" id="HASSUP" /></td>
								<td><input type="submit" name="simpan" value="T A M B A H" id="simpan" class="text" /></td>
							</tr>
						</table>
						</form>
							<?$sql="SELECT a.* FROM m_supvis a WHERE a.KODESUP = 'L'";
								$sql1="SELECT count(*) FROM m_supvis a WHERE a.KODESUP = 'L'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">no</th>
										<th width="17%">petugas pengawas keperawatan</th>
										<th width="17%">jadwal supervisi</th>
										<th width="17%">topik supervisi</th>
										<th width="17%">yang disupervisi</th>
										<th width="17%">hasil supervisi</th>
									</tr><?
									while($data = mysql_fetch_array($rs)) {?>
									<tr <?   echo "class =";
										$count++;
										if ($count % 2) {
											echo "tr1";
										}
										else {
											echo "tr2";
										}
											?>>
										<td align="center"><? echo $page;?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['SUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><? echo $data['JADSUP']; ?></td>
										<td><? echo $data['TOPSUP']; ?></td>
										<td><?php 
											$sql_dokter	= mysql_query('SELECT IDPERAWAT, NAMA FROM m_perawat WHERE idperawat = "'.$data['YGSUP'].'"');
											while($dd = mysql_fetch_array($sql_dokter)){
												echo $dd['NAMA'];
											}
										?></td>
										<td><? echo $data['HASSUP']; ?></td>
									</tr>
										<?$page++;	}

									//Display the full navigation in one go
									//echo $pager->renderFullNav();

									//Or you can display the inidividual links
									echo "<div style='padding:5px;' align=\"center\"><br />";

									//Display the link to first page: First
									echo $pager->renderFirst()." | ";

									//Display the link to previous page: <<
									echo $pager->renderPrev()." | ";

									//Display page links: 1 2 3
									echo $pager->renderNav()." | ";

									//Display the link to next page: >>
									echo $pager->renderNext()." | ";

									//Display the link to last page: Last
									echo $pager->renderLast();

									echo "</div>";
									?>
								</table>
								<?php

								//Display the full navigation in one go
								//echo $pager->renderFullNav();

								//Or you can display the inidividual links
								echo "<div style='padding:5px;' align=\"center\"><br />";

								//Display the link to first page: First
								echo $pager->renderFirst()." | ";

								//Display the link to previous page: <<
								echo $pager->renderPrev()." | ";

								//Display page links: 1 2 3
								echo $pager->renderNav()." | ";

								//Display the link to next page: >>
								echo $pager->renderNext()." | ";

								//Display the link to last page: Last
								echo $pager->renderLast();

								echo "</div>";
								?>
			</div>
		</div>
    	<br clear="all" />
    	<input type="button" name="simpan" value="S I M P A N" id="simpan" class="text" />
    	<!--</form>-->
		</div>
	</div>
	<br clear="all" />
</div>