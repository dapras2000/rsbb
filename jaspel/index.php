<? 
if($_SESSION['ROLES']!='24'){ 
?>
<script type="text/javascript" src="jaspel/ajakku.js"></script>
<div id="menu">
    	<div id="menu_nama">	
  		<div class="header">		
 <a href="jaspel_rj.php?page=1" onclick="processajax ('jaspel/jaspel_rj.php','pagecont','get',''); return false;">UNIT RAWAT JALAN</a>
 <a href="jaspel_ok.php?page=2" onclick="processajax ('jaspel/jaspel_ok.php','pagecont','get',''); return false;">UNIT  KAMAR OPERASI</a> 
 <a href="jaspel_ugd.php?page=3" onclick="processajax ('jaspel/jaspel_ugd.php','pagecont','get',''); return false;">VK UGD</a>
 <a href="jaspel_ranap.php?page=4" onclick="processajax ('jaspel/jaspel_ranap.php','pagecont','get',''); return false;">RAWAT  INAP</a>
 <a href="jaspel_lab.php?page=5" onclick="processajax ('jaspel/jaspel_lab.php','pagecont','get',''); return false;">LABORATORIUM</a>
 <a href="jaspel_rad.php?page=6" onclick="processajax ('jaspel/jaspel_rad.php','pagecont','get',''); return false;"> RADIOLOGI</a>
 <a href="jaspel_manajemen.php?page=7" onclick="processajax ('jaspel/jaspel_manajemen.php','pagecont','get',''); return false;">MANAJEMEN</a> <a href="jaspel_pendukung.php?page=8" onclick="processajax ('jaspel/jaspel_pendukung.php','pagecont','get',''); return false;">PENDUKUNG</a>
 		</div>
 		</div>
     </div>
<? } ?>


<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title">
      <h3>Jaspel</h3></div>

	<!-- Wrapper. -->

	<div class="wrapper">
		<!-- Content. -->
		<div class="content">
			<div class="pad" id="pagecont">
		  </div>			
		</div>
		<br style="clear: both;" />
	</div>

	</div>
</div>