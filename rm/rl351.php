<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';

	
	$kode = $_GET[id];
	
	$bln = $_GET[bln];
	
	$koders = $_GET[koders];
	
	$tahun = $_GET[tahun];
	
	$kode_rs = $KDRS;

	$sql_x = '' . 'select a.code_list,a.podr1,a.dot1,b.nama,a.j_meja,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah from rl351 a left join m_poly b on b.kode=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	$tindakan_x = $row_x[j_tindakan_cito] + $row_x[j_tindakan_sel];
	$pasien_x = $row_x[j_pasien_cito] + $row_x[j_pasien_sel];
	$mati_x = $row_x[j_mati_cito] + $row_x[podr_sel];
	$t_carabayar_x = $row_x[umum] + $row_x[bpjs] + $row_x[jamkesda] + $row_x[lain];

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
	 		 cari();
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
';
	echo '	document.getElementById(\'tindakan\').disabled=true;
			document.getElementById(\'tindakan\').style.backgroundColor=\'#cccccc\';
			document.getElementById(\'pasien\').disabled=true;
			document.getElementById(\'pasien\').style.backgroundColor=\'#cccccc\';
			document.getElementById(\'mati\').disabled=true;
			document.getElementById(\'mati\').style.backgroundColor=\'#cccccc\';	
		});  
    </script>
	';

	echo '<script type="text/javascript">
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

	function hitung(){
		document.getElementById(\'tindakan\').value=eval(document.getElementById(\'j_tindakan_cito\').value)+ eval(document.getElementById(\'j_tindakan_sel\').value);
		document.getElementById(\'pasien\').value=eval(document.getElementById(\'j_pasien_cito\').value) + eval(document.getElementById(\'j_pasien_sel\').value);	
		document.getElementById(\'mati\').value=eval(document.getElementById(\'j_mati_cito\').value) + eval(document.getElementById(\'podr_sel\').value);	
		document.getElementById(\'t_carabayar_x\').disabled=true;
		document.getElementById(\'t_carabayar_x\').backgroundColor=\'#ccccc\';
		document.getElementById(\'t_carabayar_x\').value=((eval(document.getElementById(\'umum\').value) + eval(document.getElementById(\'bpjs\').value)) + eval(document.getElementById(\'jamkesda\').value)) + (eval(document.getElementById(\'lain\').value));
		
		}

	</script>
		';

	echo '<script type="text/javascript">
   function cek(){
    
document.getElementById(\'j_meja\').focus();  
document.getElementById(\'j_meja\').value=0;   
document.getElementById(\'j_tindakan_cito\').value=0;
document.getElementById(\'j_pasien_cito\').value=0;
document.getElementById(\'j_mati_cito\').value=0;
document.getElementById(\'j_tindakan_sel\').value=0;
document.getElementById(\'j_pasien_sel\').value=0;
document.getElementById(\'podr_sel\').value=0;
document.getElementById(\'rata_rawat\').value=0;
document.getElementById(\'j_tunda_operasi\').value=0;
document.getElementById(\'j_pasien_pasca\').value=0;
document.getElementById(\'profilaksis_30\').value=0;
document.getElementById(\'profilaksis_jumlah\').value=0;
document.getElementById(\'tindakan\').value=0;
document.getElementById(\'pasien\').value=0;
document.getElementById(\'mati\').value=0;
document.getElementById(\'podr1\').value=0;
document.getElementById(\'dot1\').value=0;
document.getElementById(\'t_carabayar_x\').value=0;
}
</script>
';

	echo '<script>
   function cari(){
		$.post(\'rm/ambildata_rl351.php\',
			{   \'reqdata\'   :\'cari_rl351\',
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
   function get_xml(){
		$.post(\'rm/ambildata_rl351.php\',
			{   \'reqdata\'   :\'xml_rl351\',
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
	$.post(\'rm/ambildata_rl351.php\',
			{   \'reqdata\'   ';
	echo ':\'save_rl351\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahunsave\'   :$(\'#tahunsave\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'j_meja\'   :$(\'#j_meja\').val(),							
							\'j_tindakan_cito\'   :$(\'#j_tindakan_cito\').val(),
							\'j_pasien_cito\'   :$(\'#j_pasien_cito\').val(),
							\'j_mati_cito\'   :$(\'#j_mati_cito\').val(),
							\'j_tindakan_sel\'   :$(\'#j_tindakan_sel\').val(),
							\'j_pasien_sel\'   :$(\'#j_pasien_sel\').val(),
							\'podr_sel\'   :$(\'#podr_sel\').val(),
							\'podr1\'   :$(\'#podr1\').val(),
							\'dot1\'   :$(\'#dot1\').val(),
							\'rata_rawat\'   :$(\'#rata_rawat\').val(),
							\'j_tunda_operasi\'   :$(\'#j_tunda_operasi\').val(),
							\'j_pasien_pasca\'   :$(\'#j_pasien_pasca\').val(),
							\'profilaksis_30\'   :$(\'#profilaksis_30\').val(),
							\'profilaksis_jumlah\'   :$(\'#profilaksis_jumlah\').val(),
							\'umum\'   :$(\'#umum\').val(),
							\'bpjs\'   :$(\'#bpjs\').val(),
							\'jamkesda\'   :$(\'#jamkesda\').val(),
							\'lain\'   :$(\'#lain\').val(),
							\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
}	
function cancel(){
	window.location.replace("'._BASE_.'index.php?link=rl351");
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
                    font: 10px verdana; 
					border: 1px solid gray;
                    
                    }
		 #tbl_reg1 {	
					width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 10px verdana; 
					
                    
                    }	
         #tbl_regreg {	
					width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 10px verdana; 
					border: 1px solid gray;
					
                    
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
		background : #39b54a;
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

	echo '<style>
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
	<div id="frame_title"><h3>Laporan RL 3.5.1</h3></div>
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
<input type=\'button\' id=\'input\' value=\'Entri Data\' onclick=\'entri()\'>&nbsp;<input type=\'button\' id=\'input\' value=\'Buat File Laporan\' onclick=\'get_xml()\'></div>
<br>
<form name=\'ibs\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr>
<th rowspan=3 style=\'background:#39b54a;border:1px solid grey;\'>Jenis Pelayanan</th>
<th rowspan=3  style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Meja Operasi</th>
<th colspan=16 style=\'background:#39b54a;border:1px solid grey;\'>Kegiatan Pembedahan</th>
<th colspan=5 rowspan=\'2\' style=\'background:#39b54a;border:1px solid grey;\'>Cara Bayar</th>
</tr>
<tr>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=4> OPERASI CITO</th>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=6> OPERASI SELEKTIF</th>
<th style=\'background:#39b54a;border:1px solid grey;\' rowspan=2>JUMLAH PASIEN DENGAN KETIDAKSESUAIAN DIAGNOSIS PRA DAN PASCA OPERASI</th>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>JUMLAH PEMBERIAN AB PROFILAKSIS PADA OPERASI BERSIH</th>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=3>TOTAL</';
	echo 'th>
</tr>
<tr>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Tindakan</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Meninggal (death on table)</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Meninggal(PODR)</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Tindakan</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Meninggal (death on table)</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Meninggal(PODR)</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Rata2 Lama Dirawat Sebelum Operasi</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Penundaan Operasi</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>30 Menit-1 Jam sebelum Operasi</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Total Operasi Bersih</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Tindakan</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Meninggal</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Umum</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>BPJS</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jamkesda</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Lain-Lain</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Total Cara Bayar</th>
</tr>
<tr><td style=\'background:#fffff;border:1px solid grey;\'>';
	echo '<s';
	echo 'elect id=\'pelayanan\' name=\'pelayanan\' style=\'font-size:10px\'; onChange=\'cek()\'>
<option value="';
	echo '' . $row_x['code_list'];
	echo '">';
	echo '' . $row_x['code_list'] . '&nbsp;-&nbsp;' . $row_x['nama'];
	echo '</option>
';
	$sql = 'select kode,nama from m_poly order by kode';
	
	$hasil = mysql_query( $sql);
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $kode . '\'>' . $kode . '&nbsp;-&nbsp;' . $nama . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_meja\' name=\'j_meja\' size=3 ';

	if (1 <= $row_x[j_meja]) {
		echo '' . 'value=' . $row_x['j_meja'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_tindakan_cito\' name=\'j_tindakan_cito\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[j_tindakan_cito]) {
		echo '' . 'value=' . $row_x['j_tindakan_cito'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_pasien_cito\' name=\'j_pasien_cito\' size=3  onchange=\'hitung()\' ';

	if (1 <= $row_x[j_pasien_cito]) {
		echo '' . 'value=' . $row_x['j_pasien_cito'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_mati_cito\' name=\'j_mati_cito\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[j_mati_cito]) {
		echo '' . 'value=' . $row_x['j_mati_cito'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'podr1\' name=\'podr1\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[podr1]) {
		echo '' . 'value=' . $row_x['podr1'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_tindakan_sel\' name=\'j_tindakan_sel\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[j_tindakan_sel]) {
		echo '' . 'value=' . $row_x['j_tindakan_sel'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_pasien_sel\' name=\'j_pasien_sel\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[j_pasien_sel]) {
		echo '' . 'value=' . $row_x['j_pasien_sel'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'dot1\' name=\'dot1\' size=3 ';

	if (1 <= $row_x[dot1]) {
		echo '' . 'value=' . $row_x['dot1'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'podr_sel\' name=\'podr_sel\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[podr_sel]) {
		echo '' . 'value=' . $row_x['podr_sel'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'rata_rawat\' name=\'rata_rawat\' size=3 ';

	if (1 <= $row_x[rata_rawat]) {
		echo '' . 'value=' . $row_x['rata_rawat'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_tunda_operasi\' name=\'j_tunda_operasi\' size=3 ';

	if (1 <= $row_x[j_tunda_operasi]) {
		echo '' . 'value=' . $row_x['j_tunda_operasi'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'j_pasien_pasca\' name=\'j_pasien_pasca\' size=3 ';

	if (1 <= $row_x[j_pasien_pasca]) {
		echo '' . 'value=' . $row_x['j_pasien_pasca'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'profilaksis_30\' name=\'profilaksis_30\' size=3 ';

	if (1 <= $row_x[profilaksis_30]) {
		echo '' . 'value=' . $row_x['profilaksis_30'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'profilaksis_jumlah\' name=\'profilaksis_jumlah\' size=3 ';

	if (0 <= $row_x[profilaksis_jumlah]) {
		echo '' . 'value=' . $row_x['profilaksis_jumlah'];
	} 
else {
		echo 'value=0';
	}

	echo ' ></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'tindakan\' name=\'tindakan\' size=3  disabled ';

	if (0 <= $tindakan_x) {
		echo '' . 'value=' . $tindakan_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'pasien\' name=\'pasien\' size=3  disabled ';

	if (0 <= $pasien_x) {
		echo '' . 'value=' . $pasien_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'mati\' name=\'mati\' size=3  disabled ';

	if (0 <= $mati_x) {
		echo '' . 'value=' . $mati_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>

<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'umum\' name=\'umum\' size=3 onchange=\'hitung()\'';

	if (1 <= $row_x[umum]) {
		echo '' . 'value=' . $row_x['umum'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bpjs\' name=\'bpjs\' size=3 onchange=\'hitung()\'';

	if (1 <= $row_x[bpjs]) {
		echo '' . 'value=' . $row_x['bpjs'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'jamkesda\' name=\'jamkesda\' size=3 onchange=\'hitung()\'';

	if (1 <= $row_x[jamkesda]) {
		echo '' . 'value=' . $row_x['jamkesda'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'lain\' name=\'lain\' size=3 onchange=\'hitung()\'';

	if (1 <= $row_x[lain]) {
		echo '' . 'value=' . $row_x['lain'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'t_carabayar_x\' name=\'t_carabayar_x\' size=3  disabled  ';

	if (0 <= $t_carabayar_x) {
		echo '' . 'value=' . $t_carabayar_x;
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
			</div>
		</div>
</body>


</html>';
?>