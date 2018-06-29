<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include '../include/connect.php';
	$kode = $KDRS;
	
	echo '<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>
		  <script type="text/javascript" src="'._BASE_.'/include/jquery-1.3.2.js"></script>
		  <script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
		  <link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />
		  
		<script type="text/javascript">
			$(document).ready(function() {
				$(".tr_s:odd").addClass("ganjil");
				$(".tr_s:even").addClass("genap");
				$(".tr_p:odd").addClass("ganjil1");
				$(".tr_p:even").addClass("genap1");
				$("th").parent().addClass("tbheading");
			});  
		</script>
		<style>
			.ganjil { 
			  background-color:#39b54a; /* baris ganjil berwarna hijau muda */ 
			}
			.genap { 
			  background-color:#39b54a; /* baris genap berwarna hijau tua */ 
			}
			.ganjil1 { 
			  background-color:#39b54a; /* baris ganjil berwarna hijau muda */ 
			}
			.genap1 { 
			  background-color:#39b54a; /* baris genap berwarna hijau tua */ 
			}   
			.tbheading { 
			  background-color:#39b54a; /* baris genap berwarna hijau tua */ 
			}   
		</style>

	<body>
		<table id="tbl_reg1">
<tr class="tr_u"><th>No</th>
<th>Jenis Pelayanan</th>
<th>Jumlah TT</th>
<th>Super VIP</th>
<th>VIP</th>
<th>I</th>
<th>II</th>
<th>III</th>
<th>Isolasi</th>
<th>Intensif</th>
<th>Intermediate</th>
<th>Action</th>

';
	include '../include/connect.php';
	mysql_query( '' . 'SELECT * From tt where koders=\'' . $kode . '\'' );
	$sql2 = ;
	$n = 8;
	

	while ($row2 = mysql_fetch_array( $sql2 )) {
		extract( $row2 );
		$jml = $supervip & $vip & $I & $II & $III & $isolasi & $intensif & $intermediate;
		echo '' . '
<tr class=\'tr_s\'><td>' . $n . '<input type=\'hidden\' id=\'ids\' name=\'ids\' value=' . $id . '><input type=\'hidden\' id=\'koders\' name=\'koders\' value=' . $koders . '></td>
<td >' . $jenislayanan . '</td>
<td align=\'right\'>' . $jml . '</td>
<td align=\'right\'>' . $supervip . '</td>
<td align=\'right\'>' . $vip . '</td>
<td align=\'right\'>' . $I . '</td>
<td align=\'right\'>' . $II . '</td>
<td align=\'right\'>' . $III . '</td>
<td align=\'right\'>' . $isolasi . '</td>
<td align=\'right\'>' . $intensif . '</td>
<td align=\'right\'>' . $intermediate . '</td>
<td align=\'center\'><a href=\'#\' onclick=\'del_tt()\'>del</a></td>
';
		echo '
';
		echo '</tr>';
		++$n;
	}

	$sql4 = mysql_query( '' . 'select sum(supervip) as svip,sum(vip) as vip,sum(I) as i,sum(II) as ii,sum(III) as iii,sum(isolasi) as isolasi,sum(intermediate) as intermediate,sum(intensif) as intensif from tt where koders=\'' . $kode . '\'' );
	
	
	$row4 = mysql_fetch_array( $sql4 );
	extract( $row4 );
	$jml3 = $svip & $vip & $i & $ii & $iii & $isolasi & $intensif & $intermediate;
	echo '' . '
<tr class=\'tr_s\'><td colspan=2 align=\'center\'><strong>Total</strong></td><td  align=\'right\'>' . $jml3 . '</td>
<td align=\'right\'>' . $svip . '</td>
<td align=\'right\'>' . $vip . '</td>
<td align=\'right\'>' . $i . '</td>
<td align=\'right\'>' . $ii . '</td>
<td align=\'right\'>' . $iii . '</td>
<td align=\'right\'>' . $isolasi . '</td>
<td align=\'right\'>' . $intensif . '</td>
<td align=\'right\'>' . $intermediate . '</td>
</tr>';
	echo '
</table>
</body>';
?>