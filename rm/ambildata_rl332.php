<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );


if ($reqdata  == 'save_rl332') {
			
			$sql = mysql_query( '' . 'select * from rl332 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt=\'' . $bln . '\'' );
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				
				$sql_u = mysql_query( '' . 'Update rl332 set pbi=\'' . $pbi . '\', ' . ( '' . 'jamkesda=\'' . $jamkesda . '\', swasta=\'' . $swasta . '\', umum=\'' . $umum . '\', ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt=\'' . $bln . '\'' ) );
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				
				$sql_u = mysql_query( 'INSERT INTO rl332(code_list,koders,pbi,jamkesda,swasta,umum,smt,tahun,tgl_update) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $pbi . '\',\'' . $jamkesda . '\',\'' . $swasta . '\',\'' . $umum . '\',\'' . $bln . '\',\'' . $tahun . '\',\'' . $tgl . '\')' ) );
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>BPJS</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jamkesda</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Lain Lain</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Umum</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		</tr>';
			
			$sql2 = mysql_query( '' . 'select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt from rl332 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\' order by a.code_list Asc' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$j_jkn = $pbi;
				$total_jkn = $j_jkn + $jamkesda + $swasta + $umum;
				
				$jumlah_jkn = number_format( $j_jkn );
				
				$total_byr = number_format( $total_jkn );
				switch ($smt) {
					case '1': {
						$buln = 'Januari';
						break;
					}

					case '2': {
						$buln = 'Februari';
						break;
					}

					case '3': {
						$buln = 'Maret';
						break;
					}

					case '4': {
						$buln = 'April';
						break;
					}

					case '5': {
						$buln = 'Mei';
						break;
					}

					case '6': {
						$buln = 'Juni';
						break;
					}

					case '7': {
						$buln = 'Juli';
						break;
					}

					case '8': {
						$buln = 'Agustus';
						break;
					}

					case '9': {
						$buln = 'September';
						break;
					}

					case '10': {
						$buln = 'Oktober';
						break;
					}

					case '11': {
						$buln = 'Nopember';
						break;
					}

					case '12': {
						$buln = 'Desember';
					}
				}

				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
	<td style=\'border:1px solid grey;\'>' . $nama . '</td>
	<td style=\'border:1px solid grey;\'>' . $pbi . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $swasta . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_byr . '</td>
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl332&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#\'>
			<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>&nbsp;
		<a href=\'rm/hapus_rl332.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '\'>
			<img src=\'img/icon_delete.gif\' border=0>
		</a>
	</td>

	';
				echo '</tr>';
			}

			
			$sql3 = mysql_query( '' . 'select sum(a.pbi) as pbi_1,sum(a.jamkesda) as jkd_1,sum(a.swasta) as swt_1,sum(a.umum) as umum_1 from rl332 a where koders=\'' . $koders . '\'  and smt=\'' . $bln . '\' ' );
			
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			
			$j_smt_1 = $pbi_1;
			
			$jumlah_smt_1 = number_format( $j_smt_1 );
			$total_smt1 = $j_smt_1 + $jkd_1 + $swt_1 + $umum_1;
			
			$total_smt_1 = number_format( $total_smt1 );
			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Bulan  ' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $pbi_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jkd_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $swt_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_smt_1 . '</td>
		<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>
			</table>';
		}


		if ($reqdata  == 'cari_rl332') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>BPJS</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jamkesda</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Lain Lain</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Umum</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		</tr>';

			if($smtr=='1'){
				$kondisi = "smt<='6'";
			}else{
				$kondisi = "smt>='7'";
			}

			if (( empty( $smtr ) && empty( $tahun ) )) {
				
				$sql2 = mysql_query( '' . 'select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt,a.tahun from rl332 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' order by a.smt,a.code_list Asc' );
				
				$sql3 = mysql_query( '' . 'select sum(a.pbi) as pbi_1,sum(a.jamkesda) as jkd_1,sum(a.swasta) as swt_1,sum(a.umum) as umum_1 from rl332 a where koders=\'' . $koders . '\'' );
				
				$r3 = mysql_fetch_array( $sql3 );
				extract( $r3 );
				
				$j_smt_1 = $pbi_1;
				
				$jumlah_smt_1 = number_format( $j_smt_1 );
				$total_smt1 = $j_smt_1 + $jkd_1 + $swt_1 + $umum_1;
				
				$total_smt_1 = number_format( $total_smt1 );
			} 
else {
				if (( empty( $smtr ) && !empty( $tahun ) )) {
					
					$sql2 = mysql_query( '' . 'select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt from rl332 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.smt,a.code_list Asc' );
					
					$sql3 = mysql_query( '' . 'select sum(a.pbi) as pbi_1,sum(a.jamkesda) as jkd_1,sum(a.swasta) as swt_1,sum(a.umum) as umum_1 from rl332 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );
					
					$j_smt_1 = $pbi_1;
					
					$jumlah_smt_1 = number_format( $j_smt_1 );
					$total_smt1 = $j_smt_1 + $jkd_1 + $swt_1 + $umum_1;
					
					$total_smt_1 = number_format( $total_smt1 );
				} 
else {
					if (( !empty( $smtr ) && empty( $tahun ) )) {
						
						$sql2 = mysql_query("select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt,a.tahun from rl332 a left join m_poly b on b.kode=a.code_list where koders='$koders' and $kondisi order by a.smt,a.code_list Asc ");
						
						$sql3 = mysql_query("select sum(a.pbi) as pbi_1,sum(a.jamkesda) as jkd_1,sum(a.swasta) as swt_1,sum(a.umum) as umum_1 from rl332 a where koders='$koders' and $kondisi ");
						
						$r3 = mysql_fetch_array( $sql3 );
						extract( $r3 );
						
						$j_smt_1 = $pbi_1;
						
						$jumlah_smt_1 = number_format( $j_smt_1 );
						$total_smt1 = $j_smt_1 + $jkd_1 + $swt_1 + $umum_1;
						
						$total_smt_1 = number_format( $total_smt1 );
					} 
else {
						if (( !empty( $smtr ) && !empty( $tahun ) )) {
							
							$sql2 = mysql_query("select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt from rl332 a left join m_poly b on b.kode=a.code_list where koders='$koders' and tahun='$tahun' and $kondisi order by a.smt,a.code_list Asc ");
							
							$sql3 = mysql_query("select sum(a.pbi) as pbi_1,sum(a.jamkesda) as jkd_1,sum(a.swasta) as swt_1,sum(a.umum) as umum_1 from rl332 a where koders='$koders' and tahun='$tahun' and $kondisi ");
							
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
							
							$j_smt_1 = $pbi_1;
							
							$jumlah_smt_1 = number_format( $j_smt_1 );
							$total_smt1 = $j_smt_1 + $jkd_1 + $swt_1 + $umum_1;
							
							$total_smt_1 = number_format( $total_smt1 );
						}
					}
				}
			}

			switch ($smtr) {
				case '1': {
					$semester = 'Semester I';
					break;
				}

				case '2': {
					$semester = 'Semester II';
					break;
				}
			}

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$j_jkn = $pbi;
				$total = $j_jkn + $jamkesda + $swasta + $umum;
				
				$jumlah_jkn = number_format( $j_jkn );
				
				$total_byr = number_format( $total );
				switch ($smt) {
					case '1': {
						$buln = 'Januari';
						break;
					}

					case '2': {
						$buln = 'Februari';
						break;
					}

					case '3': {
						$buln = 'Maret';
						break;
					}

					case '4': {
						$buln = 'April';
						break;
					}

					case '5': {
						$buln = 'Mei';
						break;
					}

					case '6': {
						$buln = 'Juni';
						break;
					}

					case '7': {
						$buln = 'Juli';
						break;
					}

					case '8': {
						$buln = 'Agustus';
						break;
					}

					case '9': {
						$buln = 'September';
						break;
					}

					case '10': {
						$buln = 'Oktober';
						break;
					}

					case '11': {
						$buln = 'Nopember';
						break;
					}

					case '12': {
						$buln = 'Desember';
					}
				}

				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
	<td style=\'border:1px solid grey;\'>' . $nama . '</td>
	<td style=\'border:1px solid grey;\'>' . $pbi . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $swasta . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_byr . '</td>
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl332&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#\'>
			<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>&nbsp;
		<a href=\'rm/hapus_rl332.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '\'>
			<img src=\'img/icon_delete.gif\' border=0>
		</a>
	</td>
	';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total ' . $semester . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $pbi_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jkd_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $swt_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum_1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_smt_1 . '</td>
		<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl332') {

			if($smtr=='1'){
				$kondisi = "smt<='6'";
			}else{
				$kondisi = "smt>='7'";
			}

			if (( empty( $smtr ) && empty( $tahun ) )) {
				
				$sql2 = mysql_query( '' . 'select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.description,a.smt from rl332 a left join m_rl332 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
			} 
else {
				if (( empty( $smtr ) && !empty( $tahun ) )) {
					
					$sql2 = mysql_query( '' . 'select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.description,a.smt from rl332 a left join m_rl332 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
				} 
else {
					if (( !empty( $smtr ) && empty( $tahun ) )) {
						
						$sql2 = mysql_query("select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt from rl332 a left join m_poly b on b.kode=a.code_list where koders='$koders' and $kondisi order by a.code_list Asc ");
					} 
else {
						if (( !empty( $smtr ) && !empty( $tahun ) )) {
							
							$sql2 = mysql_query("select a.code_list,a.pbi,a.jamkesda,a.swasta,a.umum,b.nama,a.smt from rl332 a left join m_poly b on b.kode=a.code_list where koders='$koders' and tahun='$tahun' and $kondisi order by a.code_list Asc ");
						}
					}
				}
			}

			
			
			$xml = new SimpleXMLElement ( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'bpjs', $pbi );
				$data->addChild( 'jamkesda', $jamkesda );
				$data->addChild( 'lain_lain', $swasta );
				$data->addChild( 'umum', $umum );
				$data->addChild( 'bulan', $smt );
				$data->addChild( 'tahun', $tahun );
			}


			$fp = fopen( '../xml/rl332_' . $smtr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl332_' . $smtr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}




}