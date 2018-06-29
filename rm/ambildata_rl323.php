<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

	if ($reqdata  == 'masuk') {
			echo 'OK';
		}


		
		
		if ($reqdata  == 'save_rl323') {
			$sql = mysql_query( '' . 'select * from rl33 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and bulan=\'' . $bln . '\'' );
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				$sql_u = mysql_query( '' . 'Update rl33 set rs=\'' . $rs . '\', ' . ( '' . 'pkm=\'' . $pkm . '\', bidan=\'' . $bidan . '\', faskes_lain=\'' . $faskes . '\', ' ) . ( '' . 'nonrujukan=\'' . $nonrujukan . '\', hidup=\'' . $hidup . '\', mati=\'' . $mati . '\', ' ) . ( '' . 'dirujuk=\'' . $dirujuk . '\', dirawat_4hari=\'' . $dirawat . '\', total_sc=\'' . $total . '\' ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and bulan=\'' . $bln . '\'' ) );
				
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				$sql_u = mysql_query( 'INSERT INTO rl33(code_list,koders,rs,pkm,bidan,faskes_lain,nonrujukan,hidup,mati,dirujuk,dirawat_4hari,total_sc,bulan,tahun) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $rs . '\',\'' . $pkm . '\',\'' . $bidan . '\',\'' . $faskes . '\',\'' . $nonrujukan . '\',\'' . $hidup . '\',\'' . $mati . '\',\'' . $dirujuk . '\',\'' . $dirawat . '\',\'' . $total . '\',\'' . $bln . '\',\'' . $tahunsave . '\')' ) );
				
				echo 'Data Berhasil Disimpan';
			}

			echo '
<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=\'6\' style=\'border:1px solid grey;\'>Cara Masuk</th><th colspan=\'4\' style=\'border:1px solid grey;\'>Cara Keluar</th><th colspan=\'2\' rowspan=\'2\' style=\'border:1px solid grey;\'>SC Murni Primagravida</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th><th style=\'border:1px solid grey;\' align=\'center\' rowspan=\'3\'>-</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th colspan=\'4\' style=\'border:1px solid grey;\'>Rujukan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Non Rujukan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Hidup</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Mati</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Dirujuk</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Rumah Sakit</th><th style=\'border:1px solid grey;\'>Puskesmas</th><th style=\'border:1px solid grey;\'>Bidan</th><th style=\'border:1px solid grey;\'>Faskes Lain</th><th style=\'border:1px solid grey;\'>Dirawat < 4 hari</th><th style=\'border:1px solid grey;\'>SC Murni Primangavida</th></tr>
		';
			$sql2 = mysql_query( '' . 'select a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\'' );
			
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$total_m = $rs + $pkm + $bidan + $faskes_lain + $nonkes + $nonrujukan;
				$total_k = $hidup + $mati + $dirujuk;
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
						$bln = 'November';
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
	<td style=\'border:1px solid grey;\'>' . $nonrujukan . '</td>
		<td style=\'border:1px solid grey;\'>' . $total_m . '</td>
	<td style=\'border:1px solid grey;\'>' . $hidup . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati . '</td>
	<td style=\'border:1px solid grey;\'>' . $dirujuk . '</td>
		<td style=\'border:1px solid grey;\'>' . $total_k . '</td>
	<td style=\'border:1px solid grey;\'>' . $dirawat_4hari . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_sc . '</td>
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahunsave . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl323&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahunsave . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>&nbsp;<a href=\'rm/hapus_rl323.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahunsave . '#\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			echo '</table>';
		}


		if ($reqdata  == 'cari_rl323') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th colspan=\'6\' style=\'border:1px solid grey;\'>Cara Masuk</th>
		<th colspan=\'4\' style=\'border:1px solid grey;\'>Cara Keluar</th>
		<th colspan=\'2\' rowspan=\'2\' style=\'border:1px solid grey;\'>SC Murni Primagravida</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>
		<th style=\'border:1px solid grey;\' align=\'center\' rowspan=\'3\'>-</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th colspan=\'4\' style=\'border:1px solid grey;\'>Rujukan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Non Rujukan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Hidup</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Mati</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Dirujuk</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Rumah Sakit</th><th style=\'border:1px solid grey;\'>Puskesmas</th><th style=\'border:1px solid grey;\'>Bidan</th><th style=\'border:1px solid grey;\'>Faskes Lain</th><th style=\'border:1px solid grey;\'>Dirawat < 4 hari</th><th style=\'border:1px solid grey;\'>SC Murni Primangavida</th></tr>
		';

			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\'' );
				
				$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes, sum(a.nonrujukan) as jnr, sum(a.hidup) as jhidup, sum(a.mati) as jmati,sum(a.dirujuk) as jrujuk, sum(a.dirawat_4hari) as jrawat, sum(a.total_sc) as jtotal from rl33 a  where koders=\'' . $koders . '\'' );
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes, sum(a.nonrujukan) as jnr, sum(a.hidup) as jhidup, sum(a.mati) as jmati,sum(a.dirujuk) as jrujuk, sum(a.dirawat_4hari) as jrawat, sum(a.total_sc) as jtotal from rl33 a  where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6' );
							$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes, sum(a.nonrujukan) as jnr, sum(a.hidup) as jhidup, sum(a.mati) as jmati,sum(a.dirujuk) as jrujuk, sum(a.dirawat_4hari) as jrawat, sum(a.total_sc) as jtotal from rl33 a  where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12' );
							$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes, sum(a.nonrujukan) as jnr, sum(a.hidup) as jhidup, sum(a.mati) as jmati,sum(a.dirujuk) as jrujuk, sum(a.dirawat_4hari) as jrawat, sum(a.total_sc) as jtotal from rl33 a  where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12' );
						
						}
						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 and tahun=\'' . $tahun . '\'' );
								$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes, sum(a.nonrujukan) as jnr, sum(a.hidup) as jhidup, sum(a.mati) as jmati,sum(a.dirujuk) as jrujuk, sum(a.dirawat_4hari) as jrawat, sum(a.total_sc) as jtotal from rl33 a where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 and tahun=\'' . $tahun . '\'' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 and tahun=\'' . $tahun . '\'' );
								$sql3 = mysql_query( '' . 'select sum(a.rs) as jrs,sum(a.pkm) as jpkm, sum(a.bidan) as jbidan, sum(a.faskes_lain) as jfaskes, sum(a.nonrujukan) as jnr, sum(a.hidup) as jhidup, sum(a.mati) as jmati,sum(a.dirujuk) as jrujuk, sum(a.dirawat_4hari) as jrawat, sum(a.total_sc) as jtotal from rl33 a where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 and tahun=\'' . $tahun . '\'' );
							
							}
							
						}
					}
				}
			}

			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$total_m = $rs + $pkm + $bidan + $faskes_lain + $nonkes + $nonrujukan;
				$total_k = $hidup + $mati + $dirujuk;
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
	<td style=\'border:1px solid grey;\'>' . $nonrujukan . '</td>
		<td style=\'border:1px solid grey;\'>' . $total_m . '</td>
	<td style=\'border:1px solid grey;\'>' . $hidup . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati . '</td>
	<td style=\'border:1px solid grey;\'>' . $dirujuk . '</td>
		<td style=\'border:1px solid grey;\'>' . $total_k . '</td>
	<td style=\'border:1px solid grey;\'>' . $dirawat_4hari . '</td>
	<td style=\'border:1px solid grey;\'>' . $total_sc . '</td>
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl323&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'
		</a>&nbsp;<a href=\'rm/hapus_rl323.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			$r2 = mysql_fetch_array( $sql3 );
			extract( $r2 );
				$jtotal_m = $jrs + $jpkm + $jbidan + $jfaskes + $jnonkes + $jnr;
				$jtotal_k = $jhidup + $jmati + $jrujuk;

	echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'colspan=2 >Total Semester '. $smstr.' Tahun '.$tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $jrs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jpkm . '</td>	
	<td style=\'border:1px solid grey;\'>' . $jbidan . '</td>
	<td style=\'border:1px solid grey;\'>' . $jfaskes . '</td>
	<td style=\'border:1px solid grey;\'>' . $jnr . '</td>
	<td style=\'border:1px solid grey;\'>' . $jtotal_m . '</td>
	<td style=\'border:1px solid grey;\'>' . $jhidup . '</td>
	<td style=\'border:1px solid grey;\'>' . $jmati . '</td>
	<td style=\'border:1px solid grey;\'>' . $jrujuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $jtotal_k . '</td>
	<td style=\'border:1px solid grey;\'>' . $jrawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $jtotal . '</td>
	<td style=\'border:1px solid grey;\' colspan=4>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl323') {
			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6' );
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12' );
						}
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 1 and bulan <= 6 and tahun=\'' . $tahun . '\'' );
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.koders,a.code_list,a.rs,a.pkm,a.bidan,a.faskes_lain,a.nonrujukan,a.hidup,a.mati,a.dirujuk,a.dirawat_4hari,a.total_sc,a.bulan,a.tahun,b.description from rl33 a left join m_rl323 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan >= 7 and bulan <= 12 and tahun=\'' . $tahun . '\'' );
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
				$data->addChild( 'nonrujukan', $nonrujukan );
				$data->addChild( 'p_hidup', $hidup );
				$data->addChild( 'p_mati', $mati );
				$data->addChild( 'p_dirujuk', $dirujuk );
				$data->addChild( 'dirawat_4hari', $dirawat_4hari );
				$data->addChild( 'total_sc', $total_sc );
				$data->addChild( 'bulan', $bulan );
				$data->addChild( 'semester', $smstr );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( '../xml/rl323_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl323_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
	}