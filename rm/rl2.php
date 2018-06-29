<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include( '../include/connect.php' );

	$kode = $_GET[id];
	$smt = $_GET[smt];
	$koders = $_GET[koders];
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;
	$sql_x = '' . 'select a.code_list,b.description,a.tetap,a.tidak_tetap,a.tahun from rl2 a left join m_rl2 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $smt . '\' and a.kode_rs = \''.$koders.'\'';
	$hasil_x = mysql_query( $sql_x );
	$row_x = mysql_fetch_array( $hasil_x );
	$tenaga = $row_x['description'];
	$tetap = $row_x[tetap];
	$t_tetap = $row_x[t_tetap];
	echo '<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>';
	echo '<script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />';
	echo '<script type="text/javascript">
$(document).ready(function() {
$.post(\'ambildata.php\',
			{   \'reqdata\'   :\'pencarian_rl2\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smt\'     :$(\'#smt\').val(),
							\'tahun\'     :$(\'#tahun\').val()
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

});
</';
	echo 'script>
	';
	echo '<script type="text/javascript">
	$().ready(function() {	
		$("#nm_tenaga").autocomplete("proses.php", {
			width: 150
		});
		$("#nm_tenaga").result(function(event, data, formatted) {
			$(\'#x\').val(); 
	});
	
});
</script>
';
	echo '<s';
	echo 'cript>
   function cr_xml(){
$.post(\'ambildata.php\',
			{   \'reqdata\'   :\'xml_rl2\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'bln\'     :$(\'#smt\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

}
';
	echo '
function reset(){
$(\'#tbl_reg1\').load(\'tlb_reg.php\').hide().fadeIn(2000);

	  }
</script>

';
	echo '<s';
	echo 'cript>
   function cari(){
$.post(\'ambildata.php\',
			{   \'reqdata\'   :\'pencarian_rl2\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smt\'     :$(\'#smt\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
							\'nama\'   :$(\'#nm_tenaga\').val(),
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
</script>';
	echo '
	
';
	echo '<s';
	echo 'cript>
   function save(){
if($(\'#smt\').val()==""){
alert(\'Semester Belum Diisi\');
   	$(\'#smt\').focus();
	return false;
	}
if($(\'#tahun\').val()==""){
alert(\'Tahun Belum Diisi\');
   	$(\'#tahun\').focus();
	return false;
	}
if($(\'#nm_tenaga\').val()==""){
alert(\'Nama Tenaga Belum Diisi\');
   	$(\'#nm_tenaga\').focus();
	return false;
	}
if($(\'#tetap\').val()==""){
alert(\'Tenaga Tetap B';
	echo 'elum Diisi atau isikan angka 0\');
   	$(\'#tetap\').focus();
	return false;
	}
if($(\'#t_tetap\').val()==""){
alert(\'Tenaga Tidak Tetap Belum Diisi atau isikan angka 0\');
   	$(\'#t_tetap\').focus();
	return false;
	}
   $.post(\'ambildata.php\',
			{   \'reqdata\'   :\'save_rl2\',
                            \'smt\'   :$(\'#smt\').val(),
							\'tahun\'   :$(\'#tahun\').val(),
							\'tenaga\'   :$(\'#nm';
	echo '_tenaga\').val(),
							\'tetap\'   :$(\'#tetap\').val(),
							\'t_tetap\'   :$(\'#t_tetap\').val(),
							\'koders\'   :$(\'#koders\').val(),
							\'kode\'   :$(\'#kode\').val(),
							\'smt1\'   :$(\'#smt1\').val(),
							\'tahun1\'   :$(\'#tahun1\').val()
			  },
			    
			function (data) {
				$(\'#hasil\').html(data);
			}
			);
	
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
					border: 1px solid gray;
                    
                    }			
					
		#tbl_reg2 {	
					width:800px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid gray;
                    
                    }
	
		td		{	padding:5px;}
		.td_d{padding-left:50px}';
	echo '
		#tr_d{
		background : grey;
		color : white;
		BORDER-TOP: 1px solid black;"}
		.tr_s{
		
		BORDER-TOP: 1px solid black;"}
	
    </style>
	';
echo'<style>
thead th, thead td{text-align:center;}
thead tr:last{border-bottom :1px solid #999;}
</style>
<div align="center">
<div id="frame">
    <div id="frame_title"><h3>Laporan RL 2</h3></div>';
	
echo '<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
<tr><td colspan=2>';
	echo '</td></tr>
<tr class=\'tr_s\'><td colspan=2><table id=\'tbl_reg2\' name=\'tbl_reg2\'>
<tr class=\'tr_s\'><td colspan=2>';
	echo '<s';
	echo 'trong>Periode :</strong></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Semester :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
	echo $kode_rs;
	echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
	echo '' . $kode;
	echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
	echo '' . $smt;
	echo '">';
	echo '<select id=\'smt\' name=\'smt\'>
<option value=""></option>
<option value="1" ';
	if ($smt  == '1') {
		echo 'selected="selected"';
	}
	echo '>I</option>
<option value="2" ';
	if ($smt  == '2') {
		echo 'selected="selected"';
	}
	echo '>II</option>
</select>
</td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Tahun :</td><td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
	echo '' . $tahun;
	echo '">';
	echo '<select id=\'tahun\' name=\'tahun\'>
<option value=""></option>
<option value="2014" ';
	if ($row_x['tahun'] == '2014') {
		echo 'selected="selected"';
	}
	echo '>2014</option>
<option value="2015" ';
	if ($row_x['tahun'] == '2015') {
		echo 'selected="selected"';
	}
	echo '>2015</option>
<option value="2016" ';
	if ($row_x['tahun'] == '2016') {
		echo 'selected="selected"';
	}
	echo '>2016</option>
<option value="2017" ';
	if ($row_x['tahun'] == '2017') {
		echo 'selected="selected"';
	}
	echo '>2017</option>
<option value="2018" ';
	if ($row_x['tahun'] == '2018') {
		echo 'selected="selected"';
	}
	echo '>2018</option>
<option value="2019" ';
	if ($row_x['tahun'] == '2019') {
		echo 'selected="selected"';
	}
	echo '>2019</option>
</select>
</td></tr>
<tr class=\'tr_s\'><td colspan=2>';
	echo '<strong>Data Tenaga</strong></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Nama Tenaga : </td><td><input type="text" id=\'nm_tenaga\' name=\'nm_tenaga\' size=50 value="';
	echo '' . $tenaga;
	echo '">&nbsp;&nbsp;<input type=\'button\' id=\'cari\' value=\'Cari\' onclick=\'cari()\'></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Jumlah Tenaga Tetap : </td><td><input type="text" id=\'tetap\' name=\'tetap\' size=8  value=';
	echo '' . $row_x['tetap'];
	echo '></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Jumlah Tenaga Tidak Tetap : </td><td><input type="text" id=\'t_tetap\' name=\'t_tetap\' size=8  value=';
	echo '' . $row_x['tidak_tetap'];
	echo '></td></tr>
<tr class=\'tr_s\'><td colspan=2 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'xml\' value=\'Buat File Laporan\' onClick=\'cr_xml()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'batal()\'></td></tr>
</table> 
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table></div></div>';
?>