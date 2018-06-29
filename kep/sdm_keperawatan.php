<?php 
include("../include/connect.php");
include '../include/function.php';
require_once('./ps_pagination_x.php');?>
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
        <div id="frame_title"><h3>SDM KEPERAWATAN</h3></div>
        <div align="right" style="margin:5px;">
		<ul class="tabs">
    		<li><span id="#101">Kualifikasi</span></li>
			<!--<li><span id="#102">Sistem Mutasi</span></li>
			<li><span id="#103">Sistem Promosi</span></li>-->
			<li><span id="#104">Turn Over</span></li>
			<li><span id="#105">Program Pengembangan Tenaga Perawat Formal dan Informal</span></li>
    	</ul>
        <form id="order_lab">
        <div class="tab_container">
			<div id="101" class="tab_content">
				<ul class="tabs2">
					<li><span id="#201">Pendidikan</span></li>
					<li><span id="#202">Pelatihan</span></li>
					<li><span id="#203">Jabatan</span></li>
					<li><span id="#204">Pengalaman Kerja</span></li>
				</ul>
				<div class="tab_container2">
					<div id="201" class="tab_content2">
						<ul class="tabs3">
							<li><span id="#301">SPK</span></li>
							<li><span id="#302">D III Keperawatan</span></li>
							<li><span id="#303">Ners (S.Kp dan Ns.)</span></li>
							<li><span id="#304">S2 Magister Keperawatan (Manajemen & Kepemimpinan)</span></li>
							<li><span id="#305">Ners Spesialis</span></li>
							<li><span id="#306">S3 Keperawatan</span></li>
						</ul>
						<div class="tab_container3">
							<div id="301" class="tab_content3">
							<?$sql="SELECT a.* FROM m_perawat a WHERE a.PENDIDIKAN = '1'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PENDIDIKAN = '1'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="302" class="tab_content3">
							<?$sql="SELECT a.* FROM m_perawat a WHERE a.PENDIDIKAN = '2'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PENDIDIKAN = '2'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="303" class="tab_content3">
							<?$sql="SELECT a.* FROM m_perawat a WHERE a.PENDIDIKAN = '3'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PENDIDIKAN = '3'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="304" class="tab_content3">
							<?$sql="SELECT a.* FROM m_perawat a WHERE a.PENDIDIKAN = '4'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PENDIDIKAN = '4'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="305" class="tab_content3">
							<?$sql="SELECT a.* FROM m_perawat a WHERE a.PENDIDIKAN = '5'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PENDIDIKAN = '5'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="306" class="tab_content3">
							<?$sql="SELECT a.* FROM m_perawat a WHERE a.PENDIDIKAN = '6'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PENDIDIKAN = '6'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
					<div id="202" class="tab_content2">
						<ul class="tabs3">
							<li><span id="#311">Pelatihan Manajemen Keperawatan</span></li>
							<li><span id="#312">Pelatihan Teknis Keperawatan</span></li>
						</ul>
						<div class="tab_container3">
							<div id="311" class="tab_content3">
								<ul class="tabs4">
									<li><span id="#401">Manajemen ruangan</span></li>
									<li><span id="#402">SP2KP</span></li>
									<li><span id="#403">PPI RS</span></li>
									<li><span id="#404">Patient safety</span></li>
									<li><span id="#405">Manajemen logistik</span></li>
									<li><span id="#406">Utilisasi tenaga keperawatan</span></li>
									<li><span id="#407">TOT keperawatan / Clinical Instructor & Preceptorship</span></li>
									<li><span id="#408">Service Excellent</span></li>
									<li><span id="#409">Audit Keperawatan</span></li>
									<li><span id="#410">Manajemen mutu pel kep</span></li>
									<li><span id="#411">MPKP</span></li>
									<li><span id="#412">Diklat PIM</span></li>
									<li><span id="#413">Manajemen Askep</span></li>
								</ul>
								<div class="tab_container4">
									<div id="401" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '01%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '01%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="402" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%02%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%02%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="403" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%03%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%03%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="404" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%04%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%04%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="405" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%05%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%05%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="406" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%06%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%06%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="407" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%07%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%07%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="408" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%08%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%08%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="409" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%09%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%09%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="410" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%10%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%10%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="411" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%11%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%11%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="412" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%12%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%12%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="413" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELMANKEP like '%13%'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELMANKEP like '%13%'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
							<div id="312" class="tab_content3">
								<ul class="tabs4">
									<li><span id="#421">Kegawatdaruratan</span></li>
									<li><span id="#422">Medikal bedah</span></li>
									<li><span id="#423">Anak</span></li>
									<li><span id="#424">Maternitas</span></li>
									<li><span id="#425">Jiwa</span></li>
								</ul>
								<div class="tab_container4">
									<div id="421" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#501">BHD / BLS</span></li>
											<li><span id="#502">BTCLS</span></li>
											<li><span id="#503">BHL / ALS</span></li>
											<li><span id="#504">ATCLS</span></li>
											<li><span id="#505">Basic Emergency Nursing</span></li>
											<li><span id="#506">Advance Emergency Nursing</span></li>
											<li><span id="#507">PPGD</span></li>
											<li><span id="#508">pelatihan pelayanan keperawatan kritis</span></li>
											<li><span id="#509">pelatihan pelayanan keperawatan kritis pediatrik</span></li>
											<li><span id="#510">pelatihan pelayanan keperawatan kritis Neonatus</span></li>
											<li><span id="#511">pelatihan pelayanan keperawatan kritis Cardiology</span></li>
											<li><span id="#512">resusitasi neonatus</span></li>
										</ul>
										<div class="tab_container5">
											<div id="501" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '01%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '01%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="502" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%02%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%02%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="503" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%03%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%03%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="504" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%04%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%04%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="505" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%05%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%05%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="506" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%06%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%06%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="507" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%07%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%07%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="508" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%08%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%08%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="509" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%09%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%09%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="510" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%10%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%10%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="511" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%11%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%11%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="512" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPGAW like '%12%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPGAW like '%12%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="422" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#521">Stoma Wound care</span></li>
											<li><span id="#522">Kep. Respirasi dasar</span></li>
											<li><span id="#523">kep. Respirasi lanjutan</span></li>
											<li><span id="#524">Kep. Neurologi dasar</span></li>
											<li><span id="#525">Kep. Neurologi lanjutan</span></li>
											<li><span id="#526">Kep. Mahhir Mata</span></li>
											<li><span id="#527">Kardiologi dasar</span></li>
											<li><span id="#528">kardiologi lanjutan</span></li>
											<li><span id="#529">Perawatan luka bakar</span></li>
											<li><span id="#530">Pengelolaan kamar bedah</span></li>
											<li><span id="#531">Keperawatan mahir bedah</span></li>
											<li><span id="#532">keperawatan kemoterapi</span></li>
											<li><span id="#533">keperawatan paliatif</span></li>
											<li><span id="#534">keperawatan  geriatri</span></li>
											<li><span id="#535">manajemen pelayanan home care</span></li>
											<li><span id="#536">edukasi DM</span></li>
											<li><span id="#537">Haemodialisa</span></li>
											<li><span id="#538">kep. DM</span></li>
											<li><span id="#539">kep. Kaki diabetic</span></li>
											<li><span id="#540">VCT</span></li>
											<li><span id="#541">PCS</span></li>
											<li><span id="#542">CST</span></li>
											<li><span id="#543">PMTCT</span></li>
										</ul>
										<div class="tab_container5">
											<div id="521" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '01%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '01%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="522" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%02%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%02%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="523" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%03%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%03%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="524" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%04%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%04%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="525" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%05%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%05%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="526" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%06%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%06%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="527" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%07%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%07%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="528" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%08%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%08%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="529" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%09%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%09%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="530" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%10%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%10%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="531" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%11%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%11%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="532" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%12%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%12%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="533" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%13%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%13%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="534" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%14%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%14%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="535" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%15%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%15%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="536" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%16%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%16%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="537" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%17%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%17%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="538" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%18%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%18%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="539" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%19%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%19%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="540" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%20%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%20%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="541" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%21%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%21%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="542" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%22%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%22%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="543" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%23%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMEDAH like '%23%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="423" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#551">metode kangguru</span></li>
											<li><span id="#552">perawatan BBLR</span></li>
										</ul>
										<div class="tab_container5">
											<div id="551" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPNAK like '1%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPNAK like '1%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="552" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPNAK like '%2%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPNAK like '%2%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="424" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#561">manajemen laktasi</span></li>
											<li><span id="#562">senam hamil dan nifas</span></li>
											<li><span id="#563">pelatihan KB</span></li>
											<li><span id="#564">PONED</span></li>
											<li><span id="#565">PONEK</span></li>
										</ul>
										<div class="tab_container5">
											<div id="561" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMAT like '1%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMAT like '1%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="562" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMAT like '%2%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMAT like '%2%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="563" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMAT like '%3%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMAT like '%3%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="564" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMAT like '%4%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMAT like '%4%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="565" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPMAT like '%5%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPMAT like '%5%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="425" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#571">CT (Assertive Community Treatment)</span></li>
											<li><span id="#572">TAK (terapi aktivitas kelompok)</span></li>
											<li><span id="#573">PICU (Psychiatric Intensive Care Unit)</span></li>
											<li><span id="#574">PPGDJ (Pedoman Penggolongan Gangguan Diagnosa Jiwa)</span></li>
											<li><span id="#575">terapi modalitas</span></li>
											<li><span id="#576">CLMHN (Consultation Liasion Mental Health Nursing)</span></li>
											<li><span id="#577">MPKP Jiwa</span></li>
											<li><span id="#578">pelatihan metadon</span></li>
										</ul>
										<div class="tab_container5">
											<div id="571" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '1%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '1%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="572" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%2%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%2%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="573" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%3%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%3%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="574" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%4%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%4%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="575" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%5%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%5%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="576" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%6%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%6%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="577" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%7%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%7%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="578" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%8%'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.PELTEKKEPJIWA like '%8%'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
								</div>
							</div>
						</div>
					</div>
					<div id="203" class="tab_content2">
						<ul class="tabs3">
							<li><span id="#321">Jabatan fungsional</span></li>
							<li><span id="#322">Jabatan struktural</span></li>
						</ul>
						<div class="tab_container3">
							<div id="321" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '1'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat terampil	pelaksana pemula&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '2'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat terampil	pelaksana&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '3'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat terampil	pelaksana lanjutan&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '4'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat terampil	penyelia&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '5'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat ahli pertama&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '6'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat ahli muda&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '7'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat ahli madya&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '8'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah Perawat ahli Utama&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '9'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah ketua komite keperawatan&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '10'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah kepala instalasi&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '11'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah supervisor&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABFUNG = '12'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah kepala ruangan&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
							</div>
							<div id="322" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABSTRUK = '1'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah	Kepala keperawatan&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.JABSTRUK = '2'";
								$rs = mysql_query($sql);
								if(!$rs) die(mysql_error()); ?>
								&nbsp&nbsp&nbspJumlah	Kepala seksi pelayanan keperawatan&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
							</div>
						</div>
					</div>
					<div id="204" class="tab_content2">
						<ul class="tabs3">
							<li><span id="#331">Lama kerja</span></li>
							<li><span id="#332">Tempat Kerja Sesuai Area</span></li>
						</ul>
						<div class="tab_container3">
							<div id="331" class="tab_content3">
								<ul class="tabs4">
									<li><span id="#431">0 - 1 tahun</span></li>
									<li><span id="#432">1 - 3 tahun</span></li>
									<li><span id="#433">3 - 5 tahun</span></li>
									<li><span id="#434">5 - 7 tahun</span></li>
									<li><span id="#435">7 - 10 tahun</span></li>
									<li><span id="#436">> 10 tahun</span></li>
								</ul>
								<div class="tab_container4">
									<div id="431" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.LAMKER = '1'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.LAMKER = '1'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="432" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.LAMKER = '2'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.LAMKER = '2'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="433" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.LAMKER = '3'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.LAMKER = '3'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="434" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.LAMKER = '4'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.LAMKER = '4'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="435" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.LAMKER = '5'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.LAMKER = '5'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
									<div id="436" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.LAMKER = '6'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.LAMKER = '6'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
							<div id="332" class="tab_content3">
								<ul class="tabs4">
									<li><span id="#441">Rawat Inap</span></li>
									<li><span id="#442">Rawat Jalan</span></li>
									<li><span id="#443">Rawat Khusus</span></li>
									<li><span id="#444">Kegawatdaruratan</span></li>
								</ul>
								<div class="tab_container4">
									<div id="441" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#581">Penyakit dalam</span></li>
											<li><span id="#582">Bedah</span></li>
											<li><span id="#583">Anak</span></li>
											<li><span id="#584">Maternitas</span></li>
											<li><span id="#585">Jiwa</span></li>
											<li><span id="#586">Lain-lain</span></li>
										</ul>
										<div class="tab_container5">
											<div id="581" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Penyakit dalam'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Penyakit dalam'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="582" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Bedah'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Bedah'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="583" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Anak'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Anak'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="584" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Maternitas'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Maternitas'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="585" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Jiwa'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 = 'Jiwa'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="586" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 like 'L %'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '1' and a.TEMKER2 like 'L %'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="442" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#591">Poliklinik Penyakit dalam</span></li>
											<li><span id="#592">Poliklinik bedah</span></li>
											<li><span id="#593">Poliklinik anak</span></li>
											<li><span id="#594">Poliklinik kean</span></li>
											<li><span id="#595">Lain-lain</span></li>											
										</ul>
										<div class="tab_container5">
											<div id="591" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik Penyakit dalam'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik Penyakit dalam'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="592" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik bedah'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik bedah'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="593" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik anak'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik anak'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="594" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik kean'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 = 'Poliklinik kean'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="595" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 like 'L %'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '2' and a.TEMKER2 like 'L %'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="443" class="tab_content4">
										<ul class="tabs5">
											<li><span id="#5001">Intensif care</span></li>
											<li><span id="#5002">Kamar operasi</span></li>
											<li><span id="#5003">Unit Luka Bakar</span></li>
											<li><span id="#5004">NAPZA</span></li>
											<li><span id="#5005">Haemodialisa</span></li>
											<li><span id="#5006">Lain-lain</span></li>
										</ul>
										<div class="tab_container5">
											<div id="5001" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Intensif care'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Intensif care'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="5002" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Kamar operasi'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Kamar operasi'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="5003" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Unit Luka Bakar'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Unit Luka Bakar'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="5004" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'NAPZA'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'NAPZA'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="5005" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Haemodialisa'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 = 'Haemodialisa'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
											<div id="5006" class="tab_content5">
												<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 like 'L %'";
												$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '3' and a.TEMKER2 like 'L %'";
												$page=1;
												$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
												$rs = $pager->paginate();
												if(!$rs) die(mysql_error()); ?>
												&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
												<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
													<tr align="center">
														<th width="5%">No</th>
														<th width="5%">NIP</th>
														<th width="20%"> Nama</th>
														<th width="20%">Unit / Ruang Rawat</th>										
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
														<td><? echo $data['NIP']; ?></td>
														<td><? echo $data['NAMA']; ?></td>
														<td><? if($data['TEMKER']=="1") {
																	echo"Rawat Inap";
																}elseif($data['TEMKER']=="2") {
																	echo"Rawat Jalan";
																}elseif($data['TEMKER']=="3") {
																	echo"Rawat Khusus";
																}elseif($data['TEMKER']=="4") {
																	echo"Kegawatdaruratan";
																} ?></td>
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
									<div id="444" class="tab_content4">
										<?$sql="SELECT a.* FROM m_perawat a WHERE a.TEMKER = '4' and a.TEMKER2 = 'IGD'";
										$sql1="SELECT count(*) FROM m_perawat a WHERE a.TEMKER = '4' and a.TEMKER2 = 'IGD'";
										$page=1;
										$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
										$rs = $pager->paginate();
										if(!$rs) die(mysql_error()); ?>
										&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
										<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
											<tr align="center">
												<th width="5%">No</th>
												<th width="5%">NIP</th>
												<th width="20%"> Nama</th>
												<th width="20%">Unit / Ruang Rawat</th>										
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
												<td><? echo $data['NIP']; ?></td>
												<td><? echo $data['NAMA']; ?></td>
												<td><? if($data['TEMKER']=="1") {
															echo"Rawat Inap";
														}elseif($data['TEMKER']=="2") {
															echo"Rawat Jalan";
														}elseif($data['TEMKER']=="3") {
															echo"Rawat Khusus";
														}elseif($data['TEMKER']=="4") {
															echo"Kegawatdaruratan";
														} ?></td>
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
						</div>
					</div>
				</div>
			</div>
			<div id="104" class="tab_content">
				&nbsp&nbsp&nbsp <b>Jumlah perawat yang mengajukan pindah/keluar dari institusi per tahun</b> <br><br>
				<?$sql="SELECT * FROM m_perawat WHERE tglmutasi is not null and year(tglmutasi) = year(now())";
				$rs = mysql_query($sql);
				if(!$rs) die(mysql_error()); ?>
				&nbsp&nbsp&nbsp Perawat yang mengajukan pindah&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
				<?$sql="SELECT * FROM m_perawat WHERE tglkeluar is not null and year(tglkeluar) = year(now())";
				$rs = mysql_query($sql);
				if(!$rs) die(mysql_error()); ?>
				&nbsp&nbsp&nbsp Perawat yang mengajukan keluar&nbsp : &nbsp <? echo mysql_num_rows($rs);?><br>
			</div>
			<div id="105" class="tab_content">
				<ul class="tabs2">
					<li><span id="#231">Program peningkatan pendidikan formal keperawatan</span></li>
					<li><span id="#232">Program pengembangan tenaga perawat informal</span></li>
				</ul>
				<div class="tab_container2">
					<div id="231" class="tab_content2">
						<ul class="tabs3">
							<li><span id="#341">DIII Keperawatan</span></li>
							<li><span id="#342">S1 Keperawatan + Ners</span></li>
							<li><span id="#343">S2 Keperawatan</span></li>
							<li><span id="#344">Spesialis Keperawatan</span></li>
							<li><span id="#345">S3 Keperawatan</span></li>
						</ul>
						<div class="tab_container3">
							<div id="341" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENDIDIKAN = '1'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENDIDIKAN = '1'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="342" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENDIDIKAN = '2'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENDIDIKAN = '2'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="343" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENDIDIKAN = '3'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENDIDIKAN = '3'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="344" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENDIDIKAN = '4'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENDIDIKAN = '4'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="345" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENDIDIKAN = '5'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENDIDIKAN = '5'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
					<div id="232" class="tab_content2">
						<ul class="tabs3">
							<li><span id="#351">Pelatihan</span></li>
							<li><span id="#352">Seminar/Workshop/Lokakarya</span></li>
							<li><span id="#353">Inhouse training</span></li>
							<li><span id="#354">Sosialisasi</span></li>
						</ul>
						<div class="tab_container3">
							<div id="351" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENG like '1%'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENG like '1%'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="352" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENG like '%2%'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENG like '%2%'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="353" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENG like '%3%'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENG like '%3%'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
							<div id="354" class="tab_content3">
								<?$sql="SELECT a.* FROM m_perawat a WHERE a.PROGPENG like '%4%'";
								$sql1="SELECT count(*) FROM m_perawat a WHERE a.PROGPENG like '%4%'";
								$page=1;
								$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=sdm_kep&");
								$rs = $pager->paginate();
								if(!$rs) die(mysql_error());?>
								&nbsp&nbsp&nbspJumlah	&nbsp : &nbsp <? echo mysql_num_rows($rs);?>
								<table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Perawat.">
									<tr align="center">
										<th width="5%">No</th>
										<th width="5%">NIP</th>
										<th width="20%"> Nama</th>
										<th width="20%">Unit / Ruang Rawat</th>										
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
										<td><? echo $data['NIP']; ?></td>
										<td><? echo $data['NAMA']; ?></td>
										<td><? if($data['TEMKER']=="1") {
													echo"Rawat Inap";
												}elseif($data['TEMKER']=="2") {
													echo"Rawat Jalan";
												}elseif($data['TEMKER']=="3") {
													echo"Rawat Khusus";
												}elseif($data['TEMKER']=="4") {
													echo"Kegawatdaruratan";
												} ?></td>
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
				</div>
			</div>
    	</div>
    	<br clear="all" />
    	<!--<input type="button" name="simpan" value="S I M P A N" id="simpan" class="text" />-->
    	</form>
		</div>
	</div>
	<br clear="all" />
</div>