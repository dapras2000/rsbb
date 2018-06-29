<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';
	
	$kode = $_GET[id];
	$bln = $_GET[bln];
	$koders = $_GET[koders];
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;

	$sql_x = '' . 'select a.j_pkm,a.code_list,b.concate,b.description,a.0_6l as l6,a.0_6p as p6,a.7_28l as l28,a.7_28p as p28,a.29h_1thl as l1th,a.29h_1thp as p1th,a.1th_4thl as l4th,a.1th_4thp as p4th,a.5th_14thl as l14th,a.5th_14thp as p14th,a.15th_24thl as l24th,a.15th_24thp as p24th,a.25th_44thl as l44th,a.25th_44thp as p44th,a.45th_64thl as l64th,a.45th_64thp as p64th,a.65thl as l65th,a.65thp as p65th from rl41 a left join m_rl411 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.bulan=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	$hasil_x = mysql_query( $sql_x );
	$row_x = mysql_fetch_array( $hasil_x );

	$total_l = $row_x[l6] & $row_x[l28] & $row_x[l1th] & $row_x[l4th] & $row_x[l14th] & $row_x[l24th] & $row_x[l44th] & $row_x[l64th] & $row_x[l65th];
	$total_p = $row_x[p6] & $row_x[p28] & $row_x[p1th] & $row_x[p4th] & $row_x[p14th] & $row_x[p24th] & $row_x[p44th] & $row_x[p64th] & $row_x[p65th];
	$total_all = $total_l & $total_p;
echo'<html>
<head>';
	echo '<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>
		  <script type="text/javascript" src="'._BASE_.'/include/jquery-1.3.2.js"></script>
		  <script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
		  <link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />
		  <script type="text/javascript">
				$(document).ready(function() {
	  	 			
	  				$("#tbl_reg1").hide();
					cari();
   	  				$(".tr_s:odd").addClass("ganjil");
        			$(".tr_s:even").addClass("genap");
					$(".tr_p:odd").addClass("ganjil1");
        			$(".tr_p:even").addClass("genap1");
        			$("th").parent().addClass("tbheading");
   		 		});  
    	  </script>
		  
		  <script type="text/javascript">
				function entri(){
	 				$("#tbl_reg1").show();
	 				$("#entri").hide();
	 			}
	
				function update(){
					$("#tbl_reg1").show();
	 				$("#entri").hide();
	 			}

				function hitung(){
					document.getElementById(\'t1\').disabled=true;
					document.getElementById(\'t1\').backgroundColor=\'#ccccc\';
					document.getElementById(\'t1\').value=eval(document.getElementById(\'l1\').value)+eval(document.getElementById(\'l2\').value)+eval(document.getElementById(\'l3\').value)+eval(document.getElementById(\'l4\').value)+eval(document.getElementById(\'l5\').value)+eval(document.getElementById(\'l6\').value)+eval(document.getElementById(\'l7\').value)+eval(document.getElementById(\'l8\').value)+eval(document.getElementById(\'l9\').value);
					hitung3();
				}

				function hitung2(){
					document.getElementById(\'t2\').disabled=true;
					document.getElementById(\'t2\').backgroundColor=\'#ccccc\';
					document.getElementById(\'t2\').value=eval(document.getElementById(\'p1\').value)+eval(document.getElementById(\'p2\').value)+eval(document.getElementById(\'p3\').value)+eval(document.getElementById(\'p4\').value)+eval(document.getElementById(\'p5\').value)+eval(document.getElementById(\'p6\').value)+eval(document.getElementById(\'p7\').value)+eval(document.getElementById(\'p8\').value)+eval(document.getElementById(\'p9\').value);
					hitung3();
				}

				function hitung3(){
					document.getElementById(\'t3\').disabled=true;
					document.getElementById(\'t3\').backgroundColor=\'#ccccc\';
					document.getElementById(\'t3\').value=eval(document.getElementById(\'t1\').value)+eval(document.getElementById(\'t2\').value);
				}
		  </script>
		  <script type="text/javascript">
				$().ready(function() {	
					$("#dtd").autocomplete("proses2.php", 
					{
					width: 150
  				});

				$("#dtd").result(function(event, data, formatted) {
					$(\'#dtd1\').val(data); 
				});
	
			});
		  </script>
		  <script type="text/javascript">
   				function cek(){
					document.getElementById(\'l1\').value=0;
					document.getElementById(\'l2\').value=0;
					document.getElementById(\'l3\').value=0;
					document.getElementById(\'l4\').value=0;
					document.getElementById(\'l5\').value=0;
					document.getElementById(\'l6\').value=0;
					document.getElementById(\'l7\').value=0;
					document.getElementById(\'l8\').value=0;
					document.getElementById(\'l9\').value=0;
					document.getElementById(\'p1\').value=0;
					document.getElementById(\'p2\').value=0;
					document.getElementById(\'p3\').value=0;
					document.getElementById(\'p4\').value=0;
					document.getElementById(\'p5\').value=0;
					document.getElementById(\'p6\').value=0;
					document.getElementById(\'p7\').value=0;
					document.getElementById(\'p8\').value=0;
					document.getElementById(\'p9\').value=0;
					document.getElementById(\'t1\').value=0;
					document.getElementById(\'t2\').value=0;
					document.getElementById(\'t3\').value=0;
					document.getElementById(\'pkm\').value=0;
					document.getElementById(\'dtd1\').value="";
					lst();
				}

				function aktif(){
					if($(\'#dtd1\').val()=="A33"){
						document.getElementById(\'l1\').disabled=false;
						document.getElementById(\'l1\').backgroundColor=\'\';
						document.getElementById(\'l2\').disabled=false;
						document.getElementById(\'l2\').backgroundColor=\'\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=true;
						document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l5\').disabled=true;
						document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l6\').disabled=true;
						document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l7\').disabled=true;
						document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l8\').disabled=true;
						document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l9\').disabled=true;
						document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p1\').disabled=false;
						document.getElementById(\'p1\').backgroundColor=\'\';
						document.getElementById(\'p2\').disabled=false;
						document.getElementById(\'p2\').backgroundColor=\'\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=true;
						document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p5\').disabled=true;
						document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p6\').disabled=true;
						document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p7\').disabled=true;
						document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p8\').disabled=true;
						document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p9\').disabled=true;
						document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
					} else if ($(\'#dtd1\').val()=="A34-A35"){
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l3\').disabled=false;
						document.getElementById(\'l3\').backgroundColor=\'\';
						document.getElementById(\'l4\').disabled=false;
						document.getElementById(\'l4\').backgroundColor=\'\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=false;
						document.getElementById(\'p3\').backgroundColor=\'\';
						document.getElementById(\'p4\').disabled=false;
						document.getElementById(\'p4\').backgroundColor=\'\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="A50"){
						document.getElementById(\'l1\').disabled=false;
						document.getElementById(\'l1\').backgroundColor=\'\';
						document.getElementById(\'l2\').disabled=false;
						document.getElementById(\'l2\').backgroundColor=\'\';		
						document.getElementById(\'l3\').disabled=false;
						document.getElementById(\'l3\').backgroundColor=\'\';
						document.getElementById(\'l4\').disabled=false;
						document.getElementById(\'l4\').backgroundColor=\'\';
						document.getElementById(\'l5\').disabled=true;
						document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l6\').disabled=true;
						document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l7\').disabled=true;
						document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l8\').disabled=true;
						document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l9\').disabled=true;
						document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p1\').disabled=false;
						document.getElementById(\'p1\').backgroundColor=\'\';
						document.getElementById(\'p2\').disabled=false;
						document.getElementById(\'p2\').backgroundColor=\'\';				
						document.getElementById(\'p3\').disabled=false;
						document.getElementById(\'p3\').backgroundColor=\'\';
						document.getElementById(\'p4\').disabled=false;
						document.getElementById(\'p4\').backgroundColor=\'\';
						document.getElementById(\'p5\').disabled=true;
						document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p6\').disabled=true;
						document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p7\').disabled=true;
						document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p8\').disabled=true;
						document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p9\').disabled=true;
						document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
					} else if($(\'#dtd1\').val()=="A52-A53") {
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=true;
						document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=true;
						document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="A55-A56" && $(\'#dtd1\').val()=="A57-A64"){
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=false;
						document.getElementById(\'l4\').backgroundColor=\'\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=false;
						document.getElementById(\'p4\').backgroundColor=\'\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="C53" || $(\'#dtd1\').val()=="C54" || $(\'#dtd1\').val()=="C55" || $(\'#dtd1\').val()=="C56" || $(\'#dtd1\').val()=="C58" || $(\'#dtd1\').val()=="C51-C52.C57" || $(\'#dtd1\').val()=="D06" || $(\'#dtd1\').val()=="d25" || $(\'#dtd1\').val()=="d27" || $(\'#dtd1\').val()=="N70" || $(\'#dtd1\').val()=="N72" || $(\'#dtd1\').val()=="N73" || $(\'#dtd1\').val()=="N75.0.1" || $(\'#dtd1\').val()=="N71, N74, N75.8-N77" || $(\'#dtd1\').val()=="N80" || $(\'#dtd1\').val()=="N81" || $(\'#dtd1\').val()=="N83" || $(\'#dtd1\').val()=="N91.0.1.2" || $(\'#dtd1\').val()=="N92.0.1" || $(\'#dtd1\').val()=="Q50-Q52") {
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=true;
						document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l5\').disabled=true;
						document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l6\').disabled=true;
						document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l7\').disabled=true;
						document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l8\').disabled=true;
						document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l9\').disabled=true;
						document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p1\').disabled=false;
						document.getElementById(\'p1\').backgroundColor=\'\';
						document.getElementById(\'p2\').disabled=false;
						document.getElementById(\'p2\').backgroundColor=\'\';				
						document.getElementById(\'p3\').disabled=false;
						document.getElementById(\'p3\').backgroundColor=\'\';
						document.getElementById(\'p4\').disabled=false;
						document.getElementById(\'p4\').backgroundColor=\'\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="C60" || $(\'#dtd1\').val()=="C61" || $(\'#dtd1\').val()=="C62" || $(\'#dtd1\').val()=="C63" || $(\'#dtd1\').val()=="N40" || $(\'#dtd1\').val()=="N41-N42" || $(\'#dtd1\').val()=="N43" || $(\'#dtd1\').val()=="N47" || $(\'#dtd1\').val()=="N44-N46, N48-N51" || $(\'#dtd1\').val()=="Q54-Q56"){
						document.getElementById(\'l1\').disabled=false;
						document.getElementById(\'l1\').backgroundColor=\'\';
						document.getElementById(\'l2\').disabled=false;
						document.getElementById(\'l2\').backgroundColor=\'\';		
						document.getElementById(\'l3\').disabled=false;
						document.getElementById(\'l3\').backgroundColor=\'\';
						document.getElementById(\'l4\').disabled=false;
						document.getElementById(\'l4\').backgroundColor=\'\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=true;
						document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p5\').disabled=true;
						document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p6\').disabled=true;
						document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p7\').disabled=true;
						document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p8\').disabled=true;
						document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p9\').disabled=true;
						document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
					} else if($(\'#dtd1\').val()=="F53.0" || $(\'#dtd1\').val()=="O03" || $(\'#dtd1\').val()=="O04" || $(\'#dtd1\').val()=="O00" || $(\'#dtd1\').val()=="O01" || $(\'#dtd1\').val()=="O05" || $(\'#dtd1\').val()=="O02.O06-O08" || $(\'#dtd1\').val()=="O14" || $(\'#dtd1\').val()=="O15" || $(\'#dtd1\').val()=="O10-O13.O16" || $(\'#dtd1\').val()=="O44" || $(\'#dtd1\').val()=="O45" || $(\'#dtd1\').val()=="O46" || $(\'#dtd1\').val()=="O30" || $(\'#dtd1\').val()=="O40" || $(\'#dtd1\').val()=="O42" || $(\'#dtd1\').val()=="O48" || $(\'#dtd1\').val()=="O31-O39, O41, 043, 047" || $(\'#dtd1\').val()=="O64-O66" || $(\'#dtd1\').val()=="O72" || $(\'#dtd1\').val()=="O24" || $(\'#dtd1\').val()=="O60" || $(\'#dtd1\').val()=="O68" || $(\'#dtd1\').val()=="O84" || $(\'#dtd1\').val()=="O20-O23. 025-O29, O61-O63. O67, O69-71, O73-O75. 081-O83" || $(\'#dtd1\').val()=="080" || $(\'#dtd1\').val()=="O85-O99" || $(\'#dtd1\').val()=="Z34" || $(\'#dtd1\').val()=="Z35" || $(\'#dtd1\').val()=="Z36" || $(\'#dtd1\').val()=="Z39" || $(\'#dtd1\').val()=="O85-O99"){
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=true;
						document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l5\').disabled=true;
						document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l6\').disabled=true;
						document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l7\').disabled=true;
						document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l8\').disabled=true;
						document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l9\').disabled=true;
						document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=true;
						document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="G20" || $(\'#dtd1\').val()=="Z46.3"){
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=true;
						document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=true;
						document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="G43-G44"){
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=true;
						document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l4\').disabled=false;
						document.getElementById(\'l4\').backgroundColor=\'\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=true;
						document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p4\').disabled=false;
						document.getElementById(\'p4\').backgroundColor=\'\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} else if($(\'#dtd1\').val()=="K02" || $(\'#dtd1\').val()=="K00-K01" || $(\'#dtd1\').val()=="K03"){
						document.getElementById(\'l1\').disabled=true;
						document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l2\').disabled=true;
						document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
						document.getElementById(\'l3\').disabled=false;
						document.getElementById(\'l3\').backgroundColor=\'\';
						document.getElementById(\'l4\').disabled=false;
						document.getElementById(\'l4\').backgroundColor=\'\';
						document.getElementById(\'l5\').disabled=false;
						document.getElementById(\'l5\').backgroundColor=\'\';
						document.getElementById(\'l6\').disabled=false;
						document.getElementById(\'l6\').backgroundColor=\'\';
						document.getElementById(\'l7\').disabled=false;
						document.getElementById(\'l7\').backgroundColor=\'\';
						document.getElementById(\'l8\').disabled=false;
						document.getElementById(\'l8\').backgroundColor=\'\';
						document.getElementById(\'l9\').disabled=false;
						document.getElementById(\'l9\').backgroundColor=\'\';
						document.getElementById(\'p1\').disabled=true;
						document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p2\').disabled=true;
						document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
						document.getElementById(\'p3\').disabled=false;
						document.getElementById(\'p3\').backgroundColor=\'\';
						document.getElementById(\'p4\').disabled=false;
						document.getElementById(\'p4\').backgroundColor=\'\';
						document.getElementById(\'p5\').disabled=false;
						document.getElementById(\'p5\').backgroundColor=\'\';
						document.getElementById(\'p6\').disabled=false;
						document.getElementById(\'p6\').backgroundColor=\'\';
						document.getElementById(\'p7\').disabled=false;
						document.getElementById(\'p7\').backgroundColor=\'\';
						document.getElementById(\'p8\').disabled=false;
						document.getElementById(\'p8\').backgroundColor=\'\';
						document.getElementById(\'p9\').disabled=false;
						document.getElementById(\'p9\').backgroundColor=\'\';														
					} if($(\'#dtd1\').val()=="P00-P04" || $(\'#dtd1\').val()=="P05-P07" || $(\'#dtd1\').val()=="P10-P15" || $(\'#dtd1\').val()=="P20-P21" || $(\'#dtd1\').val()=="P22-P28" || $(\'#dtd1\').val()=="P35-P37" || $(\'#dtd1\').val()=="P38-P39" || $(\'#dtd1\').val()=="P55" || $(\'#dtd1\').val()=="P95" || $(\'#dtd1\').val()=="P08, P29, P50-54, P56-P94, P96" || $(\'#dtd1\').val()=="R95"){
						document.getElementById(\'l1\').disabled=false;
						document.getElementById(\'l1\').backgroundColor=\'\';
						document.getElementById(\'l2\').disabled=false;
						document.getElementById(\'l2\').backgroundColor=\'\';		
						document.getElementById(\'l3\').disabled=false;
						document.getElementById(\'l3\').backgroundColor=\'\';
						document.getElementById(\'l4\').disabled=true;
						document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l5\').disabled=true;
						document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l6\').disabled=true;
						document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l7\').disabled=true;
						document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l8\').disabled=true;
						document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'l9\').disabled=true;
						document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p1\').disabled=false;
						document.getElementById(\'p1\').backgroundColor=\'\';
						document.getElementById(\'p2\').disabled=false;
						document.getElementById(\'p2\').backgroundColor=\'\';				
						document.getElementById(\'p3\').disabled=false;
						document.getElementById(\'p3\').backgroundColor=\'\';
						document.getElementById(\'p4\').disabled=true;
						document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p5\').disabled=true;
						document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p6\').disabled=true;
						document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p7\').disabled=true;
						document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p8\').disabled=true;
						document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
						document.getElementById(\'p9\').disabled=true;
						document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
					}
				}
			</script>
			<script>
   				function cari(){
					$.post(\'ambildata.php\',
						{   \'reqdata\'   :\'cari_rl41\',
                            \'koders\'   :$(\'#koders\').val(),
                            \'bln\'     :$(\'#bln\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
						function (data) {
							$(\'#hasil\').html(data);
						}
					);
				};
  
  				function lst(){
 					$.post(\'ambildata.php\',
						{   \'reqdata\'   :\'cari_code\',
                            \'code\'   :$(\'#dtd\').val()
                        },
						function (data) {
							$(\'#dtd1\').val(data);
						aktif();
						}
					);
				};
			</script>
			<script>
   				function get_xml(){
					$.post(\'ambildata.php\',
						{   \'reqdata\'   :\'xml_rl41\',
                            \'koders\'   :$(\'#koders\').val(),
                            \'bln\'     :$(\'#bln\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						},
						function (data) {
							$(\'#hasil\').html(data);
						}
					);
				};
			</script>
			<script>
   				function save(){
					if($(\'#dtd\').val()==""){
						alert(\'Jenis Pelayanan Belum Diisi\');
   						$(\'#dtd\').focus();
						return false;
					}
					if($(\'#dtd1\').val()==""){
						alert(\'DTD Masih Kosong, Tekan enter pada Kolom DTD\');
   						$(\'#dtd\').focus();
						return false;
					}
					if($(\'#tahun\').val()==""){
						alert(\'Tahun Belum Diisi\');
   						$(\'#tahun\').focus();
					return false;
					}
					if($(\'#bln\').val()==""){
						alert(\'Bulan Belum Diisi\');
   						$(\'#bln\').focus();
						return false;
					}
					$.post(\'ambildata.php\',
						{   \'reqdata\'   :\'save_rl41\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahun\'   :$(\'#tahun\').val(),
							\'pelayanan\'   :$(\'#dtd1\').val(),
							\'l1\'   :$(\'#l1\').val(),
							\'l2\'   :$(\'#l2\').val(),
							\'l3\'   :$(\'#l3\').val(),
							\'l4\'   :$(\'#l4\').val(),
							\'l5\'   :$(\'#l5\').val(),
							\'l6\'   :$(\'#l6\').val(),
							\'l7\'   :$(\'#l7\').val(),
							\'l8\'   :$(\'#l8\').val(),
							\'l9\'   :$(\'#l9\').val(),
							\'p1\'   :$(\'#p1\').val(),
							\'p2\'   :$(\'#p2\').val(),
							\'p3\'   :$(\'#p3\').val(),
							\'p4\'   :$(\'#p4\').val(),
							\'p5\'   :$(\'#p5\').val(),
							\'p6\'   :$(\'#p6\').val(),
							\'p7\'   :$(\'#p7\').val(),
							\'p8\'   :$(\'#p8\').val(),
							\'p9\'   :$(\'#p9\').val(),
							\'pkm\'   :$(\'#pkm\').val(),							
							\'koders\'   :$(\'#koders\').val()
			  			},
			    		function (data) {
							$(\'#hasil\').html(data);
						}
					);	
				}	
				function cancel(){
					window.location.replace("'._BASE_.'index.php?link=rl41");
				}
			</script>	
			<style>
		        #tbl_rs {	width:1220px;
							
		                    border-collapse:collapse; 
		                    background-color:white;
		                    font: 12px verdana; 
		                    border: 1px solid gray; 
							border-bottom:3px solid grey;
							border-right:3px solid grey;
		                    border-spacing:0px; 
		                    padding:3px
		                }
				#tbl_reg 
		                {	
							width:1024px;
		                    border-collapse:collapse; 
		                    background-color:white;
		                    font: 10px verdana; 
							border: 1px solid gray;
	                    
	                    }
		 		#tbl_reg1 
	                    {	
							width:900px;
		                    border-collapse:collapse; 
		                    background-color:white;
		                    font: 10px verdana;
	                	}			
				#tbl_reg2
	                	{	
							width:650px;
		                    border-collapse:collapse; 
		                    background-color:white;
		                    font: 12px verdana; 
							border: 1px solid gray;
		               }
	
				td{	padding:5px;}
				.td_d{padding-left:50px}
				#tr_d
					{
						background : #39b54a;
						BORDER-TOP: 1px solid grey;"
					}
				.rest{ font:10px; color:red;}
 				#teks{ 
				    opacity:0.92; 
				    position: absolute;
				    top: 90px;
				    left: auto;
				}
			</style>
			<style>
			    .ganjil { 
			      background-color:#39b54a; /* baris ganjil berwarna hijau muda */ 
			    }
			    .genap { 
			      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
			    }
				.ganjil1 { 
			      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
			    }
			    .genap1 { 
			      background-color:#39b54a; /* baris genap berwarna hijau tua */ 
			    }   
			    .tbheading { 
		      	background-color:#f1fe1b; 
			 
			 	 /* baris genap berwarna hijau tua */ } 
		       
		    </style>
</head>

<body bgcolor="#fff">
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Laporan RL 4.1</h3></div>
		<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
			<tr class=\'tr_s\'>
				<td colspan=2>
					<table id=\'tbl_reg\' name=\'tbl_reg\'>
						<tr class=\'tr_s\'>
							<td colspan=6>
								<strong>Periode :</strong>
							</td>
						</tr>
						<tr class=\'tr_s\'>
						<td class=\'td_d\'>
							Bulan :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
							echo $kode_rs;
							echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
							echo '' . $kode;
							echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
							echo '' . $smt;
							echo '">';
							echo '<select id=\'bln\' name=\'bln\' onChange=\'cari()\'>
									<option value=""></option>
									<option value=1 ';

										if ($bln  == '1') {
											echo 'selected="selected"';
										}

										echo '>Januari</option>
									<option value=2 ';

										if ($bln  == '2') {
											echo 'selected="selected"';
										}

										echo '>Februari</option>
									<option value=3 ';

										if ($bln  == '3') {
											echo 'selected="selected"';
										}

										echo '>Maret</option>
									<option value=4 ';

										if ($bln  == '4') {
											echo 'selected="selected"';
										}

										echo '>April</option>
									<option value=5 ';

										if ($bln  == '5') {
											echo 'selected="selected"';
										}

										echo '>Mei</option>
									<option value=6 ';

										if ($bln  == '6') {
											echo 'selected="selected"';
										}

										echo '>Juni</option>
									<option value=7 ';

										if ($bln  == '7') {
											echo 'selected="selected"';
										}

										echo '>Juli</option>
									<option value=8 ';

										if ($bln  == '8') {
											echo 'selected="selected"';
										}

										echo '>Agustus</option>
									<option value=9 ';

										if ($bln  == '9') {
											echo 'selected="selected"';
										}

										echo '>September</option>
									<option value=10 ';

										if ($bln  == '10') {
											echo 'selected="selected"';
										}

										echo '>Oktober</option>
									<option value=11 ';

										if ($bln  == '11') {
											echo 'selected="selected"';
										}

										echo '>November</option>
									<option value=12 ';

										if ($bln  == '12') {
											echo 'selected="selected"';
										}

										echo '>Desember</option>
								</select>
						</td>
						<td class=\'td_d\'>Tahun :</td>
						<td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
							echo '' . $tahun;
							echo '">';
							echo '<select id=\'tahun\' name=\'tahun\'  onChange=\'cari()\'>
									<option value=""></option>
									<option value="2014" ';

										if ($tahun  == '2014') {
											echo 'selected="selected"';
										}

										echo '>2014</option>
									<option value="2015" ';

										if ($tahun  == '2015') {
											echo 'selected="selected"';
										}

										echo '>2015</option>
									<option value="2016" ';

										if ($tahun  == '2016') {
											echo 'selected="selected"';
										}

										echo '>2016</option>
									<option value="2017" ';

										if ($tahun  == '2017') {
											echo 'selected="selected"';
										}

										echo '>2017</option>
									<option value="2018" ';

										if ($tahun  == '2018') {
											echo 'selected="selected"';
										}

										echo '>2018</option>
									<option value="2019" ';

										if ($tahun  == '2019') {
											echo 'selected="selected"';
										}

										echo '>2019</option>
								</select>
							</td>
						</tr>
					</table>
					<div id=\'entri\'>
						<input type=\'button\' id=\'input\' value=\'Buat File Laporan\' onclick=\'get_xml()\'></div>
						<br>
				</td>
			</tr>
			<tr>
				<td colspan=2><div id=\'hasil\'></div>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>
</body>


</html>';
?>