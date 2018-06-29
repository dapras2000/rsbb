<style>
thead th, thead td{text-align:center;}
thead tr:last{border-bottom :1px solid #999;}
</style>
<div align="center">
<div id="frame">
    <div id="frame_title"><h3>Laporan RL 3.1.1</h3></div>


<table border="0" width="95%">
	<tr valign="top">
		<td align="center">
		
	<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include( '../include/connect.php' );
	$kode = $_GET[id];
	
	$smt = $_GET[smt];
	
	$koders = $_GET[koders];
	
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;
	$sql_x = '' . 'select a.code_list,b.description,a.rs,a.pkm,a.faskes_lain,a.nonrujukan,a.p_baru,a.p_lama,a.k_baru,a.k_lama,a.dirujuk,a.rujuknalik from rl311 a left join m_rl311 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.bulan=\'' . $smt . '\' and a.tahun=\'' . $tahun . '\'';	
	$hasil_x = mysql_query( $sql_x );
	$row_x = mysql_fetch_array( $hasil_x );
	
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
	  
    </script>';

	echo '<script type="text/javascript">
		$(document).ready(function() {
		$.post(\'rm/ambildata_rl311.php\',
			{   \'reqdata\'   :\'cari_rl311\',
                \'koders\'   :$(\'#koders\').val(),
                \'smstr\'     :$(\'#smstr\').val(),
				\'tahun\'     :$(\'#tahun\').val()
                },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	});
</script>';
	
	echo '<script type="text/javascript">
   function cek(){
   document.getElementById(\'p_baru\').focus(); 
	document.getElementById(\'p_baru\').value=0;
	document.getElementById(\'p_lama\').value=0;
	document.getElementById(\'k_baru\').value=0;
	document.getElementById(\'k_lama\').value=0;
	document.getElementById(\'rs\').value=0;
	document.getElementById(\'pkm\').value=0;
	document.getElementById(\'faskes\').value=0;';
	echo '
document.getElementById(\'nonrujukan\').value=0;
document.getElementById(\'rujukbalik\').value=0;
document.getElementById(\'dirujuk\').value=0;
 }
</script>';
	
	echo '<script>
	function create_xml(){
	$.post(\'rm/ambildata_rl311.php\',
			{   \'reqdata\'   :\'xml_rl311\',
                \'koders\'   :$(\'#koders\').val(),
                \'smstr\'     :$(\'#smstr\').val(),
				\'tahun\'     :$(\'#tahun\').val(),
	        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>';

	echo '<script>
	function cari(){
	$.post(\'rm/ambildata_rl311.php\',
			{   \'reqdata\'   :\'cari_rl311\',
                \'koders\'   :$(\'#koders\').val(),
                \'smstr\'     :$(\'#smstr\').val(),
				\'tahun\'     :$(\'#tahun\').val(),
			},
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
function cancel(){
	window.location = "'._BASE_.'/index.php?link=rl311";
}
</script>';
	
	
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
	echo ': 10px verdana; 
					
                    
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
		.th1{vertical-align';
	echo ':center}
		#tr_d{
		background : #666;
		BORDER-TOP: 1px solid grey;"}
	
				#menu{ 
    opacity:0.92; 
    position: absolute;
    top: 115px;

}
	#teks{ 
    opacity:0.92; 
    position: absolute;
    top: 90px;
    left: auto;
	
}
		
						
		.rest{ font:10px; color:red;}
    </style>
	';
	echo '<s';
	echo 'tyle>
    .ganjil { 
      background-color:#666; /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }
	.ganjil1 { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#666; /* baris genap berwarna hijau tua */ 
    }   
    .tbheadin';
	echo 'g { 
      background-color:#cc4afa; /* baris genap berwarna hijau tua */ 
    }   
    </style>

</head>


<tr class=\'tr_s\'><td colspan=2><table width="95%" id=\'tbl_reg\' name=\'tbl_reg\'>
<tr class=\'tr_s\'><td style=\'background:#39b54a;border:1px solid grey;\' colspan=4>';
	echo '<strong>Periode :</strong></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Semester :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
	echo $kode_rs;
	echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
	echo '' . $kode;
	echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
	echo '' . $smt;
	echo '">';
	echo '<s';
	echo 'elect id=\'smstr\' name=\'smstr\' onChange=\'cari()\'>
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

	if ($tahun == '2014') {
		echo 'selected="selected"';
	}

	echo '>2014</option>
<option value="2015" ';

	if ($tahun == '2015') {
		echo 'selected="selected"';
	}

	echo '>2015</option>
<option value="2016" ';

	if ($tahun == '2016') {
		echo 'selected="selected"';
	}

	echo '>2016</option>
<option value="2017" ';

	if ($tahun == '2017') {
		echo 'selected="selected"';
	}

	echo '>2017</option>
<option value="2018" ';

	if ($tahun == '2018') {
		echo 'selected="selected"';
	}

	echo '>2018</option>
<option value="2019" ';

	if ($tahun == '2019') {
		echo 'selected="selected"';
	}

	echo '>2019</option>
</select>
</td></tr>
</table>
<div id=\'entri\'>
<input type=\'button\' id=\'input2\' value=\'Buat File Laporan\' onclick=\'create_xml()\'></div>
<br>
<form name=\'rajal\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=11>';
	echo '<s';
	echo 'trong>Data Pelayanan</strong></td></tr>
<tr><th rowspan=2 style=\'background:#666;border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=2  style=\'background:#666;border:1px solid grey;\'>Pengunjung</th>
<th colspan=2 style=\'background:#666;border:1px solid grey;\'>Kunjungan</th><th colspan=3 style=\'background:#666;border:1px solid grey;\'>Asal Rujukan</th>
<th rowspan=2 style=\'background:#666;b';
	echo 'order:1px solid grey;\'>Non Rujukan</th><th colspan=2 style=\'background:#666;border:1px solid grey;\'>Rujukan</th>
</tr>
<tr><th style=\'background:#666;border:1px solid grey;\'>Baru</th><th style=\'background:#666;border:1px solid grey;\'>Lama</th><th style=\'background:#666;border:1px solid grey;\'>Baru</th><th style=\'background:#666;border:1px solid grey;\'>Lama</th><th style=\'background:#666;bord';
	echo 'er:1px solid grey;\'>Puskesmas</th><th style=\'background:#666;border:1px solid grey;\'>RS</th>
<th style=\'background:#666;border:1px solid grey;\'>Faskes Lain</th>
<th style=\'background:#666;border:1px solid grey;\'>Dirujuk</th><th style=\'background:#666;border:1px solid grey;\'>Rujuk Balik</th>
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
	$sql = 'select code_list,description from m_rl311 where code_list!=\'\' order by code_group,ord';
	
	$hasil = mysql_query( $sql );
	

	while ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $code_list . '\'>' . $code_list . '&nbsp;-&nbsp;' . $description . '</option>
';
	}

	echo '</select></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_baru\' name=\'p_baru\' size=3 ';

	if (1 <= $row_x[p_baru]) {
		echo '' . 'value=' . $row_x['p_baru'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'p_lama\' name=\'p_lama\' size=3 ';

	if (1 <= $row_x[p_lama]) {
		echo '' . 'value=' . $row_x['p_lama'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'k_baru\' name=\'k_baru\' size=3 ';

	if (1 <= $row_x[k_baru]) {
		echo '' . 'value=' . $row_x['k_baru'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'k_lama\' name=\'k_lama\' size=3 ';

	if (1 <= $row_x[k_lama]) {
		echo '' . 'value=' . $row_x['k_lama'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'pkm\' name=\'pkm\' size=3  ';

	if (1 <= $row_x[pkm]) {
		echo '' . 'value=' . $row_x['pkm'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'rs\' name=\'rs\' size=3 ';

	if (1 <= $row_x[rs]) {
		echo '' . 'value=' . $row_x['rs'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'faskes\' name=\'faskes\' size=3 ';

	if (1 <= $row_x[faskes_lain]) {
		echo '' . 'value=' . $row_x['faskes_lain'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'nonrujukan\' name=\'nonrujukan\' size=3 value=0 ';

	if (1 <= $row_x[nonrujukan]) {
		echo '' . 'value=' . $row_x['nonrujukan'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'dirujuk\' name=\'dirujuk\' size=3 ';

	if (1 <= $row_x[dirujuk]) {
		echo '' . 'value=' . $row_x['dirujuk'];
	} 
else {
		echo '0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:10px;\'><input type=\'text\' id=\'rujukbalik\' name=\'rujukbalik\' size=3 ';

	if (1 <= $row_x[rujukbalik]) {
		echo '' . 'value=' . $row_x['rujukbalik'];
	} 
else {
		echo '0';
	}

	echo '></td>
</tr>
<tr><td colspan=13 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table>';
?>
				
        </td>
    </tr>
</table>
</div>
</div>