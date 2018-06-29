<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include( 'include/connect.php' );
	$kode = $KDRS;
		
	echo '<s';
	echo 'cript type="text/javascript">
      $(document).ready(function() {
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
      });  
    </script>
';
	echo '<s';
	echo 'tyle>
    .ganjil { 
      background-color:#9AE8A7; /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }
	.ganjil1 { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#9AE8A7; /* baris genap berwarna hijau tua */ 
    }   
    .tbheadin';
	echo 'g { 
      background-color:#cc4afa; /* baris genap berwarna hijau tua */ 
    }   
	
    </style>

	<body>
<table id="tbl_reg1" width="95%">
<tr class="tr_s"><th>No</th>
<th>Jenis Pelayanan</th>
<th>Jumlah TT</th>
<th>Super VIP</th>
<th>VIP</th>
<th>I</th>
<th>II</th>
<th>III</th>
<th>Isolasi</th>
<th>Intensif</th>
<th>Intermediate</th>';
	include( 'include/connect.php' );
	$n = 0;
	//$sql2 = mysql_query( '' . 'SELECT * From tt where koders=\'' . $kode . '\'' );
	$sql2 = mysql_query("SELECT nama, jumlah_tt, COUNT(IF(idx_ruang='VVIP',1, NULL)) 'vvip',
       COUNT(IF(idx_ruang='VIP',1, NULL)) 'vip',
	   COUNT(IF(kelas='Isolasi',1, NULL)) 'iso',
	   COUNT(IF(kelas='Intensif',1, NULL)) 'int',
       COUNT(IF(idx_ruang='I',1, NULL)) 'i',
       COUNT(IF(idx_ruang='II',1, NULL)) 'ii',
       COUNT(IF(idx_ruang='III',32, NULL)) 'iii'
FROM m_ruang 
JOIN m_detail_tempat_tidur b on b.idxruang = m_ruang.no group by nama");
	while ($row2 = mysql_fetch_array( $sql2 )) {
		
		extract( $row2 );
		$jml = $row2['vvip'] + $row2['vip'] + $row2['i'] + $row2['ii'] + $row2['iii'] + $row2['iso'] + $row2['int'] + $intermediate;
		echo '' . '
<tr class=\'tr_s\'><td>' . ++$n . '<input type=\'hidden\' id=\'id\' name=\'id\' value=' . $id . '><input type=\'hidden\' id=\'koders\' name=\'koders\' value=' . $koders . '></td>
<td >' . $row2['nama'] . '</td>
<td align=\'right\'>' . $jml . '</td>
<td align=\'right\'>' . $row2['vvip'] . '</td>
<td align=\'right\'>' . $row2['vip'] . '</td>
<td align=\'right\'>' . $row2['i'] . '</td>
<td align=\'right\'>' . $row2['ii'] . '</td>
<td align=\'right\'>' . $row2['iii'] . '</td>
<td align=\'right\'>' . $row2['iso'] . '</td>
<td align=\'right\'>' . $row2['int']. '</td>
<td align=\'right\'>' . $intermediate . '</td>';
		echo '</tr>';
	}

	$sql4 = mysql_query("SELECT nama, sum(jumlah_tt)as jml3, sum(IF(idx_ruang='VVIP',1, NULL)) 'vvip',
       sum(IF(idx_ruang='VIP',1, NULL)) 'vip',
	   sum(IF(kelas='Isolasi',1, NULL)) 'iso',
	   sum(IF(kelas='Intensif',1, NULL)) 'int',
       sum(IF(idx_ruang='I',1, NULL)) 'i',
       sum(IF(idx_ruang='II',1, NULL)) 'ii',
       sum(IF(idx_ruang='III',32, NULL)) 'iii'
FROM m_ruang 
JOIN m_detail_tempat_tidur b on b.idxruang = m_ruang.no group by nama");
	$row4 = mysql_fetch_array( $sql4 );
	extract( $row4 );
	//$jml3 = $svip + $vip + $i + $ii + $iii + $isolasi + $intensif + $intermediate;
	//$jml3 = $vvip + $vip + $row4['i'] + $row4['ii'] + $row4['iii'] + $row4['iso'] + $row4['int'];
	$jml3 = $row4['jml3'];
	$vvip = $row4['vvip'];
	echo '' . '
<tr><td colspan=2 align=\'center\'><strong>Total</strong></td><td  align=\'right\'>' . $jml3 . '</td>';
/*<td align=\'right\'>' . $vvip . '</td>
<td align=\'right\'>' . $vip . '</td>
<td align=\'right\'>' . $i . '</td>
<td align=\'right\'>' . $ii . '</td>
<td align=\'right\'>' . $iii . '</td>
<td align=\'right\'>' . $isolasi . '</td>
<td align=\'right\'>' . $intensif . '</td>
<td align=\'right\'>' . $intermediate . '</td>*/
'</tr>';
	echo '
</table>
</body>';
?>