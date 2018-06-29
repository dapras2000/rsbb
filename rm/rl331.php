<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';

	$kode = $_GET[id];
	$bln = $_GET[bln];
	$koders = $_GET[koders];
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;
	
	$sql_x = '' . 'select a.code_list,b.nama_unit,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.p_beresiko_jatuh,a.jumlah_tt,a.pengembalian_rm,a.j_hari, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	$total = $row_x[pasien_awal] + $row_x[pasien_masuk] + $row_x[pasien_keluar_hidup] + $row_x[pasien_keluar_mati_k48] + $row_x[pasien_keluar_mati_l48];
	$total2 = $row_x[spvip] + $row_x[vip] + $row_x[I] + $row_x[II] + $row_x[III] + $row_x[kelas_khusus];
	$bor = round( $total2 / ( $row_x[jumlah_tt] + $row_x[j_hari] ) + 100, 2 );
	
	$alos = round( $row_x[lama_dirawat] / ( $row_x[pasien_keluar_hidup] + $row_x[pasien_keluar_mati_k48] + $row_x[pasien_keluar_mati_l48] ), 2 );
	
	$ndr = round( $row_x[pasien_keluar_mati_l48] / ( $row_x[pasien_keluar_hidup] + $row_x[pasien_keluar_mati_k48] + $row_x[pasien_keluar_mati_l48] ) + 1000, 2 );
	
	$gdr = round( ( $row_x[pasien_keluar_mati_l48] + $row_x[pasien_keluar_mati_k48] ) / ( $row_x[pasien_keluar_hidup] + $row_x[pasien_keluar_mati_k48] + $row_x[pasien_keluar_mati_l48] ) + 1000, 2 );
	
	$bto = round( ( $row_x[pasien_keluar_mati_l48] + $row_x[pasien_keluar_mati_k48] + $row_x[pasien_keluar_hidup] ) / $row_x[j_hari], 2 );
	
	$toi = round( ( $row_x[jumlah_tt] + $row_x[j_hari] - $total2 ) / ( $row_x[pasien_keluar_hidup] + $row_x[pasien_keluar_mati_k48] + $row_x[pasien_keluar_mati_l48] ), 2 );
	
	$p_jatuh = round( $row_x[pasien_jatuh] / $row_x[p_beresiko_jatuh] + 100, 2 );
	$t_carabayar_x = $row_x[umum] + $row_x[bpjs] + $row_x[jamkesda] + $row_x[lain];
	
	echo '<html>

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
	document.getElementById(\'total_faskes\').disabled=true;
	document.getElementById(\'total_faskes\').style.backgroundColor=\'#cccccc\';
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
		document.getElementById(\'pasien_akhir\').disabled=true;
		document.getElementById(\'pasien_akhir\').backgroundColor=\'#ccccc\';
		document.getElementById(\'pasien_akhir\').value=eval(document.getElementById(\'pasien_awal\').value) + eval(document.getElementById(\'pasien_masuk\').value) - (eval(document.getElementById(\'pasien_keluar_hidup\').value) +  eval(document.getElementById(\'pasien_keluar_mati_k48\').value) +  eval(document.getElementById(\'pasien_keluar_mati_l48\').value));
		hitung4();
	}
	function hitung2(){
		document.getElementById(\'hari_perawatan\').disabled=true;
		document.getElementById(\'hari_perawatan\').backgroundColor=\'#ccccc\';
		document.getElementById(\'hari_perawatan\').value=eval(document.getElementById(\'spvip\').value) + eval(document.getElementById(\'vip\').value) +  eval(document.getElementById(\'i\').value) +  eval(document.getElementById(\'ii\').value) +  eval(document.getElementById(\'iii\').value) +  eval(document.getElementById(\'kelas_khusus\').value);
		hitung3();
	}	
	function hitung3(){
		document.getElementById(\'bor\').disabled=true;
		document.getElementById(\'bor\').backgroundColor=\'#ccccc\';
		document.getElementById(\'bor\').value=eval(document.getElementById(\'hari_perawatan\').value)/ (eval(document.getElementById(\'jumlah_tt\').value) *  eval(document.getElementById(\'j_hari\').value))*100;
		hitung4();
	}
	function hitung4(){
		document.getElementById(\'alos\').disabled=true;
		document.getElementById(\'alos\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'alos\').value=eval(document.getElementById(\'lama_dirawat\').value)/ (eval(document.getElementById(\'pasien_keluar_hidup\').value) +  eval(document.getElementById(\'pasien_keluar_mati_k48\').value) +  eval(document.getElementById(\'pasien_keluar_mati_l48\').value));
		document.getElementById(\'ndr\').disabled=true;
		document.getElementById(\'ndr\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'ndr\').value=eval(document.getElementById(\'pasien_keluar_mati_l48\').value)/ (eval(document.getElementById(\'pasien_keluar_hidup\').value) +  eval(document.getElementById(\'pasien_keluar_mati_k48\').value) +  eval(document.getElementById(\'pasien_keluar_mati_l48\').value))*1000;
		document.getElementById(\'gdr\').disabled=true;
		document.getElementById(\'gdr\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'gdr\').value=(eval(document.getElementById(\'pasien_keluar_mati_k48\').value) + eval(document.getElementById(\'pasien_keluar_mati_l48\').value))/ (eval(document.getElementById(\'pasien_keluar_hidup\').value) +  eval(document.getElementById(\'pasien_keluar_mati_k48\').value) +  eval(document.getElementById(\'pasien_keluar_mati_l48\').value))*1000;
		document.getElementById(\'bto\').disabled=true;
		document.getElementById(\'bto\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'bto\').value=(eval(document.getElementById(\'pasien_keluar_hidup\').value) + eval(document.getElementById(\'pasien_keluar_mati_k48\').value) + eval(document.getElementById(\'pasien_keluar_mati_l48\').value))/ eval(document.getElementById(\'jumlah_tt\').value);
		document.getElementById(\'toi\').disabled=true;
		document.getElementById(\'toi\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'toi\').value=((eval(document.getElementById(\'jumlah_tt\').value) * eval(document.getElementById(\'j_hari\').value))- eval(document.getElementById(\'hari_perawatan\').value))/ (eval(document.getElementById(\'pasien_keluar_hidup\').value) +  eval(document.getElementById(\'pasien_keluar_mati_k48\').value) +  eval(document.getElementById(\'pasien_keluar_mati_l48\').value));
		document.getElementById(\'p_jatuh\').disabled=true;
		document.getElementById(\'p_jatuh\').style.backgroundColor=\'#ccccc\';
		document.getElementById(\'p_jatuh\').value=eval(document.getElementById(\'pasien_jatuh\').value)/eval(document.getElementById(\'p_beresiko\').value)*100;
	}
	
	function hitung5(){
		document.getElementById(\'t_carabayar_x\').disabled=true;
		document.getElementById(\'t_carabayar_x\').backgroundColor=\'#ccccc\';
		document.getElementById(\'t_carabayar_x\').value=((eval(document.getElementById(\'umum\').value) + eval(document.getElementById(\'bpjs\').value)) + eval(document.getElementById(\'jamkesda\').value)) + (eval(document.getElementById(\'lain\').value));
		
	}
	
	</script>
		';
	
	echo '<script type="text/javascript">
   function cek(){
		document.getElementById(\'pasien_awal\').focus();   
		document.getElementById(\'pasien_awal\').value=0;
		document.getElementById(\'pasien_masuk\').value=0;
		document.getElementById(\'pasien_keluar_hidup\').value=0;
		document.getElementById(\'pasien_keluar_mati_k48\').value=0;
		document.getElementById(\'pasien_keluar_mati_l48\').value=0;
		document.getElementById(\'pasien_akhir\').value=0;
		document.getElementById(\'lama_dirawat\').value=0;
		document.getElementById(\'spvip\').value=0;
		document.getElementById(\'vip\').value=0;
		document.getElementById(\'i\').value=0;
		document.getElementById(\'ii\').value=0;
		document.getElementById(\'iii\').value=0;
		document.getElementById(\'kelas_khusus\').value=0;
		document.getElementById(\'hari_perawatan\').value=0;
		document.getElementById(\'pasien_jatuh\').value=0;
		document.getElementById(\'p_beresiko\').value=0;
		document.getElementById(\'jumlah_tt\').value=0;
		document.getElementById(\'pengembalian_rm\').value=0;
		document.getElementById(\'t_carabayar_x\').value=0;
   }
</script>
';
	echo '<script>
   function cari(){
		$.post(\'rm/ambildata_rl331.php\',
			{   \'reqdata\'   :\'cari_rl331\',
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
$.post(\'rm/ambildata_rl331.php\',
			{   \'reqdata\'   :\'xml_rl331\',
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
		function cancel(){
			window.location.replace("'._BASE_.'index.php?link=rl331");
		}

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
	}';
	echo '
if($(\'#j_harisave\').val()==""){
alert(\'Jumlah Hari Belum Diisi\');
   	$(\'#j_harisave\').focus();
	return false;
	}	
	$.post(\'rm/ambildata_rl331.php\',
			{   \'reqdata\'   :\'save_rl331\',
                            \'bln\'   :$(\'#bln\').val(),
							\'tahunsave\'   :$(\'#tahunsave\').val(),
							\'hari\'   :$(\'#j_harisave\').val(),
							\'pelayanan\'   :$(\'#pelayanan\').val(),
							\'pasien_awal\'   :$(\'#pasien_awal\').val(),
							\'pasien_masuk\'   :$(\'#pasien_masuk\').val(),
							\'pasien_keluar_hidup\'   :$(\'#pasien_keluar_hidup\').val(),
							\'pkm_k48\'   :$(\'#pasien_keluar_mati_k48\').val(),
							\'pkm_l48\'   :$(\'#pasien_keluar_mati_l48\').val(),
							\'lama_dirawat\'   :$(\'#lama_dirawat\').val(),
							\'spvip\'   :$(\'#spvip\').val(),
							\'vip\'   :$(\'#vip\').val(),
							\'i\'   :$(\'#i\').val(),
							\'ii\'  :$(\'#ii\').val(),
							\'iii\'   :$(\'#iii\').val(),
							\'kelas_khusus\'   :$(\'#kelas_khusus\').val(),
							\'p_beresiko\'   :$(\'#p_beresiko\').val(),							
							\'pasien_jatuh\'   :$(\'#pasien_jatuh\').val(),
							\'jumlah_tt\'   :$(\'#jumlah_tt\').val(),
							\'pengembalian_rm\'   :$(\'#pengembalian_rm\').val(),
							\'umum\'   :$(\'#umum\').val(),
							\'bpjs\'   :$(\'#bpjs\').val(),
							\'jamkesda\'   :$(\'#jamkesda\').val(),
							\'lain\'   :$(\'#lain\').val(),
							\'koders\'   :$(\'#koders\').val()
			  },
			    
			function (data) {
				';
	echo '$(\'#hasil\').html(data);
			}
			);
	
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
                    font: 10px verdana; 
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
    .tbheading { 
      background-color:#f1fe1b; 
	 
	  /* baris genap berwarna hijau tua */ } 
       
    </style>
</head>

<body bgcolor="#fff">
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Laporan RL 3.3.1</h3></div>
		<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
			<tr class=\'tr_s\'>
				<td colspan=2>
					<table id=\'tbl_regreg\' name=\'tbl_regreg\'>
<tr class=\'tr_s\'><td colspan=6>';
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
</td>
<td class=\'td_d\'>Jumlah Hari 1 Periode :</td>
<td class=\'td_d\'><input type=\'text\' id=\'j_hari\' name=\'j_hari\' value="';
	echo '' . $row_x['j_hari'];
	echo '" size=3 onchange=\'hitung3()\' ></td>
</tr>
</table>

<table id=\'tbl_reg\' name=\'tbl_reg\'>
<tr class=\'tr_s\'><td colspan=6>';
	echo '<strong>Periode :</strong></td></tr>
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
</td>
<td class=\'td_d\'>Jumlah Hari 1 Periode :</td>
<td class=\'td_d\'><input type=\'text\' id=\'j_harisave\' name=\'j_harisave\' value="';
	echo '' . $row_x['j_hari'];
	echo '" size=3 onchange=\'hitung3()\' ></td>
</tr>
</table>

<div id=\'entri\'>
<input type=\'button\' id=\'input\' value=\'Entri Data\' onclick=\'entri()\'>&nbsp;<input type=\'button\' id=\'input\' value=\'Buat File Laporan\' onclick=\'get_xml()\'></div>
<br>
<form name=\'irna\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<strong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jenis Pelayanan</th><th rowspan=2  style=\'background:#39b54a;border:1px solid grey;\'>Pasien Awal</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Masuk</th><th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Keluar Hidup</th>
<th colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Keluar Mati</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Akhir</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Lama Dirawat</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Hari Perawatan</th>
<th colspan=6 style=\'background:#39b54a;border:1px solid grey;\'>Rincian Hari Perawatan Per Kelas</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Beresiko Jatuh</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pasien Jatuh</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah TT</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Pengembalian RM 1x24 Jam</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>BOR</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>ALOS</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>NDR</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>GDR</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>BTO</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>TOI</th>
<th rowspan=2 style=\'background:#39b54a;border:1px solid grey;\'>% Pasien Jatuh</th>
<th colspan=5 style=\'background:#39b54a;border:1px solid grey;\'>Cara Bayar</th>

</tr>
<tr><th style=\'background:#39b54a;border:1px solid grey;\'>< 48 Jam</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>>= 48 Jam</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Super VIP</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>VIP</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>I</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>II</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>III</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>Kelas Khusus</th>
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
	echo '' . $row_x['code_list'] . '&nbsp;-&nbsp;' . $row_x['nama_unit'];
	echo '</option>
';
	$sql = 'select kode_unit,nama_unit from m_unit order by kode_unit';
	
	$hasil = mysql_query( $sql);
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $kode_unit . '\'>' . $kode_unit . '&nbsp;-&nbsp;' . $nama_unit . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_awal\' name=\'pasien_awal\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[pasien_awal]) {
		echo '' . 'value=' . $row_x['pasien_awal'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_masuk\' name=\'pasien_masuk\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[pasien_masuk]) {
		echo '' . 'value=' . $row_x['pasien_masuk'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_keluar_hidup\' name=\'pasien_keluar_hidup\' onchange=\'hitung()\' size=3 ';

	if (1 <= $row_x[pasien_keluar_hidup]) {
		echo '' . 'value=' . $row_x['pasien_keluar_hidup'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_keluar_mati_k48\' name=\'pasien_keluar_mati_k48\' size=3 onchange=\'hitung()\' ';

	if (1 <= $row_x[pasien_keluar_mati_k48]) {
		echo '' . 'value=' . $row_x['pasien_keluar_mati_k48'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_keluar_mati_l48\' name=\'pasien_keluar_mati_l48\' size=3 onchange=\'hitung()\'  ';

	if (1 <= $row_x[pasien_keluar_mati_l48]) {
		echo '' . 'value=' . $row_x['pasien_keluar_mati_l48'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_akhir\' name=\'pasien_akhir\' size=3 ';

	if (1 <= $total) {
		echo '' . 'value=' . $total;
	} 
else {
		echo '0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'lama_dirawat\' name=\'lama_dirawat\' size=3 onchange=\'hitung4()\' ';

	if (1 <= $row_x[lama_dirawat]) {
		echo '' . 'value=' . $row_x['lama_dirawat'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'hari_perawatan\' name=\'hari_perawatan\' size=3 ';

	if (1 <= $total2) {
		echo '' . 'value=' . $total2;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'spvip\' name=\'spvip\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[spvip]) {
		echo '' . 'value=' . $row_x['spvip'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'vip\' name=\'vip\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[vip]) {
		echo '' . 'value=' . $row_x['vip'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'i\' name=\'i\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[I]) {
		echo '' . 'value=' . $row_x['I'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'ii\' name=\'ii\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[II]) {
		echo '' . 'value=' . $row_x['II'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'iii\' name=\'iii\' size=3 onchange=\'hitung2()\' ';

	if (1 <= $row_x[III]) {
		echo '' . 'value=' . $row_x['III'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'kelas_khusus\' name=\'kelas_khusus\' onchange=\'hitung2()\' size=3 ';

	if (1 <= $row_x[kelas_khusus]) {
		echo '' . 'value=' . $row_x['kelas_khusus'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_beresiko\' name=\'p_beresiko\' size=3 ';

	if (1 <= $row_x[p_beresiko_jatuh]) {
		echo '' . 'value=' . $row_x['p_beresiko_jatuh'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pasien_jatuh\' name=\'pasien_jatuh\' size=3 ';

	if (1 <= $row_x[pasien_jatuh]) {
		echo '' . 'value=' . $row_x['pasien_jatuh'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'jumlah_tt\' name=\'jumlah_tt\' size=3 onchange=\'hitung3()\' ';

	if (1 <= $row_x[jumlah_tt]) {
		echo '' . 'value=' . $row_x['jumlah_tt'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pengembalian_rm\' name=\'pengembalian_rm\' size=3 ';

	if (1 <= $row_x[pengembalian_rm]) {
		echo '' . 'value=' . $row_x['pengembalian_rm'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bor\' name=\'bor\' size=3 ';

	if (0 <= $bor) {
		echo '' . 'value=' . $bor;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'alos\' name=\'alos\' size=3 ';

	if (0 <= $alos) {
		echo '' . 'value=' . $alos;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'ndr\' name=\'ndr\' size=3 ';

	if (0 <= $ndr) {
		echo '' . 'value=' . $ndr;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'gdr\' name=\'gdr\' size=3 ';

	if (0 <= $gdr) {
		echo '' . 'value=' . $gdr;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bto\' name=\'bto\' size=3 ';

	if (0 <= $bto) {
		echo '' . 'value=' . $bto;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'toi\' name=\'toi\' size=3 ';

	if (0 <= $toi) {
		echo '' . 'value=' . $toi;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_jatuh\' name=\'p_jatuh\' size=3 ';

	if (0 <= $p_jatuh) {
		echo '' . 'value=' . $p_jatuh;
	} 
else {
		echo 'value=0';
	}

	echo ' disabled></td>
	
	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'umum\' name=\'umum\' size=3 onchange=\'hitung5()\'';

	if (1 <= $row_x[umum]) {
		echo '' . 'value=' . $row_x['umum'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'bpjs\' name=\'bpjs\' size=3 onchange=\'hitung5()\'';

	if (1 <= $row_x[bpjs]) {
		echo '' . 'value=' . $row_x['bpjs'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'jamkesda\' name=\'jamkesda\' size=3 onchange=\'hitung5()\'';

	if (1 <= $row_x[jamkesda]) {
		echo '' . 'value=' . $row_x['jamkesda'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>

	<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'lain\' name=\'lain\' size=3 onchange=\'hitung5()\'';

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
<tr><td colspan=11 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onclick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table>

</div>
</body>


</html>';
?>