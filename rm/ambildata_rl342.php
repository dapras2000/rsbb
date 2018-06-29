<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );


if ($reqdata  == 'save_rl343') {
			
			$sql = mysql_query( '' . 'select * from rl343 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and bulan=\'' . $bln . '\'' );
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				
				$sql_u = mysql_query( '' . 'Update rl343 set isk_infeksi=\'' . $inf1 . '\', ' . ( '' . 'isk_kateter=\'' . $jumlah1 . '\', ido_infeksi=\'' . $inf2 . '\', ido_operasi=\'' . $jumlah2 . '\', dkb_infeksi=\'' . $inf3 . '\', ' ) . ( '' . 'dkb_tirah=\'' . $jumlah3 . '\',phb_infeksi=\'' . $inf4 . '\',phb_infus=\'' . $jumlah4 . '\',hap_infeksi=\'' . $inf5 . '\',hap_rawat=\'' . $jumlah5 . '\', ' ) . ( '' . 'iad_infeksi=\'' . $inf6 . '\',iad_kvs=\'' . $jumlah6 . '\',vap_infeksi=\'' . $inf7 . '\',vap_jumlah=\'' . $jumlah7 . '\' ' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and bulan=\'' . $bln . '\'' ) );
				echo 'Update Data Berhasil Dilakukan';
			} 
else {
				
				$sql_u = mysql_query( 'INSERT INTO rl343(code_list,koders,isk_infeksi,isk_kateter,ido_infeksi,ido_operasi,dkb_infeksi,dkb_tirah,phb_infeksi,phb_infus,hap_infeksi,hap_rawat,iad_infeksi,vap_infeksi,vap_jumlah,iad_kvs,bulan,tahun,tgl_update) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $inf1 . '\',\'' . $jumlah1 . '\',\'' . $inf2 . '\',\'' . $jumlah2 . '\',\'' . $inf3 . '\',\'' . $jumlah3 . '\',\'' . $inf4 . '\',\'' . $jumlah4 . '\',\'' . $inf5 . '\',\'' . $jumlah5 . '\',\'' . $inf6 . '\',\'' . $jumlah6 . '\',\'' . $inf7 . '\',\'' . $jumlah7 . '\',\'' . $bln . '\',\'' . $tahun . '\',\'' . $tgl . '\')' ) );
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=\'2\' style=\'border:1px solid grey;\'>ISK</th><th colspan=\'2\' style=\'border:1px solid grey;\'>IDO</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Dekubitus</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Phlebitis</th><th colspan=\'2\' style=\'border:1px solid grey;\'>VAP</th><th colspan=\'2\' style=\'border:1px solid grey;\'>HAP</th><th colspan=\'2\' style=\'border:1px solid grey;\'>IAD</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>infeksi Nosokomial</th><th style=\'border:1px solid grey;\'>Jml. Hari Pemakaian Kateter Urine</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Pasien Operasi</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th><th style=\'border:1px solid grey;\'>Lama Hari Rawat Pasien Tirah</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Lama Pemakain Infus</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th><th style=\'border:1px solid grey;\'>Jml. Hari Pemakaian Ventilator</th>
		<th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Lama Hari Rawat</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Hari Pemakaian Kateter Vena Sentral</th>
		</tr>';
			
			$sql2 = mysql_query( '' . 'select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.iad_infeksi,a.iad_kvs,a.vap_infeksi,a.vap_jumlah,b.description,a.bulan from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and bulan=\'' . $bln . '\' order by a.code_list Asc' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				$j_nosokomial = $isk_infeksi & $ido_infeksi & $dkb_infeksi & $phb_infeksi & $hap_infeksi & $iad_infeksi & $vap_infeksi;
				
				$jumlah_nosokomial = number_format( $j_nosokomial );
				switch ($bulan) {
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
	<td style=\'border:1px solid grey;\'>' . $isk_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $isk_kateter . '</td>
	<td style=\'border:1px solid grey;\'>' . $ido_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $ido_operasi . '</td>
	<td style=\'border:1px solid grey;\'>' . $dkb_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $dkb_tirah . '</td>
	<td style=\'border:1px solid grey;\'>' . $phb_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $phb_infus . '</td>
	<td style=\'border:1px solid grey;\'>' . $vap_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $vap_jumlah . '</td>
	<td style=\'border:1px solid grey;\'>' . $hap_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $hap_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $iad_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $iad_kvs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah_nosokomial . '</td>
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl342&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '#\'>
			<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>&nbsp;
		<a href=\'rm/hapus_rl342.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '\'>
			<img src=\'img/icon_delete.gif\' border=0>
		</a>
	</td>
	';
				echo '</tr>';
			}

			
			$sql3 = mysql_query( '' . 'select sum(a.isk_infeksi) as infeksi1,sum(a.isk_kateter) as jumlah1,sum(a.ido_infeksi) as infeksi2,sum(a.ido_operasi) as jumlah2,sum(a.dkb_infeksi) as infeksi3,sum(a.dkb_tirah) as jumlah3,sum(a.phb_infeksi) as infeksi4,sum(a.phb_infus) as jumlah4,sum(a.hap_infeksi) as infeksi5,sum(a.hap_rawat) as jumlah5,sum(a.iad_infeksi) as infeksi6,sum(a.iad_kvs) as jumlah6,sum(a.vap_infeksi) as infeksi7,sum(a.vap_jumlah) as jumlah7 from rl343 a where koders=\'' . $koders . '\' and bulan=\'' . $bln . '\'' );
			
			$r3 = mysql_fetch_array( $sql3 );
			extract( $r3 );
			$j_bln = $infeksi1 + $infeksi2 + $infeksi3 + $infeksi4 + $infeksi5 + $infeksi6 + $infeksi7;
			
			$jumlah_bln = number_format( $j_bln );
			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Bulan ' . $buln . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi3 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah3 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi4 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah4 . '</td>
<td style=\'border:1px solid grey;\'>' . $infeksi7 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah7 . '</td>
		<td style=\'border:1px solid grey;\'>' . $infeksi5 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah5 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi6 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah6 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah_bln . '</td>
		<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'cari_rl343') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th><th colspan=\'2\' style=\'border:1px solid grey;\'>ISK</th><th colspan=\'2\' style=\'border:1px solid grey;\'>IDO</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Dekubitus</th><th colspan=\'2\' style=\'border:1px solid grey;\'>Phlebitis</th><th colspan=\'2\' style=\'border:1px solid grey;\'>VAP</th><th colspan=\'2\' style=\'border:1px solid grey;\'>HAP</th><th colspan=\'2\' style=\'border:1px solid grey;\'>IAD</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>infeksi Nosokomial</th><th style=\'border:1px solid grey;\'>Jml. Hari Pemakaian Kateter Urine</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Pasien Operasi</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th><th style=\'border:1px solid grey;\'>Lama Hari Rawat Pasien Tirah</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Lama Pemakain Infus</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Hari Pemakaian Ventilator</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Lama Hari Rawat</th><th style=\'border:1px solid grey;\'>Infeksi Nosokomial</th>
		<th style=\'border:1px solid grey;\'>Jml. Hari Pemakaian Kateter Vena Sentral</th>
		</tr>';

			if($smtr=='1'){
				$kondisi = "bulan<='6'";
			}else{
				$kondisi = "bulan>='7'";
			}

			if (( empty( $smtr ) && empty( $tahun ) )) {
				
				$sql2 = mysql_query( '' . 'select a.tahun,a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.vap_infeksi,a.vap_jumlah,a.hap_infeksi,a.hap_rawat,a.iad_infeksi,a.iad_kvs,b.description,a.bulan from rl343 a left join m_rl341 b on b.code_list=a.code_list where a.koders=\'' . $koders . '\' order by a.code_list Asc' );
				
				$sql3 = mysql_query( '' . 'select sum(a.isk_infeksi) as infeksi1,sum(a.isk_kateter) as jumlah1,sum(a.ido_infeksi) as infeksi2,sum(a.ido_operasi) as jumlah2,sum(a.dkb_infeksi) as infeksi3,sum(a.dkb_tirah) as jumlah3,sum(a.phb_infeksi) as infeksi4,sum(a.phb_infus) as jumlah4,sum(a.hap_infeksi) as infeksi5,sum(a.hap_rawat) as jumlah5,sum(a.iad_infeksi) as infeksi6,sum(a.iad_kvs) as jumlah6,sum(a.vap_infeksi) as infeksi7,sum(a.vap_jumlah) as jumlah7 from rl343 a where koders=\'' . $koders . '\'' );
				
				$r3 = mysql_fetch_array( $sql3 );
				extract( $r3 );
				$j_bln = $infeksi1 + $infeksi2 + $infeksi3 + $infeksi4 + $infeksi5 + $infeksi6 + $infeksi7;
				
				$jumlah_bln = number_format( $j_bln );
			} 
else {
				if (( empty( $smtr ) && !empty( $tahun ) )) {
					
					$sql2 = mysql_query( '' . 'select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.vap_infeksi,a.vap_jumlah,a.iad_infeksi,a.iad_kvs,b.description,a.bulan from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					
					$sql3 = mysql_query( '' . 'select sum(a.isk_infeksi) as infeksi1,sum(a.isk_kateter) as jumlah1,sum(a.ido_infeksi) as infeksi2,sum(a.ido_operasi) as jumlah2,sum(a.dkb_infeksi) as infeksi3,sum(a.dkb_tirah) as jumlah3,sum(a.phb_infeksi) as infeksi4,sum(a.phb_infus) as jumlah4,sum(a.hap_infeksi) as infeksi5,sum(a.hap_rawat) as jumlah5,sum(a.iad_infeksi) as infeksi6,sum(a.iad_kvs) as jumlah6,sum(a.vap_infeksi) as infeksi7,sum(a.vap_jumlah) as jumlah7 from rl343 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					
					$r3 = mysql_fetch_array( $sql3 );
					extract( $r3 );
					$j_bln = $infeksi1 + $infeksi2 + $infeksi3 + $infeksi4 + $infeksi5 + $infeksi6 + $infeksi7;
					
					$jumlah_bln = number_format( $j_bln );
				} 
else {
					if (( !empty( $smtr ) && empty( $tahun ) )) {
						
						$sql2 = mysql_query("select a.tahun,a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.vap_infeksi,a.vap_jumlah,a.iad_infeksi,a.iad_kvs,b.description,a.bulan from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders='$koders' and $kondisi order by a.code_list Asc ");
						
						$sql3 = mysql_query("select sum(a.isk_infeksi) as infeksi1,sum(a.isk_kateter) as jumlah1,sum(a.ido_infeksi) as infeksi2,sum(a.ido_operasi) as jumlah2,sum(a.dkb_infeksi) as infeksi3,sum(a.dkb_tirah) as jumlah3,sum(a.phb_infeksi) as infeksi4,sum(a.phb_infus) as jumlah4,sum(a.hap_infeksi) as infeksi5,sum(a.hap_rawat) as jumlah5,sum(a.iad_infeksi) as infeksi6,sum(a.iad_kvs) as jumlah6,sum(a.vap_infeksi) as infeksi7,sum(a.vap_jumlah) as jumlah7 from rl343 a where koders='$koders' and $kondisi");
						
						$r3 = mysql_fetch_array( $sql3 );
						extract( $r3 );
						$j_bln = $infeksi1 + $infeksi2 + $infeksi3 + $infeksi4 + $infeksi5 + $infeksi6 + $infeksi7;
						
						$jumlah_bln = number_format( $j_bln );
					} 
else {
						if (( !empty( $smtr ) && !empty( $tahun ) )) {
							
							$sql2 = mysql_query("select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.vap_infeksi,a.vap_jumlah,a.iad_infeksi,a.iad_kvs,b.description,a.bulan from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders='$koders' and tahun='$tahun' and $kondisi order by a.code_list Asc ");
							
							$sql3 = mysql_query("select sum(a.isk_infeksi) as infeksi1,sum(a.isk_kateter) as jumlah1,sum(a.ido_infeksi) as infeksi2,sum(a.ido_operasi) as jumlah2,sum(a.dkb_infeksi) as infeksi3,sum(a.dkb_tirah) as jumlah3,sum(a.phb_infeksi) as infeksi4,sum(a.phb_infus) as jumlah4,sum(a.hap_infeksi) as infeksi5,sum(a.hap_rawat) as jumlah5,sum(a.iad_infeksi) as infeksi6,sum(a.iad_kvs) as jumlah6,sum(a.vap_infeksi) as infeksi7,sum(a.vap_jumlah) as jumlah7 from rl343 a where koders='$koders'  and tahun='$tahun' and $kondisi ");
							
							$r3 = mysql_fetch_array( $sql3 );
							extract( $r3 );
							$j_bln = $infeksi1 + $infeksi2 + $infeksi3 + $infeksi4 + $infeksi5 + $infeksi6 + $infeksi7;
							
							$jumlah_bln = number_format( $j_bln );
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
				$j_nosokomial = $isk_infeksi + $ido_infeksi + $dkb_infeksi + $phb_infeksi + $hap_infeksi + $iad_infeksi + $vap_infeksi;
				
				$jumlah_nosokomial = number_format( $j_nosokomial );
				switch ($bulan) {
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
	<td style=\'border:1px solid grey;\'>' . $isk_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $isk_kateter . '</td>
	<td style=\'border:1px solid grey;\'>' . $ido_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $ido_operasi . '</td>
	<td style=\'border:1px solid grey;\'>' . $dkb_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $dkb_tirah . '</td>
	<td style=\'border:1px solid grey;\'>' . $phb_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $phb_infus . '</td>
	<td style=\'border:1px solid grey;\'>' . $vap_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $vap_jumlah . '</td>	
	<td style=\'border:1px solid grey;\'>' . $hap_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $hap_rawat . '</td>
	<td style=\'border:1px solid grey;\'>' . $iad_infeksi . '</td>
	<td style=\'border:1px solid grey;\'>' . $iad_kvs . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah_nosokomial . '</td>
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
		<a href=\'index.php?link=rl342&id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '#\'>
			<img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'>
		</a>&nbsp;
		<a href=\'rm/hapus_rl342.php?id=' . $code_list . '&bln=' . $bulan . '&koders=' . $koders . '&tahun=' . $tahun . '\'>
			<img src=\'img/icon_delete.gif\' border=0>
		</a>
	</td>
	';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total ' . $semester . ' ' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah1 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah2 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi3 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah3 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi4 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah4 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi7 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah7 . '</td>		
	<td style=\'border:1px solid grey;\'>' . $infeksi5 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah5 . '</td>
	<td style=\'border:1px solid grey;\'>' . $infeksi6 . '</td>
		<td style=\'border:1px solid grey;\'>' . $jumlah6 . '</td>
	<td style=\'border:1px solid grey;\'>' . $jumlah_bln . '</td>
		<td style=\'border:1px solid grey;\' colspan=3 align=\'center\'>-</td>
	';
			echo '</tr>';
		}


		if ($reqdata  == 'xml_rl343') {

			if($smtr=='1'){
				$kondisi = "bulan<='6'";
			}else{
				$kondisi = "bulan>='7'";
			}

			if (( empty( $smtr ) && empty( $tahun ) )) {
				
				$sql2 = mysql_query( '' . 'select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.iad_infeksi,a.iad_kvs,b.description,a.bulan,vap_infeksi,vap_jumlah from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
			} 
else {
				if (( empty( $smtr ) && !empty( $tahun ) )) {
					
					$sql2 = mysql_query( '' . 'select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.iad_infeksi,a.iad_kvs,b.description,a.bulan,vap_infeksi,vap_jumlah from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
				} 
else {
					if (( !empty( $smtr ) && empty( $tahun ) )) {
						
						$sql2 = mysql_query("select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.iad_infeksi,a.iad_kvs,b.description,a.bulan,vap_infeksi,vap_jumlah from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders='$koders' and $kondisi order by a.code_list Asc ");
					} 
else {
						if (( !empty( $smtr ) && !empty( $tahun ) )) {
							
							$sql2 = mysql_query("select a.code_list,a.isk_infeksi,a.isk_kateter,a.ido_infeksi,a.ido_operasi,a.dkb_infeksi,a.dkb_tirah,a.phb_infeksi,a.phb_infus,a.hap_infeksi,a.hap_rawat,a.iad_infeksi,a.iad_kvs,b.description,a.bulan,vap_infeksi,vap_jumlah from rl343 a left join m_rl341 b on b.code_list=a.code_list where koders='$koders' and tahun='$tahun' and $kondisi order by a.code_list Asc ");
						}
					}
				}
			}

			
			
			$xml = new SimpleXMLElement ( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'isk_infeksi', $isk_infeksi );
				$data->addChild( 'isk_kateter', $isk_kateter );
				$data->addChild( 'ido_infeksi', $ido_infeksi );
				$data->addChild( 'ido_operasi', $ido_operasi );
				$data->addChild( 'dkb_infeksi', $dkb_infeksi );
				$data->addChild( 'dkb_tirah', $dkb_tirah );
				$data->addChild( 'phb_infeksi', $phb_infeksi );
				$data->addChild( 'phb_infus', $phb_infus );
				$data->addChild( 'vap_infeksi', $hap_infeksi );
				$data->addChild( 'vap_jumlah', $hap_rawat );
				$data->addChild( 'hap_infeksi', $hap_infeksi );
				$data->addChild( 'hap_rawat', $hap_rawat );
				$data->addChild( 'iad_infeksi', $iad_infeksi );
				$data->addChild( 'iad_kvs', $iad_kvs );
				$data->addChild( 'bulan', $bulan );
				$data->addChild( 'tahun', $tahun );
			}

			$fp = fopen( '../xml/rl342_' . $smtr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl342_' . $smtr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}




}