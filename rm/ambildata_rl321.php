<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );
	//include( 'lib/function.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );



		if ($reqdata  == 'cari_rl321') {
			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Kode</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Jenis Pelayanan</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Total Pasien</th>
		<th colspan=\'3\' style=\'border:1px solid grey;\'>Tindak Lanjut Pelayanan</th>
		<th colspan=\'2\' style=\'border:1px solid grey;\'>Mati di IGD</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>D O A</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Rata2 Emergency Respon Time (Menit)</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Rujukan</th><th style=\'border:1px solid grey;\'>Non Rujukan</th><th style=\'border:1px solid grey;\'>Dirawat</th><th style=\'border:1px solid grey;\'>Dirujuk</th><th style=\'border:1px solid grey;\'>Pulang</th><th style=\'border:1px solid grey;\'><= 8 Jam</th><th style=\'border:1px solid grey;\'>> 8 Jam</th></tr>
		';
			
			$bln = date('m');
			if (( empty( $smstr ) && empty( $tahun ) )) {
				if($bln <= 6){
					$smstr = 'I';
					$thn = date('Y');
				}else{
					$smstr = 'II';
					$thn = date('Y');
				}
			} else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					if($bln <= 6){
						$smstr = 'I';
						$thn = $tahun;
					}else{
						$smstr = 'II';
						$thn = $tahun;
					}
			} else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						$thn = date('Y');
			} else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							$thn = $tahun;
						}
					}
				}
			}

				if($smstr=='I'){
					$star = 1;
					$end = 6;
				}elseif($smstr=='II'){
					$star = 7;
					$end = 12;
				}

			$sql2 = mysql_query("SELECT DISTINCT jenis from t_diagnosadanterapi 
					WHERE
					MONTH(TANGGAL) >= $star AND 
					MONTH(TANGGAL) <= $end AND 
					YEAR(TANGGAL) = $thn");


			$kondisi_select1 = "SELECT a.jenis from t_diagnosadanterapi a right join t_pendaftaran b ON a.IDXDAFTAR=b.IDXDAFTAR
								";
			$kondisi_select2 = "SELECT a.STATUS from t_pendaftaran a";
			$kondisi_select3 = mysql_num_rows(mysql_query("SELECT a.IDXDAFTAR from t_pendaftaran a where a.KDPOLY='9'"));
			$kondisi_select4 = mysql_fetch_array(mysql_query("SELECT sum(((HOUR(KELUARPOLY)-HOUR(MASUKPOLY))*60)+(MINUTE(KELUARPOLY)-MINUTE(MASUKPOLY))) as menit from t_pendaftaran where MONTH(TGLREG) >= '".$star."' and MONTH(TGLREG) <= '".$end."' and YEAR(TGLREG) = '".$thn."' and KDPOLY='9'"));
					extract( $kondisi_select4 );
					$RERT = $menit / $kondisi_select3;

			$where = "and MONTH(a.TANGGAL) >= '".$star."' and MONTH(a.TANGGAL) <= '".$end."' and YEAR(a.TANGGAL) = '".$thn."' ";
			$where2 = "and MONTH(a.TGLREG) >= '".$star."' and MONTH(a.TGLREG) <= '".$end."' and YEAR(a.TGLREG) = '".$thn."' ";
			$no = 1;
			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				if ($jenis == 1){
					$jenispel = 'Kebidanan';
				}else if ($jenis == 2){
					$jenispel = 'Psikiatri';
				}else if ($jenis == 3){
					$jenispel = 'Anak';
				}else if ($jenis == 4){
					$jenispel = 'Bedah';
				}else if ($jenis == 5){
					$jenispel = 'Penyakit Dalam';
				}
				
				echo '' . '<tr class=\'tr_s\'>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
					<td style=\'border:1px solid grey;\'>' . $no++ . '</td>
					<td style=\'border:1px solid grey;\'>' . $jenispel . '</td>
					<td style=\'border:1px solid grey;\'>' ; $rujukan = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.KDRUJUK !='1' $where ")); echo $rujukan; echo  '</td>
					<td style=\'border:1px solid grey;\'>' ; $nonrujukan = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.KDRUJUK ='1' $where ")); echo $nonrujukan; echo  '</td>
					<td style=\'border:1px solid grey;\'>' ; $dirawat = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='2' and b.STATUS ='5'  $where ")); echo $dirawat; echo  '</td>
					<td style=\'border:1px solid grey;\'>' ; $dirujuk = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='2' and b.STATUS ='5' and b.STATUS ='12' $where ")); echo $dirujuk; echo  '</td>
					<td style=\'border:1px solid grey;\'>' ; $pulang = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='1' and b.STATUS ='9' $where ")); echo $pulang; echo  '</td>
					<td style=\'border:1px solid grey;\'>' ; $k_8jam = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='8' and HOUR(KELUARPOLY)-HOUR(MASUKPOLY) <= '8' $where ")); echo $k_8jam; echo  '</td>
					<td style=\'border:1px solid grey;\'>' ; $l_8jam = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='8' and HOUR(KELUARPOLY)-HOUR(MASUKPOLY) > '8' $where ")); echo $l_8jam; echo  '</td>
					<td style=\'border:1px solid grey;\'></td>
					<td style=\'border:1px solid grey;\'></td>
					<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
					<td style=\'border:1px solid grey;\'>' . $thn . '</td>
					';
				echo '</tr>';
			}

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'>DOA</td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>	
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'>' ; $DOA = mysql_num_rows(mysql_query("$kondisi_select2 Where a.STATUS='3' and a.KDPOLY='9' $where2")); echo $DOA; echo  '</td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $thn . '</td>
	';
			echo '</tr>';

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'>Rata2 Emergency Respon Time (Menit)</td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>	
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'></td>
	<td style=\'border:1px solid grey;\'>' . $RERT .'</td>
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $thn . '</td>
	';
			echo '</tr>';

			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'colspan=2 >Total Semester '. $smstr.' Tahun '.$thn . '</td>
	<td style=\'border:1px solid grey;\'>' ; $jrujuk = mysql_num_rows(mysql_query("$kondisi_select1 WHERE b.KDRUJUK !='1' $where ")); echo $jrujuk; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $jnr = mysql_num_rows(mysql_query("$kondisi_select1 WHERE  b.KDRUJUK ='1' $where ")); echo $jnr; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $jrawat = mysql_num_rows(mysql_query("$kondisi_select1 WHERE b.STATUS ='2' and b.STATUS ='5'  $where ")); echo $jrawat; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $jdirujuk = mysql_num_rows(mysql_query("$kondisi_select1 WHERE b.STATUS ='2' and b.STATUS ='5' and b.STATUS ='12' $where ")); echo $jdirujuk; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $jpulang = mysql_num_rows(mysql_query("$kondisi_select1 WHERE  b.STATUS ='1' and b.STATUS ='9' $where ")); echo $jpulang; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $k8jam = mysql_num_rows(mysql_query("$kondisi_select1 WHERE  b.STATUS ='8' and HOUR(KELUARPOLY)-HOUR(MASUKPOLY) <= '8' $where ")); echo $k8jam; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $l8jam = mysql_num_rows(mysql_query("$kondisi_select1 WHERE  b.STATUS ='8' and HOUR(KELUARPOLY)-HOUR(MASUKPOLY) > '8' $where ")); echo $l8jam; echo  '</td>
	<td style=\'border:1px solid grey;\'>' ; $jdoa = mysql_num_rows(mysql_query("$kondisi_select2 Where a.STATUS='3' and a.KDPOLY='9' $where2")); echo $jdoa; echo  '</td>
	<td style=\'border:1px solid grey;\'>' . $RERT . '</td>
	<td style=\'border:1px solid grey;\' colspan=2>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl321') {
			$bln = date('m');
			if (( empty( $smstr ) && empty( $tahun ) )) {
				if($bln <= 6){
					$smstr = 'I';
					$thn = date('Y');
				}else{
					$smstr = 'II';
					$thn = date('Y');
				}
			} else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					if($bln <= 6){
						$smstr = 'I';
						$thn = $tahun;
					}else{
						$smstr = 'II';
						$thn = $tahun;
					}
			} else {
					if (( !empty( $smstr ) && empty( $tahun ) )) {
						$thn = date('Y');
			} else {
						if (( !empty( $smstr ) && !empty( $tahun ) )) {
							$thn = $tahun;
						}
					}
				}
			}

				if($smstr=='I'){
					$star = 1;
					$end = 6;
				}elseif($smstr=='II'){
					$star = 7;
					$end = 12;
				}

			$sql2 = mysql_query("SELECT DISTINCT jenis from t_diagnosadanterapi 
					WHERE
					MONTH(TANGGAL) >= $star AND 
					MONTH(TANGGAL) <= $end AND 
					YEAR(TANGGAL) = $thn");


			$kondisi_select1 = "SELECT a.jenis from t_diagnosadanterapi a right join t_pendaftaran b ON a.IDXDAFTAR=b.IDXDAFTAR
								";
			$kondisi_select2 = "SELECT a.STATUS from t_pendaftaran a";
			$kondisi_select3 = mysql_num_rows(mysql_query("SELECT a.IDXDAFTAR from t_pendaftaran a where a.KDPOLY='9'"));
			$kondisi_select4 = mysql_fetch_array(mysql_query("SELECT sum(((HOUR(KELUARPOLY)-HOUR(MASUKPOLY))*60)+(MINUTE(KELUARPOLY)-MINUTE(MASUKPOLY))) as menit from t_pendaftaran where MONTH(TGLREG) >= '".$star."' and MONTH(TGLREG) <= '".$end."' and YEAR(TGLREG) = '".$thn."' and KDPOLY='9'"));
					extract( $kondisi_select4 );
					$RERT = $menit / $kondisi_select3;

			$where = "and MONTH(a.TANGGAL) >= '".$star."' and MONTH(a.TANGGAL) <= '".$end."' and YEAR(a.TANGGAL) = '".$thn."' ";
			$where2 = "and MONTH(a.TGLREG) >= '".$star."' and MONTH(a.TGLREG) <= '".$end."' and YEAR(a.TGLREG) = '".$thn."' ";
			$no = 1;

			$xml = new SimpleXMLElement( '<xml/>' );
			
			

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				if ($jenis == 1){
					$jenispel = 'Kebidanan';
				}else if ($jenis == 2){
					$jenispel = 'Psikiatri';
				}else if ($jenis == 3){
					$jenispel = 'Anak';
				}else if ($jenis == 4){
					$jenispel = 'Bedah';
				}else if ($jenis == 5){
					$jenispel = 'Penyakit Dalam';
				}

				 $rujukan = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.KDRUJUK !='1' $where "));
				 $nonrujukan = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.KDRUJUK ='1' $where "));
				 $dirawat = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='2' and b.STATUS ='5'  $where ")); 
				 $dirujuk = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='2' and b.STATUS ='5' and b.STATUS ='12' $where ")); 
				 $pulang = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='1' and b.STATUS ='9' $where ")); 
				 $k_8jam = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='8' and HOUR(KELUARPOLY)-HOUR(MASUKPOLY) <= '8' $where ")); 
				 $l_8jam = mysql_num_rows(mysql_query("$kondisi_select1 WHERE a.jenis = '$jenis' and b.STATUS ='8' and HOUR(KELUARPOLY)-HOUR(MASUKPOLY) > '8' $where ")); 
				 $DOA = mysql_num_rows(mysql_query("$kondisi_select2 Where a.STATUS='3' and a.KDPOLY='9' $where2"));


				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $jenispel );
				$data->addChild( 'rujukan', $rujukan );
				$data->addChild( 'nonrujukan', $nonrujukan );
				$data->addChild( 'dirawat', $dirawat );
				$data->addChild( 'dirujuk', $dirujuk );
				$data->addChild( 'pulang', $pulang );
				$data->addChild( 'k_8jam', $k_8jam );
				$data->addChild( 'l_8jam', $l_8jam );
				$data->addChild( 'doa', $DOA );
				$data->addChild( 'ert', $RERT );
				$data->addChild( 'smt', $smstr );
				$data->addChild( 'tahun', $thn );
			}

			
			$fp = fopen( '../xml/rl321_' . $smstr . '_' . $thn . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl321_' . $smstr . '_' . $thn . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
	}