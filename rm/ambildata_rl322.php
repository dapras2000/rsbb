
<?php
echo'<script>
$(document).ready(function(){
    $("button").click(function(){
        $("button").dblclick();
    });
});
</script>';

	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );
	//include( 'lib/function.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );

	if ($reqdata  == 'masuk') {
			echo 'OK';
		}

if ($reqdata == 'save_rl322') {
			$sql = mysql_query( '' . 'select * from rl322 where code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' );
			
			
			$row = mysql_num_rows( $sql );

			if (1 <= $row) {
				$sql_u = mysql_query( '' . 'update rl322 set kasus_l=\'' . $kasus_l . '\',kasus_p=\'' . $kasus_p . '\', luka_l=\'' . $luka_l . '\',luka_p=\'' . $luka_p . '\', doa_l=\'' . $doa_l . '\', ' . ( '' . 'doa_p=\'' . $doa_p . '\', mati_l=\'' . $mati_l . '\', mati_p=\'' . $mati_p . '\',' ) . ( '' . 'tglupdate=\'' . $tgl . '\'' ) . ( '' . 'WHERE code_list=\'' . $pelayanan . '\' and koders=\'' . $koders . '\' and tahun=\'' . $tahunsave . '\' and smt=\'' . $bln . '\'' ) );
				
				echo 'Update Data Berhasil Dilakukan';
			} else {
				$sql_u = mysql_query( 'INSERT INTO rl322(code_list,koders,kasus_l,kasus_p,luka_l,luka_p,doa_l,doa_p,mati_l,mati_p,smt,tahun,tglupdate) ' . ( '' . 'VALUES(\'' . $pelayanan . '\',\'' . $koders . '\',\'' . $kasus_l . '\',\'' . $kasus_p . '\',\'' . $luka_l . '\',\'' . $luka_p . '\',\'' . $doa_l . '\',\'' . $doa_p . '\',\'' . $mati_l . '\',\'' . $mati_p . '\',\'' . $bln . '\',\'' . $tahunsave . '\',\'' . $tgl . '\')' ) );
				
				echo 'Penyimpanan Data Berhasil Dilakukan';
			}

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Kode</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Luka-Luka</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>D O A</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Meninggal di RS</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Kasus</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		</tr>
		';
			$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where a.koders=\'' . $koders . '\'' );
			
			

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

				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $code_list . '</td>
	<td style=\'border:1px solid grey;\'>' . $description . '</td>
	<td style=\'border:1px solid grey;\'>' . $luka_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $luka_p . '</td>	
	<td style=\'border:1px solid grey;\'>' . $doa_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $doa_p . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_p . '</td>
	<td style=\'border:1px solid grey;\'>' . $kasus_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $kasus_p . '</td>	
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahunsave . '</td>
	<td style=\'border:1px solid grey;\'><a href=\'index.php?link=rl322?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahunsave . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\'></a>&nbsp;
			<a href=\'rm/hapus_rl322.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahunsave . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			echo '</table>';
		}


		if ($reqdata  == 'cari_rl322') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Kode</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Luka-Luka</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>D O A</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Meninggal di RS</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Jumlah Kasus</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Bulan</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Koreksi</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		<th style=\'border:1px solid grey;\'>L</th><th style=\'border:1px solid grey;\'>P</th>
		</tr>
		';


			
			if (( empty( $smstr ) && empty( $tahun ) )) {

				$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' ' );
				
				$sql3 = mysql_query( '' . 'select sum(a.kasus_l) as jkasusl,sum(a.kasus_p) as jkasusp,sum(a.luka_l) as jlukal,sum(a.luka_p) as jlukap,sum(a.doa_l) as jdoal,sum(a.doa_p)jdoap,sum(a.mati_l) as jmatil,sum(a.mati_p) as jmatip from rl322 a where a.koders=\'' . $koders . '\'' );
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$sql2 =mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					
					$sql3 = mysql_query( '' . 'select sum(a.kasus_l) as jkasusl,sum(a.kasus_p) as jkasusp,sum(a.luka_l) as jlukal,sum(a.luka_p) as jlukap,sum(a.doa_l) as jdoal,sum(a.doa_p)jdoap,sum(a.mati_l) as jmatil,sum(a.mati_p) as jmatip from rl322 a where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\'' );
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if ($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 ' );
						
							$sql3 = mysql_query( '' . 'select sum(a.kasus_l) as jkasusl,sum(a.kasus_p) as jkasusp,sum(a.luka_l) as jlukal,sum(a.luka_p) as jlukap,sum(a.doa_l) as jdoal,sum(a.doa_p)jdoap,sum(a.mati_l) as jmatil,sum(a.mati_p) as jmatip from rl322 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6' );
						
						}else if ($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 ' );
						
							$sql3 = mysql_query( '' . 'select sum(a.kasus_l) as jkasusl,sum(a.kasus_p) as jkasusp,sum(a.luka_l) as jlukal,sum(a.luka_p) as jlukap,sum(a.doa_l) as jdoal,sum(a.doa_p)jdoap,sum(a.mati_l) as jmatil,sum(a.mati_p) as jmatip from rl322 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 ' );
						}
						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if ($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6  and tahun=\'' . $tahun . '\'' );
							
								$sql3 = mysql_query( '' . 'select sum(a.kasus_l) as jkasusl,sum(a.kasus_p) as jkasusp,sum(a.luka_l) as jlukal,sum(a.luka_p) as jlukap,sum(a.doa_l) as jdoal,sum(a.doa_p)jdoap,sum(a.mati_l) as jmatil,sum(a.mati_p) as jmatip from rl322 a where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6  and tahun=\'' . $tahun . '\'' );
							
							}else if ($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12  and tahun=\'' . $tahun . '\'' );
							
								$sql3 = mysql_query( '' . 'select sum(a.kasus_l) as jkasusl,sum(a.kasus_p) as jkasusp,sum(a.luka_l) as jlukal,sum(a.luka_p) as jlukap,sum(a.doa_l) as jdoal,sum(a.doa_p)jdoap,sum(a.mati_l) as jmatil,sum(a.mati_p) as jmatip from rl322 a where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12  and tahun=\'' . $tahun . '\'' );
							
							}
							
						}
					}
				}
			}

			
			$r2 = mysql_fetch_array( $sql3 );
			extract( $r2 );
			

			while ($r = mysql_fetch_array( $sql2 ) ) {
				extract( $r );
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
	<td style=\'border:1px solid grey;\'>' . $description . '</td>
	<td style=\'border:1px solid grey;\'>' . $luka_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $luka_p . '</td>	
	<td style=\'border:1px solid grey;\'>' . $doa_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $doa_p . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $mati_p . '</td>
	<td style=\'border:1px solid grey;\'>' . $kasus_l . '</td>
	<td style=\'border:1px solid grey;\'>' . $kasus_p . '</td>	
	<td style=\'border:1px solid grey;\'>' . $buln . '</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $tahun . '</td>
	<td style=\'border:1px solid grey;\'>
			
			<a href=\'index.php?link=rl322&id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '#\'><img src=\'img/icon_edit_new.gif\' border=0 onclick=\'update()\' ></a>&nbsp;
			<a href=\'rm/hapus_rl322.php?id=' . $code_list . '&bln=' . $smt . '&koders=' . $koders . '&tahun=' . $tahun . '\'><img src=\'img/icon_delete.gif\' border=0></a></td>
	';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'colspan=2 >Total Semester '. $smstr.' Tahun '.$tahun . '</td>
	<td style=\'border:1px solid grey;\'>' . $jlukal . '</td>
	<td style=\'border:1px solid grey;\'>' . $jlukap . '</td>	
	<td style=\'border:1px solid grey;\'>' . $jdoal . '</td>
	<td style=\'border:1px solid grey;\'>' . $jdoap . '</td>
	<td style=\'border:1px solid grey;\'>' . $jmatil . '</td>
	<td style=\'border:1px solid grey;\'>' . $jmatip . '</td>
	<td style=\'border:1px solid grey;\'>' . $jkasusl . '</td>
	<td style=\'border:1px solid grey;\'>' . $jkasusp . '</td>
	<td style=\'border:1px solid grey;\' colspan=4>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl322') {
			if (( empty( $smstr ) && empty( $tahun ) )) {
				if ($smstr=="I"){
					$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				}else if($smstr=="II"){
					$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' order by a.code_list Asc' );
				}
				
			} 
else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					if($smstr=="I"){
						$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					}else if($smstr=="II"){
						$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' order by a.code_list Asc' );
					}
					
				} 
else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						if($smstr=="I"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
						}else if($smstr=="II"){
							$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
						}
						
					} 
else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							if($smstr=="I"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 1 and smt <= 6 order by a.code_list Asc' );
							}else if($smstr=="II"){
								$sql2 = mysql_query( '' . 'select a.code_list,a.kasus_l,a.kasus_p,a.luka_l,a.luka_p,a.doa_l,a.doa_p,a.mati_l,a.mati_p,a.smt,a.tahun,b.description from rl322 a left join m_rl322 b on b.code_list=a.code_list where koders=\'' . $koders . '\' and tahun=\'' . $tahun . '\' and smt >= 7 and smt <= 12 order by a.code_list Asc' );
							}
							
						}
					}
				}
			}

			
			
			$xml = new SimpleXMLElement( '<xml/>' );
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $code_list );
				$data->addChild( 'description', $description );
				$data->addChild( 'luka_L', $luka_l );
				$data->addChild( 'luka_P', $luka_p );
				$data->addChild( 'doa_L', $doa_l );
				$data->addChild( 'doa_P', $doa_p );
				$data->addChild( 'meninggal_L', $mati_l );
				$data->addChild( 'meninggal_P', $mati_p );
				$data->addChild( 'jumlah_kasus_L', $kasus_l );
				$data->addChild( 'jumlah_kasus_P', $kasus_p );
				$data->addChild( 'smt', $smt );
				$data->addChild( 'tahun', $tahun );
			}

			
			$fp = fopen( '../xml/rl322_' . $smstr . '_' . $tahun . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl322_' . $smstr . '_' . $tahun . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
	}