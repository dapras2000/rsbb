<?php

	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';

	$kode = $_GET[id];
	$bln = $_GET[bln];
	$koders = $_GET[koders];
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;

	$sql_x = '' . 'select a.p_beresiko,a.code_list,b.description,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	$bor_x = $row_x[hari_rawat] / ( $row_x[tt] + $row_x[j_hari] ) + 100;
	$los_x = $row_x[lama_rawat] / ( $row_x[pkh] + $row_x[pkm_k48] + $row_x[pkm_l48] );
	$ndr_x = $row_x[pkm_l48] / ( $row_x[pkh] + $row_x[pkm_k48] + $row_x[pkm_l48] );
	$gdr_x = ( $row_x[pkm_k48] + $row_x[pkm_l48] ) / ( $row_x[pkh] + $row_x[pkm_k48] + $row_x[pkm_l48] ) + 1000;
	$bto_x = ( $row_x[pkh] + $row_x[pkm_k48] + $row_x[pkm_l48] ) / $row_x[tt];
	$toi_x = ( $row_x[tt] + $row_x[j_hari] - $row_x[hari_rawat] ) / ( $row_x[pkh] + $row_x[pkm_k48] + $row_x[pkm_l48] );
	$p_jatuh_x = $row_x[p_jatuh] / $row_x[p_beresiko] + 100;
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
	echo '	document.getElementById(\'total_faskes\').disabled=true;
			document.getElementById(\'total_faskes\').style.backgroundColor=\'#cccccc\';
			document.getElementById(\'p_akhir\').disabled=true;
			document.getElementById(\'p_akhir\').style.backgroundColor=\'#cccccc\';
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
		document.getElementById(\'p_akhir\').disabled=true;
		document.getElementById(\'p_akhir\').backgroundColor=\'#ccccc\';
		document.getElementById(\'p_akhir\').value=(eval(document.getElementById(\'p_awal\').value)+eval(document.getElementById(\'p_masuk\').value))-(eval(document.getElementById(\'pkh\').value)+eval(document.getElementById(\'pkm_k48\').value)+eval(document.getElementById(\'pkm_l48\').value));
		document.getElementById(\'bor\').disabled=true;
		document.getElementById(\'bor\').backgroundColor=\'#ccccc\';
		document.getElementById(\'bor\').value=eval(document.getElementById(\'hari_rawat\').value)/(eval(document.getElementById(\'tt\').value)*eval(document.getElementById(\'j_hari\').value))*100;
		document.getElementById(\'alos\').disabled=true;
		document.getElementById(\'alos\').backgroundColor=\'#ccccc\';
		document.getElementById(\'alos\').value=eval(document.getElementById(\'lama_rawat\').value) /(eval(document.getElementById(\'pkh\').value) + eval(document.getElementById(\'pkm_k48\').value) + e';
		echo 'val(document.getElementById(\'pkm_l48\').value));	
		document.getElementById(\'ndr\').disabled=true;
		document.getElementById(\'ndr\').backgroundColor=\'#ccccc\';
		document.getElementById(\'ndr\').value=eval(document.getElementById(\'pkm_l48\').value) /(eval(document.getElementById(\'pkh\').value) + eval(document.getElementById(\'pkm_k48\').value) + eval(document.getElementById(\'pkm_l48\').value));	
		document.getElementById(\'gdr\').disabled=true;
		document.getElementById(\'gdr\').backgroundColor=\'#ccccc\';
		document.getElementById(\'gdr\').value=(eval(document.getElementById(\'pkm_k48\').value) + eval(document.getElementById(\'pkm_l48\').value)) /(eval(document.getElementById(\'pkh\').value) + eval(document.getElementById(\'pkm_k48\').value) + eval(document.getElementById(\'pkm_l48\').value))*1000;	
		document.getElementById(\'bto\').disabled=true;
		document.getElementById(\'bto\').backgroundColor=\'#ccccc\';
		document.getElementById(\'bto\').value=(eval(document.getElementById(\'pkh\').value) + eval(document.getElementById(\'pkm_k48\').value) + eval(document.getElementById(\'pkm_l48\').value)) /eval(document.getElementById(\'tt\').value);
		document.getElementById(\'toi\').disabled=true;
		document.getElementById(\'toi\').backgroundColor=\'#ccccc\';
		document.getElementById(\'toi\').value=((eval(document.getElementById(\'tt\').value) * eval(document.getElementById(\'j_hari\').value)) - eval(document.getElementById(\'hari_rawat\').value)) / (eval(document.getElementById(\'pkh\').value) + eval(document.getElementById(\'pkm_k48\').value) + eval(document.getElementById(\'pkm_l48\').value));
		
		}

	function hitung2(){
		document.getElementById(\'p_jatuh_x\').disabled=true;
		document.getElementById(\'p_jatuh_x\').backgroundColor=\'#ccccc\';
		document.getElementById(\'p_jatuh_x\').value=eval(document.getElementById(\'p_jatuh\').value) /eval(document.getElementById(\'p_beresiko\').value)*100;
		
		document.getElementById(\'t_carabayar_x\').disabled=true;
		document.getElementById(\'t_carabayar_x\').backgroundColor=\'#ccccc\';
		document.getElementById(\'t_carabayar_x\').value=((eval(document.getElementById(\'umum\').value) + eval(document.getElementById(\'bpjs\').value)) + eval(document.getElementById(\'jamkesda\').value)) + (eval(document.getElementById(\'lain\').value));
		
	}
	</script>
		';

	echo '<script type="text/javascript">
   function cek(){
document.getElementById(\'p_awal\').value=0;
document.getElementById(\'p_masuk\').value=0;
document.getElementById(\'pkh\').value=0;
document.getElementById(\'pkm_k48\').value=0;
document.getElementById(\'pkm_l48\').value=0;
document.getElementById(\'p_akhir\').value=0;
document.getElementById(\'lama_rawat\').value=0;
document.getElementById(\'hari_rawat\').value=0;
document.getElementById(\'p_beresiko\').value=0;
document.getElementById(\'p_jatuh\').value=0;
document.getElementById(\'tt\').value=0;
document.getElementById(\'rm\').value=0;
document.getElementById(\'bor\').value=0;
document.getElementById(\'alos\').value=0;
document.getElementById(\'ndr\').value=0;
document.getElementById(\'gdr\').value=0;
document.getElementById(\'bto\').value=0;
document.getElementById(\'toi\').value=0;
document.getElementById(\'p_jatuh_x\').value=0;
document.getElementById(\'t_carabayar_x\').value=0;
}
</script>
';

	echo '<script>
   function cari(){
		$.post(\'rm/ambildata_rl341.php\',
			{   \'reqdata\'   :\'cari_rl341\',
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
		$.post(\'rm/ambildata_rl341.php\',
			{   \'reqdata\'   :\'xml_rl341\',
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
		if($(\'#j_hari\').val()==""){
			alert(\'Jumlah Hari Belum Diisi\');
		   	$(\'#j_hari\').focus();
			return false;
		}	
		$.post(\'rm/ambildata_rl341.php\',
			{   \'reqdata\'   :\'save_rl341\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahunsave\'   :$(\'#tahunsave\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'p_awal\'   :$(\'#p_awal\').val(),
							\'p_masuk\'   :$(\'#p_masuk\').val(),
							\'pkh\'   :$(\'#pkh\').val(),
							\'pkm_k48\'  :$(\'#pkm_k48\').val(),
							\'pkm_l48\'   :$(\'#pkm_l48\').val(),
							\'p_akhir\'   :$(\'#p_akhir\').val(),
							\'lama_rawat\'   :$(\'#lama_rawat\').val(),
							\'hari_rawat\'   :$(\'#hari_rawat\').val(),
							\'p_beresiko\'   :$(\'#p_beresiko\').val(),
							\'p_jatuh\'   :$(\'#p_jatuh\').val(),
							\'tt\'   :$(\'#tt\').val(),
							\'rm\'   :$(\'#rm\').val(),
							\'j_hari\'   :$(\'#j_hari\').val(),
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
		window.location.replace("'._BASE_.'index.php?link=rl341");
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
       		#tbl_reg {	
					width:1024px;
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
			#tbl_reg1 {	
					width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
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
		background : #eba3fe;
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
    .tbheading { 
      background-color:#f1fe1b; 
	 
	  /* baris genap berwarna hijau tua */ } 
       
    </style>
</head>


<body bgcolor="#fff">
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Laporan RL 3.4.1</h3></div>
		<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
			<tr class=\'tr_s\'>
				<td colspan=2>
					<table id=\'tbl_regreg\' name=\'tbl_regreg\'>
<tr class=\'tr_s\'><td colspan=4>';
	echo '<strong>Periode :</strong></td></tr>
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
<form name=\'irna\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jenis Pelayanan</th>
<th rowspan=2  style=\'background:#39b54a;border:1px solid grey;\'>Pasien Awal</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Masuk</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Keluar Hidup</th>
<th colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Keluar Mati</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Akhir</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Lama Dirawat</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Hari Perawatan</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Beresiko Jatuh</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Jatuh</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Tempat Tidur</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pengembalian RM 1x24 Jam</th>
<th colspan=7 style=\'background:#39b54a;border:1px solid grey;\'>Indikator</th>
<th colspan=5 style=\'background:#39b54a;border:1px solid grey;\'>Cara Bayar</th>
</tr>
<tr><th style=\'background:#39b54a;border:1px solid grey;\'> < 48</th>
<th style=\'background:#39b54a;border:1px solid grey;\'> >= 48</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>BOR</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>ALOS</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>NDR</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>GDR</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>BTO</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>TOI</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>%Pasien Jatuh</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Umum</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>BPJS</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Jamkesda</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Lain-Lain</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Total Cara Bayar</th>
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
	$sql = 'select code_list,description from m_rl341 order by code_list';
	
	$hasil = mysql_query( $sql );
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_awal\' name=\'p_awal\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[p_awal]) {
		echo '' . 'value=' . $row_x['p_awal'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_masuk\' name=\'p_masuk\' size=3 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p_masuk]) {
		echo '' . 'value=' . $row_x['p_masuk'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pkh\' name=\'pkh\' size=3  onchange=\'hitung()\' ';

	if (1 <= $row_x[pkh]) {
		echo '' . 'value=' . $row_x['pkh'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pkm_k48\' name=\'pkm_k48\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[pkm_k48]) {
		echo '' . 'value=' . $row_x['pkm_k48'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pkm_l48\' name=\'pkm_l48\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[pkm_l48]) {
		echo '' . 'value=' . $row_x['pkm_l48'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_akhir\' name=\'p_akhir\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[p_akhir]) {
		echo '' . 'value=' . $row_x['p_akhir'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'lama_rawat\' name=\'lama_rawat\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[lama_rawat]) {
		echo '' . 'value=' . $row_x['lama_rawat'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'hari_rawat\' name=\'hari_rawat\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[hari_rawat]) {
		echo '' . 'value=' . $row_x['hari_rawat'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_beresiko\' name=\'p_beresiko\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[p_beresiko]) {
		echo '' . 'value=' . $row_x['p_beresiko'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_jatuh\' name=\'p_jatuh\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[p_jatuh]) {
		echo '' . 'value=' . $row_x['p_jatuh'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'tt\' name=\'tt\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[tt]) {
		echo '' . 'value=' . $row_x['tt'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'rm\' name=\'rm\' size=3 ';

	if (1 <= $row_x[rm]) {
		echo '' . 'value=' . $row_x['rm'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	

<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bor\' name=\'bor\' size=3 ';

	if (0 <= $bor_x) {
		echo '' . 'value=' . $bor_x;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'alos\' name=\'alos\' size=3  disabled ';

	if (0 <= $los_x) {
		echo '' . 'value=' . $los_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'ndr\' name=\'ndr\' size=3  disabled ';

	if (0 <= $ndr_x) {
		echo '' . 'value=' . $ndr_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'gdr\' name=\'gdr\' size=3  disabled ';

	if (0 <= $gdr_x) {
		echo '' . 'value=' . $gdr_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bto\' name=\'bto\' size=3  disabled ';

	if (0 <= $bto_x) {
		echo '' . 'value=' . $bto_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'toi\' name=\'toi\' size=3  disabled ';

	if (0 <= $toi_x) {
		echo '' . 'value=' . $toi_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_jatuh_x\' name=\'p_jatuh_x\' size=3  disabled ';

	if (0 <= $p_jatuh_x) {
		echo '' . 'value=' . $p_jatuh_x;
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'umum\' name=\'umum\' size=3 onchange=\'hitung2()\'';

	if (1 <= $row_x[umum]) {
		echo '' . 'value=' . $row_x['umum'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bpjs\' name=\'bpjs\' size=3 onchange=\'hitung2()\'';

	if (1 <= $row_x[bpjs]) {
		echo '' . 'value=' . $row_x['bpjs'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'jamkesda\' name=\'jamkesda\' size=3 onchange=\'hitung2()\'';

	if (1 <= $row_x[jamkesda]) {
		echo '' . 'value=' . $row_x['jamkesda'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'lain\' name=\'lain\' size=3 onchange=\'hitung2()\'';

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