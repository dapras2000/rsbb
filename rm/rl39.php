<?php
    error_reporting( 'E_ALL' );
    session_start(  );
    include( '../include/connect.php' );

    $kode = $_GET[id];
    $smt = $_GET[smt];
    $koders = $_GET[koders];
    $tahun = $_GET[tahun];
    $bln = $_GET[bln];
    $kode_rs = $KDRS;


	$sql_x = '' . 'select a.code_list,b.description,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.swasta,a.umum from rl39 a left join m_rl39 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	$hasil_x = mysql_query( $sql_x );
	$row_x = mysql_fetch_array( $hasil_x );
	
	$total_jkn = $row_x[pbi];
	$total_lain = $total_jkn + $row_x[jamkesda] + $row_x[swasta] + $row_x[umum];
	$j_penggunaan = $row_x[rj] + $row_x[ri] + $row_x[igd];


	echo '<html>
	<head>';

	echo '<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>';
    echo '<script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />';

	echo '<script type="text/javascript">
      $(document).ready(function() {
	  	$("#menu").hide();
	  	$("#tbl_reg1").hide();

	  	$("#tag_bulan").hide();
	  	$("#lbl_bulan").hide();

	  cari();
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");';
	
	echo '});  
    </script>';


	echo '<script type="text/javascript">
	function update(){
		$("#tbl_reg1").show();
		$("#entri").hide();

		$("#tag_bulan").show();
	  	$("#lbl_bulan").show();
	  	$("#tag_semester").hide();
	  	$("#lbl_semester").hide();
	}
	</script>';

	echo '<script type="text/javascript">
	function entri(){
	  $("#tbl_reg1").show();
	  $("#file_xml").hide();
	  
	  $("#tag_bulan").show();
	  $("#lbl_bulan").show();
	  $("#tag_semester").hide();
	  $("#lbl_semester").hide();

	cek2();
	 }


	function hitung(){
		document.getElementById(\'j_penggunaan\').disabled=true;
		document.getElementById(\'j_penggunaan\').backgroundColor=\'#ccccc\';
		document.getElementById(\'j_penggunaan\').value=ev';
	echo 'al(document.getElementById(\'rj\').value)+eval(document.getElementById(\'ri\').value)+eval(document.getElementById(\'igd\').value);
				}
		
	function hitung3(){
		document.getElementById(\'lainnya\').disabled=true;
		document.getElementById(\'lainnya\').backgroundColor=\'#ccccc\';
		document.getElementById(\'lainnya\').value=eval(document.getElementById(\'jamkesda\').value)+eval(document.getElementById(\'sw';
	echo 'asta\').value)+eval(document.getElementById(\'umum\').value)+eval(document.getElementById(\'pbi\').value);
				}			

	</script>';

	echo '<script type=\'text/javascript\' src="include/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="include/css/jquery.autocomplete.css" />';

	echo '<script type="text/javascript">
   function cek(){
  if($(\'#pelayanan\').val()=="1"){
document.getElementById(\'pengadaan\').backgroundColor=\'#ccccc\';
document.getElementById(\'pengadaan\').disabled=true;
document.getElementById(\'rj\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'rj\').disabled=true;
document.getElementById(\'ri\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'';
	echo 'ri\').disabled=true;
document.getElementById(\'igd\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'igd\').disabled=true;
document.getElementById(\'j_penggunaan\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'pbi\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'pbi\').disabled=true;
document.getElementById(\'jkn\').style.backgroundColor=\'#ccccc\';
document.getElementB';
	echo 'yId(\'jamkesda\').backgroundColor=\'#ccccc\';
document.getElementById(\'jamkesda\').disabled=true;
document.getElementById(\'swasta\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'swasta\').disabled=true;
document.getElementById(\'umum\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'umum\').disabled=true;
document.getElementById(\'lainnya\').style.backgroundColor=\'#ccccc\';

}
else{
document.getElementById(\'pengadaan\').disabled=false;
document.getElementById(\'rj\').disabled=false;
document.getElementById(\'ri\').disabled=false;
document.getElementById(\'igd\').disabled=false;
document.getElementById(\'pbi\').disabled=false;
document.getElementById(\'non_pbi\')';
	echo '.disabled=false;
document.getElementById(\'jamkesda\').disabled=false;
document.getElementById(\'swasta\').disabled=false;
document.getElementById(\'umum\').disabled=false;
document.getElementById(\'j_resep\').backgroundColor=\'#ccccc\';
document.getElementById(\'j_resep\').disabled=true;
document.getElementById(\'j_resep\').value=0;
document.getElementB';
	echo 'yId(\'pengadaan\').value=0;
document.getElementById(\'j_penggunaan\').value=0;
document.getElementById(\'rj\').value=0;
document.getElementById(\'ri\').value=0;
document.getElementById(\'igd\').value=0;
document.getElementById(\'pbi\').value=0;
document.getElementById(\'jamkesda\').value=0;
document.getElementById(\'swasta\').value=0;
document.getElementById(\'umum\').value=0;
document.getElementById(\'grat';
	echo 'is\').value=0;
document.getElementById(\'lainnya\').value=0;
}

}
function cek2(){ 
 if($(\'#pelayanan\').val()=="1"){
document.getElementById(\'pengadaan\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'pengadaan\').disabled=true;
document.getElementById(\'rj\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'rj\').disabled=true;
document.getElementById(\'ri\').style.backgroundC';
	echo 'olor=\'#ccccc\';
document.getElementById(\'ri\').disabled=true;
document.getElementById(\'igd\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'igd\').disabled=true;
document.getElementById(\'j_penggunaan\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'pbi\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'pbi\').disabled=true;
document.getElementById(\'jamkesda\').style.b';
	echo 'ackgroundColor=\'#ccccc\';
document.getElementById(\'jamkesda\').disabled=true;
document.getElementById(\'swasta\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'swasta\').disabled=true;
document.getElementById(\'umum\').style.backgroundColor=\'#ccccc\';
document.getElementById(\'umum\').disabled=true;
document.getElementById(\'lainnya\').style.backgroundColor=\'#ccccc\';

}
}
</script>';
	echo '<script>
   function cari(){
$.post(\'rm/ambildata_rl39.php\',
			{   \'reqdata\'   :\'cari_rl39\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smtr\'     :$(\'#smt\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>

';
	echo '<script>
   function get_xml(){
   	$("#tbl_reg1").hide();
   	$("#tag_bulan").hide();
    $("#lbl_bulan").hide();
    $("#tag_semester").show();
    $("#lbl_semester").show();
$.post(\'rm/ambildata_rl39.php\',
			{   \'reqdata\'   :\'xml_rl39\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smtr\'     :$(\'#smt\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>
	
';
	echo '<script>
   function save(){
if($(\'#pelayanan\').val()==""){
alert(\'Jenis Pelayanan Belum Diisi\');
   	$(\'#pelayanan\').focus();
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

	$.post(\'rm/ambildata_rl39.php\',
			{   \'reqdata\' ';
	echo '  :\'save_rl39\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahun\'   :$(\'#tahun\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'j_resep\'   :$(\'#j_resep\').val(),
							\'pengadaan\'   :$(\'#pengadaan\').val(),
							\'rj\'   :$(\'#rj\').val(),
							\'ri\'   :$(\'#ri\').val(),
							\'igd\'   :$(\'#igd\').val(),
							\'pbi\'   :$(\'#pbi\').val(),
							\'jamkesda\'   :$(\'';
	echo '#jamkesda\').val(),
							\'swasta\'   :$(\'#swasta\').val(),
							\'umum\'   :$(\'#umum\').val(),
							\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
}

function cancel(){
	window.location = "'._BASE_.'/index.php?link=rl39";
}

</script>';

	echo '<style>
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
   ';
	echo '     #tbl_reg {	
					width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;
                    
                    }
		 #tbl_reg1 {	
					width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    fo';
	echo 'nt: 12px verdana; 
					
                    
                    }			
					
		#tbl_reg2 {	
					width:650px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;
                    
                    }
	
		td		{	padding:5px;}
		.td_d{padding-left:50px}
		#tr_d{
		backgro';
	echo 'und : #39b54a;
		BORDER-TOP: 1px solid grey;"}
	
		
		
						
		.rest{ font:10px; color:red;}

	#teks{ 
    opacity:0.92; 
    position: absolute;
    top: 40px;
    left: 1024px;
	
}
	</style>
	';
	echo '<s';
	echo 'tyle>
    .ganjil { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#39b54a; /* baris genap berwarna hijau tua */ 
    }
	.ganjil1 { 
      background-color:#39b54a; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }   
    .tbheadin';
	echo 'g { 
      background-color:#f1fe1b; 
	 
	  /* baris genap berwarna hijau tua */ } 
       
    </style>
</head>

<body bgcolor="#fff">

<div id="frame">
    <div id="frame_title"><h3>Laporan RL 3.9</h3></div>

<div align="center">
<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
<td colspan=2><table id=\'tbl_reg\' name=\'tbl_reg\'>
<tr class=\'tr_s\'><td colspan=6>';
	echo '<font color="white"><strong>Periode :</strong></font></td></tr>
<tr class=\'tr_s\'>



<td class=\'td_d\'>
	<div id="lbl_semester">Semester :</div>
	<div id="lbl_bulan">Bulan :</div>
</td>
<td>
<input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';echo $kode_rs;echo '\'>
<input type=\'hidden\' id=\'kode\' name=\'kode\' value="';echo '' . $kode;echo '">
<input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';echo '' . $smt;echo '">';
echo '


<div id=\'tag_semester\'>
<select id=\'smt\' name=\'smt\' onChange=\'cari()\'>
<option value=""></option>
	<option value=1 ';if ($bln  == '1') {echo 'selected="selected"';}echo '>I</option>
	<option value=2 ';if ($bln  == '2') {echo 'selected="selected"';}echo '>II</option>
</select>
</div>



<div id=\'tag_bulan\'>
<select id=\'bln\' name=\'bln\'>
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
	echo '>Februai</option>
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
</div>

</td>






<td class=\'td_d\'>Tahun :</td><td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
	echo '' . $tahun;
	echo '">';
	echo '<s';
	echo 'elect id=\'tahun\' name=\'tahun\'  onChange=\'cari()\'>
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
<!--
<td class=\'td_d\'>Jumlah Hari 1 Periode :</td>
<td class=\'td_d\'><input type=\'text\' id=\'j_hari\' name=\'j_hari\' value="';
	echo '' . $row_x['j_hari'];
	echo '" size=3 onchange=\'hitung()\' ></td>-->
</tr>
</table>


<div id=\'entri\'>
<input type=\'button\' id=\'input\' value=\'Entri Data\' onclick=\'entri()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'input\' value=\'Buat XML File\' onclick=\'get_xml()\'>
</div>

<form name=\'irna\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=15>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jenis Pelayanan</th><th rowspan=2  style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Lembar Resep</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pengadaan (R/)</th><th colspan=4 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Penggunaan (R/)</th>
<th colspa';
	echo 'n=6 style=\'background:#39b54a;border:1px solid grey;\'>Cara Bayar</th>
</tr>
<tr><th style=\'background:#39b54a;border:1px solid grey;\'> Rawat Jalan</th><th style=\'background:#39b54a;border:1px solid grey;\'>Rawat Inap</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>IGD</th><th style=\'background:#39b54a;border:1px solid grey;\'>Total</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>BPJS</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jamkesda</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Lain Lain</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Umum</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Total</th>
</tr>
<tr><td style=\'background:#fffff;border:1px solid grey;\'>';
	echo '<s';
	echo 'elect id=\'pelayanan\' name=\'pelayanan\' style=\'font-size:10px\'; onChange=\'cek()\'>
<option value="';
	echo '' . $row_x['code_list'];
	echo '">';
	echo '' . $row_x['code_list'] . '&nbsp;-&nbsp;' . $row_x['description'];
	echo '</option>
';
	$sql = 'select code_list,description from m_rl39 order by code_list';
	
	$hasil = mysql_query( $sql);
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_resep\' name=\'j_resep\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[j_resep]) {
		echo '' . 'value=' . $row_x['j_resep'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'pengadaan\' name=\'pengadaan\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[pengadaan]) {
		echo '' . 'value=' . $row_x['pengadaan'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'rj\' name=\'rj\' size=3  onchange=\'hitung()\' ';

	if (1 <= $row_x[rj]) {
		echo '' . 'value=' . $row_x['rj'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'ri\' name=\'ri\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[ri]) {
		echo '' . 'value=' . $row_x['ri'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'igd\' name=\'igd\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[igd]) {
		echo '' . 'value=' . $row_x['igd'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_penggunaan\' name=\'j_penggunaan\' size=3 disabled ';

	if (1 <= $j_penggunaan) {
		echo '' . 'value=' . $j_penggunaan;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'pbi\' name=\'pbi\' size=3 onchange=\'hitung3()\' ';

	if (1 <= $row_x[pbi]) {
		echo '' . 'value=' . $row_x['pbi'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'jamkesda\' name=\'jamkesda\' size=3 onchange=\'hitung3()\' ';

	if (1 <= $row_x[jamkesda]) {
		echo '' . 'value=' . $row_x['jamkesda'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'swasta\' name=\'swasta\' size=3 onchange=\'hitung3()\' ';

	if (1 <= $row_x[swasta]) {
		echo '' . 'value=' . $row_x['swasta'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'umum\' name=\'umum\' size=3 onchange=\'hitung3()\' ';

	if (1 <= $row_x[umum]) {
		echo '' . 'value=' . $row_x['umum'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'lainnya\' name=\'lainnya\' size=3 disabled ';

	if (1 <= $total_lain) {
		echo '' . 'value=' . $total_lain;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
</tr>
<tr><td colspan=15 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table>
	</div>
</body>


</html>';
?>