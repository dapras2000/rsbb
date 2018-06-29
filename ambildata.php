<?php
	error_reporting( 'E_ALL' );
	include( 'include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

		if ($reqdata  == 'masuk') {
			echo 'OK';
		}

		if (( $reqdata  == 'propinsi' && !empty( $nama ) )) {
			$s = '' . 'SELECT propinsi_kode from propinsi where propinsi_name=\'' . $nama . '\'';
			$h = mysql_query( $s );
			$r = mysql_fetch_array( $h );
			$sql = '' . 'select `KAB/KOTA` as kabupaten from `KAB/KOTA` where propinsi_kode=\'' . $r['propinsi_kode'] . '\' order by `KAB/KOTA`';
			$hasil = mysql_query( $sql );

			if ($row = mysql_fetch_array( $hasil )) {
				extract( $row );
				echo '' . '<option>' . $kabupaten . '</option>
';
			}
		}

		///////////////// AWAL RL2 ////////////////////
		if ($reqdata  == 'save_rl2') {
			$sql3 = mysql_query( '' . 'select code_list as kode from m_rl2 where description=\'' . $tenaga . '\'' );
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			$sql = mysql_query( '' . 'select code_list from rl2 where kode_rs=\'' . $koders . '\' and code_list=\'' . $kode . '\' and smt=\'' . $smt . '\' and tahun=\'' . $tahun . '\'' );
			$r = mysql_num_rows( $sql );

			if (1 <= $r) {
				if (!empty( $kode )) {
					$sql = mysql_query( '' . 'update RL2 set tetap=\'' . $tetap . '\',tidak_tetap=\'' . $t_tetap . '\',tahun=\'' . $tahun . '\' where code_list=\'' . $kode . '\' and tahun=\'' . $tahun1 . '\' and smt=\'' . $smt1 . '\'' );
				} else {
					echo '' . 'Data Tenaga ' . $tenaga . ' Sudah ada, silahkan klik icon update pada tabel untuk Update Data';
				}
			} else {
				$sql = mysql_query( '' . 'INSERT INTO rl2 (code_list,tetap,tidak_tetap,kode_rs,smt,tahun) values(\'' . $kode . '\',\'' . $tetap . '\',\'' . $t_tetap . '\',\'' . $koders . '\',\'' . $smt . '\',\'' . $tahun . '\')' );
				echo '' . 'Data Tenaga ' . $tenaga . ' Sudah Tersimpan';
			}

			$sql2 = mysql_query( '' . 'select a.code_list,a.tetap,a.tidak_tetap,a.kode_rs,a.smt,a.tahun,b.description from rl2 a left join m_rl2 b on b.code_list=a.code_list where kode_rs=\'' . $koders . '\'' );
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th>Kode</th><th>Tenaga</th><th>Jumlah Tenaga</th><th>Tetap</th><th>Tidak Tetap</th><th>Semester</th><th>Tahun</th><th>-</th>
		</tr>';

			while ($row = mysql_fetch_array( $sql2 )) {
				extract( $row );
				$total = $tetap + $tidak_tetap;

				if ($smt == 1) {
					$semt = 'I';
				} else {
					$semt = 'II';
				}

				echo '' . '		
		<tr class=\'tr_s\'><td>' . $code_list . '</td><td>' . $description . '</td><td align=\'right\'>' . $total . '</td><td align=\'right\'>' . $tetap . '</td><td align=\'right\'>' . $tidak_tetap . '</td><td align=\'center\'>' . $semt . '</td><td align=\'center\'>' . $tahun . '</td><td align=\'center\'><a href=\'index.php?link=rl2&id=' . $code_list . '&smt=' . $smt . '&koders=' . $kode_rs . '&tahun=' . $tahun . '\'><img src=\'img/icon_edit_new.gif\' border=0></a>&nbsp;<a href=\'rm/hapus_rl2.php?id=' . $code_list . '&smt=' . $smt . '&koders=' . $kode_rs . '&tahun=' . $tahun . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
		</tr>';
			}

			$sql_s = mysql_query( '' . 'select SUM(tetap) as tetap1, SUM(tidak_tetap) as t_tetap1 from rl2 where kode_rs=\'' . $koders . '\' and smt=\'1\'' );
			$r_s = mysql_fetch_array( $sql_s );
			extract( $r_s );
			$total_1 = $tetap1 + $t_tetap1;
			$sql_s2 = mysql_query( '' . 'select SUM(tetap) as tetap2, SUM(tidak_tetap) as t_tetap2 from rl2 where kode_rs=\'' . $koders . '\' and smt=\'2\'' );
			$r_s2 = mysql_fetch_array( $sql_s2 );
			extract( $r_s2 );
			$total_2 = $tetap2 + $t_tetap2;
			echo '' . '<tr id=\'tr_d\'>
		<td colspan=2>Jumlah Tenaga Semester I : </td><td class=\'td_t\' align=\'right\'>' . $total_1 . '</td><td class=\'td_t\'  align=\'right\'>' . $tetap1 . '</td><td class=\'td_t\' align=\'right\'>' . $t_tetap1 . '</td><td colspan=3>&nbsp;</td>
		</tr>
		<tr  id=\'tr_d\'>
		<td colspan=2>Jumlah Tenaga Semester II : </td><td class=\'td_t\' align=\'right\'>' . $total_2 . '</td><td class=\'td_t\' align=\'right\'>' . $tetap2 . '</td><td class=\'td_t\' align=\'right\'>' . $t_tetap2 . '</td><td colspan=3>&nbsp;</td>
		</tr>
		';
			echo '</table>';
		}


		if ($reqdata == 'pencarian_rl2') {
			if (empty( $nama )) {
				$sql = mysql_query( '' . 'select a.code_list,a.tetap,a.tidak_tetap,a.kode_rs,a.smt,a.tahun,b.description from rl2 a left join m_rl2 b on b.code_list=a.code_list where a.kode_rs=\'' . $koders . '\'' );;
			} else {
				if (!empty( $nama )) {
					$sql3 = mysql_query( '' . 'select code_list as kode from m_rl2 where description=\'' . $nama . '\'' );;
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );
					$sql = mysql_query( '' . 'select a.code_list,a.tetap,a.tidak_tetap,a.kode_rs,a.smt,a.tahun,b.description from rl2 a left join m_rl2 b on b.code_list=a.code_list where a.code_list=\'' . $kode . '\' and a.kode_rs=\'' . $koders . '\'' );
				}
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_s\' style=\'border-bottom:1px solid grey;\'>
		<th>Kode</th><th>Tenaga</th><th>Jumlah Tenaga</th><th>Tetap</th><th>Tidak Tetap</th><th>Semester</th><th>Tahun</th><th>-</th>
		</tr>';

			while ($row = mysql_fetch_array( $sql )) {
				extract( $row );
				$total = $tetap + $tidak_tetap;

				if ($smt == 1) {
					$semt = 'I';
				} else {
					$semt = 'II';
				}

				echo '' . '		
		<tr class=\'tr_s\' style=\'border-bottom:1px solid grey;\'><td  style=\'border-left:1px solid grey;\'>' . $code_list . '</td><td style=\'border-left:1px solid grey;\'>' . $description . '</td><td align=\'right\' style=\'border-left:1px solid grey;\'>' . $total . '</td><td align=\'right\' style=\'border-left:1px solid grey;\'>' . $tetap . '</td><td align=\'right\' style=\'border-left:1px solid grey;\'>' . $tidak_tetap . '</td><td align=\'center\' style=\'border-left:1px solid grey;\'>' . $semt . '</td><td align=\'center\' style=\'border-left:1px solid grey;\'>' . $tahun . '</td><td align=\'center\' style=\'border-left:1px solid grey;\'><a href=\'index.php?link=rl2&id=' . $code_list . '&smt=' . $smt . '&koders=' . $kode_rs . '&tahun=' . $tahun . '\'><img src=\'img/icon_edit_new.gif\' border=0></a>&nbsp;<a href=\'rm/hapus_rl2.php?id=' . $code_list . '&smt=' . $smt . '&koders=' . $kode_rs . '&tahun=' . $tahun . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
		</tr>';
			}

			$sql_s = mysql_query( '' . 'select SUM(tetap) as tetap1, SUM(tidak_tetap) as t_tetap1 from rl2 where kode_rs=\'' . $koders . '\' and smt=\'1\'' );
			$r_s = mysql_fetch_array( $sql_s );
			extract( $r_s );
			$total_1 = $tetap1 + $t_tetap1;
			$sql_s2 = mysql_query( '' . 'select SUM(tetap) as tetap2, SUM(tidak_tetap) as t_tetap2 from rl2 where kode_rs=\'' . $koders . '\' and smt=\'2\'' );
			$r_s2 = mysql_fetch_array( $sql_s2 );
			extract( $r_s2 );
			$total_2 = $tetap2 + $t_tetap2;
			echo '' . '<tr id=\'tr_d\'>
		<td colspan=2>Jumlah Tenaga Semester I : </td><td class=\'td_t\' align=\'right\'>' . $total_1 . '</td><td class=\'td_t\' align=\'right\'>' . $tetap1 . '</td><td class=\'td_t\' align=\'right\'>' . $t_tetap1 . '</td><td colspan=3>&nbsp;</td>
		</tr>
		<tr  id=\'tr_d\'>
		<td colspan=2>Jumlah Tenaga Semester II : </td><td class=\'td_t\' align=\'right\'>' . $total_2 . '</td><td class=\'td_t\' align=\'right\'>' . $tetap2 . '</td><td class=\'td_t\' align=\'right\'>' . $t_tetap2 . '</td><td colspan=3>&nbsp;</td>
		</tr>
		';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl2') {
			if (( empty( $bln ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.kode_rs,a.code_list,a.tetap,a.tidak_tetap,a.smt,a.tahun from rl2 a left join m_rl2 b on b.code_list=a.code_list where kode_rs=\'' . $koders . '\' order by a.code_list Asc' );
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.kode_rs,a.code_list,a.tetap,a.tidak_tetap,a.smt,a.tahun from rl2 a left join m_rl2 b on b.code_list=a.code_list where kode_rs=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
				} else {
					if (( !empty( $bln ) && empty( $tahun ) )) {
						$sql2 = mysql_query( '' . 'select a.kode_rs,a.code_list,a.tetap,a.tidak_tetap,a.smt,a.tahun from rl2 a left join m_rl2 b on b.code_list=a.code_list where kode_rs=\'' . $koders . '\' and smt=\'' . $bln . '\' order by a.code_list Asc' );
					} else {
						if (( !empty( $bln ) && !empty( $tahun ) )) {
							$sql2 = mysql_query( '' . 'select a.kode_rs,a.code_list,a.tetap,a.tidak_tetap,a.smt,a.tahun from rl2 a left join m_rl2 b on b.code_list=a.code_list where kode_rs=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt=\'' . $bln . '\' order by a.code_list Asc' );
						}
					}
				}
			}

			
			$xml = new SimpleXMLElement( '<xml/>' );

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'tetap', $tetap );
				$data->addChild( 'tidak_tetap', $tidak_tetap );
				$data->addChild( 'smt', $smt );
				$data->addChild( 'tahun', $tahun );
			}

			$fp = fopen( 'xml/rl2_' . $bln . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl2_' . $bln . '_' . $tahun . '.xml';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
		}
//////////////////////////AKHIR RL2/////////////

//////////////AWAL BATAS RL41////////////////
		if ($reqdata  == 'cari_rl41') {
			echo '
			<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>No. DTD</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>No. Daftar Terperinci</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Golongan Sebab Penyakit</th>
			<th colspan=\'18\' style=\'border:1px solid grey;\'>Jumlah Pasien Hidup/Mati Menurut Umur dan Jenis Kelamin</th>
			<th colspan=\'2\' rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar (Hidup & Mati) Menurut Jenis Kelamin</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar (Hidup & Mati)</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar Mati</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>

			</tr>
			<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 0-6hr </th><th style=\'border:1px solid grey;\' colspan=\'2\'> 7-28hr </th><th style=\'border:1px solid grey;\' colspan=\'2\'>29hr-<1th</th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 1-4th </th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 5-14th </th><th style=\'border:1px solid grey;\' colspan=\'2\'> 15-24th </th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 25-44th </th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 45-64th</th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> >65th</th>
			</tr>
			<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			</tr>';

			if (( empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = " AND a.TGLMASUK LIKE '".date('Y')."-%' ";
					$tanggal2 = " AND a.TGLMASUK LIKE '%-".date('m')."-%' ";
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = " AND a.TGLMASUK LIKE '".$tahun."-%' ";
					$tanggal2 = "";
			}else {
				if (( !empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = "";
					$tanggal2 = " AND a.TGLMASUK LIKE '%-".$bln."-%' ";
			}else {
				if (( !empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = "  AND a.TGLMASUK LIKE '".$tahun."-%' ";
					$tanggal2 = " AND a.TGLMASUK LIKE '%-".$bln."-%' ";
						}
					}
				}
			}

			$sql2 = mysql_query("SELECT DISTINCT b.icd_code
									FROM t_resumepulang a 
										LEFT JOIN icd b ON a.ICDKELUAR=b.icd_code
										INNER JOIN t_admission c ON a.IDADMISSION=c.id_admission
										INNER JOIN m_pasien d ON d.NOMR=a.NOMR
									WHERE
										a.NIP='rekammedik' $tanggal1 $tanggal2

										 ");

			//SELECT ? FROM ?
			$kondisi_select = " a.ICDKELUAR FROM t_resumepulang a 
								LEFT JOIN icd b ON a.ICDKELUAR=b.icd_code 
								INNER JOIN t_admission c ON a.IDADMISSION=c.id_admission
								INNER JOIN m_pasien d ON d.NOMR=a.NOMR ";
			//WHERE NIP STATUS JENIS KELAMIN L
			$nip_status_jkL = "AND a.NIP='rekammedik' AND a.JENISKELAMIN='L' ";
			//WHERE NIP STATUS JENIS KELAMIN P
			$nip_status_jkP = "AND a.NIP='rekammedik' AND a.JENISKELAMIN='P' ";

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				
				switch ($bln) {
					case '1': {
						$bln = 'Januari';
						break;
					}

					case '2': {
						$bln = 'Februari';
						break;
					}

					case '3': {
						$bln = 'Maret';
						break;
					}

					case '4': {
						$bln = 'April';
						break;
					}

					case '5': {
						$bln = 'Mei';
						break;
					}

					case '6': {
						$bln = 'Juni';
						break;
					}

					case '7': {
						$bln = 'Juli';
						break;
					}

					case '8': {
						$bln = 'Agustus';
						break;
					}

					case '9': {
						$bln = 'September';
						break;
					}

					case '10': {
						$bln = 'Oktober';
						break;
					}

					case '11': {
						$bln = 'November';
						break;
					}

					case '12': {
						$bln = 'Desember';
					}
				}

				echo '' . '<tr class=\'tr_s\'>
					<td style=\'border:1px solid grey;\'>'; $sqldtd = mysql_fetch_array( mysql_query("SELECT dtd FROM icd WHERE icd_code ='$icd_code' ") );extract( $sqldtd );echo $dtd; echo '</td>
					<td style=\'border:1px solid grey;\'>' . $icd_code . '</td>
					<td style=\'border:1px solid grey;\'>'; $sqlsebabpenyakit = mysql_fetch_array( mysql_query("SELECT sebabpenyakit FROM icd WHERE icd_code ='$icd_code' ") );extract( $sqlsebabpenyakit );echo $sebabpenyakit; echo '</td>
					<td style=\'border:1px solid grey;\'>'; $jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml6L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml6P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml28L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml28P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml28P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml1L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml1P; echo  '</td>	
					<td style=\'border:1px solid grey;\'>'; $jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml4L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml4P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml14L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml14P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml24L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml24P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml44L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml44P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml65_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64_L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml65_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64_P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlTL = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code'  $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jmlTL; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlTP = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jmlTP; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlT = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND a.NIP='rekammedik' $tanggal1 $tanggal2 ")); echo $jmlT; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlTM = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND a.NIP='rekammedik' AND a.STATUSPULANG ='7' $tanggal1 $tanggal2 ")); echo $jmlTM; echo  '</td>
					<td style=\'border:1px solid grey;\'>' . $bln . '</td>
					<td style=\'border:1px solid grey;\'>' . $tahun . '</td>';

				echo '</tr>';
							}

							echo '' . '<tr class=\'tr_s\'>
					<td style=\'border:1px solid grey;\' colspan=3>Total Bulan ' . $bln . ' Tahun ' . $tahun . '</td>
					<td style=\'border:1px solid grey;\'>'; $jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(d.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml6L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(d.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml6P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(d.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml28L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml28p = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(d.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml28P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(d.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml1L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(d.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml1P; echo  '</td>	
					<td style=\'border:1px solid grey;\'>'; $jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml4L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml4P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml14L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml14P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml24L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml24P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml44L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml44P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64_L; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64_P; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlSTL = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND a.JENISKELAMIN='L' $tanggal1 $tanggal2 ")); echo $jmlSTL; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlSTP = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik'  AND a.JENISKELAMIN='P' $tanggal1 $tanggal2 ")); echo $jmlSTP; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlST = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik'  $tanggal1 $tanggal2 ")); echo $jmlST; echo  '</td>
					<td style=\'border:1px solid grey;\'>'; $jmlST = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik'  AND a.STATUSPULANG ='7' $tanggal1 $tanggal2 ")); echo $jmlST; echo  '</td>
					<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
					';
							echo '</tr>';
							echo '</table>';
		}



		if ($reqdata  == 'xml_rl41') {
			if (( empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = " AND a.TGLMASUK LIKE '".date('Y')."-%' ";
					$tanggal2 = " AND a.TGLMASUK LIKE '%-".date('m')."-%' ";
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = " AND a.TGLMASUK LIKE '".$tahun."-%' ";
					$tanggal2 = "";
			}else {
				if (( !empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = "";
					$tanggal2 = " AND a.TGLMASUK LIKE '%-".$bln."-%' ";
			}else {
				if (( !empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = "  AND a.TGLMASUK LIKE '".$tahun."-%' ";
					$tanggal2 = " AND a.TGLMASUK LIKE '%-".$bln."-%' ";
						}
					}
				}
			}

			$sql2 = mysql_query("SELECT DISTINCT b.icd_code
									FROM t_resumepulang a 
										LEFT JOIN icd b ON a.ICDKELUAR=b.icd_code
										INNER JOIN t_admission c ON a.IDADMISSION=c.id_admission
										INNER JOIN m_pasien d ON d.NOMR=a.NOMR
									WHERE
										a.NIP='rekammedik' $tanggal1 $tanggal2

										 ");

			//SELECT ? FROM ?
			$kondisi_select = " a.ICDKELUAR FROM t_resumepulang a 
								LEFT JOIN icd b ON a.ICDKELUAR=b.icd_code 
								INNER JOIN t_admission c ON a.IDADMISSION=c.id_admission
								INNER JOIN m_pasien d ON d.NOMR=a.NOMR ";
			//WHERE NIP STATUS JENIS KELAMIN L
			$nip_status_jkL = "AND a.NIP='rekammedik' AND a.JENISKELAMIN='L' ";
			//WHERE NIP STATUS JENIS KELAMIN P
			$nip_status_jkP = "AND a.NIP='rekammedik' AND a.JENISKELAMIN='P' ";
			
			$xml = new SimpleXMLElement( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml28P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(d.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(d.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 "));

				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $icd_code );
				$data->addChild( 'j_1_6hr_L', $jml6L );
				$data->addChild( 'j_1_6hr_P', $jml6P );
				$data->addChild( 'j_7_28hr_L', $jml28L );
				$data->addChild( 'j_7_28hr_P', $jml28P );
				$data->addChild( 'j_28hr_1th_L', $jml1L );
				$data->addChild( 'j_28hr_1th_P', $jml1P );
				$data->addChild( 'j_1_4th_L', $jml4L );
				$data->addChild( 'j_1_4th_P', $jml4P );
				$data->addChild( 'j_5_14th_L', $jml14L );
				$data->addChild( 'j_5_14th_P', $jml14P );
				$data->addChild( 'j_15_24th_L', $jml24L );
				$data->addChild( 'j_15_24th_P', $jml24P );
				$data->addChild( 'j_25_44th_L', $jml44L );
				$data->addChild( 'j_25_44th_P', $jml44P );
				$data->addChild( 'j_45_64th_L', $jml64L );
				$data->addChild( 'j_45_64th_P', $jml64P );
				$data->addChild( 'j_65th_L', $jml64_L );
				$data->addChild( 'j_65th_P', $jml64_P );
				$data->addChild( 'bulan', $bln );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( 'xml/rl41_' . $bln . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl41_' . $bln . '_' . $tahun . '.xml';
			echo "<div id='file_xml'>";
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo "</div>";
		}
		
/////////////AKHIR BATAS RL41///////////


///////////////////////AWAL BATAS RL42////////////////////
		
		if ($reqdata  == 'cari_rl42') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>No. DTD</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>No. Daftar Terperinci</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Golongan Sebab Penyakit</th>
			<th colspan=\'18\' style=\'border:1px solid grey;\'>Jumlah Pasien Hidup/Mati Menurut Umur dan Jenis Kelamin</th>
			<th colspan=\'2\' rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar (Hidup & Mati) Menurut Jenis Kelamin</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar (Hidup & Mati)</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar Mati</th>
			<th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>

			</tr>
			<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 0-6hr </th><th style=\'border:1px solid grey;\' colspan=\'2\'> 7-28hr </th><th style=\'border:1px solid grey;\' colspan=\'2\'>29hr-<1th</th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 1-4th </th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 5-14th </th><th style=\'border:1px solid grey;\' colspan=\'2\'> 15-24th </th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'> 25-44th </th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'>45-64th</th>
			<th style=\'border:1px solid grey;\' colspan=\'2\'>>65th</th>
			</tr>
			<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
			</tr>';

			if (( empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".date('Y')."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".date('m')."-%' ";
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = "";
			}else {
				if (( !empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = "";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
			}else {
				if (( !empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = "  AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
						}
					}
				}
			}
			

			echo $nip_jk_status;
				$sql2 = mysql_query("SELECT DISTINCT b.icd_code
									FROM t_diagnosadanterapi a 
										LEFT JOIN icd b ON a.ICD_CODE=b.icd_code
										INNER JOIN m_pasien c ON a.NOMR=c.NOMR
										INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR
									WHERE
										a.NIP='rekammedik' AND
										d.STATUS !='0' $tanggal1 $tanggal2

										 ");

			//SELECT ? FROM ?
			$kondisi_select = "a.ICD_CODE FROM t_diagnosadanterapi a LEFT JOIN icd b ON a.ICD_CODE=b.icd_code INNER JOIN m_pasien c ON a.NOMR=c.NOMR INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR";
			//WHERE NIP STATUS JENIS KELAMIN L
			$nip_status_jkL = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='L' AND d.STATUS!='0'";
			//WHERE NIP STATUS JENIS KELAMIN P
			$nip_status_jkP = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='P' AND d.STATUS!='0'";
			
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );

				switch ($bln) {
					case '1': {
						$bln = 'Januari';
						break;
					}

					case '2': {
						$bln = 'Februari';
						break;
					}

					case '3': {
						$bln = 'Maret';
						break;
					}

					case '4': {
						$bln = 'April';
						break;
					}

					case '5': {
						$bln = 'Mei';
						break;
					}

					case '6': {
						$bln = 'Juni';
						break;
					}

					case '7': {
						$bln = 'Juli';
						break;
					}

					case '8': {
						$bln = 'Agustus';
						break;
					}

					case '9': {
						$bln = 'September';
						break;
					}

					case '10': {
						$bln = 'Oktober';
						break;
					}

					case '11': {
						$bln = 'Nopember';
						break;
					}

					case '12': {
						$bln = 'Desember';
					}
							}
					


				echo '' . '<tr class=\'tr_s\'>

	<td style=\'border:1px solid grey;\'>'; $sqldtd = mysql_fetch_array( mysql_query("SELECT dtd FROM icd WHERE icd_code ='$icd_code' ") );extract( $sqldtd );echo $dtd; echo '</td>
	<td style=\'border:1px solid grey;\'>' . $icd_code . '</td>
	<td style=\'border:1px solid grey;\'>'; $sqlsebabpenyakit = mysql_fetch_array( mysql_query("SELECT sebabpenyakit FROM icd WHERE icd_code ='$icd_code' ") );extract( $sqlsebabpenyakit );echo $sebabpenyakit; echo '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml6L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml6P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml28L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml28P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml1L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml1P; echo  '</td>	
	<td style=\'border:1px solid grey;\'>'; $jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml4L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml4P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml14L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml14P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml24L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml24P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml44L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml44P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64_L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64_P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlTL = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code'  $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jmlTL; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlTP = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jmlTP; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlT = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND a.NIP='rekammedik' AND d.STATUS!='0' $tanggal1 $tanggal2 ")); echo $jmlT; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlTM = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND a.NIP='rekammedik' AND d.STATUS='8' $tanggal1 $tanggal2 ")); echo $jmlTM; echo  '</td>
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>';

echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=3>Total Bulan ' . $bln . ' Tahun ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml6L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml6P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml28L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28p = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml28P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml1L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml1P; echo  '</td>	
	<td style=\'border:1px solid grey;\'>'; $jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml4L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml4P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml14L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml14P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml24L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml24P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml44L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml44P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64_L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64_P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlSTL = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS!='0' AND c.JENISKELAMIN='L' $tanggal1 $tanggal2 ")); echo $jmlSTL; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlSTP = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS!='0' AND c.JENISKELAMIN='P' $tanggal1 $tanggal2 ")); echo $jmlSTP; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlST = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS!='0' $tanggal1 $tanggal2 ")); echo $jmlST; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlSTM = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS='8' $tanggal1 $tanggal2 ")); echo $jmlSTM; echo  '</td>
	<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl42') {
			if (( empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".date('Y')."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".date('m')."-%' ";
					$bln = date('m');
					$tahun = date('Y');
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = "";
					//$bln = date('m');
			}else {
				if (( !empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = "";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
					$tahun = date('Y');
			}else {
				if (( !empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = "  AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
						}
					}
				}
			}


				$sql2 = mysql_query("SELECT DISTINCT b.icd_code
									FROM t_diagnosadanterapi a 
										LEFT JOIN icd b ON a.ICD_CODE=b.icd_code
										INNER JOIN m_pasien  c ON a.NOMR=c.NOMR
										INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR
									WHERE
										a.NIP='rekammedik' AND
										d.STATUS!='0' $tanggal1 $tanggal2
										 ");
			
			
			//SELECT ? FROM ?
			$kondisi_select = "a.ICD_CODE FROM t_diagnosadanterapi a LEFT JOIN icd b ON a.ICD_CODE=b.icd_code INNER JOIN m_pasien c ON a.NOMR=c.NOMR INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR";
			//WHERE NIP STATUS JENIS KELAMIN L
			$nip_status_jkL = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='L' AND d.STATUS!='0'";
			//WHERE NIP STATUS JENIS KELAMIN P
			$nip_status_jkP = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='P' AND d.STATUS!='0'";

			$xml = new SimpleXMLElement ( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$date1 = new DateTime(date('Y-m-d', strtotime($TGLLAHIR)));
				$date2 = new DateTime(date('Y-m-d'));
				$interval = $date1->diff($date2);

				$jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml28P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICDKELUAR='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 "));

				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $icd_code );
				$data->addChild( 'j_1_6hr_L', $jml6L );
				$data->addChild( 'j_1_6hr_P', $jml6P );
				$data->addChild( 'j_7_28hr_L', $jml28L );
				$data->addChild( 'j_7_28hr_P', $jml28P );
				$data->addChild( 'j_28hr_1th_L', $jml1L );
				$data->addChild( 'j_28hr_1th_P', $jml1P );
				$data->addChild( 'j_1_4th_L', $jml4L );
				$data->addChild( 'j_1_4th_P', $jml4P );
				$data->addChild( 'j_5_14th_L', $jml14L );
				$data->addChild( 'j_5_14th_P', $jml14P );
				$data->addChild( 'j_15_24th_L', $jml24L );
				$data->addChild( 'j_15_24th_P', $jml24P );
				$data->addChild( 'j_25_44th_L', $jml44L );
				$data->addChild( 'j_25_44th_P', $jml44P );
				$data->addChild( 'j_45_64th_L', $jml64L );
				$data->addChild( 'j_45_64th_P', $jml64P );
				$data->addChild( 'j_65th_L', $jml64_L );
				$data->addChild( 'j_65th_P', $jml64_P );
				$data->addChild( 'bulan', $bln );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( 'xml/rl42_' . $bln . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl42_' . $bln . '_' . $tahun . '.xml';
			echo "<div id='file_xml'>";
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo "</div>";
		}
/////////////////BATAS AKHIR RL42////////////////////
		
////////////////BATAS AWAL RL43////////

		
		if ($reqdata  == 'cari_rl43') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No. DTD</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>No. Daftar Terperinci</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Golongan Sebab Penyakit</th><th colspan=\'18\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar Mati Menurut Umur dan Jenis Kelamin</th><th colspan=\'2\' rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar Mati Menurut Jenis Kelamin</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Pasien Keluar Mati</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\' colspan=\'2\'> 0-6hr </th><th style=\'border:1px solid grey;\' colspan=\'2\'> 7-28hr </th><th style=\'border:1px solid grey;\' colspan=\'2\'>29hr-<1th</th>
		<th style=\'border:1px solid grey;\' colspan=\'2\'> 1-4th </th>
		<th style=\'border:1px solid grey;\' colspan=\'2\'> 5-14th </th><th style=\'border:1px solid grey;\' colspan=\'2\'> 15-24th </th>
		<th style=\'border:1px solid grey;\' colspan=\'2\'> 25-44th </th>
		<th style=\'border:1px solid grey;\' colspan=\'2\'>45-64th</th>
		<th style=\'border:1px solid grey;\' colspan=\'2\'>>65th</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'> L </th><th style=\'border:1px solid grey;\'>P</th>
		</tr>';

			if (( empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".date('Y')."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".date('m')."-%' ";
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = "";
			}else {
				if (( !empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = "";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
			}else {
				if (( !empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = "  AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
						}
					}
				}
			}
			

				$sql2 = mysql_query("SELECT DISTINCT b.icd_code
									FROM t_diagnosadanterapi a 
										LEFT JOIN icd b ON a.ICD_CODE=b.icd_code
										INNER JOIN m_pasien c ON a.NOMR=c.NOMR
										INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR
									WHERE
										a.NIP='rekammedik' AND
										d.STATUS='8' $tanggal1 $tanggal2

										 ");

			//SELECT ? FROM ?
			$kondisi_select = "a.ICD_CODE FROM t_diagnosadanterapi a LEFT JOIN icd b ON a.ICD_CODE=b.icd_code INNER JOIN m_pasien c ON a.NOMR=c.NOMR INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR";
			//WHERE NIP STATUS JENIS KELAMIN L
			$nip_status_jkL = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='L' AND d.STATUS='8'";
			//WHERE NIP STATUS JENIS KELAMIN P
			$nip_status_jkP = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='P' AND d.STATUS='8'";
			
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );

				switch ($bln) {
					case '1': {
						$bln = 'Januari';
						break;
					}

					case '2': {
						$bln = 'Februari';
						break;
					}

					case '3': {
						$bln = 'Maret';
						break;
					}

					case '4': {
						$bln = 'April';
						break;
					}

					case '5': {
						$bln = 'Mei';
						break;
					}

					case '6': {
						$bln = 'Juni';
						break;
					}

					case '7': {
						$bln = 'Juli';
						break;
					}

					case '8': {
						$bln = 'Agustus';
						break;
					}

					case '9': {
						$bln = 'September';
						break;
					}

					case '10': {
						$bln = 'Oktober';
						break;
					}

					case '11': {
						$bln = 'Nopember';
						break;
					}

					case '12': {
						$bln = 'Desember';
					}
							}
					


				echo '' . '<tr class=\'tr_s\'>

	<td style=\'border:1px solid grey;\'>'; $sqldtd = mysql_fetch_array( mysql_query("SELECT dtd FROM icd WHERE icd_code ='$icd_code' ") );extract( $sqldtd );echo $dtd; echo '</td>
	<td style=\'border:1px solid grey;\'>' . $icd_code . '</td>
	<td style=\'border:1px solid grey;\'>'; $sqlsebabpenyakit = mysql_fetch_array( mysql_query("SELECT sebabpenyakit FROM icd WHERE icd_code ='$icd_code' ") );extract( $sqlsebabpenyakit );echo $sebabpenyakit; echo '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml6L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml6P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml28L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml28P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml1L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml1P; echo  '</td>	
	<td style=\'border:1px solid grey;\'>'; $jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml4L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml4P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml14L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml14P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml24L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml24P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml44L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml44P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64_L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64_P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlTL = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code'  $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jmlTL; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlTP = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jmlTP; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlT = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND a.NIP='rekammedik' AND d.STATUS='8' $tanggal1 $tanggal2 ")); echo $jmlT; echo  '</td>
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>';

echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=3>Total Bulan ' . $bln . ' Tahun ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml6L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml6P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml28L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml28p = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml28P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml1L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml1P; echo  '</td>	
	<td style=\'border:1px solid grey;\'>'; $jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml4L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml4P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml14L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml14P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml24L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml24P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml44L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml44P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 ")); echo $jml64_L; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 ")); echo $jml64_P; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlSTL = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS='8' AND c.JENISKELAMIN='L' $tanggal1 $tanggal2 ")); echo $jmlSTL; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlSTP = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS='8' AND c.JENISKELAMIN='P' $tanggal1 $tanggal2 ")); echo $jmlSTP; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jmlST = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.NIP='rekammedik' AND d.STATUS='8' $tanggal1 $tanggal2 ")); echo $jmlST; echo  '</td>
	<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl43') {
			if (( empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".date('Y')."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".date('m')."-%' ";
					$bln = date('m');
					$tahun = date('Y');
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = " AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = "";
					//$bln = date('m');
			}else {
				if (( !empty( $bln ) && empty( $tahun ) )) {
					$tanggal1 = "";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
					$tahun = date('Y');
			}else {
				if (( !empty( $bln ) && !empty( $tahun ) )) {
					$tanggal1 = "  AND a.TANGGAL LIKE '".$tahun."-%' ";
					$tanggal2 = " AND a.TANGGAL LIKE '%-".$bln."-%' ";
						}
					}
				}
			}


				$sql2 = mysql_query("SELECT DISTINCT b.icd_code
									FROM t_diagnosadanterapi a 
										LEFT JOIN icd b ON a.ICD_CODE=b.icd_code
										INNER JOIN m_pasien  c ON a.NOMR=c.NOMR
										INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR
									WHERE
										a.NIP='rekammedik' AND
										d.STATUS='8' $tanggal1 $tanggal2
										 ");
			
			
			//SELECT ? FROM ?
			$kondisi_select = "a.ICD_CODE FROM t_diagnosadanterapi a LEFT JOIN icd b ON a.ICD_CODE=b.icd_code INNER JOIN m_pasien c ON a.NOMR=c.NOMR INNER JOIN t_pendaftaran d ON a.NOMR=d.NOMR";
			//WHERE NIP STATUS JENIS KELAMIN L
			$nip_status_jkL = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='L' AND d.STATUS='8'";
			//WHERE NIP STATUS JENIS KELAMIN P
			$nip_status_jkP = "AND a.NIP='rekammedik' AND c.JENISKELAMIN='P' AND d.STATUS='8'";

			$xml = new SimpleXMLElement ( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$jml6L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml6P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='0' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='6' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml28L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml28P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='7' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)<='28' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)='0' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml1L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml1P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND DAY(CURDATE()) - DAY(c.TGLLAHIR)>='29' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'1' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml4L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml4P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='1' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='4' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml14L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml14P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='5' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='14' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml24L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml24P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='15' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='24' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml44L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml44P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'25' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<'44' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml64L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml64P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>='45' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)<='64' $nip_status_jkP $tanggal1 $tanggal2 "));
				$jml64_L = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkL $tanggal1 $tanggal2 "));
				$jml64_P = mysql_num_rows(mysql_query("SELECT $kondisi_select WHERE a.ICD_CODE='$icd_code' AND YEAR(CURDATE()) - YEAR(c.TGLLAHIR)>'65' $nip_status_jkP $tanggal1 $tanggal2 "));

				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $icd_code );
				$data->addChild( 'j_1_6hr_L', $jml6L );
				$data->addChild( 'j_1_6hr_P', $jml6P );
				$data->addChild( 'j_7_28hr_L', $jml28L );
				$data->addChild( 'j_7_28hr_P', $jml28P );
				$data->addChild( 'j_28hr_1th_L', $jml1L );
				$data->addChild( 'j_28hr_1th_P', $jml1P );
				$data->addChild( 'j_1_4th_L', $jml4L );
				$data->addChild( 'j_1_4th_P', $jml4P );
				$data->addChild( 'j_5_14th_L', $jml14L );
				$data->addChild( 'j_5_14th_P', $jml14P );
				$data->addChild( 'j_15_24th_L', $jml24L );
				$data->addChild( 'j_15_24th_P', $jml24P );
				$data->addChild( 'j_25_44th_L', $jml44L );
				$data->addChild( 'j_25_44th_P', $jml44P );
				$data->addChild( 'j_45_64th_L', $jml64L );
				$data->addChild( 'j_45_64th_P', $jml64P );
				$data->addChild( 'j_65th_L', $jml64_L );
				$data->addChild( 'j_65th_P', $jml64_P );
				$data->addChild( 'bulan', $bln );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( 'xml/rl43_' . $bln . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl43_' . $bln . '_' . $tahun . '.xml';
			echo "<div id='file_xml'>";
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo "</div>";
		}

		/////////////BATAS AKHIR RL43////////////
	}
	




?>