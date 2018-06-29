<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';

	
	$kode = $_GET[id];
	
	$bln = $_GET[bln];
	
	$koders = $_GET[koders];
	
	$tahun = $_GET[tahun];
	
	$kode_rs = $KDRS;
	$sql_x = '' . 'select a.code_list,b.description,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk from rl324 a left join m_rl324 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.bulan=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	$total = $row_x[rs] + $row_x[pkm] + $row_x[bidan] + $row_x[faskes_lain] + $row_x[mati_faskes];
	echo '<html>
<html>
<head>
   <script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>
		  <script type="text/javascript" src="'._BASE_.'/include/jquery-1.3.2.js"></script>
		  <script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
		  <link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />';
	echo '<script type="text/javascript">
      $(document).ready(function() { 
	  $("#tbl_reg1").hide();
	  $("#tbl_reg").hide();
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
				document.getElementById(\'total_faskes\').disabled=true;
				document.getElementById(\'total_faskes\').style.backgroundColor=\'#cccccc\';
				aktif();
		});  
    </script>
	';
	echo '<script>
   function create_xml(){
$.post(\'rm/ambildata_rl324.php\',
			{   \'reqdata\'   :\'xml_rl324\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smstr\'     :$(\'#smstr\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>
	';

	echo '<script type="text/javascript">
	function entri(){
	
	 $("#tbl_reg1").show();
	 $("#tbl_reg").show();
	 $("#tbl_regreg").hide();
	  $("#entri").hide();
	    if($(\'#pelayanan\').val()=="1.1" || $(\'#pelayanan\').val()=="1.2"){
	document.getElementById(\'dirujuk\').disabled=false;
	document.getElementById(\'dirujuk\').style.backgroundColor=\'\';
		}
		
	else{
	document.getElementById(\'dirujuk\').disabled=true;
		document.getElementById(\'dirujuk\').style.backgroundColor=\'#cccccc\';
}

	  }
	function update(){
	
	 $("#tbl_reg1").show();
	 $("#tbl_reg").show();
	 $("#tbl_regreg").hide();
	  $("#entri").hide();
	
	}
	function aktif(){
	 if($(\'#pelayanan\').val()=="1.1" || $(\'#pelayanan\').val()=="1.2"){
	document.getElementById(\'dirujuk\').disabled=false;
	document.getElementById(\'dirujuk\').style.backgroundColor=\'\';
			document.getElementById(\'mati_faskes\').disabled=false;
	document.getElementById(\'mati_faskes\').style.backgroundColor=\'\';
		document.getElementById(\'total_non_rujukan\').disabled=false;
	document.getElementById(\'total_non_rujukan\').style.backgroundColor=\'\';	
	}
	 else if($(\'#pelayanan\').val()=="3.1" || $(\'#pelayanan\').val()=="3.2" || $(\'#pelayanan\').val()=="3.3" || $(\'#pelayanan\').val()=="3.4" || $(\'#pelayanan\').val()=="3.5" || $(\'#pelayanan\').val()=="3.5" || $';
	echo '(\'#pelayanan\').val()=="3.6" || $(\'#pelayanan\').val()=="3.7" || $(\'#pelayanan\').val()=="3.8" || $(\'#pelayanan\').val()=="3.9" || $(\'#pelayanan\').val()=="3.10"){
	document.getElementById(\'mati_faskes\').disabled=true;
	document.getElementById(\'mati_faskes\').style.backgroundColor=\'#cccccc\';
		document.getElementById(\'total_non_rujukan\').disabled=true;
	document.getElementById(\'total_non_rujukan\').style.backgroundColor=\'#cccccc\';
	}
	else{
	document.getElementById(\'dirujuk\').disabled=true;
		document.getElementById(\'dirujuk\').style.backgroundColor=\'#cccccc\';
			document.getElementById(\'mati_faskes\').disabled=false;
	document.getElementById(\'mati_faskes\').style.backgroundColor=\'\';
		document.getElementById(\'total_non_rujukan\').disabled=false;
	document.getElementById(\'total_non_rujukan\').style.backgroundColor=\'\';
}
	}
	function hitung(){
		document.getElementById(\'total_faskes\').disabled=true;
		document.getElementById(\'total_faskes\').backgroundColor=\'#ccccc\';
		document.getElementById(\'total_faskes\').value=eval(document.getElementById(\'rs\').value) + eval(document.getElementById(\'pkm\').value) +  eval(document.getElementById(\'bidan\').value) +  eval(document.getElementById';
	echo '(\'faskes\').value) +  eval(document.getElementById(\'mati_faskes\').value);
		}
		
		
	</script>
		';
	echo '<script type=\'text/javascript\' src="include/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="include/css/jquery.autocomplete.css" />

';
	echo '<script type="text/javascript">
$(document).ready(function() {
$.post(\'rm/ambildata_rl324.php\',
			{   \'reqdata\'   :\'cari_rl324\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'bln\'     :$(\'#bln\').val(),
							\'tahun\'     :$(\'#tahun\').val()
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

});
</script>

';
	echo '<script type="text/javascript">
   function cek(){
document.getElementById(\'dirujuk\').value=0;
document.getElementById(\'mati_faskes\').value=0;
document.getElementById(\'rs\').value=0;
document.getElementById(\'pkm\').value=0;
document.getElementById(\'bidan\').value=0;
document.getElementById(\'faskes\').value=0;
document.getElementById(\'total_faskes\').value=0;
document.getElementById(\'mati_non_rujukan\').value=0;
document.getElementById(\'total_non_rujukan\').value=0;
   if($(\'#pelayanan\').val()=="1.1" || $(\'#pelayanan\').val()=="1.2"){
	document.getElementById(\'dirujuk\').disabled=false;
	document.getElementById(\'dirujuk\').style.backgroundColor=\'\';
			document.getElementById(\'mati_faskes\').disabled=false;
	document.getElementById(\'mati_faskes\').style.backgroundColor=\'\';
		document.getElementById(\'total_non_rujukan\').disabled=false;
	document.getElementById(\'total_non_rujukan\').style.backgroundColor=\'\';	
	}
	 else if($(\'#pelayanan\').val()=="3.1" || $(\'#pelayanan\').val()=="3.2" || $(\'#pelayanan\').val()=="3.3" || $(\'#pelayanan\').val()=="3.4" || $(\'#pelayanan\').val()=="3.5" || $(\'#pelayanan\').val()=="3.5" || $(\'#pelayanan\').val()=="3.6" || $(\'#pelayanan\').val()=="3.7" || $(\'#pela';
	echo 'yanan\').val()=="3.8" || $(\'#pelayanan\').val()=="3.9" || $(\'#pelayanan\').val()=="3.10"){
	document.getElementById(\'mati_faskes\').disabled=true;
	document.getElementById(\'mati_faskes\').style.backgroundColor=\'#cccccc\';
		document.getElementById(\'total_non_rujukan\').disabled=true;
	document.getElementById(\'total_non_rujukan\').style.backgroundColor=\'#cccccc\';
	}
	else{
	document.getElementById(\'dirujuk\').disabled=true;
		document.getElementById(\'dirujuk\').style.backgroundColor=\'#cccccc\';
			document.getElementById(\'mati_faskes\').disabled=false;
	document.getElementById(\'mati_faskes\').style.backgroundColor=\'\';
		document.getElementById(\'total_non_rujukan\').disabled=false;
	document.getElementById(\'total_non_rujukan\').style.backgroundColor=\'\';
}	
}
</script>
';
	echo '<script>
   function cari(){
$.post(\'rm/ambildata_rl324.php\',
			{   \'reqdata\'   :\'cari_rl324\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smstr\'     :$(\'#smstr\').val(),
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
if($(\'#tahunsave\').val()==""){
alert(\'Tahun Belum Diisi\');
   	$(\'#tahunsave\').focus();
	return false;
	}
if($(\'#bln\').val()==""){
alert(\'Bulan Belum Diisi\');
   	$(\'#bln\').focus();
	return false;
	}


	$.post(\'rm/ambildata_rl324.php\',
			{   \'reqdata\'  ';
	echo ' :\'save_rl324\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahunsave\'   :$(\'#tahunsave\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'rs\'   :$(\'#rs\').val(),
							\'pkm\'   :$(\'#pkm\').val(),
							\'bidan\'   :$(\'#bidan\').val(),
							\'faskes\'   :$(\'#faskes\').val(),
							\'mati_faskes\'   :$(\'#mati_faskes\').val(),
							\'total_faskes\'   :$(\'#total_faskes\').val(),';
	echo '
							\'mati_non_rujukan\'   :$(\'#mati_non_rujukan\').val(),
							\'total_non_rujukan\'   :$(\'#total_non_rujukan\').val(),
							\'dirujuk\'   :$(\'#dirujuk\').val(),
							\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
}	
function cancel(){
window.location.replace("'._BASE_.'index.php?link=rl324");
		}
		
		</script>	
	';
	echo '<s';
	echo 'tyle>
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
					width:900px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;
                    
                    }
		 #tbl_reg1 {	
					width:900px;
                    border-collapse:collapse; 
                    background-color:white;
                    font';
	echo ': 12px verdana; 
					
                    
                    }
                    #tbl_regreg {	
					width:900px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;			
					
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
		backgroun';
	echo 'd : #eba3fe;
		BORDER-TOP: 1px solid grey;"}
	
		
		
						
		.rest{ font:10px; color:red;}
    				#menu{ 
    opacity:0.92; 
    position: absolute;
    top: 115px;
    left: 45px;
	
}
	#teks{ 
    opacity:0.92; 
    position: absolute;
    top: 90px;
    left: auto;
	
}
	</style>
	';
	echo '<s';
	echo 'tyle>
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
    .tbheadin';
	echo 'g { 
      background-color:#f1fe1b; 
	 
	  /* baris genap berwarna hijau tua */ } 
       
    </style>
</head>

<body bgcolor="#fff">
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Laporan RL 3.2.4</h3></div>
		<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
			<tr class=\'tr_s\'>
				<td colspan=2>

					<table id=\'tbl_regreg\' name=\'tbl_regreg\'>
<tr class=\'tr_s\'><td colspan=4>';
	echo '<s';
	echo 'trong>Periode :</strong></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Semester :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
	echo $kode_rs;
	echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
	echo '' . $kode;
	echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
	echo '' . $smt;
	echo '">';
	echo '<select id=\'smstr\' name=\'smstr\' onChange=\'cari()\'>
<option value=""></option>
<option value=I ';

    if ($smstr  == 'I') {
        echo 'selected="selected"';
    }

    echo '>I</option>
<option value=II ';

    if ($smstr  == 'II') {
        echo 'selected="selected"';
    }

    echo '>II</option>
</select>
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
</td></tr>
</table>


<table id=\'tbl_reg\' name=\'tbl_reg\'>
						<tr class=\'tr_s\'><td colspan=4>';
	echo '<s';
	echo 'trong>Periode :</strong></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Bulan :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
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
<td class=\'td_d\'>Tahun :</td><td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
	echo '' . $tahun;
	echo '">';
	echo '<s';
	echo 'elect id=\'tahunsave\' name=\'tahunsave\'  onChange=\'cari()\'>
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
</td></tr>
</table>



<div id=\'entri\'>
<input type=\'button\' id=\'input\' value=\'Entri Data\' onclick=\'entri()\'>
<input type=\'button\' id=\'input2\' value=\'Buat File Laporan\' onclick=\'create_xml()\'>
</div>
<br>
<form name=\'anak\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=3 style=\'background:#39b54a;border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=6  style=\'background:#39b54a;border:1px solid grey;\'>Rujukan</th>
<th colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Non Rujukan</th><th rowspan=3 style=\'background:#39b54a;border:1px solid grey;\'>Dirujuk</th>
</tr>
<tr><th colspan=6 style=\'background:#39b54a;border:1px solid grey;\'>Fasilitas Kesehatan</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Hidup</th><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Mati</th>
</tr>
<tr><th style=\'background:#39b54a;border:1px solid grey;\'>RS</th><th style=\'background:#39b54a;border:1px solid grey;\'>Puskesmas</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Bidan</th><th sty';
	echo 'le=\'background:#39b54a;border:1px solid grey;\'>Faskes Lain</th><th style=\'background:#39b54a;border:1px solid grey;\'>Mati</th><th style=\'background:#39b54a;border:1px solid grey;\'>Total</th>
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
	$sql = 'select code_list,description from m_rl324 order by code';
	
	$hasil = mysql_query( $sql);
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'rs\' name=\'rs\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[rs]) {
		echo '' . 'value=' . $row_x['rs'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pkm\' name=\'pkm\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[pkm]) {
		echo '' . 'value=' . $row_x['pkm'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bidan\' name=\'bidan\' onchange=\'hitung()\' size=3 ';

	if (1 <= $row_x[bidan]) {
		echo '' . 'value=' . $row_x['bidan'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'faskes\' name=\'faskes\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[faskes_lain]) {
		echo '' . 'value=' . $row_x['faskes_lain'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'mati_faskes\' name=\'mati_faskes\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[mati_faskes]) {
		echo '' . 'value=' . $row_x['mati_faskes'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'total_faskes\' name=\'total_faskes\' size=3 ';

	if (1 <= $total) {
		echo '' . 'value=' . $total;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'total_non_rujukan\' name=\'total_non_rujukan\' size=3 ';

	if (1 <= $row_x[total_non_rujukan]) {
		echo '' . 'value=' . $row_x['total_non_rujukan'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'mati_non_rujukan\' name=\'mati_non_rujukan\' size=3 ';

	if (1 <= $row_x[mati_non_rujukan]) {
		echo '' . 'value=' . $row_x['mati_non_rujukan'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'dirujuk\' name=\'dirujuk\' size=3 ';

	if (1 <= $row_x[dirujuk]) {
		echo '' . 'value=' . $row_x['dirujuk'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
</tr>
<tr><td colspan=11 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table>
				</div>
			</div>
		</div>
</body>


</html>';
?>