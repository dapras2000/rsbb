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
	
	jQuery(".tab_content3").hide(); //Hide all content
	jQuery("ul.tabs3 li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content3:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs3 li").click(function() {
		jQuery("ul.tabs3 li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content3").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("span").attr("id"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	jQuery(".tab_content4").hide(); //Hide all content
	jQuery("ul.tabs4 li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content4:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs4 li").click(function() {
		jQuery("ul.tabs4 li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content4").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("span").attr("id"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
	
	jQuery(".tab_content5").hide(); //Hide all content
	jQuery("ul.tabs5 li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content5:first").show(); //Show first tab content
	//On Click Event
	jQuery("ul.tabs5 li").click(function() {
		jQuery("ul.tabs5 li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content5").hide(); //Hide all tab content
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

ul.tabs3 {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs3 li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs3 li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs3 li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs3 li a:hover {background: #ccc;}	
html ul.tabs3 li.active, html ul.tabs3 li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container3 {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:5px;}
.tab_content3 {padding: 5px;font-size: 11px; text-align:left;}

ul.tabs4 {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs4 li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs4 li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs4 li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs4 li a:hover {background: #ccc;}	
html ul.tabs4 li.active, html ul.tabs4 li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container4 {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:40px;}
.tab_content4 {padding: 5px;font-size: 11px; text-align:left;}

ul.tabs5 {margin: 0;padding: 0;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 100%;}
ul.tabs5 li {float: left;margin: 0;padding: 0 3px;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;background: #e0e0e0;overflow: hidden;position: relative;}
ul.tabs5 li:hover{ background:#FF9; display:block; cursor:pointer;}
ul.tabs5 li a {text-decoration: none;color: #000;display: block;font-size: 10px;padding: 0 10px;border: 1px solid #fff;outline: none;}
ul.tabs5 li a:hover {background: #ccc;}	
html ul.tabs5 li.active, html ul.tabs5 li.active a:hover  {background: #fff;border-bottom: 1px solid #fff;}
.tab_container5 {border: 1px solid #999;	border-top: none;clear: both;float: left; width: 100%;background: #fff;	-moz-border-radius-bottomright: 5px;-khtml-border-radius-bottomright: 5px;	-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomleft: 5px;	-khtml-border-radius-bottomleft: 5px;	-webkit-border-bottom-left-radius: 5px; padding-top:65px;}
.tab_content5 {padding: 5px;font-size: 11px; text-align:left;}
</style>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>LAPORAN RAWAT INAP</h3></div>
        <div align="right" style="margin:5px;">
		<ul class="tabs">
    		<li><span id="#101">indikator pelayanan keperawatan</span></li>
			<li><span id="#102">Indikator Pelayanan RS</span></li>
			<li><span id="#103">Tingkat ketergantungan pasien</span></li>
			<li><span id="#104">work load index</span></li>
			<li><span id="#105">tingkat kepuasan pasien</span></li>
    	</ul>
        <form id="order_lab">
        <div class="tab_container">
			<div id="101" class="tab_content">
				<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
					<tr align="center">
						<th width="5%">bulan</th>
						<th width="10%">angka kejadian dekubitus</th>
						<th width="10%">angka kejadian pasien jatuh</th>
						<th width="10%">angka kejadian infeksi karena jarum infus</th>
						<th width="10%">angka kejadian kesalahan pemberian obat</th>
						<th width="10%">angka kejadian restrain</th>
						<th width="10%">angka kenyamanan</th>
						<th width="10%">Angka Tatalaksana Nyeri</th>
					</tr>
				</table>
			</div>
			<div id="102" class="tab_content">
				&nbsp&nbsp&nbsp angka kejadian infeksi luka operasi&nbsp : <br>
			</div>
			<div id="103" class="tab_content">
				<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
					<tr align="center">
						<th width="5%">bulan</th>
						<th width="10%">minimal care</th>
						<th width="10%">partial care</th>
						<th width="10%">total care</th>
					</tr>
				</table>
			</div>
			<div id="104" class="tab_content">
				&nbsp&nbsp&nbsp rasio perawat : pasien sesuai tingkat ketergantungan pasien&nbsp : <br>
			</div>
			<div id="105" class="tab_content">
				<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
					<tr align="center">
						<th width="5%">bulan</th>
						<th width="10%">Kelengkapan dan ketepatan informasi</th>
						<th width="10%">Penurunan kecemasan</th>
						<th width="10%">Perawat trampil profesional</th>
						<th width="10%">Pasien merasa nyaman</th>
						<th width="10%">Terhindar dari bahaya</th>
						<th width="10%">Perawat ramah dan empati</th>
					</tr>
				</table>
			</div>
		</div>
    	<br clear="all" />
    	<input type="button" name="simpan" value="S I M P A N" id="simpan" class="text" />
    	</form>
		</div>
	</div>
	<br clear="all" />
</div>