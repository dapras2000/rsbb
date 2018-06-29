<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

	if ($reqdata  == 'masuk') {
			echo 'OK';
		}

if ($reqdata  == 'save_rl351') {
			$sql = mysql_query( '' . 'select * from rl351 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' );
			
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				$sql_u = mysql_query( '' . 'Update rl351 set j_meja=\'' . $j_meja . '\', ' . ( '' . 'j_tindakan_cito=\'' . $j_tindakan_cito . '\', j_pasien_cito=\'' . $j_pasien_cito . '\', j_mati_cito=\'' . $j_mati_cito . '\', j_tindakan_sel=\'' . $j_tindakan_sel . '\', ' ) . ( '' . 'j_pasien_sel=\'' . $j_pasien_sel . '\',podr_sel=\'' . $podr_sel . '\',rata_rawat=\'' . $rata_rawat . '\',j_tunda_operasi=\'' . $j_tunda_operasi . '\',j_pasien_pasca=\'' . $j_pasien_pasca . '\', ' ) . ( '' . 'profilaksis_30=\'' . $profilaksis_30 . '\',profilaksis_jumlah=\'' . $profilaksis_jumlah . '\',podr1=\'' . $podr1 . '\',dot1=\'' . $dot1 . '\',umum=\'' . $umum . '\',bpjs=\'' . $bpjs . '\',jamkesda=\'' . $jamkesda . '\',lain=\'' . $lain . '\' ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' ) );
				
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				$sql_u = mysql_query( 'INSERT INTO rl351(code_list,koders,j_tindakan_cito,j_pasien_cito,j_mati_cito,j_tindakan_sel,j_pasien_sel,podr_sel,rata_rawat,j_tunda_operasi,j_pasien_pasca,profilaksis_30,profilaksis_jumlah,podr1,dot1,j_meja,umum,bpjs,jamkesda,lain,smt,tahun,tgl_update) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $j_tindakan_cito . '\',\'' . $j_pasien_cito . '\',\'' . $j_mati_cito . '\',\'' . $j_tindakan_sel . '\',\'' . $j_pasien_sel . '\',\'' . $podr_sel . '\',\'' . $rata_rawat . '\',\'' . $j_tunda_operasi . '\',\'' . $j_pasien_pasca . '\',\'' . $profilaksis_30 . '\',\'' . $profilaksis_jumlah . '\',\'' . $podr1 . '\',\'' . $dot1 . '\',\'' . $j_meja . '\',\'' . $umum . '\',\'' . $bpjs . '\',\'' . $jamkesda . '\',\'' . $lain . '\',\'' . $bln . '\',\'' . $tahunsave . '\',\'' . $tgl . '\')' ) );
				
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Spesialisasi</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Meja Operasi</th>
		<th colspan=\'16\' style=\'border:1px solid grey;\'>Kegiatan Pembedahan</th>
		<th colspan=\'5\' rowspan=\'2\' style=\'border:1px solid grey;\'>Cara Bayar</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>-</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\' colspan=4>Operasi CITO</th>
		<th style=\'border:1px solid grey;\' colspan=6>Operasi Selektif</th>
		<th style=\'border:1px solid grey;\' rowspan=2>JUMLAH PASIEN DENGAN KETIDAKSESUAIAN DIAGNOSIS PRA DAN PASCA OPERASI</th>
		<th style=\'border:1px solid grey;\' colspan=2>JUMLAH PEMBERIAN AB PROFILAKSIS PADA OPERASI BERSIH</th><th style=\'border:1px solid grey;\' colspan=3>TOTAL</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Jumlah Tindakan</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (Death on Table)</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (PODR)</th>
		<th style=\'border:1px solid grey;\'>Jumlah Tindakan</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (Death on Table)</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (PODR)</th>
		<th style=\'border:1px solid grey;\'>Rata2 Lama Dirawat Sebelum Operasi</th>
		<th style=\'border:1px solid grey;\'>Jumlah Penundaan Operasi</th>
		<th style=\'border:1px solid grey;\'>30 Menit- 1 Jam Sebelum Operasi</th>
		<th style=\'border:1px solid grey;\'>Jumlah Total Operasi Bersih</th>
		<th style=\'border:1px solid grey;\'>Jumlah Tindakan</th>
		
		<th style=\'border:1px solid grey;\'>Jumlah Pasien</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'>BPJS</th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain-Lain</th>
		<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>
		</tr>
		';
			$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and smt=\'' . $bln . '\' and tahun=\'' . $tahunsave . '\' order by a.code_list Asc' );
			
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$j_tindakan = number_format( $j_tindakan_cito + $j_tindakan_sel );
				
				$j_pasien = number_format( $j_pasien_cito + $j_pasien_sel );
				
				$j_mati = number_format( $j_mati_cito + $podr_sel );
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
						$buln = 'November';
						break;
					}

					case '12': {
						$buln = 'Desember';
					}
				}

				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
	<td style=\'border:1px solid grey;\'>' . $nama . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_meja . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tindakan_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_mati_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $podr1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tindakan_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $dot1 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $podr_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $rata_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tunda_operasi . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien_pasca . '</td>
	<td style=\'border:1px solid grey;\'>' . $profilaksis_30 . '</td>
	<td style=\'border:1px solid grey;\'>' . $profilaksis_jumlah . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tindakan . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_mati . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $bpjs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_carabayar . '</td>	
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahunsave . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl351&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahunsave . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
		<a href=\'rm/hapus_rl351.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahunsave . '#\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\' and smt=\'' . $bln . '\'' );
			
			
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			
			$t_tindakan = number_format( $t_cito + $t_sel );
			
			$t_pasien = number_format( $p_cito + $p_sel );
			
			$t_mati = number_format( $m_cito + $podr );
			$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Semester ' . $smstr . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $m_cito . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_podr1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_dot1 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $podr . '</td>
	<td style=\'border:1px solid grey;\'>' . $rata . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_operasi . '</td>
<td style=\'border:1px solid grey;\'>' . $p_pasca . '</td>
		<td style=\'border:1px solid grey;\'>' . $p_30 . '</td>
		<td style=\'border:1px solid grey;\'>' . $p_jumlah . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_tindakan . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_pasien . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_mati . '</td>
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


		if ($reqdata  == 'cari_rl351') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>No</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Spesialisasi</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Jumlah Meja Operasi</th>
		<th colspan=\'16\' style=\'border:1px solid grey;\'>Kegiatan Pembedahan</th>
		<th colspan=\'5\' rowspan=\'2\' style=\'border:1px solid grey;\'>Cara bayar</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'3\' style=\'border:1px solid grey;\'>-</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\' colspan=4>Operasi CITO</th>
		<th style=\'border:1px solid grey;\' colspan=6>Operasi Selektif</th>
		<th style=\'border:1px solid grey;\' rowspan=2>JUMLAH PASIEN DENGAN KETIDAKSESUAIAN DIAGNOSIS PRA DAN PASCA OPERASI</th>
		<th style=\'border:1px solid grey;\' colspan=2>JUMLAH PEMBERIAN AB PROFILAKSIS PADA OPERASI BERSIH</th>
		<th style=\'border:1px solid grey;\' colspan=3>TOTAL</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Jumlah Tindakan</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (Death on Table)</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (PODR)</th>
		<th style=\'border:1px solid grey;\'>Jumlah Tindakan</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien</th>
<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (Death on Table)</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal (PODR)</th>
		<th style=\'border:1px solid grey;\'>Rata2 Lama Dirawat Sebelum Operasi</th>
		<th style=\'border:1px solid grey;\'>Jumlah Penundaan Operasi</th>
		<th style=\'border:1px solid grey;\'>30 Menit- 1 Jam Sebelum Operasi</th>
		<th style=\'border:1px solid grey;\'>Jumlah Total Operasi Bersih</th>
		<th style=\'border:1px solid grey;\'>Jumlah Tindakan</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien</th>
		<th style=\'border:1px solid grey;\'>Jumlah Pasien Meninggal</th>
		<th style=\'border:1px solid grey;\'>Umum</th>
		<th style=\'border:1px solid grey;\'>BPJS</th>
		<th style=\'border:1px solid grey;\'>Jamkesda</th>
		<th style=\'border:1px solid grey;\'>Lain-Lain</th>
		<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>
		</tr>
		';

			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.tahun,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where a.koders=\'' . $koders . '\' order by a.code_list Asc' );
				
				$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\'' );
				
				
				$r3 = mysql_fetch_array( $sql3 );
				extract( $r3 );
				
				$t_tindakan = number_format( $t_cito + $t_sel );
				
				$t_pasien = number_format( $p_cito + $p_sel );
				
				$t_mati = number_format( $m_cito + $podr );
				$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
					$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja,sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					
					
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );
					
					$t_tindakan = number_format( $t_cito + $t_sel );
					
					$t_pasien = number_format( $p_cito + $p_sel );
					
					$t_mati = number_format( $m_cito + $podr );
					$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.tahun,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
						
							$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja,sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6' );
							
							
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
							
							$t_tindakan = number_format( $t_cito + $t_sel );
							
							$t_pasien = number_format( $p_cito + $p_sel );
							
							$t_mati = number_format( $m_cito + $podr );
							$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.tahun,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
						
							$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja,sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12' );
							
							
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
							
							$t_tindakan = number_format( $t_cito + $t_sel );
							
							$t_pasien = number_format( $p_cito + $p_sel );
							
							$t_mati = number_format( $m_cito + $podr );
							$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
						}

						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where a.koders=\'' . $koders . '\' and a.tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							
								$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 and tahun=\'' . $tahun . '\'' );
								
								
								$r3 = mysql_fetch_array( $sql3 );
								extract( $r3 );
								
								$t_tindakan = number_format( $t_cito + $t_sel );
								
								$t_pasien = number_format( $p_cito + $p_sel );
								
								$t_mati = number_format( $m_cito + $podr );
								$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where a.koders=\'' . $koders . '\' and a.tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							
								$sql3 = mysql_query( '' . 'select sum(a.podr1) as t_podr1,sum(a.dot1) as t_dot1,sum(a.j_tindakan_cito) as t_cito,sum(a.j_pasien_cito) as p_cito,sum(a.j_mati_cito) as m_cito,sum(a.j_tindakan_sel) as t_sel,sum(a.j_pasien_sel) as p_sel,sum(a.podr_sel) as podr,sum(a.rata_rawat) as rata,sum(a.j_tunda_operasi) as t_operasi,sum(a.j_pasien_pasca) as p_pasca,sum(a.profilaksis_30) as p_30,sum(a.profilaksis_jumlah) p_jumlah,sum(a.j_meja) as meja, sum(a.umum) as umum_a, sum(a.bpjs) as bpjs_a, sum(a.jamkesda) as jamkesda_a, sum(a.lain) as lain_a from rl351 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 and tahun=\'' . $tahun . '\'' );
								
								
								$r3 = mysql_fetch_array( $sql3 );
								extract( $r3 );
								
								$t_tindakan = number_format( $t_cito + $t_sel );
								
								$t_pasien = number_format( $p_cito + $p_sel );
								
								$t_mati = number_format( $m_cito + $podr );
								$t_carabayar_a = $umum_a + $bpjs_a + $jamkesda_a + $lain_a;
							}

							
						}
					}
				}
			}

			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$j_tindakan = number_format( $j_tindakan_cito + $j_tindakan_sel );
				
				$j_pasien = number_format( $j_pasien_cito + $j_pasien_sel );
				
				$j_mati = number_format( $j_mati_cito + $podr_sel );
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
						$buln = 'November';
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
	<td style=\'border:1px solid grey;\'>' . $nama . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_meja . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tindakan_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_mati_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $podr1 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $j_tindakan_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $dot1 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $podr_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $rata_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tunda_operasi . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien_pasca . '</td>
	<td style=\'border:1px solid grey;\'>' . $profilaksis_30 . '</td>
	<td style=\'border:1px solid grey;\'>' . $profilaksis_jumlah . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_tindakan . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_pasien . '</td>
	<td style=\'border:1px solid grey;\'>' . $j_mati . '</td>
	<td style=\'border:1px solid grey;\'>' . $umum . '</td>
	<td style=\'border:1px solid grey;\'>' . $bpjs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jamkesda . '</td>
	<td style=\'border:1px solid grey;\'>' . $lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_carabayar . '</td>
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl351&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
		<a href=\'rm/hapus_rl351.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Semester ' . $smstr . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $meja . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $m_cito . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_podr1 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $t_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_sel . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_dot1 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $podr . '</td>
	<td style=\'border:1px solid grey;\'>' . $rata . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_operasi . '</td>
<td style=\'border:1px solid grey;\'>' . $p_pasca . '</td>
		<td style=\'border:1px solid grey;\'>' . $p_30 . '</td>
		<td style=\'border:1px solid grey;\'>' . $p_jumlah . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_tindakan . '</td>
	<td style=\'border:1px solid grey;\'>' . $t_pasien . '</td>
		<td style=\'border:1px solid grey;\'>' . $t_mati . '</td>
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


		if ($reqdata  == 'xml_rl351') {
			if (( empty( $bln ) && empty( $tahun ) )) {
				$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				
			} 
else {
				if (( empty( $bln ) && !empty( $tahun ) )) {
					$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
				} 
else {
					if (( !empty( $bln ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
						
						}
						
					} 
else {
						if (( !empty( $bln ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.podr1,a.dot1,a.code_list,a.j_tindakan_cito,a.j_pasien_cito,a.j_mati_cito,a.j_tindakan_sel,a.j_pasien_sel,a.podr_sel,a.rata_rawat,a.j_tunda_operasi,a.j_pasien_pasca,a.profilaksis_30,a.profilaksis_jumlah,a.j_meja,b.nama,a.smt, a.umum, a.bpjs, a.jamkesda, a.lain from rl351 a left join m_poly b on b.kode=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							
							}
							
						}
					}
				}
			}

			
			
			$xml = new SimpleXMLElement ( '<xml/>' );
			
			while ($r = mysql_fetch_array( $sql2 ) ) {
				extract( $r );
				
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'j_meja', $j_meja );
				$data->addChild( 'j_tindakan_cito', $j_tindakan_cito );
				$data->addChild( 'j_pasien_cito', $j_pasien_cito );
				$data->addChild( 'dot_cito', $j_mati_cito );
				$data->addChild( 'podr_cito', $podr1 );
				$data->addChild( 'j_tindakan_selektif', $j_tindakan_sel );
				$data->addChild( 'j_pasien_selektif', $j_pasien_sel );
				$data->addChild( 'dot_sel', $dot1 );
				$data->addChild( 'podr_sel', $podr_sel );
				$data->addChild( 'rata2_rawat', $rata_rawat );
				$data->addChild( 'j_tunda_operasi', $j_tunda_operasi );
				$data->addChild( 'pasien_pasca_operasi', $j_pasien_pasca );
				$data->addChild( 'profilaksis_30_1jam', $profilaksis_30 );
				$data->addChild( 'profilaksis_jumlah', $profilaksis_jumlah );
				$data->addChild( 'umum', $umum );
				$data->addChild( 'bpjs', $bpjs );
				$data->addChild( 'jamkesda', $jamkesda );
				$data->addChild( 'lain', $lain );
				$data->addChild( 'bulan', $smt );
				$data->addChild( 'Semester', $smstr );
				$data->addChild( 'tahun', $tahun );
			}

			
			
			$fp = fopen( '../xml/rl351_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl351_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
	}