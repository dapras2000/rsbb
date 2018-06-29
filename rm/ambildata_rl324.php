<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

	if ($reqdata  == 'masuk') {
			echo 'OK';
		}

if ($reqdata  == 'save_rl324') {
			$sql = mysql_query( '' . 'select * from rl324 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and bulan=\'' . $bln . '\'' );
			
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				$sql_u = mysql_query( '' . 'Update rl324 set rs=\'' . $rs . '\', ' . ( '' . 'pkm=\'' . $pkm . '\', bidan=\'' . $bidan . '\', faskes_lain=\'' . $faskes . '\', mati_faskes=\'' . $mati_faskes . '\', ' ) . ( '' . 'total_faskes=\'' . $total_faskes . '\', ' ) . ( '' . 'mati_non_rujukan=\'' . $mati_non_rujukan . '\', total_non_rujukan=\'' . $total_non_rujukan . '\', dirujuk=\'' . $dirujuk . '\' ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and bulan=\'' . $bln . '\'' ) );
				
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				$sql_u = mysql_query( 'INSERT INTO rl324(code_list,koders,rs,pkm,bidan,faskes_lain,mati_faskes,total_faskes,mati_non_rujukan,total_non_rujukan,dirujuk,bulan,tahun,tgl_update) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $rs . '\',\'' . $pkm . '\',\'' . $bidan . '\',\'' . $faskes . '\',\'' . $mati_faskes . '\',\'' . $total_faskes . '\',\'' . $mati_non_rujukan . '\',\'' . $total_non_rujukan . '\',\'' . $dirujuk . '\',\'' . $bln . '\',\'' . $tahunsave . '\',\'' . $tgl . '\')' ) );
				
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=\'6\' style=\'border:1px solid grey;\'>Rujukan</th><th colspan=\'3\' style=\'border:1px solid grey;\'>Non Rujukan</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Dirujuk</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>-</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th colspan=\'6\' style=\'border:1px solid grey;\'>Fasilitas Kesehatan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Hidup</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Mati</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Rumah Sakit</th><th style=\'border:1px solid grey;\'>Puskesmas</th><th style=\'border:1px solid grey;\'>Bidan</th><th style=\'border:1px solid grey;\'>Faskes Lain</th><th style=\'border:1px solid grey;\'>Mati</th><th style=\'border:1px solid grey;\'>Total</th></tr>
		';
			$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list' );
			
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$total_fas = $rs + $pkm + $bidan + $faskes_lain + $mati_faskes;
				$total_non_r = $mati_non_rujukan + $total_non_rujukan;
				switch ($bulan) {
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
	<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
	<td style=\'border:1px solid grey;\'>' . $description . '</td>
	<td style=\'border:1px solid grey;\'>' . $rs . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm . '</td>
	<td style=\'border:1px solid grey;\'>' . $bidan . '</td>
	<td style=\'border:1px solid grey;\'>' . $faskes_lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_faskes . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_fas . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_non_rujukan . '</td>	
	<td style=\'border:1px solid grey;\'>' . $mati_non_rujukan . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_non_r . '</td>
		<td style=\'border:1px solid grey;\'>' . $dirujuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahunsave . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl324.php&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahunsave . '\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
		<a href=\'rm/hapus_rl324.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahunsave . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			
			echo '</table>';
		}


		if ($reqdata  == 'cari_rl324') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th colspan=\'6\' style=\'border:1px solid grey;\'>Rujukan</th>
		<th colspan=\'3\' style=\'border:1px solid grey;\'>Non Rujukan</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Dirujuk</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>
		<th style=\'border:1px solid grey;\' align=\'center\' rowspan=\'3\'>-</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th colspan=\'6\' style=\'border:1px solid grey;\'>Fasilitas Kesehatan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Hidup</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Mati</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Rumah Sakit</th><th style=\'border:1px solid grey;\'>Puskesmas</th><th style=\'border:1px solid grey;\'>Bidan</th><th style=\'border:1px solid grey;\'>Faskes Lain</th><th style=\'border:1px solid grey;\'>Mati</th><th style=\'border:1px solid grey;\'>Total</th>		
		</tr>
		';

			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list' );
				$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes_lain,sum(a.mati_faskes) as jmati_faskes,sum(a.total_faskes) as jtotal_fas,sum(a.mati_non_faskes) as jmati_non_faskes,sum(a.total_non_faskes) as jtotal_non_faskes,sum(a.mati_non_rujukan) as jmati_non_rujukan,sum(a.total_non_rujukan) as jtotal_non_rujukan,sum(a.dirujuk) as jdirujuk from rl324 a  where koders=\'' . $koders . '\' order by a.code_list' );
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'  order by a.code_list' );
					$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes_lain,sum(a.mati_faskes) as jmati_faskes,sum(a.total_faskes) as jtotal_fas,sum(a.mati_non_faskes) as jmati_non_faskes,sum(a.total_non_faskes) as jtotal_non_faskes,sum(a.mati_non_rujukan) as jmati_non_rujukan,sum(a.total_non_rujukan) as jtotal_non_rujukan,sum(a.dirujuk) as jdirujuk from rl324 a  where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'  order by a.code_list' );
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 order by a.code_list' );
							$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes_lain,sum(a.mati_faskes) as jmati_faskes,sum(a.total_faskes) as jtotal_fas,sum(a.mati_non_faskes) as jmati_non_faskes,sum(a.total_non_faskes) as jtotal_non_faskes,sum(a.mati_non_rujukan) as jmati_non_rujukan,sum(a.total_non_rujukan) as jtotal_non_rujukan,sum(a.dirujuk) as jdirujuk from rl324 a  where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 order by a.code_list' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 order by a.code_list' );
							$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes_lain,sum(a.mati_faskes) as jmati_faskes,sum(a.total_faskes) as jtotal_fas,sum(a.mati_non_faskes) as jmati_non_faskes,sum(a.total_non_faskes) as jtotal_non_faskes,sum(a.mati_non_rujukan) as jmati_non_rujukan,sum(a.total_non_rujukan) as jtotal_non_rujukan,sum(a.dirujuk) as jdirujuk from rl324 a  where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 order by a.code_list' );
						
						}
						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 and tahun=\'' . $tahun . '\' order by a.code_list' );
								$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes_lain,sum(a.mati_faskes) as jmati_faskes,sum(a.total_faskes) as jtotal_fas,sum(a.mati_non_faskes) as jmati_non_faskes,sum(a.total_non_faskes) as jtotal_non_faskes,sum(a.mati_non_rujukan) as jmati_non_rujukan,sum(a.total_non_rujukan) as jtotal_non_rujukan,sum(a.dirujuk) as jdirujuk from rl324 a  where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 and tahun=\'' . $tahun . '\' order by a.code_list' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 and tahun=\'' . $tahun . '\' order by a.code_list' );
								$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes_lain,sum(a.mati_faskes) as jmati_faskes,sum(a.total_faskes) as jtotal_fas,sum(a.mati_non_faskes) as jmati_non_faskes,sum(a.total_non_faskes) as jtotal_non_faskes,sum(a.mati_non_rujukan) as jmati_non_rujukan,sum(a.total_non_rujukan) as jtotal_non_rujukan,sum(a.dirujuk) as jdirujuk from rl324 a  where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 and tahun=\'' . $tahun . '\' order by a.code_list' );
							
							}
							
						}
					}
				}
			}

			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$total_fas = $rs + $pkm + $bidan + $faskes_lain + $mati_faskes;
				$total_non_r = $mati_non_rujukan + $total_non_rujukan;
				switch ($bulan) {
					case '1': {
						$bln = 'Januari';
						$smstr = 'I';
						break;
					}

					case '2': {
						$bln = 'Februari';
						$smstr = 'I';
						break;
					}

					case '3': {
						$bln = 'Maret';
						$smstr = 'I';
						break;
					}

					case '4': {
						$bln = 'April';
						$smstr = 'I';
						break;
					}

					case '5': {
						$bln = 'Mei';
						$smstr = 'I';
						break;
					}

					case '6': {
						$bln = 'Juni';
						$smstr = 'I';
						break;
					}

					case '7': {
						$bln = 'Juli';
						$smstr = 'II';
						break;
					}

					case '8': {
						$bln = 'Agustus';
						$smstr = 'II';
						break;
					}

					case '9': {
						$bln = 'September';
						$smstr = 'II';
						break;
					}

					case '10': {
						$bln = 'Oktober';
						$smstr = 'II';
						break;
					}

					case '11': {
						$bln = 'November';
						$smstr = 'II';
						break;
					}

					case '12': {
						$bln = 'Desember';
						$smstr = 'II';
					}
				}

				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
	<td style=\'border:1px solid grey;\'>' . $description . '</td>
	<td style=\'border:1px solid grey;\'>' . $rs . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm . '</td>
	<td style=\'border:1px solid grey;\'>' . $bidan . '</td>
	<td style=\'border:1px solid grey;\'>' . $faskes_lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_faskes . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_fas . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_non_rujukan . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_non_rujukan . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_non_r . '</td>

		<td style=\'border:1px solid grey;\'>' . $dirujuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl324&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
		<a href=\'rm/hapus_rl324.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			$r2 = mysql_fetch_array( $sql3 );
			extract( $r2 );
				$jtotal_fas = $jrs + $jpkm + $jbidan + $jfaskes_lain + $jmati_faskes;
				$jtotal_non_r = $jmati_non_rujukan + $jtotal_non_rujukan;

			echo '' . '<tr class=\'tr_s\'>
			<td style=\'border:1px solid grey;\'colspan=2 >Total Semester '. $smstr.' Tahun '.$tahun . '</td>
			<td style=\'border:1px solid grey;\'>' . $jrs . '</td>
			<td style=\'border:1px solid grey;\'>' . $jpkm . '</td>
			<td style=\'border:1px solid grey;\'>' . $jbidan . '</td>
			<td style=\'border:1px solid grey;\'>' . $jfaskes_lain . '</td>
			<td style=\'border:1px solid grey;\'>' . $jmati_faskes . '</td>
			<td style=\'border:1px solid grey;\'>' . $jtotal_fas . '</td>
			<td style=\'border:1px solid grey;\'>' . $jtotal_non_rujukan . '</td>	
			<td style=\'border:1px solid grey;\'>' . $jmati_non_rujukan . '</td>
			<td style=\'border:1px solid grey;\'>' . $jtotal_non_r . '</td>
			<td style=\'border:1px solid grey;\'>' . $jdirujuk . '</td>
			<td style=\'border:1px solid grey;\' colspan=4>-</td>
			';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl324') {
			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 order by a.code_list Asc' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 order by a.code_list Asc' );
						
						}
						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and bulan >= 1 and bulan <= 6 order by a.code_list Asc' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.mati_faskes,a.total_faskes,a.mati_non_faskes,a.total_non_faskes,a.mati_non_rujukan,a.total_non_rujukan,a.dirujuk,a.bulan,a.tahun,b.description from rl324 a left join m_rl324 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and bulan >= 7 and bulan <= 12 order by a.code_list Asc' );
							
							}
							
						}
					}
				}
			}

			
			
			$xml = new SimpleXMLElement ( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'rs', $rs );
				$data->addChild( 'puskesmas', $pkm );
				$data->addChild( 'bidan', $bidan );
				$data->addChild( 'faskes_lain', $faskes_lain );
				$data->addChild( 'mati_faskes', $mati_faskes );
				$data->addChild( 'total_faskes', $total_faskes );
				$data->addChild( 'mati_non_faskes', $mati_non_faskes );
				$data->addChild( 'total_non_faskes', $total_non_faskes );
				$data->addChild( 'mati_non_rujukan', $mati_non_rujukan );
				$data->addChild( 'total_non_rujukan', $total_non_rujukan );
				$data->addChild( 'p_dirujuk', $dirujuk );
				$data->addChild( 'bulan', $bulan );
				$data->addChild( 'semester', $smstr );
				$data->addChild( 'tahun', $tahun );
			}

			$fp = fopen( '../xml/rl324_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl324_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
	}