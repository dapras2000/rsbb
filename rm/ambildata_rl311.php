<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );
	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

		if ($reqdata == 'cari_rl311') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Kode</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Pengunjung</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Kunjungan</th><th colspan=\'3\' style=\'border:1px solid grey;\'>Asal Rujukan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Non Rujukan</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Rujukan</th><th colspan=\'5\' style=\'border:1px solid grey;\'>CARA BAYAR</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
	</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Baru</th><th style=\'border:1px solid grey;\'>Lama</th><th style=\'border:1px solid grey;\'>Baru</th><th style=\'border:1px solid grey;\'>Lama</th><th style=\'border:1px solid grey;\'>Rumah Sakit</th><th style=\'border:1px solid grey;\'>Puskesmas</th><th style=\'border:1px solid grey;\'>Faskes Lain</th><th style=\'border:1px solid grey;\'>Dirujuk</th><th style=\'border:1px solid grey;\'>Rujukan Balik</th>';
		$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
		while($ds = mysql_fetch_array($ss)){
		echo '<th style=\'border:1px solid grey;\'>'.$ds['NAMA'].'</th>';
		}
		echo '<th style=\'border:1px solid grey;\'>Total Cara Bayar</th>';
		'</tr>';

			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',
						
								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								JOIN m_poly p on p.kode = m.KDPoly 
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								
								group by p.nama");
				

			}else {
			if (( empty( $smstr ) && !empty( $tahun ) )) {
				$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',
						
								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								
								WHERE YEAR(m.TGLREG)='".$tahun."'
								 group by p.nama");
				
			}else {
			if (( !empty( $smstr ) && empty( $tahun ) )) {
				if ($smstr=="I"){
					$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',
						
								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '01' and '06'
								group by p.nama");

				}else if ($smstr=="II"){
					$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',
						
								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '07' and '12'
								group by p.nama");

				}
				
			}else {
			if (( !empty( $smstr ) && !empty( $tahun ) )) {
				if ($smstr=="I"){
						$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',
						
								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '01' and '06' and YEAR(m.TGLREG)='".$tahun."'
								group by p.nama");
				
				}else if ($smstr=="II"){
					$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',
						
								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama',
								SUM(if(m.PASIENBARU = '0', 1, 0)) AS pas_lama
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '07' and '12' and YEAR(m.TGLREG)='".$tahun."'
								group by p.nama");
				
						}
				
						}
					}
				}
			}

			$no = 1;
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
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
		$tot1 += $p_baru;
		$tot2 += $p_lama;
		$tot3 += $k_baru;
		$tot4 += $k_lama;
		$tot5 += $rs;
		$tot6 += $puskesmas;
		$tot7 += $faskes_lain;
		$tot8 += $nonrujukan;
		$tot9 += $dirujuk;
		$tot10 += $rujukbalik;
		$tot11 += $jkn;
		$tot12 += $jamkesda;
		$tot13 += $jamswasta;
		$tot14 += $umum;
		$total = $jkn + $jamkesda + $jamswasta + $umum;
		$jmltot += $total;
			
				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $no++ . '</td>
	<td style=\'border:1px solid grey;\'>' . $nama . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_baru . '</td>
	<td style=\'border:1px solid grey;\'>' . $p_lama . '</td>
	<td style=\'border:1px solid grey;\'>' . $k_baru . '</td>
	<td style=\'border:1px solid grey;\'>' . $k_lama . '</td>	
	<td style=\'border:1px solid grey;\'>' . $rs . '</td>
	<td style=\'border:1px solid grey;\'>' . $puskesmas . '</td>
	<td style=\'border:1px solid grey;\'>' . $faskes_lain . '</td>
	<td style=\'border:1px solid grey;\'>' . $nonrujukan . '</td>
	<td style=\'border:1px solid grey;\'>' . $dirujuk . '</td>
	<td style=\'border:1px solid grey;\'>' . $rujukbalik . '</td>
	<td style=\'border:1px solid grey;\'>'.$umum.'</td>
	<td style=\'border:1px solid grey;\'>'.$jkn.'</td>
	<td style=\'border:1px solid grey;\'>'.$jamkesda.'</td>
	<td style=\'border:1px solid grey;\'>'.$jamswasta.'</td>
	

	<td style=\'border:1px solid grey;\'>'.$total.'</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	
	';
				echo '</tr>';
			}
		
			$sql1 = mysql_query("SELECT SUM(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'kbaru',
								SUM(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'klama'
								FROM t_diagnosadanterapi d
								JOIN t_pendaftaran p on p.KDPOLY = d.KDPOLY ");
			while ($s = mysql_fetch_array( $sql1 )) {
				extract( $s );
				$baru = $s['kbaru'];
				$lama = $s['klama'];
			}

		
			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'colspan=2 >Total : </td>
	<td style=\'border:1px solid grey;\'>' . $tot1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot3 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot4 . '</td>	
	<td style=\'border:1px solid grey;\'>' . $tot5 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot6 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot7 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot8 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot9 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot10 . '</td>
	
	<td style=\'border:1px solid grey;\'>' . $tot14 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot11 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot12 . '</td>
	<td style=\'border:1px solid grey;\'>' . $tot13 . '</td>
	

	<td style=\'border:1px solid grey;\'>'.$jmltot.' </td>
	<td style=\'border:1px solid grey;\' colspan=2></td>
	';
			echo '</tr>';
			echo '</table>';
		}
		

		if ($reqdata == 'xml_rl311') {
			if (( empty( $smstr ) && empty( $tahun ) )) {
				$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',

								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								JOIN m_poly p on p.kode = m.KDPoly 
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								
								group by p.nama");
			}else {
			if (( empty( $smstr ) && !empty( $tahun ) )) {
				$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',

								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								
								WHERE YEAR(m.TGLREG)='".$tahun."'
								 group by p.nama");
			}else {
			if (( !empty( $smstr ) && empty( $tahun ) )) {
				if ($smstr=="I"){
					$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',

								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '01' and '06'
								group by p.nama");

				}else if ($smstr=="II"){
					$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',

								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '07' and '12'
								group by p.nama");

				}
			}else {
			if (( !empty( $smstr ) && !empty( $tahun ) )) {
				if ($smstr=="I"){
						$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',

								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama'
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '01' and '06' and YEAR(m.TGLREG)='".$tahun."'
								group by p.nama");
				
				}else if ($smstr=="II"){
					$sql2 = mysql_query("SELECT p.nama, COUNT(IF(m.PASIENBARU='0',1, NULL)) 'p_lama',
								COUNT(IF(m.PASIENBARU='1',1, NULL)) 'p_baru',
								COUNT(IF(m.KDRUJUK='2',1, NULL)) 'rs',
								COUNT(IF(m.KDRUJUK='3',1, NULL)) 'puskesmas',
								COUNT(IF(m.KDRUJUK='4',1, NULL)) 'faskes_lain',
								COUNT(IF(m.STATUS='6',1, NULL)) 'dirujuk',
								COUNT(IF(m.MINTA_RUJUKAN='1',1, NULL)) 'rujukbalik',
								COUNT(IF(m.KDCARABAYAR='5',1, NULL)) 'jkn',
								COUNT(IF(m.KDCARABAYAR='9',1, NULL)) 'jamkesda',
								COUNT(IF(m.KDCARABAYAR='6',1, NULL)) 'jamswasta',
								COUNT(IF(m.KDCARABAYAR='1',1, NULL)) 'umum',

								COUNT(IF(m.KDRUJUK='1',1, NULL)) 'nonrujukan',
								COUNT(IF(d.KUNJUNGAN_BL='1',1, NULL)) 'k_baru',
								COUNT(IF(d.KUNJUNGAN_BL='0',1, NULL)) 'k_lama',
								SUM(if(m.PASIENBARU = '0', 1, 0)) AS pas_lama
								FROM t_pendaftaran m
								LEFT JOIN m_poly p on p.kode = m.KDPoly
								LEFT JOIN t_diagnosadanterapi d on d.KDPOLY = m.KDPOLY
								WHERE DATE_FORMAT (m.TGLREG, '%m') BETWEEN '07' and '12' and YEAR(m.TGLREG)='".$tahun."'
								group by p.nama");
				
						}
					}
				}
			}
		}

			
			$xml = new SimpleXMLElement ( '<xml/>' );
			$no = 1;
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $no++ );
				$data->addChild( 'pengunjung_baru', $p_baru );
				$data->addChild( 'pengunjung_lama', $p_lama );
				$data->addChild( 'kunjungan_baru', $k_baru );
				$data->addChild( 'kunjungan_lama', $k_lama );
				$data->addChild( 'rs', $rs );
				$data->addChild( 'puskesmas', $puskesmas );
				$data->addChild( 'faskes_lain', $faskes_lain );
				$data->addChild( 'nonrujukan', $nonrujukan );
				$data->addChild( 'dirujuk', $dirujuk );
				$data->addChild( 'rujuk_balik', $rujukbalik );
				$data->addChild( 'umum', $umum );
				$data->addChild( 'bpjs', $jkn );
				$data->addChild( 'jamkesda', $jamkesda );
				$data->addChild( 'lain', $jamswasta );
				$data->addChild( 'bulan', $smstr );
				$data->addChild( 'tahun', $tahun );
			}

			$fp = fopen( '../xml/rl311_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl311_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
	}