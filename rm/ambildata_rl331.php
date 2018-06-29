<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

	if ($reqdata  == 'masuk') {
			echo 'OK';
		}

		if ($reqdata  == 'save_rl331') {
			$sql = mysql_query( '' . 'select * from rl331 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' );
			
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				$sql_u = mysql_query( '' . 'Update rl331 set pasien_awal=\'' . $pasien_awal . '\', ' . ( '' . 'pasien_masuk=\'' . $pasien_masuk . '\', pasien_keluar_hidup=\'' . $pasien_keluar_hidup . '\', pasien_keluar_mati_k48=\'' . $pkm_k48 . '\', pasien_keluar_mati_l48=\'' . $pkm_l48 . '\', ' ) . ( '' . 'lama_dirawat=\'' . $lama_dirawat . '\', spvip=\'' . $spvip . '\', vip=\'' . $vip . '\', ' ) . ( '' . 'I=\'' . $i . '\', II=\'' . $ii . '\', III=\'' . $iii . '\', kelas_khusus=\'' . $kelas_khusus . '\', ' ) . ( '' . 'pasien_jatuh=\'' . $pasien_jatuh . '\', p_beresiko_jatuh=\'' . $p_beresiko . '\', jumlah_tt=\'' . $jumlah_tt . '\', pengembalian_rm=\'' . $pengembalian_rm . '\', kelas_khusus=\'' . $kelas_khusus . '\', j_hari=\'' . $hari . '\',umum=\'' . $umum . '\',bpjs=\'' . $bpjs . '\',jamkesda=\'' . $jamkesda . '\',lain=\'' . $lain . '\'  ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' ) );
				
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				$sql_u = mysql_query( 'INSERT INTO rl331(code_list,koders,pasien_awal,pasien_masuk,pasien_keluar_hidup,pasien_keluar_mati_k48,pasien_keluar_mati_l48,lama_dirawat,spvip,vip,I,II,III,kelas_khusus,p_beresiko_jatuh,pasien_jatuh,jumlah_tt,pengembalian_rm,umum,bpjs,jamkesda,lain,smt,tahun,tgl_update,j_hari) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $pasien_awal . '\',\'' . $pasien_masuk . '\',\'' . $pasien_keluar_hidup . '\',\'' . $pkm_k48 . '\',\'' . $pkm_l48 . '\',\'' . $lama_dirawat . '\',\'' . $spvip . '\',\'' . $vip . '\',\'' . $i . '\',\'' . $ii . '\',\'' . $iii . '\',\'' . $kelas_khusus . '\',\'' . $p_beresiko . '\',\'' . $pasien_jatuh . '\',\'' . $jumlah_tt . '\',\'' . $pengembalian_rm . '\',\'' . $umum . '\',\'' . $bpjs . '\',\'' . $jamkesda . '\',\'' . $lain . '\',\'' . $bln . '\',\'' . $tahunsave . '\',\'' . $tgl . '\',\'' . $hari . '\')' ) );
				
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
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>J. Lama Dirawat</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>J. Hari Perawatan</th>
		<th colspan=\'6\' style=\'border:1px solid grey;\'>Rincian Hari Perawatan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Beresiko Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah TT</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pengembalian RM 1x24 Jam</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>BOR</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>ALOS</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>NDR</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>GDR</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>BTO</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>TOI</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>%Pasien jatuh</th>
		<th colspan=\'5\' style=\'border:1px solid grey;\'>Cara Bayar</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>< 48 Jam</th>
		<th style=\'border:1px solid grey;\'>>= 48 Jam</th>
		<th style=\'border:1px solid grey;\'>Super VIP</th>
		<th style=\'border:1px solid grey;\'>VIP</th>
		<th style=\'border:1px solid grey;\'>I</th>
		<th style=\'border:1px solid grey;\'>II</th>
		<th style=\'border:1px solid grey;\'>III</th>
		<th style=\'border:1px solid grey;\'>Kelas Khusus</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'>BPJS</th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain-Lain</th>
		<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>
		</tr>';
			$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
			
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$p_akhir = $pasien_awal + $pasien_masuk - ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 );
				$j_hari_perawatan = $spvip + $vip + $I + $II + $III + $kelas_khusus;
				$bor = round( $j_hari_perawatan / ( $jumlah_tt + $j_hari ) + 100, 2 );
				$alos = round( $lama_dirawat / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ), 2 );
				$ndr = round( $pasien_keluar_mati_l48 / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ) + 1000, 2 );
				$gdr = round( ( $pasien_keluar_mati_l48 + $pasien_keluar_mati_k48 ) / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ) + 1000, 2 );
				$bto = round( ( $pasien_keluar_mati_l48 + $pasien_keluar_mati_k48 + $pasien_keluar_hidup ) / $jumlah_tt, 2 );
				$toi = round( ( $jumlah_tt + $j_hari - $j_hari_perawatan ) / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ), 2 );
				$p_jatuh = round( $pasien_jatuh / $p_beresiko_jatuh + 100, 2 );
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
	<td style=\'border:1px solid grey;\'>' . $nama_unit . '</td>
	<td style=\'border:1px solid grey;\'>' . $pasien_awal . '</td>
	<td style=\'border:1px solid grey;\'>' . $pasien_masuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $pasien_keluar_hidup . '</td>
	<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_k48 . '</td>
	<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_l48 . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_akhir . '</td>
	<td style=\'border:1px solid grey;\'>' . $lama_dirawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_hari_perawatan . '</td>
		<td style=\'border:1px solid grey;\'>' . $spvip . '</td>
	<td style=\'border:1px solid grey;\'>' . $vip . '</td>
	<td style=\'border:1px solid grey;\'>' . $I . '</td>
	<td style=\'border:1px solid grey;\'>' . $II . '</td>
	<td style=\'border:1px solid grey;\'>' . $III . '</td>
	<td style=\'border:1px solid grey;\'>' . $kelas_khusus . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_beresiko_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $pasien_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah_tt . '</td>
	<td style=\'border:1px solid grey;\'>' . $pengembalian_rm . '</td>
	<td style=\'border:1px solid grey;\'>' . $bor . '</td>
	<td style=\'border:1px solid grey;\'>' . $alos . '</td>
	<td style=\'border:1px solid grey;\'>' . $ndr . '</td>
	<td style=\'border:1px solid grey;\'>' . $gdr . '</td>
	<td style=\'border:1px solid grey;\'>' . $bto . '</td>
	<td style=\'border:1px solid grey;\'>' . $toi . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_jatuh . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $bpjs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_carabayar . '</td>
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahunsave . '</td>
	<td style=\'border:1px solid grey;\'>
				<a href=\'index.php?link=rl331&id' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
				<a href=\'rm/hapus_rl331.php?id=' . $kode_unit . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahunsave . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}
			$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1,sum(a.j_hari) as j_hari1,sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1,sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1,sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\'' );
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			
				$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
				$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
				$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
				$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
				$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
				$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
				$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
				$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
				$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
				$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;

			echo '' . '<tr class=\'tr_s\'>
				<td style=\'border:1px solid grey;\' colspan=2>Total Bulan ' . $buln . ' ' . $tahun . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_awal1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_masuk1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_keluar_hidup1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_k481 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_l481 . '</td>
				<td style=\'border:1px solid grey;\'>' . $p_akhir1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $lama_dirawat1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $j_hari_perawatan1 . '</td>
					<td style=\'border:1px solid grey;\'>' . $spvip1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $vip1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $I1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $II1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $III1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $kelas_khusus1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $p_beresiko_jatuh1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_jatuh1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $jumlah_tt1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pengembalian_rm1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $bor1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $alos1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $ndr1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $gdr1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $bto1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $toi1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $p_jatuh1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $umum1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $bpjs1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $jamkesda1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $lain1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $t_carabayar1 . '</td>	
				<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
				';
				echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'cari_rl331') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Awal</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Masuk</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Keluar Hidup</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Pasien Keluar Mati</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Akhir</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>J. Lama Dirawat</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>J. Hari Perawatan</th>
		<th colspan=\'6\' style=\'border:1px solid grey;\'>Rincian Hari Perawatan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Beresiko Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pasien Jatuh</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jumlah TT</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Pengembalian RM 1x24 Jam</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>BOR</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>ALOS</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>NDR</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>GDR</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>BTO</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>TOI</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>%Pasien jatuh</th>
		<th colspan=\'5\' style=\'border:1px solid grey;\'>Cara Bayar</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>< 48 Jam</th>
		<th style=\'border:1px solid grey;\'>>= 48 Jam</th>
		<th style=\'border:1px solid grey;\'>Super VIP</th>
		<th style=\'border:1px solid grey;\'>VIP</th>
		<th style=\'border:1px solid grey;\'>I</th>
		<th style=\'border:1px solid grey;\'>II</th>
		<th style=\'border:1px solid grey;\'>III</th>
		<th style=\'border:1px solid grey;\'>Kelas Khusus</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'>BPJS</th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain-Lain</th>
		<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>
		</tr>';

			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn,a.umum, a.bpjs, a.jamkesda, a.lain  from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1, sum(a.j_hari) as j_hari1, sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1, sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1, sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\' order by a.code_list Asc' );
				$r3 = mysql_fetch_array( $sql3 );
				extract( $r3 );
			
				$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
				$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
				$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
				$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
				$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
				$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
				$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
				$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
				$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
				$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1, sum(a.j_hari) as j_hari1, sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1, sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1, sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );
				
					$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
					$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
					$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
					$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
					$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
					$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
					$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
					$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
					$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
					$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1, sum(a.j_hari) as j_hari1, sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1, sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1, sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
						
							$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
							$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
							$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
							$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
							$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
							$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
							$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
							$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
							$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
							$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1, sum(a.j_hari) as j_hari1, sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1, sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1, sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
						
							$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
							$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
							$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
							$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
							$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
							$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
							$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
							$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
							$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
							$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;
						}
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
								$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1, sum(a.j_hari) as j_hari1, sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1, sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1, sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
								$r3 = mysql_fetch_array( $sql3 );
								extract( $r3 );
							
								$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
								$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
								$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
								$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
								$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
								$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
								$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
								$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
								$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
								$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
								$sql3 = mysql_query( '' . 'select sum(a.p_beresiko_jatuh) as p_beresiko_jatuh1, sum(a.j_hari) as j_hari1, sum(a.pasien_awal) as pasien_awal1,
										sum(a.pasien_masuk) as pasien_masuk1, sum(a.pasien_keluar_hidup) as pasien_keluar_hidup1, sum(a.pasien_keluar_mati_k48) as pasien_keluar_mati_k481,
										sum(a.pasien_keluar_mati_l48) as pasien_keluar_mati_l481,sum(a.lama_dirawat) as lama_dirawat1,sum(a.spvip) as spvip1,
										sum(a.vip) as vip1,sum(a.I) as I1,sum(a.II) as II1,
										sum(a.III) as III1,sum(a.kelas_khusus) as kelas_khusus1,sum(a.pasien_jatuh) as pasien_jatuh1,
										sum(a.jumlah_tt) as jumlah_tt1,sum(a.pengembalian_rm) as pengembalian_rm1,
										sum(a.umum) as umum1, sum(a.bpjs) as bpjs1, sum(a.jamkesda) as jamkesda1, sum(a.lain) as lain1
										from rl331 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
								$r3 = mysql_fetch_array( $sql3 );
								extract( $r3 );
							
								$p_akhir1 = $pasien_awal1 + $pasien_masuk1 - ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 );
								$j_hari_perawatan1 = $spvip1 + $vip1 + $I1 + $II1 + $III1 + $kelas_khusus1;
								$bor1 = round( $j_hari_perawatan1 / ( $jumlah_tt1 + $j_hari1 ) + 100, 2 );
								$alos1 = round( $lama_dirawat1 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
								$ndr1 = round( $pasien_keluar_mati_l481 / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
								$gdr1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ) + 1000, 2 );
								$bto1 = round( ( $pasien_keluar_mati_l481 + $pasien_keluar_mati_k481 + $pasien_keluar_hidup1 ) / $jumlah_tt1, 2 );
								$toi1 = round( ( $jumlah_tt1 + $j_hari1 - $j_hari_perawatan1 ) / ( $pasien_keluar_hidup1 + $pasien_keluar_mati_k481 + $pasien_keluar_mati_l481 ), 2 );
								$p_jatuh1 = round( $pasien_jatuh1 / $p_beresiko_jatuh1 + 100, 2 );
								$t_carabayar1 = $umum1 + $bpjs1 + $jamkesda1 + $lain1;
							}
						}
					}
				}
			}

			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$p_akhir = $pasien_awal + $pasien_masuk - ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 );
				$j_hari_perawatan = $spvip + $vip + $I + $II + $III + $kelas_khusus;
				$bor = round( $j_hari_perawatan / ( $jumlah_tt + $j_hari ) + 100, 2 );
				
				$alos = round( $lama_dirawat / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ), 2 );
				
				$ndr = round( $pasien_keluar_mati_l48 / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ) + 1000, 2 );
				
				$gdr = round( ( $pasien_keluar_mati_l48 + $pasien_keluar_mati_k48 ) / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ) + 1000, 2 );
				
				$bto = round( ( $pasien_keluar_mati_l48 + $pasien_keluar_mati_k48 + $pasien_keluar_hidup ) / $jumlah_tt, 2 );
				
				$toi = round( ( $jumlah_tt + $j_hari - $j_hari_perawatan ) / ( $pasien_keluar_hidup + $pasien_keluar_mati_k48 + $pasien_keluar_mati_l48 ), 2 );
				
				$p_jatuh = round( $pasien_jatuh / $p_beresiko_jatuh + 100, 2 );
				$t_carabayar = $umum + $bpjs + $jamkesda + $lain ;
				
				switch ($smt) {
					case '1': {
						$buln = 'Januari';
						$smstr = 'I';
						break;
					}

					case '2': {
						$buln = 'Februari';
						$smstr = 'I';
						break;
					}

					case '3': {
						$buln = 'Maret';
						$smstr = 'I';
						break;
					}

					case '4': {
						$buln = 'April';
						$smstr = 'I';
						break;
					}

					case '5': {
						$buln = 'Mei';
						$smstr = 'I';
						break;
					}

					case '6': {
						$buln = 'Juni';
						$smstr = 'I';
						break;
					}

					case '7': {
						$buln = 'Juli';
						$smstr = 'II';
						break;
					}

					case '8': {
						$buln = 'Agustus';
						$smstr = 'II';
						break;
					}

					case '9': {
						$buln = 'September';
						$smstr = 'II';
						break;
					}

					case '10': {
						$buln = 'Oktober';
						$smstr = 'II';
						break;
					}

					case '11': {
						$buln = 'Nopember';
						$smstr = 'II';
						break;
					}

					case '12': {
						$buln = 'Desember';
						$smstr = 'II';
					}
				}

				echo '' . '<tr class=\'tr_s\'>
							<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
							<td style=\'border:1px solid grey;\'>' . $nama_unit . '</td>
							<td style=\'border:1px solid grey;\'>' . $pasien_awal . '</td>
							<td style=\'border:1px solid grey;\'>' . $pasien_masuk . '</td>
							<td style=\'border:1px solid grey;\'>' . $pasien_keluar_hidup . '</td>
							<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_k48 . '</td>
							<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_l48 . '</td>
							<td style=\'border:1px solid grey;\'>' . $p_akhir . '</td>
							<td style=\'border:1px solid grey;\'>' . $lama_dirawat . '</td>
							<td style=\'border:1px solid grey;\'>' . $j_hari_perawatan . '</td>
							<td style=\'border:1px solid grey;\'>' . $spvip . '</td>
							<td style=\'border:1px solid grey;\'>' . $vip . '</td>
							<td style=\'border:1px solid grey;\'>' . $I . '</td>
							<td style=\'border:1px solid grey;\'>' . $II . '</td>
							<td style=\'border:1px solid grey;\'>' . $III . '</td>
							<td style=\'border:1px solid grey;\'>' . $kelas_khusus . '</td>
							<td style=\'border:1px solid grey;\'>' . $p_beresiko_jatuh . '</td>
							<td style=\'border:1px solid grey;\'>' . $pasien_jatuh . '</td>
							<td style=\'border:1px solid grey;\'>' . $jumlah_tt . '</td>
							<td style=\'border:1px solid grey;\'>' . $pengembalian_rm . '</td>
							<td style=\'border:1px solid grey;\'>' . $bor . '</td>
							<td style=\'border:1px solid grey;\'>' . $alos . '</td>
							<td style=\'border:1px solid grey;\'>' . $ndr . '</td>
							<td style=\'border:1px solid grey;\'>' . $gdr . '</td>
							<td style=\'border:1px solid grey;\'>' . $bto . '</td>
							<td style=\'border:1px solid grey;\'>' . $toi . '</td>
							<td style=\'border:1px solid grey;\'>' . $p_jatuh . '</td>
							<td style=\'border:1px solid grey;\'>' . $umum . '</td>
							<td style=\'border:1px solid grey;\'>' . $bpjs . '</td>
							<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
							<td style=\'border:1px solid grey;\'>' . $lain . '</td>
							<td style=\'border:1px solid grey;\'>' . $t_carabayar . '</td>	
							<td style=\'border:1px solid grey;\'>' . $buln . '</td>
							<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
							<td style=\'border:1px solid grey;\'>' . $thn . '</td>
							<td style=\'border:1px solid grey;\'>
								<a href=\'index.php?link=rl331&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $thn . '#\'>
								<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
								<a href=\'rm/hapus_rl331.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $thn . '\'>
								<img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}
			echo '' . '<tr class=\'tr_s\'>
				<td style=\'border:1px solid grey;\' colspan=2>Total Semester ' . $smstr . ' ' . $tahun . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_awal1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_masuk1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_keluar_hidup1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_k481 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_keluar_mati_l481 . '</td>
				<td style=\'border:1px solid grey;\'>' . $p_akhir1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $lama_dirawat1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $j_hari_perawatan1 . '</td>
					<td style=\'border:1px solid grey;\'>' . $spvip1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $vip1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $I1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $II1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $III1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $kelas_khusus1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $p_beresiko_jatuh1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pasien_jatuh1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $jumlah_tt1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $pengembalian_rm1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $bor1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $alos1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $ndr1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $gdr1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $bto1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $toi1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $p_jatuh1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $umum1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $bpjs1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $jamkesda1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $lain1 . '</td>
				<td style=\'border:1px solid grey;\'>' . $t_carabayar1 . '</td>	
				<td style=\'border:1px solid grey;\' colspan=4 align=\'center\'>-</td>
				';
				echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl331') {
			if (( empty( $bln ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				
			} else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh,a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
				} else {
					if (( !empty( $bln ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh, a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh, a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
						
						}
						
					} else {
						if (( !empty( $bln ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh, a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.p_beresiko_jatuh, a.j_hari,a.code_list,a.pasien_awal,a.pasien_masuk,a.pasien_keluar_hidup,a.pasien_keluar_mati_k48,a.pasien_keluar_mati_l48,a.lama_dirawat,a.spvip,a.vip,a.I,a.II,a.III,a.kelas_khusus,a.pasien_jatuh,a.jumlah_tt,a.pengembalian_rm,b.nama_unit,a.smt,a.tahun as thn, a.umum, a.bpjs, a.jamkesda, a.lain from rl331 a left join m_unit b on b.kode_unit=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							
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
				$data->addChild( 'pasien_awal', $pasien_awal );
				$data->addChild( 'pasien_masuk', $pasien_masuk );
				$data->addChild( 'pasien_keluar_hidup', $pasien_keluar_hidup );
				$data->addChild( 'pkm_k24', $pasien_keluar_mati_k48 );
				$data->addChild( 'pkm_l24', $pasien_keluar_mati_l48 );
				$data->addChild( 'lama_dirawat', $lama_dirawat );
				$data->addChild( 'super_vip', $spvip );
				$data->addChild( 'vip', $vip );
				$data->addChild( 'kelas_1', $I );
				$data->addChild( 'kelas_2', $II );
				$data->addChild( 'kelas_3', $III );
				$data->addChild( 'kelas_khusus', $kelas_khusus );
				$data->addChild( 'pasien_jatuh', $p_beresiko_jatuh );
				$data->addChild( 'pasien_jatuh', $pasien_jatuh );
				$data->addChild( 'jumlah_tt', $jumlah_tt );
				$data->addChild( 'pengembalian_rm', $pengembalian_rm );
				$data->addChild( 'j_hari', $j_hari );
				$data->addChild( 'umum', $umum );
				$data->addChild( 'bpjs', $bpjs );
				$data->addChild( 'jamkesda', $jamkesda );
				$data->addChild( 'lain', $lain );
				$data->addChild( 'smt', $smt );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( '../xml/rl331_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl331_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
}