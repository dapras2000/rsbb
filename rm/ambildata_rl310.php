<?php
	error_reporting( 'E_ALL' );
	include( '../include/connect.php' );

	if ($_POST) {
		$tgl = date( 'Y-m-d' );
		extract( $_POST );


		if ($reqdata  == 'cari_rl310') {

			echo '
		<table id=\'tbl_reg\'><tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>No</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Diet Makanan</th><th colspan=\'6\' style=\'border:1px solid grey;\'>Kelas Perawatan</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Total</th>
		<th rowspan=\'2\' style=\'border:1px solid grey;\'>Semester</th><th rowspan=\'2\' style=\'border:1px solid grey;\'>Tahun</th>
		</tr>
		<tr id=\'tr_d\' style=\'border-bottom:1px solid grey;\'>
		<th style=\'border:1px solid grey;\'>Super VIP</th><th style=\'border:1px solid grey;\'> VIP </th><th style=\'border:1px solid grey;\'>I</th>
		<th style=\'border:1px solid grey;\'> II </th>
		<th style=\'border:1px solid grey;\'> III </th><th style=\'border:1px solid grey;\'> Intensif </th>
		</tr>';

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

			$sql2 = mysql_query("
				SELECT DISTINCT a.TYPEMAKANAN as x, a.IDXTGL as tgl,
	 				case a.TYPEMAKANAN 
			 		   when 1 then 'Makanan Biasa'
	 				   when 2 then 'Makanan Khusus'
					   ELSE '-'
			 		end as TYPEMAKANAN
				FROM
					t_dpmp a
					LEFT JOIN m_ruang b ON a.RUANG=b.no
				WHERE
					MONTH(a.IDXTGL) >= $star AND 
					MONTH(a.IDXTGL) <= $end AND 
					YEAR(a.IDXTGL) = $thn
			");


			$kondisi_select = "SELECT b.kelas from t_dpmp a LEFT JOIN m_ruang b ON a.RUANG=b.no";
			$where = "and MONTH(a.IDXTGL) >= '".$star."' and MONTH(a.IDXTGL) <= '".$end."' and YEAR(a.IDXTGL) = '".$thn."' ";

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\'>' . $x . '</td>
	<td style=\'border:1px solid grey;\'>' . $TYPEMAKANAN . '</td>
	<td style=\'border:1px solid grey;\'>'; $jsvip = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' and b.idx_ruang='VVIP' and b.kelas='Super VIP' $where ")); echo $jsvip; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jvip = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' and b.idx_ruang IN ('VVIP','VIP') and b.kelas NOT LIKE 'Super VIP' $where ")); echo $jvip; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $ji = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' and b.idx_ruang='I' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where ")); echo $ji; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jii = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' and b.idx_ruang='II' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where ")); echo $jii; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jiii = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' and b.idx_ruang='III' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where ")); echo $jiii; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $jiten = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' and b.kelas IN ('Isolasi','Khusus') $where ")); echo $jiten; echo  '</td>	
	<td style=\'border:1px solid grey;\'>'; $t = mysql_num_rows(mysql_query("$kondisi_select WHERE a.TYPEMAKANAN='$x' $where ")); echo $t; echo  '</td>	
	<td style=\'border:1px solid grey;\'>' . $smstr . '</td>
	<td style=\'border:1px solid grey;\'>' . $thn . '</td>
	';
				echo '</tr>';
			}


			echo '' . '<tr class=\'tr_s\'>
	<td style=\'border:1px solid grey;\' colspan=2>Total Semester '.$smstr.' Tahun '.$thn.'</td>
	<td style=\'border:1px solid grey;\'>'; $tjsvip = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='VVIP' and b.kelas='Super VIP' $where ")); echo $tjsvip; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $tjvip = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang IN ('VVIP','VIP') and b.kelas NOT LIKE 'Super VIP' $where ")); echo $tjvip; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $tji = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='I' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where ")); echo $tji; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $tjii = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='II' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where ")); echo $tjii; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $tjiii = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='III' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where ")); echo $tjiii; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $tjiten = mysql_num_rows(mysql_query("$kondisi_select WHERE b.kelas IN ('Isolasi','Khusus') $where ")); echo $tjiten; echo  '</td>
	<td style=\'border:1px solid grey;\'>'; $tt = mysql_num_rows(mysql_query("$kondisi_select WHERE MONTH(a.IDXTGL) >= '".$star."' and MONTH(a.IDXTGL) <= '".$end."' and YEAR(a.IDXTGL) = '".$thn."' ")); echo $tt; echo  '</td>
	<td style=\'border:1px solid grey;\' colspan=3>-</td>
	';
			echo '</tr>';
			echo '</table>';
		}


		if ($reqdata  == 'xml_rl310') {
			
			if (( empty( $smstr ) && empty( $tahun ) )) {
				$bln = date('m');
				if($bln <= 6){
					$smstr = 'I';
					$thn = date('Y');
				}else{
					$smstr = 'II';
					$thn = date('Y');
				}
			} else {
				if (( empty( $smstr ) && !empty( $tahun ) )) {
					$thn = $tahun;
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

			$sql2 = mysql_query("
				SELECT DISTINCT a.TYPEMAKANAN as x, a.IDXTGL as tgl,
	 				case a.TYPEMAKANAN 
			 		   when 1 then 'Makanan Biasa'
	 				   when 2 then 'Makanan Khusus'
					   ELSE '-'
			 		end as TYPEMAKANAN
				FROM
					t_dpmp a
					LEFT JOIN m_ruang b ON a.RUANG=b.no
				WHERE
					MONTH(a.IDXTGL) >= $star AND 
					MONTH(a.IDXTGL) <= $end AND 
					YEAR(a.IDXTGL) = $thn
			");
			
			
			$kondisi_select = "SELECT b.kelas from t_dpmp a LEFT JOIN m_ruang b ON a.RUANG=b.no";
			$where = "and MONTH(a.IDXTGL) >= '".$star."' and MONTH(a.IDXTGL) <= '".$end."' and YEAR(a.IDXTGL) = '".$thn."' ";

			$xml = new SimpleXMLElement ( '<xml/>' );

			while ($r = mysql_fetch_array( $sql2 )) {
				extract( $r );
				
				$tjsvip = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='VVIP' and b.kelas='Super VIP' $where "));
				$tjvip = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang IN ('VVIP','VIP') and b.kelas NOT LIKE 'Super VIP' $where "));
				$tji = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='I' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where "));
				$tjii = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='II' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where "));
				$tjiii = mysql_num_rows(mysql_query("$kondisi_select WHERE b.idx_ruang='III' and b.kelas!='Isolasi' and b.kelas!='Khusus' $where "));
				$tjiten = mysql_num_rows(mysql_query("$kondisi_select WHERE b.kelas IN ('Isolasi','Khusus') $where "));

				$data = $xml->addChild( 'data' );
				$data->addChild( 'code', $x );
				$data->addChild( 'supervip', $tjsvip );
				$data->addChild( 'vip', $tjvip );
				$data->addChild( 'kelas_1', $tji );
				$data->addChild( 'kelas_2', $tjii );
				$data->addChild( 'kelas_3', $tjiii );
				$data->addChild( 'intensif', $tjiten );
				$data->addChild( 'Semester', $smstr );
				$data->addChild( 'tahun', $thn );
			}
			
			$fp = fopen( '../xml/rl310_' . $smstr . '_' . $thn . '.xml', 'wb' );
			fwrite( $fp, $xml->asXML(  ) );
			fclose( $fp );
			$file = 'rl310_' . $smstr . '_' . $thn . '.xml';
			echo '<div id=\'file_xml\'>';
			echo '' . '<a href=\'download.php?xml=' . $file . '\'>' . $file . '</a>';
			echo ' | <input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'>';
			echo '</div>';
		}
}