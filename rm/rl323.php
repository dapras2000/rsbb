<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';

	
	$kode = $_GET[id];
	
	$bln = $_GET[bln];
	$smt = $_GET[bln];

	$koders = $_GET[koders];
	
	$tahun = $_GET[tahun];
	
	$kode_rs = $KDRS;

	$sql_x = '' . 'select a.code_list,b.description,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc from rl33 a left join m_rl323 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.bulan=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	$tmasuk = $row_x[rs] + $row_x[pkm] + $row_x[bidan] + $row_x[faskes_lain] + $row_x[nonrujukan];
	$tkeluar = $row_x[hidup] + $row_x[mati] + $row_x[dirujuk];
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
			document.getEl';
	echo 'ementById(\'t_masuk\').disabled=true;
		document.getElementById(\'t_keluar\').disabled=true;
	document.getElementById(\'totalsc\').disabled=true;
	document.getElementById(\'dirawat4\').disabled=true;
	  });  
    </script>
	';
	echo '<s';
	echo 'cript type="text/javascript">
	function entri(){
	
	 $("#tbl_reg1").show();
	 $("#tbl_reg").show();
	 $("#tbl_regreg").hide();
	  $("#entri").hide();
	}
	function update(){
	
	 $("#tbl_reg1").show();
	 $("#tbl_reg").show();
	 $("#tbl_regreg").hide();
	  $("#entri").hide();
	  
	}
		
	</script>
		';
	echo '<s';
	echo 'cript type="text/javascript">
$(document).ready(function() {
$.post(\'rm/ambildata_rl323.php\',
			{   \'reqdata\'   :\'cari_rl323\',
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
	
	echo '<s';
	echo 'cript type="text/javascript">
   function cek(){
 document.getElementById(\'totalsc\').value=0;
document.getElementById(\'dirawat4\').value=0;
document.getElementById(\'rs\').value=0;
document.getElementById(\'pkm\').value=0;
document.getElementById(\'bidan\').value=0;
document.getElementById(\'faskes\').value=0;
document.getElementById(\'nonrujukan\').value=0;
document.getElementById(\'hidup\').value=0;';
	echo '
document.getElementById(\'mati\').value=0;
document.getElementById(\'dirujuk\').value=0;
document.getElementById(\'t_masuk\').value=0;
document.getElementById(\'t_keluar\').value=0;
	document.getElementById(\'t_masuk\').disabled=true;
		document.getElementById(\'t_keluar\').disabled=true;
   if($(\'#pelayanan\').val()!="5"){
   document.getElementById(\'rs\').focus();
	document.getElementById(\'totalsc\')';
	echo '.disabled=true;
	document.getElementById(\'dirawat4\').disabled=true;
	document.getElementById(\'rs\').disabled=false;
document.getElementById(\'pkm\').disabled=false;
document.getElementById(\'bidan\').disabled=false;
document.getElementById(\'faskes\').disabled=false;
document.getElementById(\'nonrujukan\').disabled=false;
document.getElementById(\'hidup\').disabled=false;
document.getElementById(\'mat';
	echo 'i\').disabled=false;
document.getElementById(\'dirujuk\').disabled=false;
	}
	else{
document.getElementById(\'rs\').disabled=true;
document.getElementById(\'pkm\').disabled=true;
document.getElementById(\'bidan\').disabled=true;
document.getElementById(\'faskes\').disabled=true;
document.getElementById(\'nonrujukan\').disabled=true;
document.getElementById(\'hidup\').disabled=true;
document.getElementB';
	echo 'yId(\'mati\').disabled=true;
document.getElementById(\'dirujuk\').disabled=true;
document.getElementById(\'t_masuk\').disabled=true;
document.getElementById(\'t_keluar\').disabled=true;
	document.getElementById(\'totalsc\').disabled=false;
	document.getElementById(\'dirawat4\').disabled=false;
document.getElementById(\'dirawat4\').focus();
	}	
hitung();
hitung2();
}

function hitung(){
document.getEl';
	echo 'ementById(\'t_masuk\').value=eval(document.getElementById(\'rs\').value)+ eval(document.getElementById(\'pkm\').value)+ eval(document.getElementById(\'bidan\').value)+ eval(document.getElementById(\'faskes\').value)+ eval(document.getElementById(\'nonrujukan\').value);
}

function hitung2(){
document.getElementById(\'t_keluar\').value=eval(document.getElementById(\'hidup\').value)+ eval(document.getElementById(';
	echo '\'mati\').value)+ eval(document.getElementById(\'dirujuk\').value);
}
</script>
';
	echo '<s';
	echo 'cript>
   function create_xml(){
$.post(\'rm/ambildata_rl323.php\',
			{   \'reqdata\'   :\'xml_rl323\',
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
	echo '<s';
	echo 'cript>
   function cari(){
$.post(\'rm/ambildata_rl323.php\',
			{   \'reqdata\'   :\'cari_rl323\',
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
	echo '<s';
	echo 'cript>
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

	$.post(\'rm/ambildata_rl323.php\',
			{   \'reqdata\'   :';
	echo '\'save_rl323\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahunsave\'   :$(\'#tahunsave\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'rs\'   :$(\'#rs\').val(),
							\'pkm\'   :$(\'#pkm\').val(),
							\'bidan\'   :$(\'#bidan\').val(),
							\'faskes\'   :$(\'#faskes\').val(),
							\'nonrujukan\'   :$(\'#nonrujukan\').val(),
							\'hidup\'   :$(\'#hidup\').val(),
							\'mati\'   ';
	echo ':$(\'#mati\').val(),
							\'dirujuk\'   :$(\'#dirujuk\').val(),
							\'dirawat\'   :$(\'#dirawat4\').val(),
							\'total\'   :$(\'#totalsc\').val(),
							\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
}	
function cancel(){
window.location.replace("'._BASE_.'index.php?link=rl323");
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
        			#tbl_regreg {	
					width:900px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;

                    
                    }
		 #tbl_reg1 {	
					width:auto;
                    border-collapse:collapse; 
                    background-color:white;
                    font:';
	echo ' 12px verdana; 
					
                    
                    }			
					
		#tbl_reg2 {	
					width:auto;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;
                    
                    }
	
		td		{	padding:5px;}
		.td_d{padding-left:50px}
		#tr_d{
		background ';
	echo ': #eba3fe;
		BORDER-TOP: 1px solid grey;"}
	
		
		
						
		.rest{ font:10px; color:red;}
  
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
      background-color:#39b54a; 
	 
	  /* baris genap berwarna hijau tua */ } 
       
    </style>
</head>

<body bgcolor="#fff">
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Laporan RL 3.2.3</h3></div>
		<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
			<tr class=\'tr_s\'>
				<td colspan=2>

					<table id=\'tbl_regreg\' name=\'tbl_regreg\'>
<tr class=\'tr_s\'><td colspan=4>';
	echo '<strong>Periode :</strong></td></tr>
<tr class=\'tr_s\'>

<td class=\'td_d\'>Semester :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
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
	echo '<s';
	echo 'elect id=\'bln\' name=\'bln\' onChange=\'cari()\'>
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
<input type=\'button\' id=\'input2\' value=\'Buat File Laporan\' onclick=\'create_xml()\'></div>
<br>
<form name=\'kebidanan\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=3 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Jenis Pelayanan</div></th><th colspan=6  style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Cara Masuk</div></th>
<th colspan=4 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Cara Keluar</div></th>
<th colspan=2 rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">SC Murni Primagravida</div></th>
</tr>
<tr><th colspan=4 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Rujukan</div></th><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Non Rujukan</div></th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Total Masuk</div></th><th rowsp';
	echo 'an=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Hidup</div></th><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Mati</div></th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Dirujuk</div></th><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Total Keluar</div></th>
</tr>
<tr><th ';
	echo 'style=\'background:#39b54a;border:1px solid grey;\'><div align="center">RS</div></th><th style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Puskesmas</div></th>
<th style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Bidan</div></th><th style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Faskes Lain</div></th>
<th style=\'background:#39b54a;border:1px solid gr';
	echo 'ey;\'><div align="center">Dirawat < 4 Hari</div></th><th style=\'background:#39b54a;border:1px solid grey;\'><div align="center">Total</div></th>
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
	$sql = 'select code_list,description from m_rl323 order by code';
	
	$hasil = mysql_query( $sql);
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'rs\' name=\'rs\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[rs]) {
		echo '' . 'value=' . $row_x['rs'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'pkm\' name=\'pkm\' size=3  onchange=\'hitung()\' ';

	if (1 <= $row_x[pkm]) {
		echo '' . 'value=' . $row_x['pkm'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'bidan\' name=\'bidan\' size=3  onchange=\'hitung()\' ';

	if (1 <= $row_x[bidan]) {
		echo '' . 'value=' . $row_x['bidan'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'faskes\' name=\'faskes\' size=3  onchange=\'hitung()\' ';

	if (1 <= $row_x[faskes_lain]) {
		echo '' . 'value=' . $row_x['faskes_lain'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'nonrujukan\' name=\'nonrujukan\' size=3 value=0  onchange=\'hitung()\' ';

	if (1 <= $row_x[nonrujukan]) {
		echo '' . 'value=' . $row_x['nonrujukan'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'t_masuk\' name=\'t_masuk\' size=3 ';

	if (1 <= $tmasuk) {
		echo 'value=\'' . $tmasuk . '\'';
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'hidup\' name=\'hidup\' size=3  onchange=\'hitung2()\' ';

	if (1 <= $row_x[hidup]) {
		echo '' . 'value=' . $row_x['hidup'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'mati\' name=\'mati\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[mati]) {
		echo '' . 'value=' . $row_x['mati'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'dirujuk\' name=\'dirujuk\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[dirujuk]) {
		echo '' . 'value=' . $row_x['dirujuk'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'t_keluar\' name=\'t_keluar\' size=3 ';

	if (1 <= $tkeluar) {
		echo '' . 'value=' . $tkeluar;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'dirawat4\' name=\'dirawat4\' size=3 ';

	if (1 <= $row_x[dirawat_4hari]) {
		echo '' . 'value=' . $row_x['dirawat_4hari'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'totalsc\' name=\'totalsc\' size=3 ';

	if (1 <= $row_x[total_sc]) {
		echo '' . 'value=' . $row_x['total_sc'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
</tr>
<tr><td colspan=11 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> 
</form>
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