<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';
	
	
	$kode = $_GET[id];
	
	$smt = $_GET[smt];
	
	$koders = $_GET[koders];
	
	$tahun = $_GET[tahun];
	$kode_rs = $KDRS;
	
	$sql_x = '' . 'select a.code_list,b.description,a.rujukan,a.nonrujukan,a.dirawat,a.dirujuk,a.pulang,a.k_8jam,a.l_8jam,a.doa,a.ert,a.tglupdate from rl321 a left join m_rl321 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.smt=\'' . $smt . '\' and a.tahun=\'' . $tahun . '\'';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	echo'<html>
	<head>';
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
		  </script>
				
			<script type="text/javascript">
				$(document).ready(function() {
					$.post(\'rm/ambildata_rl321.php\',
						{   \'reqdata\'   :\'cari_rl321\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smstr\'     :$(\'#smstr\').val(),
							\'tahun\'     :$(\'#tahun\').val()
                        },
						function (data) {
							$(\'#hasil\').html(data);
						}
					);

				});
			</script>
			
			<script>
				function create_xml(){
					$.post(\'rm/ambildata_rl321.php\',
						{   \'reqdata\'   :\'xml_rl321\',
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
			<script>
				function cari(){
					$.post(\'rm/ambildata_rl321.php\',
						{   \'reqdata\'   :\'cari_rl321\',
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
			<script>
				function cancel(){
					window.location.replace("'._BASE_.'index.php?link=rl321");
				}
			</script>	
			<style>
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
							width:1000px;
		                    border-collapse:collapse; 
		                    background-color:white;
		                    font: 12px verdana; 
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
						BORDER-TOP: 1px solid grey;"
					}				
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
			<style>
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
				  background-color:#f1fe1b; /* baris genap berwarna hijau tua */ } 
			</style>
		</head>
		
		<body bgcolor="#fff">
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Laporan RL 3.2.1</h3></div>
		<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
			<tr class=\'tr_s\'>
				<td colspan=2>
					<table id=\'tbl_reg\' name=\'tbl_reg\'>
						<tr class=\'tr_s\'><td colspan=4>';
							echo '<strong>Periode :</strong></td></tr>
						<tr class=\'tr_s\'>
							<td class=\'td_d\'>Semester :</td>
							<td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
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
							<td class=\'td_d\'>Tahun :</td>
							<td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
								echo '' . $tahun;
								echo '">';
								echo '<select id=\'tahun\' name=\'tahun\'  onChange=\'cari()\'>
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
								<input type=\'button\' id=\'input2\' value=\'Buat File Laporan\' onclick=\'create_xml()\'></div>
								<br>

								

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