<?php
	error_reporting( 'E_ALL' );
    session_start(  );
    include( '../include/connect.php' );

	$kode = $_GET[id];
    $koders = $_GET[koders];
    $tahun = $_GET[tahun];
    $bln = $_GET[bln];
    $kode_rs = $KDRS;

	$sql_x = '' . 'select a.code_list,b.description,a.j_pasien,a.pbi,a.jamkesda,a.swasta,a.umum from rl38 a left join m_rl38 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	$hasil_x = mysql_query( $sql_x );	
	$row_x = mysql_fetch_array( $hasil_x );
	$total_x = $row_x[pbi] & $row_x[jamkesda] & $row_x[swasta] & $row_x[umum];
	echo '<html>
<head>

	<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>';
    echo '<script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />';

	echo '<script type="text/javascript">
      $(document).ready(function() {
	  	 	    	  $("#menu").hide();
	  	 	    	  $("#lebel_bulan").hide();
	  	 	    	  $("#opsi_bulan").hide();
	     $(\'#teks\').load(\'clock.html\');
	  $("#tbl_reg1").hide();
	  cari();
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
';
	echo '		});  
    </script>';

	echo '<script type="text/javascript">
	function entri(){
		$("#tbl_reg1").show();
	  	$("#entri").hide();

	  	$("#lebel_bulan").show();
	  	$("#opsi_bulan").show();
	  	$("#lebel_semester").hide();
	  	$("#opsi_semester").hide();
	}

	function update(){
	 	$("#tbl_reg1").show();
	  	$("#entri").hide();
	  	
	  	$("#lebel_bulan").show();
	  	$("#opsi_bulan").show();
	  	$("#lebel_semester").hide();
	  	$("#opsi_semester").hide();
	}

	function hitung(){
		document.getElementById(\'total\').disabled=true;
		document.getElementById(\'total\').backgroundColor=\'#ccccc\';
		document.getElementById(\'total\').value=eval(document.getElementById(\'pbi\')';
	echo '.value)+eval(document.getElementById(\'jamkesda\').value)+eval(document.getElementById(\'swasta\').value)+eval(document.getElementById(\'umum\').value);
				}

	</script>
		';
	echo '<s';
	echo 'cript type=\'text/javascript\' src="include/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="include/css/jquery.autocomplete.css" />


';
	echo '<s';
	echo 'cript type="text/javascript">
   function cek(){
 document.getElementById(\'j_pasien\').focus();  
document.getElementById(\'j_pasien\').value=0;
document.getElementById(\'pbi\').value=0;
document.getElementById(\'jamkesda\').value=0;
document.getElementById(\'swasta\').value=0;
document.getElementById(\'umum\').value=0;
document.getElementById(\'total\').valu';
	echo 'e=0;
}
</script>
';


	echo '<script>
   function cari(){
$.post(\'rm/ambildata_rl38.php\',
			{   \'reqdata\'   :\'cari_rl38\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smtr\'     :$(\'#smtr\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>';


	echo '<script>
   function get_xml(){
$.post(\'rm/ambildata_rl38.php\',
			{   \'reqdata\'   :\'xml_rl38\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smtr\'     :$(\'#smtr\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>
	
';
	echo '<s';
	echo 'cript>
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

	$.post(\'rm/ambildata_rl38.php\',
			{   \'reqdata\' ';
	echo '  :\'save_rl38\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahun\'   :$(\'#tahun\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'j_pasien\'   :$(\'#j_pasien\').val(),
							\'pbi\'   :$(\'#pbi\').val(),
							\'jamkesda\'   :$(\'#jamkesda\').val(),
							\'swasta\'   :$(\'#swasta\').val(),
							\'umum\'   :$(\'#umum\').val(),
						';
	echo '	\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
}

function cancel(){
	window.location = "'._BASE_.'/index.php?link=rl38";
}

function sh_menu(){
$(\'#menu\').show();
}
		</script>	
	';


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
    <div id="frame_title"><h3>Laporan RL 3.8</h3></div>

<div align="center">
<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
<td colspan=2><table id=\'tbl_reg\' name=\'tbl_reg\'>
<tr class=\'tr_s\'><td colspan=6 bgcolor=#39b54a>';
	echo '<font color="white"><strong>Periode :</strong></font></td></tr>
<tr class=\'tr_s\'>


<td class=\'td_d\'>

<div id="lebel_semester">Semester :</div>
<div id="lebel_bulan">Bulan :</div>

</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
	echo $kode_rs;
	echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
	echo '' . $kode;
	echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
	echo '' . $smt;
	echo '">';


echo '

<div id="opsi_semester">
<select id=\'smtr\' name=\'smtr\' onChange=\'cari()\'>
<option value=""></option>
<option value=1 ';

	if ($bln  == '1') {
		echo 'selected="selected"';
	}

	echo '>I</option>
<option value=2 ';

	if ($bln  == '2') {
		echo 'selected="selected"';
	}

	echo '>II</option>
</select>
</div>';


echo '
<div id="opsi_bulan">
<select id=\'bln\' name=\'bln\' onChange=\'cari()\'>
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

	echo '>Nopember</option>
<option value=12 ';

	if ($bln  == '12') {
		echo 'selected="selected"';
	}

	echo '>Desember</option>
</select>
</div>';


echo '

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
<input type=\'button\' id=\'input\' value=\'Entri Data\' onclick=\'entri()\'>&nbsp;<input type=\'button\' id=\'input\' value=\'Buat XML File\' onclick=\'get_xml()\'></div>
<br>
<form name=\'irna\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jenis Pelayanan</th><th rowspan=2  style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pelayanan</th>
<th colspan=4 style=\'background:#39b54a;border:1px solid grey;\'>Cara Bayar Lainnya</th>
<th rowspan=2 style=\'bac';
	echo 'kground:#39b54a;border:1px solid grey;\'>Total</th>
</tr>
<tr>
<th style=\'background:#39b54a;border:1px solid grey;\'>BPJS</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jamkesda</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Lain Lain</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Umum</th>
</tr>
<tr><td style=\'background:#fffff;border:1px solid grey;\'>';
	echo '<s';
	echo 'elect id=\'pelayanan\' name=\'pelayanan\' style=\'font-size:12px\'; onChange=\'cek()\'>
<option value="';
	echo '' . $row_x['code_list'];
	echo '">';
	echo '' . $row_x['code_list'] . '&nbsp;-&nbsp;' . $row_x['description'];
	echo '</option>
';
	$sql = 'select code_list,description from m_rl38 order by code_list';
	
	$hasil = mysql_query($sql);
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_pasien\' name=\'j_pasien\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[j_pasien]) {
		echo '' . 'value=' . $row_x['j_pasien'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'pbi\' name=\'pbi\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[pbi]) {
		echo '' . 'value=' . $row_x['pbi'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'jamkesda\' name=\'jamkesda\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[jamkesda]) {
		echo '' . 'value=' . $row_x['jamkesda'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'swasta\' name=\'swasta\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[swasta]) {
		echo '' . 'value=' . $row_x['swasta'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'umum\' name=\'umum\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[umum]) {
		echo '' . 'value=' . $row_x['umum'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'total\' name=\'total\' size=3  disabled ';

	if (0 <= $total_x) {
		echo '' . 'value=' . $total_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
</tr>
<tr><td colspan=18 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table>
		
		</div>	

		</body>


</html>';
?>