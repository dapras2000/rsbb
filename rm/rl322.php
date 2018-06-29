<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';
	
	
	$kode = $_GET[id];
	
	$smt = $_GET[bln];
	$bln = $_GET[bln];
	
	$koders = $_GET[koders];
	
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;

	$sql_x = ' select a.code_list,b.description,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.tglupdate from rl322 a left join m_rl322 b on b.code_list=a.code_list where a.code_list="'.$kode.'" and a.smt="'.$smt.'" and a.tahun="'.$tahun.'"';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
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
		document.getElementById(\'kasus_l\').disabled=true;
		document.getElementById(\'kasus_l\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'kasus_p\').disabled=true;
		document.getElementById(\'kasus_p\').style.backgroundColor=\'#ccccc\';
		});  
    </script>
	';
	echo '<script type="text/javascript">
	function entri(){
	
	 $("#tbl_reg1").show();
	  $("#entri").hide();
	  $("#tbl_reg").show();
	  $("#tbl_regreg").hide();
	 }
	function update(){
 	
	 $("#tbl_reg1").show();
	  $("#entri").hide();
	  $("#tbl_reg").show();
	  $("#tbl_regreg").hide();
	}
		
	</script>
		';
	
	echo '<script type="text/javascript">
$(document).ready(function() {
$.post(\'rm/ambildata_rl322.php\',
			{   \'reqdata\'   :\'cari_rl322\',
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
   document.getElementById(\'kasus_l\').value=0;
document.getElementById(\'kasus_p\').value=0;
 document.getElementById(\'luka_l\').value=0;
document.getElementById(\'luka_p\').value=0;
document.getElementById(\'doa_l\').value=0;
document.getElementById(\'doa_p\').value=0;
document.getElementById(\'mati_l\').value=0;
document.getElementById(\'mati_p\').value=0;
 }
 	function hitung(){
		document.getElementById(\'kasus_l\').value=eval(document.getElementById(\'luka_l\').value)+eval(document.getElementById(\'doa_l\').value)+eval(document.getElementById(\'mati_l\').value);
						}
	 	function hitung2(){

		document.getElementById(\'kasus_p\').value=eval(document.getElementById(\'luka_p\').value)+eval(document.getElementById(\'doa_p\').value)+eval(document.ge';
	echo 'tElementById(\'mati_p\').value);
						}					

</script>
';
	echo '<script>
   function create_xml(){
$.post(\'rm/ambildata_rl322.php\',
			{   \'reqdata\'   :\'xml_rl322\',
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
   function cari(){
$.post(\'rm/ambildata_rl322.php\',
			{   \'reqdata\'   :\'cari_rl322\',
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

	$.post(\'rm/ambildata_rl322.php\',
			{   \'reqdata\'   :
							\'save_rl322\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahunsave\'   :$(\'#tahunsave\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'kasus_l\'   :$(\'#kasus_l\').val(),
							\'kasus_p\'   :$(\'#kasus_p\').val(),
							\'luka_l\'   :$(\'#luka_l\').val(),
							\'luka_p\'   :$(\'#luka_p\').val(),
							\'doa_l\'   :$(\'#doa_l\').val(),
							\'doa_p\'   :$(\'#doa_p\').val(),
							\'mati_l\'   :$(\'#mati_l\').val(),
							\'mati_p\'   :$(\'#mati_p\').val(),
							\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
}	
function cancel(){
window.location.replace("'._BASE_.'index.php?link=rl322");
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
					width:1000px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;

                    
                    }
                    #tbl_regreg {	
					width:1000px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;

                    
                    }
		 #tbl_reg1 {	
					width:1000px;
                    border-collapse:collapse; 
                    background-color:white;
                    ';
	echo 'font: 12px verdana; 
						th: vertical-align:middle;	
                    
                    }			
					
		#tbl_reg2 {	
					width:650px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;
                    
                    }
	
		td		{	padding:5px;}
		.td_d{padding-l';
	echo 'eft:50px}
		#tr_d{
		background : #eba3fe;
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
		<div id="frame_title"><h3>Laporan RL 3.2.2</h3></div>
<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>

<tr class=\'tr_s\'><td colspan=2>



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
	echo '<strong>Periode :</strong></td></tr>
<tr class=\'tr_s\'>

<td class=\'td_d\'>Bulan :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
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
<form name=\'ird\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=10>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Transportasi</th>
<th colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Luka-Luka</th>
<th colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>DOA</th>
<th colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Meninggal di RS</th>
<th colspan=2  style=\'background:#39b54a;border:1';
	echo 'px solid grey;\'>Jumlah Kasus</th>
</tr>
<tr><th style=\'background:#39b54a;border:1px solid grey;\'>L</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th st';
	echo 'yle=\'background:#39b54a;border:1px solid grey;\'>L</th>
	<th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
</tr>
<tr><td style=\'background:#fffff;border:1px solid grey;\'>';
	echo '<select id=\'pelayanan\' name=\'pelayanan\' style=\'font-size:12px\'; onChange=\'cek()\'>
<option value="';
	echo '' . $row_x['code_list'];
	echo '">';
	echo '' . $row_x['code_list'] . '&nbsp;-&nbsp;' . $row_x['description'];
	echo '</option>
';
	$sql = 'select code_list,description from m_rl322 order by code_list';
	
	$hasil = mysql_query( $sql);
	
	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'luka_l\' name=\'luka_l\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[luka_l]) {
		echo '' . 'value=' . $row_x['luka_l'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'luka_p\' name=\'luka_p\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[luka_p]) {
		echo '' . 'value=' . $row_x['luka_p'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'doa_l\' name=\'doa_l\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[doa_l]) {
		echo '' . 'value=' . $row_x['doa_l'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'doa_p\' name=\'doa_p\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[doa_p]) {
		echo '' . 'value=' . $row_x['doa_p'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'mati_l\' name=\'mati_l\' onchange=\'hitung()\' size=3 ';

	if (1 <= $row_x[mati_l]) {
		echo '' . 'value=' . $row_x['mati_l'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'mati_p\' name=\'mati_p\' size=3  onchange=\'hitung2()\' ';

	if (1 <= $row_x[mati_p]) {
		echo '' . 'value=' . $row_x['mati_p'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'kasus_l\' name=\'kasus_l\' size=3 ';

	if (1 <= $row_x[kasus_l]) {
		echo '' . 'value=' . $row_x['kasus_l'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'kasus_p\' name=\'kasus_p\' size=3 ';

	if (1 <= $row_x[kasus_p]) {
		echo '' . 'value=' . $row_x['kasus_p'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
</tr>
<tr><td colspan=10 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr ><td colspan=2><div id=\'hasil\'></div>
</td></tr>
					</table>
				</div>
			</div>
		</div>
</body>


</html>';
?>