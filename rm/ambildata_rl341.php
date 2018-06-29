<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

	if ($reqdata  == 'masuk') {
			echo 'OK';
		}


if ($reqdata  == 'save_rl341') {
			$sql = mysql_query( '' . 'select * from rl341 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' );
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				$sql_u = mysql_query( '' . 'Update rl341 set p_awal=\'' . $p_awal . '\', ' . ( '' . 'p_masuk=\'' . $p_masuk . '\', pkh=\'' . $pkh . '\', pkm_k48=\'' . $pkm_k48 . '\', pkm_l48=\'' . $pkm_l48 . '\', ' ) . ( '' . 'p_akhir=\'' . $p_akhir . '\',lama_rawat=\'' . $lama_rawat . '\',hari_rawat=\'' . $hari_rawat . '\',p_beresiko=\'' . $p_beresiko . '\',p_jatuh=\'' . $p_jatuh . '\',tt=\'' . $tt . '\', ' ) . ( '' . 'rm=\'' . $rm . '\',j_hari=\'' . $j_hari . '\',umum=\'' . $umum . '\',bpjs=\'' . $bpjs . '\',jamkesda=\'' . $jamkesda . '\',lain=\'' . $lain . '\' ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' ) );
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				$sql_u = mysql_query( 'INSERT INTO rl341(code_list,koders,p_awal,p_masuk,pkh,pkm_k48,pkm_l48,p_akhir,lama_rawat,hari_rawat,p_beresiko,p_jatuh,tt,rm,j_hari,umum,bpjs,jamkesda,lain,smt,tahun,tgl_update) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $p_awal . '\',\'' . $p_masuk . '\',\'' . $pkh . '\',\'' . $pkm_k48 . '\',\'' . $pkm_l48 . '\',\'' . $p_akhir . '\',\'' . $lama_rawat . '\',\'' . $hari_rawat . '\',\'' . $p_beresiko . '\',\'' . $p_jatuh . '\',\'' . $tt . '\',\'' . $rm . '\',\'' . $j_hari . '\',\'' . $umum . '\',\'' . $bpjs . '\',\'' . $jamkesda . '\',\'' . $lain . '\',\'' . $bln . '\',\'' . $tahunsave . '\',\'' . $tgl . '\')' ) );
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Awal</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Masuk</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Keluar Hidup</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Pasien Keluar Mati</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Akhir</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Lama Dirawat</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Hari Perawatan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Beresiko Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tempat Tidur</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pengembalian RM 1x24 Jam</th>
		<th colspan=\'7\' style=\'border:1px solid grey;\'>Indikator</th>
		<th colspan=\'5\' style=\'border:1px solid grey;\'>Cara Bayar</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'> <48 </th>
		<th style=\'border:1px solid grey;\'> >=48 </th>
		<th style=\'border:1px solid grey;\'>BOR</th>
		<th style=\'border:1px solid grey;\'>ALOS</th>
		<th style=\'border:1px solid grey;\'>NDR</th>
		<th style=\'border:1px solid grey;\'>GDR</th>
		<th style=\'border:1px solid grey;\'>BTO</th>
		<th style=\'border:1px solid grey;\'>TOI</th>
		<th style=\'border:1px solid grey;\'>% Pasien Jatuh</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'>BPJS</th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain-Lain</th>
		<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>
		</tr>';
			$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt=\'' . $bln . '\' order by a.code_list Asc' );
		
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$bor = round( $hari_rawat / ( $tt + $j_hari ) + 100, 2 );
				$alos = round( $lama_rawat / ( $pkh + $pkm_k48 + $pkm_l48 ), 2 );
				$ndr = round( $pkm_l48 / ( $pkh + $pkm_k48 + $pkm_l48 ), 2 );
				$gdr = round( ( $pkm_k48 + $pkm_l48 ) / ( $pkh + $pkm_k48 + $pkm_l48 ) + 1000, 2 );
				$bto = round( ( $pkh + $pkm_k48 + $pkm_l48 ) / $tt, 2 );
				$toi = round( ( $tt + $j_hari - $hari_rawat ) / ( $pkh + $pkm_k48 + $pkm_l48 ), 2 );
				$persen_jatuh = round( $p_jatuh / ( $p_awal + $p_masuk ) + 100, 2 );
				$t_carabayar = $umum + $bpjs + $jamkesda + $lain ;

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
	<td style=\'border:1px solid grey;\'>' . $p_awal . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_masuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkh . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm_k48 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm_l48 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_akhir . '</td>
	<td style=\'border:1px solid grey;\'>' . $lama_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $hari_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_beresiko . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $tt . '</td>
	<td style=\'border:1px solid grey;\'>' . $rm . '</td>
	<td style=\'border:1px solid grey;\'>' . $bor . '</td>
	<td style=\'border:1px solid grey;\'>' . $alos . '</td>
	<td style=\'border:1px solid grey;\'>' . $ndr . '</td>
	<td style=\'border:1px solid grey;\'>' . $gdr . '</td>
	<td style=\'border:1px solid grey;\'>' . $bto . '</td>
	<td style=\'border:1px solid grey;\'>' . $toi . '</td>
	<td style=\'border:1px solid grey;\'>' . $persen_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $bpjs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_carabayar . '</td>	
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahunsave . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl341&id=' . $code_list . '&bln=' . $bln . '&koders=' . $koders . '&tahun=' . $tahunsave . '\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
			</a>&nbsp;<a href=\'rm/hapus_rl341.php?id=' . $code_list . '&bln=' . $bln . '&koders=' . $koders . '&tahun=' . $tahunsave . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1,sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl341 a where koders=\'' . $koders . '\' and smt=\'' . $bln . '\'' );
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			
			$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
			$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
			$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
			$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
			$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
			$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
			$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
			$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Bulan ' . $buln . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_awal1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_masuk1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkh1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_akhir1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $lama1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $hari1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_beresiko1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jatuh1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tt1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $rm1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $bor_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $alos_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $ndr_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $gdr_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $bto_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $toi_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $persen_jatuh_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $bpjs_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $lain_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_carabayar_a . '</td>	
	<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'cari_rl341') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Awal</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Masuk</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Keluar Hidup</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Pasien Keluar Mati</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Akhir</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Lama Dirawat</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Hari Perawatan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Beresiko Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tempat Tidur</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pengembalian RM 1x24 Jam</th>
		<th colspan=\'7\' style=\'border:1px solid grey;\'>Indikator</th>
		<th colspan=\'5\' style=\'border:1px solid grey;\'>Cara Bayar</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'> <48 </th>
		<th style=\'border:1px solid grey;\'> >=48 </th>
		<th style=\'border:1px solid grey;\'>BOR</th>
		<th style=\'border:1px solid grey;\'>ALOS</th>
		<th style=\'border:1px solid grey;\'>NDR</th>
		<th style=\'border:1px solid grey;\'>GDR</th>
		<th style=\'border:1px solid grey;\'>BTO</th>
		<th style=\'border:1px solid grey;\'>TOI</th>
		<th style=\'border:1px solid grey;\'>% Pasien Jatuh</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'>BPJS</th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain-Lain</th>
		<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>
		</tr>';

			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt,a.tahun, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list,a.smt Asc' );
				$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1,sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a  from rl341 a where a.koders=\'' . $koders . '\'' );
				$r3 = mysql_fetch_array( $sql3 );
				extract( $r3 );
				
				$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
				$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
				$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
				$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
				$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
				$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
				$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
				$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list,a.smt Asc' );
					$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1, sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl341 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );
					
					$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
					$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
					$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
					$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
					$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
					$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
					$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
					$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {

						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt,a.tahun, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list,a.smt Asc' );
							$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1, sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl341 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 ' );
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
							
							$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
							$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
							$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
							$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
							$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
							$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
							$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
							$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
					
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt,a.tahun, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list,a.smt Asc' );
							$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1, sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl341 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12' );
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
							
							$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
							$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
							$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
							$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
							$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
							$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
							$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
							$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
					
						}


						} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list,a.smt Asc' );
								$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1, sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl341 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 and tahun=\'' . $tahun . '\'' );
								$r3 = mysql_fetch_array( $sql3 );
								extract( $r3 );
								
								$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
								$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
								$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
								$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
								$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
								$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
								$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
								$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
						
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list,a.smt Asc' );
								$sql3 = mysql_query( '' . 'select j_hari, sum(a.p_beresiko) as p_beresiko1, sum(a.p_awal) as p_awal1,sum(a.p_masuk) as p_masuk1,sum(a.pkh) as pkh1,sum(a.pkm_k48) as pkm1,sum(a.pkm_l48) as pkm2,sum(a.p_akhir) as p_akhir1,sum(a.lama_rawat) as lama1,sum(a.hari_rawat) as hari1,sum(a.p_jatuh) as jatuh1,sum(a.tt) as tt1,sum(a.rm) as rm1, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl341 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 and tahun=\'' . $tahun . '\'' );
								$r3 = mysql_fetch_array( $sql3 );
								extract( $r3 );
								
								$bor_a = round( $hari1 / ( $tt1 + $j_hari ) + 100, 2 );
								$alos_a = round( $lama1 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
								$ndr_a = round( $pkm2 / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
								$gdr_a = round( ( $pkm1 + $pkm2 ) / ( $pkh1 + $pkm1 + $pkm2 ) + 1000, 2 );
								$bto_a = round( ( $pkh1 + $pkm1 + $pkm2 ) / $tt1, 2 );
								$toi_a = round( ( $tt1 + $j_hari - $hari1 ) / ( $pkh1 + $pkm1 + $pkm2 ), 2 );
								$persen_jatuh_a = round( $jatuh1 / ( $p_awal1 + $p_masuk1 ) + 100, 2 );
								$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
						
							}
							}
					}
				}
			}

			
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$bor = round( $hari_rawat / ( $tt + $j_hari ) + 100, 2 );
				$alos = round( $lama_rawat / ( $pkh + $pkm_k48 + $pkm_l48 ), 2 );
				$ndr = round( $pkm_l48 / ( $pkh + $pkm_k48 + $pkm_l48 ), 2 );
				$gdr = round( ( $pkm_k48 + $pkm_l48 ) / ( $pkh + $pkm_k48 + $pkm_l48 ) + 1000, 2 );
				$bto = round( ( $pkh + $pkm_k48 + $pkm_l48 ) / $tt, 2 );
				$toi = round( ( $tt + $j_hari - $hari_rawat ) / ( $pkh + $pkm_k48 + $pkm_l48 ), 2 );
				$persen_jatuh = round( $p_jatuh / ( $p_awal + $p_masuk ) + 100, 2 );
				$t_carabayar = $umum + $bpjs + $jamkesda + $lain ;
				
				switch ($smstr) {
					case 'I': {
						$semester = 'Semester I';
						break;
					}
					case 'II': {
						$semester = 'Semester II';
						break;
					}
				}

				switch ($smt) {
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
	<td style=\'border:1px solid grey;\'>' . $p_awal . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_masuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkh . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm_k48 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm_l48 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_akhir . '</td>
	<td style=\'border:1px solid grey;\'>' . $lama_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $hari_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_beresiko . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $tt . '</td>
	<td style=\'border:1px solid grey;\'>' . $rm . '</td>
	<td style=\'border:1px solid grey;\'>' . $bor . '</td>
	<td style=\'border:1px solid grey;\'>' . $alos . '</td>
	<td style=\'border:1px solid grey;\'>' . $ndr . '</td>
	<td style=\'border:1px solid grey;\'>' . $gdr . '</td>
	<td style=\'border:1px solid grey;\'>' . $bto . '</td>
	<td style=\'border:1px solid grey;\'>' . $toi . '</td>
	<td style=\'border:1px solid grey;\'>' . $persen_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $bpjs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_carabayar . '</td>	
	<td style=\'border:1px solid grey;\'>' . $bln . '</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl341&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
		<a href=\'rm/hapus_rl341.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total ' . $semester . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_awal1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_masuk1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkh1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pkm2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_akhir1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $lama1 . '</td>
		<td style=\'border:1px solid grey;\'>' . $hari1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_beresiko1 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jatuh1 . '</td>
		<td style=\'border:1px solid grey;\'>' . $tt1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $rm1 . '</td>
			<td style=\'border:1px solid grey;\'>' . $bor_a . '</td>
		<td style=\'border:1px solid grey;\'>' . $alos_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $ndr_a . '</td>
			<td style=\'border:1px solid grey;\'>' . $gdr_a . '</td>
			<td style=\'border:1px solid grey;\'>' . $bto_a . '</td>
		<td style=\'border:1px solid grey;\'>' . $toi_a . '</td>
		<td style=\'border:1px solid grey;\'>' . $persen_jatuh_a . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum_a . '</td>
			<td style=\'border:1px solid grey;\'>' . $bpjs_a . '</td>
			<td style=\'border:1px solid grey;\'>' . $jamkesda_a . '</td>
		<td style=\'border:1px solid grey;\'>' . $lain_a . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_carabayar_a . '</td>		
		<td style=\'border:1px solid grey;\' colspan=4 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl341') {
			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
						
						}

						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko,a.code_list,a.p_awal,a.p_masuk,a.pkh,a.pkm_k48,a.pkm_l48,a.p_akhir,a.lama_rawat,a.hari_rawat,a.p_jatuh,a.tt,a.rm,a.j_hari,b.description,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl341 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							
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
				$data->addChild( 'pasien_awal', $p_awal );
				$data->addChild( 'pasien_masuk', $p_masuk );
				$data->addChild( 'pasien_keluar_hidup', $pkh );
				$data->addChild( 'pasien_keluar_mati_k48', $pkm_k48 );
				$data->addChild( 'pasien_keluar_mati_l48', $pkm_l48 );
				$data->addChild( 'pasien_akhir', $p_akhir );
				$data->addChild( 'jumlah_lama_rawat', $lama_rawat );
				$data->addChild( 'jumlah_hari_perawatan', $hari_rawat );
				$data->addChild( 'pasien_beresiko_jatuh', $p_beresiko );
				$data->addChild( 'pasien_jatuh', $p_jatuh );
				$data->addChild( 'jumlah_tt', $tt );
				$data->addChild( 'rm_24jam', $rm );
				$data->addChild( 'jumlah_hari', $j_hari );
				$data->addChild( 'umum', $umum );
				$data->addChild( 'bpjs', $bpjs );
				$data->addChild( 'jamkesda', $jamkesda );
				$data->addChild( 'lain', $lain );
				$data->addChild( 'bulan', $smt );
				$data->addChild( 'Semester', $smstr );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( '../xml/rl341_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl341_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
}
