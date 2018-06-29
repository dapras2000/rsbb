<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );


	



		if ($reqdata  == 'save_rl39') {
			
			$sql = mysql_query( '' . 'select * from rl39 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt=\'' . $bln . '\'' );
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				
				$sql_u = mysql_query( '' . 'Update rl39 set j_resep=\'' . $j_resep . '\', pengadaan=\'' . $pengadaan . '\', rj=\'' . $rj . '\', ' . ( '' . 'ri=\'' . $ri . '\', igd=\'' . $igd . '\', ' ) . ( '' . 'pbi=\'' . $pbi . '\', jamkesda=\'' . $jamkesda . '\', swasta=\'' . $swasta . '\', ' ) . ( '' . 'umum=\'' . $umum . '\'' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt=\'' . $bln . '\'' ) );
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				
				$sql_u = mysql_query( 'INSERT INTO rl39(code_list,koders,j_resep,pengadaan,ri,rj,igd,pbi,jamkesda,swasta,umum,smt,tahun,tgl_update) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $j_resep . '\',\'' . $pengadaan . '\',\'' . $ri . '\',\'' . $rj . '\',\'' . $igd . '\',\'' . $pbi . '\',\'' . $jamkesda . '\',\'' . $swasta . '\',\'' . $umum . '\',\'' . $bln . '\',\'' . $tahun . '\',\'' . $tgl . '\')' ) );
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Resep</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Pengadaan (R/)</th><th colspan=\'4\' style=\'border:1px solid grey;\'>Jumlah Penggunaan (R/)</th><th colspan=\'5\' style=\'border:1px solid grey;\'>Cara Bayar</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'> Rawat Jalan </th>
		<th style=\'border:1px solid grey;\'> Rawat Inap </th>
		<th style=\'border:1px solid grey;\'>IGD</th>
		<th style=\'border:1px solid grey;\'> Total </th>
		<th style=\'border:1px solid grey;\'> BPJS </th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain - Lain</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'> Total Lainnya </th>
		</tr>';
			
			$sql2 = mysql_query( '' . 'select a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.umum,a.swasta,b.description,a.smt from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\' order by a.code_list Asc' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$lainnya = number_format( $pbi + $jamkesda + $umum + $swasta );
				
				$penggunaan = number_format( $rj + $ri + $igd );
				
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
	<td style=\'border:1px solid grey;\'>' . $description . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_resep . '</td>
	<td style=\'border:1px solid grey;\'>' . $pengadaan . '</td>
	<td style=\'border:1px solid grey;\'>' . $rj . '</td>
	<td style=\'border:1px solid grey;\'>' . $ri . '</td>
	<td style=\'border:1px solid grey;\'>' . $igd . '</td>
	<td style=\'border:1px solid grey;\'>' . $penggunaan . '</td>	
	<td style=\'border:1px solid grey;\'>' . $pbi . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $swasta . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $lainnya . '</td>	
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href="index.php?link=rl39&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#">
			<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>&nbsp;
		<a href=\'rm/hapus_rl39.php?id=' . $code_list . '&bln=' . $bln . '&koders=' . $koders . '&tahun=' . $tahun . '\'>
			<img src=\'img/icon_delete.gif\' border=0>
		</a>
	</td>
	';
				echo '</tr>';
			}

			
			$sql3 = mysql_query( '' . 'select sum(a.j_resep) as j_resep1,sum(a.pengadaan) as pengadaan1,sum(a.rj) as rj1,sum(a.ri) as ri1,sum(a.igd) as igd1,sum(a.pbi) as pbi1,sum(a.jamkesda) as jkd1,sum(a.swasta) as swt1,sum(a.umum) as umum1 from rl39 a where a.koders=\'' . $koders . '\' and a.smt=\'' . $bln . '\'' );
			
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			$lainnya1 = $pbi1 + $jkd1 + $swt1 + $umum1;
			
			$t_lainnya1 = number_format( $lainnya1 );
			$penggunaan1 = $rj + $ri + $igd;
			
			$t_penggunaan1 = number_format( $penggunaan1 );
			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Bulan  ' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_resep1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pengadaan1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $rj1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $ri1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $igd1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_penggunaan1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pbi1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jkd1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $swt1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum1 . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_lainnya1 . '</td>
			<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}






		if ($reqdata  == 'cari_rl39') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Resep</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Pengadaan (R/)</th>
		<th colspan=\'4\' style=\'border:1px solid grey;\'>Jumlah Penggunaan (R/)</th>
		<th colspan=\'5\' style=\'border:1px solid grey;\'>Cara Bayar</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'> Rawat Jalan </th><th style=\'border:1px solid grey;\'> Rawat Inap </th><th style=\'border:1px solid grey;\'>IGD</th>
		<th style=\'border:1px solid grey;\'> Total </th>
		<th style=\'border:1px solid grey;\'> BPJS </th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain Lain</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'> Total Lainnya </th>
		</tr>';

		if($smtr=='1'){
			$kondisi = "smt<='6'";
		}else{
			$kondisi = "smt>='7'";
		}

			if (( empty( $smtr ) && empty( $tahun ) )) {
				
				$sql2 = mysql_query( '' . 'select distinct a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.umum,a.swasta,b.description,a.smt,a.tahun from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				
				$sql3 = mysql_query( '' . 'select sum(a.j_resep) as j_resep1,sum(a.pengadaan) as pengadaan1,sum(a.rj) as rj1,sum(a.ri) as ri1,sum(a.igd) as igd1,sum(a.pbi) as pbi1,sum(a.jamkesda) as jkd1,sum(a.swasta) as swt1,sum(a.umum) as umum1 from rl39 a where a.koders=\'' . $koders . '\'' );
				$r3 = mysql_fetch_array( $sql3 );
				extract( $r3 );

				$lainnya1 = $pbi1 + $jkd1 + $swt1 + $umum1;
				$t_lainnya1 = number_format( $lainnya1 );

				$penggunaan1 = $rj1 + $ri1 + $igd1;
				$t_penggunaan1 = number_format( $penggunaan1 );
			} 
else {
				if (( empty( $smtr ) && !empty( $tahun ) )) {
					
					$sql2 = mysql_query( '' . 'select distinct a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.umum,a.swasta,b.description,a.smt from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and a.tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
					$sql3 = mysql_query( '' . 'select sum(a.j_resep) as j_resep1,sum(a.pengadaan) as pengadaan1,sum(a.rj) as rj1,sum(a.ri) as ri1,sum(a.igd) as igd1,sum(a.pbi) as pbi1,sum(a.jamkesda) as jkd1,sum(a.swasta) as swt1,sum(a.umum) as umum1 from rl39 a where a.koders=\'' . $koders . '\' and a.tahun=\'' . $tahun . '\'' );
					
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );

					$lainnya1 = $pbi1 + $jkd1 + $swt1 + $umum1;
					$t_lainnya1 = number_format( $lainnya1 );

					$penggunaan1 = $rj1 + $ri1 + $igd1;
					$t_penggunaan1 = number_format( $penggunaan1 );
				} 
else {
					if (( !empty( $smtr ) && empty( $tahun ) )) {
						
						$sql2 = mysql_query("select distinct a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.umum,a.swasta,b.description,a.smt,a.tahun from rl39 a left join m_rl39 b on b.code_list=a.code_list where a.koders='$koders' and $kondisi order by a.code_list Asc");
						
						$sql3 = mysql_query("select sum(a.j_resep) as j_resep1,sum(a.pengadaan) as pengadaan1,sum(a.rj) as rj1,sum(a.ri) as ri1,sum(a.igd) as igd1,sum(a.pbi) as pbi1,sum(a.jamkesda) as jkd1,sum(a.swasta) as swt1,sum(a.umum) as umum1 from rl39 a where a.koders='$koders' and $kondisi ");
						
						$r3 = mysql_fetch_array( $sql3 );
						extract( $r3 );

						$lainnya1 = $pbi1 + $jkd1 + $swt1 + $umum1;
						$t_lainnya1 = number_format( $lainnya1 );
						
						$penggunaan1 = $rj1 + $ri1 + $igd1;
						$t_penggunaan1 = number_format( $penggunaan1 );
					} 
else {
						if (( !empty( $smtr ) && !empty( $tahun ) )) {
							
							$sql2 = mysql_query("select distinct a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.umum,b.description,a.smt,a.tahun from rl39 a left join m_rl39 b on b.code_list=a.code_list where a.koders='$koders' and a.tahun='$tahun' and $kondisi order by a.code_list Asc ");
							
							$sql3 = mysql_query("select sum(a.j_resep) as j_resep1,sum(a.pengadaan) as pengadaan1,sum(a.rj) as rj1,sum(a.ri) as ri1,sum(a.igd) as igd1,sum(a.pbi) as pbi1,sum(a.jamkesda) as jkd1,sum(a.swasta) as swt1,sum(a.umum) as umum1 from rl39 a where a.koders='$koders' and a.tahun='$tahun' and $kondisi ");
							
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );

							$lainnya1 = $pbi1 + $jkd1 + $swt1 + $umum1;
							$t_lainnya1 = number_format( $lainnya1 );

							$penggunaan1 = $rj1 = $ri1 + $igd1;
							$t_penggunaan1 = number_format( $penggunaan1 );
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
				
				$lainnya = number_format( $pbi + $jamkesda + $umum + $swasta );
				
				$penggunaan = number_format( $rj + $ri + $igd );

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
	<td style=\'border:1px solid grey;\'>' . $description . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_resep . '</td>
	<td style=\'border:1px solid grey;\'>' . $pengadaan . '</td>
	<td style=\'border:1px solid grey;\'>' . $rj . '</td>
	<td style=\'border:1px solid grey;\'>' . $ri . '</td>
	<td style=\'border:1px solid grey;\'>' . $igd . '</td>
	<td style=\'border:1px solid grey;\'>' . $penggunaan . '</td>	
	<td style=\'border:1px solid grey;\'>' . $pbi . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $swasta . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $lainnya . '</td>	
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>

		<a href="index.php?link=rl39&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#">
			<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>

		&nbsp;
		<a href=\'rm/hapus_rl39.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '\'>
			<img src=\'img/icon_delete.gif\' border=0>
		</a>
	</td>
	';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total ' . $semester . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_resep1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pengadaan1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $rj1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $ri1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $igd1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_penggunaan1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pbi1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jkd1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $swt1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum1 . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_lainnya1 . '</td>
			<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}








	if ($reqdata  == 'xml_rl39') {
		if($smtr=='1'){
			$kondisi = "smt<='6'";
		}else{
			$kondisi = "smt>='7'";
		}

			if (( empty( $smtr ) && empty( $tahun ) )) {
				
				$sql2 = mysql_query( '' . 'select a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.swasta,a.umum,b.description,a.smt,a.tahun from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
			} 
else {
				if (( empty( $smtr ) && !empty( $tahun ) )) {
					
					$sql2 = mysql_query( '' . 'select a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.swasta,a.umum,b.description,a.smt from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
				} 
else {
					if (( !empty( $smtr ) && empty( $tahun ) )) {
						
						$sql2 = mysql_query("select a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.swasta,a.umum,b.description,a.smt,a.tahun from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders='$koders' and $kondisi order by a.code_list Asc ");
					} 
else {
						if (( !empty( $smtr ) && !empty( $tahun ) )) {
							
							$sql2 = mysql_query("select a.code_list,a.j_resep,a.pengadaan,a.rj,a.ri,a.igd,a.pbi,a.jamkesda,a.swasta,a.umum,b.description,a.smt from rl39 a left join m_rl39 b on b.code_list=a.code_list where koders='$koders' and tahun='$tahun' and $kondisi order by a.code_list Asc ");
						}
					}
				}
			}

			$xml = new SimpleXMLElement ( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				if($smt<=6){
					$semester = "I";
				}else{
					$semester = "II";
				}
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'jumlah_resep', $j_resep );
				$data->addChild( 'jumlah_pengadaan', $pengadaan );
				$data->addChild( 'rawat_jalan', $rj );
				$data->addChild( 'rawat_inap', $ri );
				$data->addChild( 'igd', $igd );
				$data->addChild( 'bpjs', $pbi );
				$data->addChild( 'jamkesda', $jamkesda );
				$data->addChild( 'lain_lain', $swasta );
				$data->addChild( 'umum', $umum );
				$data->addChild( 'semester', $semester );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( '../xml/rl39_' . $smtr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl39_' . $smtr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
	}

}