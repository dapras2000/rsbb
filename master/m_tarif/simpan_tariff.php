<?php 
session_start();
include "../../include/connect.php";
include("../../include/function.php");


$kolamp = $_POST['kolamp'];
$grup	= $_POST['GRUP'];
$tindakan = $_POST['KDTINDAKAN'];
$subtindakan = $_POST['SUBTINDAKAN'];
if($_POST['poli'] == ""){
	$poli = $_POST['poli2'];
}else{
	$poli = $_POST['poli'];
}
$kelas = $_POST['kelas'];
$grupnama = $_POST['GRUPNAMA'];
$tindakanbaru1 = $_POST['tindakanbaru1'];
$hit = $_POST['hit'];
$grupnama = $_POST['GRUPNAMA'];
$tindakannama = $_POST['KDTINDAKANNAMA'];
$subtindakannama = $_POST['SUBTINDAKANNAMA'];

  function zero($value, $places){
	 if(is_numeric($value)){
		 for($x = 1; $x <= $places; $x++){
			 $ceiling = pow(10, $x);
			 if($value < $ceiling){
				 $zeros = $places - $x;
				 for($y = 1; $y <= $zeros; $y++){
					$leading .= "0";
				 }
				 $x = $places + 1;
			 }
		 }
		 $output = $leading . $value;
	 }else{
		$output = $value;
	 }
	 return $output;
  }


if(isset($_POST['simpan'])){
	if($_POST['KDTINDAKAN']=="" && $_POST['statustindakan']=="show") $_error_msg = $_error_msg."kode tindakan Belum Dipilih, ";
	if($_POST['SUBTINDAKAN']=="" && $_POST['statussubtindakan']=="show") $_error_msg = $_error_msg."kode sub tindakan Belum Dipilih, ";
	if($poli=="" && $_POST['statuspoli1']=="show" || $_POST['statuspoli12']=="show") $_error_msg = $_error_msg."kode poli Belum Dipilih, ";
	if($_POST['kelas']=="" && $_POST['statuskelas']=="show") $_error_msg = $_error_msg."kode kelas Belum Dipilih, ";
	if($_POST['GRUPNAMA']=="" && $_POST['status']=="show") $_error_msg = $_error_msg."Nama grup tindakan Belum Diisi, ";
	if($_POST['TINDAKANNAMA']=="" && $_POST['status']=="show") $_error_msg = $_error_msg."Nama sub grup tindakan Belum Diisi, ";
	if($_POST['tindakanbaru1']=="" && $_POST['status']=="show") $_error_msg = $_error_msg."Nama tindakan baru Belum Diisi, ";
	if($_POST['SUBTINDAKANNAMA']=="" && $_POST['status']=="show") $_error_msg = $_error_msg."Nama sub tindakan Belum Diisi, ";

if(strlen($_error_msg)>0) {
    $_error_msg = substr($_error_msg,0,strlen($_error_msg)-2).".";
?>

<SCRIPT language="JavaScript">
    alert("<?=$_error_msg?>");
	window.location="../m_tarif/index.php";
</SCRIPT>
    <?
}else{

	if ($kolamp == "01"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "01" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$gruptambah = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$cekdata="select kode_tindakan from m_tarif2012 where kode_tindakan= '".$gruptambahawal."'";
			$ada=mysql_query($cekdata) or die(mysql_error());
			if(mysql_num_rows($ada)>0)
			{ 
			  echo "<h3>Kode Tindakan telah Terdaftar! Silahkan diulangi.</h3>"; 
			}
			else
			{
				$sqlinsert_00 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan)
									VALUES ("'.$kolamp.'", "01","Pelayanan Rawat Jalan","'.$gruptambahawal.'","'.$nama_grup.'")';
				
				mysql_query($sqlinsert_00)or die(mysql_error());
			}
			
		}else{
			$gruptambah = $grup;
			$sqlnamagrup2 = 'SELECT nama_tindakan
							FROM m_tarif2012
							WHERE kode_tindakan =  "'.$grup.'" ';
			$tindakannama2 = mysql_query($sqlnamagrup2) or die (mysql_error());
			$rowtindakannama2 = mysql_fetch_array($tindakannama2);
			$nama_grup2 = $rowtindakannama2['nama_tindakan'];
			$sqltndkan = 'SELECT SUBSTR( MAX( kode_gruptindakan ),7,2) AS kotind
							FROM m_tarif2012
							WHERE kode_lampiran =  "01" and CHAR_LENGTH(kode_gruptindakan) = "8"';
			$tindakan1 = mysql_query($sqltndkan) or die (mysql_error());
			$rowtindakan = mysql_fetch_array($tindakan1);

			$tindakantambah = $rowtindakan['kotind']+1;
				
		
			$baru = $gruptambah.".".$tindakantambah;
				
				
			$sqlnamapoli = 'SELECT nama
							FROM m_poly
							WHERE kode =  "'.$poli.'" ';
			$namapoli = mysql_query($sqlnamapoli) or die (mysql_error());
			$rownamapoli = mysql_fetch_array($namapoli);

			
		


			if ($gruptambah == "01.01"){
				$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi).'","'.$gruptambah.'","'.$nama_grup2.'","'.$baru.'","'.$nama_grup2.' '.$rownamapoli['nama'].'")';
			
				mysql_query($sqlinsert_01)or die(mysql_error());
				$i = 1;
				$x = 1;
				while($i <= 3 && $x <= 3){
					if ($i == '1'){
						$profesi2 = "1";
						$baru4 = "Pemeriksaan dan Konsultasi dokter spesialis";
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										
									VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi2).'","'.$baru.'","'.$nama_grup2.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
				
						mysql_query($sqlinsert_01)or die(mysql_error());
					} else if ($i == '2'){
						$profesi2 = "0";
						$baru4 = "Pemeriksaan dan Konsultasi dokter umum";
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										
									VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi2).'","'.$baru.'","'.$nama_grup2.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
				
						mysql_query($sqlinsert_01)or die(mysql_error());
					}else {
						$profesi2 = "3";
						$baru4 = "Pemeriksaan dan Konsultasi tenaga ahli lain";
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										
									VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi2).'","'.$baru.'","'.$nama_grup2.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
				
						mysql_query($sqlinsert_01)or die(mysql_error());
					}
					$i++;
					$x++;
				}
			}
			if ($grup != "01.01"){
				if($tindakannama != ''){
					$sqltindakan = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind2
									FROM m_tarif2012
									WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "8"';
					$rowsqltindakan = mysql_query($sqltindakan) or die (mysql_error());
					$row2sqltindakan = mysql_fetch_array($rowsqltindakan);
					
					$nama_grup  = $tindakannama;
					$sqlnamagrup1 = 'SELECT nama_tindakan
									FROM m_tarif2012
									WHERE kode_tindakan =  "'.$grup.'" ';
					$tindakannama1 = mysql_query($sqlnamagrup1) or die (mysql_error());
					$rowtindakannama1 = mysql_fetch_array($tindakannama1);
					$nama_grup1 = $rowtindakannama1['nama_tindakan'];
					$sqlnamakelas = 'SELECT kelas
									FROM m_tarif2012
									WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';

					$sblum = $row2sqltindakan['kotind2']+1;
					$gruptambahawal = $grup.'.'.zero($sblum,2);
					$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											
										VALUES ("01", "'.intval($poli).'","'.$grup.'","'.$nama_grup1.'","'.$gruptambahawal.'","'.$tindakannama.'")';
					
					mysql_query($sqlinsert_04)or die(mysql_error());
				}else{
					$gruptambah1 = $tindakan;
					$sqlnamagrup = 'SELECT nama_tindakan
									FROM m_tarif2012
									WHERE kode_tindakan =  "'.$tindakan.'" ';
					$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
					$rowtindakannama = mysql_fetch_array($tindakannama);
					$nama_grup  = $tindakannama;
					$sqlnamagrup1 = 'SELECT nama_tindakan
									FROM m_tarif2012
									WHERE kode_tindakan =  "'.$grup.'" ';
					$tindakannama1 = mysql_query($sqlnamagrup1) or die (mysql_error());
					$rowtindakannama1 = mysql_fetch_array($tindakannama1);
					$nama_grup1 = $rowtindakannama1['nama_tindakan'];
					$sqlnamakelas = 'SELECT kelas
									FROM m_tarif2012
									WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
								
					if ($hit == ''){
						$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,3) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah1.'" and CHAR_LENGTH(kode_tindakan) = "12"';
						$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
						$rowtindakan042 = mysql_fetch_array($tindakan042);
						$tindakantambah042 = zero($rowtindakan042['kotind02']+1,3);
						$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
											VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah1.'","'.$rowtindakannama['nama_tindakan'].'","'.$tindakan.'.'.$tindakantambah042.'","'.$tindakanbaru1.'","'.$nama_kelas.'")';
						mysql_query($sqlinsert_04)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,3) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah1.'" and CHAR_LENGTH(kode_tindakan) = "12"';
							$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
							$rowtindakan042 = mysql_fetch_array($tindakan042);
							$tindakantambah042 = zero($rowtindakan042['kotind02']+1,3);
								
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_042 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
												VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah1.'","'.$rowtindakannama['nama_tindakan'].'","'.$tindakan.'.'.$tindakantambah042.',"'.$tindakanbaru.'","'.$nama_kelas.'")';
							mysql_query($sqlinsert_042)or die(mysql_error());	
						$t++;
						}
					}
				}
			}
			
		}
	}

	if ($kolamp == "02"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "02" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_00 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "02","Pelayanan Gawat Darurat","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_00)or die(mysql_error());
		}else{
			$gruptambah = $grup;
			$sqlnamagrup = 'SELECT nama_tindakan
							FROM m_tarif2012
							WHERE kode_tindakan =  "'.$grup.'" ';
			$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
			$rowtindakannama = mysql_fetch_array($tindakannama);
			$nama_grup = $rowtindakannama['nama_tindakan'];
			$sqltndkan = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind
							FROM m_tarif2012
							WHERE kode_lampiran =  "02" and CHAR_LENGTH(kode_tindakan) = "5"';
			$tindakan = mysql_query($sqltndkan) or die (mysql_error());
			$rowtindakan = mysql_fetch_array($tindakan);

			$tindakantambah = $rowtindakan['kotind']+1;
				
			$baru = $gruptambah.".".zero($tindakantambah,2);
					
			$sqlnamapoli = 'SELECT nama
							FROM m_poly
							WHERE kode =  "'.$poli.'" ';
			$namapoli = mysql_query($sqlnamapoli) or die (mysql_error());
			$rownamapoli = mysql_fetch_array($namapoli);

			if ($gruptambah == "02.01"){
				$i = 1;
				$x = 1;
				while($i <= 3 && $x <= 3){
					if ($i == '1'){
						$profesi2 = "1";
						$baru4 = "Pemeriksaan dan Konsultasi dokter spesialis";
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										
									VALUES ("'.$kolamp.'", "9","'.intval($profesi2).'","'.$grup.'","'.$nama_grup.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
				
						mysql_query($sqlinsert_01)or die(mysql_error());
					} else if ($i == '2'){
						$profesi2 = "0";
						$baru4 = "Pemeriksaan dan Konsultasi dokter umum";
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										
									VALUES ("'.$kolamp.'", "9","'.intval($profesi2).'","'.$grup.'","'.$nama_grup.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
				
						mysql_query($sqlinsert_01)or die(mysql_error());
					}else {
						$profesi2 = "3";
						$baru4 = "Pemeriksaan dan Konsultasi tenaga ahli lain";
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										
									VALUES ("'.$kolamp.'", "9","'.intval($profesi2).'","'.$grup.'","'.$nama_grup.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
				
						mysql_query($sqlinsert_01)or die(mysql_error());
					}
					$i++;
					$x++;
				}
			}else if ($grup == "02.02"){
				if ($hit == ''){
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
								VALUES ("'.$kolamp.'", "9","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.02","'.$tindakanbaru1.'")';
					mysql_query($sqlinsert_01)or die(mysql_error());
				}else{
					$t=1;
					while ($t<=$hit){
						$sqltndkan02 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "02.02" and CHAR_LENGTH(kode_tindakan) = "8"';
							$tindakan02 = mysql_query($sqltndkan02) or die (mysql_error());
							$rowtindakan02 = mysql_fetch_array($tindakan02);
							$tindakantambah02 = zero($rowtindakan02['kotind02']+1,2);
						$tindakanbaru = $_POST['tindakanbaru'.$t];
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit,  kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											VALUES ("'.$kolamp.'", "9","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].' '.$rownamapoli['nama'].'","'.$gruptambah.'.'.$tindakantambah02.'","'.$tindakanbaru.'")';
						mysql_query($sqlinsert_01)or die(mysql_error());	
					$t++;
					}
				}
			}else if ($grup == "02.03"){
				if ($hit == ''){
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
								VALUES ("'.$kolamp.'", "9","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.03","'.$tindakanbaru1.'")';
					mysql_query($sqlinsert_01)or die(mysql_error());
				}else{
					$t=1;
					while ($t<=$hit){
						$sqltndkan02 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,3) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "02.03" and CHAR_LENGTH(kode_tindakan) = "9"';
							$tindakan02 = mysql_query($sqltndkan02) or die (mysql_error());
							$rowtindakan02 = mysql_fetch_array($tindakan02);
							$tindakantambah02 = zero($rowtindakan02['kotind02']+1,3);
						$tindakanbaru = $_POST['tindakanbaru'.$t];
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit,  kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											VALUES ("'.$kolamp.'", "9","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].' UGD","'.$gruptambah.'.'.$tindakantambah02.'","'.$tindakanbaru.'")';
						mysql_query($sqlinsert_01)or die(mysql_error());	
					$t++;
					}
				}
			}else if ($grup == "02.04"){
				if ($hit == ''){
							$sqltndkan014 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "8"';
										$tindakan014 = mysql_query($sqltndkan014) or die (mysql_error());
										$rowtindakan014 = mysql_fetch_array($tindakan014);
										$tindakantambah014 = zero($rowtindakan014['kotind02']+1,2);
								$sqlinsert_014 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											VALUES ("'.$kolamp.'","9","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$grup.'.'.$tindakantambah014.'","'.$tindakanbaru1.'")';
								mysql_query($sqlinsert_014)or die(mysql_error());
							}else{
								$t=1;
								while ($t<=$hit){
									$sqltndkan014 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "8"';
										$tindakan014 = mysql_query($sqltndkan014) or die (mysql_error());
										$rowtindakan014 = mysql_fetch_array($tindakan014);
										$tindakantambah014 = zero($rowtindakan014['kotind02']+1,2);
									
									$tindakanbaru = $_POST['tindakanbaru'.$t];
									$sqlinsert_014 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
														VALUES ("'.$kolamp.'","9","'.$grup.'","'.$rowtindakannama['nama_tindakan'].'","'.$grup.'.'.$tindakantambah014.'","'.$tindakanbaru.'")';
									mysql_query($sqlinsert_014)or die(mysql_error());	
								$t++;
							}
						}
			}else {
				if ($hit == ''){
					$sqltndkan01 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,3) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "9"';
								$tindakan01 = mysql_query($sqltndkan01) or die (mysql_error());
								$rowtindakan01 = mysql_fetch_array($tindakan01);
								$tindakantambah01 = zero($rowtindakan01['kotind02']+1,3);
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									VALUES ("'.$kolamp.'","9","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$grup.'.'.$tindakantambah01.'","'.$tindakanbaru1.'")';
						mysql_query($sqlinsert_01)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan01 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,3) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "9"';
								$tindakan01 = mysql_query($sqltndkan01) or die (mysql_error());
								$rowtindakan01 = mysql_fetch_array($tindakan01);
								$tindakantambah01 = zero($rowtindakan01['kotind02']+1,3);
							
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
												VALUES ("'.$kolamp.'","9","'.$grup.'","'.$rowtindakannama['nama_tindakan'].'","'.$grup.'.'.$tindakantambah01.'","'.$tindakanbaru.'")';
							mysql_query($sqlinsert_01)or die(mysql_error());	
						$t++;
					}
				}
			}
		}
	}
	if ($kolamp == "03"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "03" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_03 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "03","Pelayanan Rawat Inap","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_03)or die(mysql_error());
		}else{
			if ($grup == "03.01" || $grup == "03.04"){
				if ($grup == "03.04"){
					$polipilih = intval($poli);
				}else{
					$polipilih = "";
				}
				if($tindakannama != ''){
					$sqltindakan = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind2
									FROM m_tarif2012
									WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "8"';
					$rowsqltindakan = mysql_query($sqltindakan) or die (mysql_error());
					$row2sqltindakan = mysql_fetch_array($rowsqltindakan);

					$sblum = $row2sqltindakan['kotind2']+1;
					$gruptambahawal = $grup.'.'.zero($sblum,2);
					$nama_grup  = $tindakannama;
					$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											
										VALUES ("03", "'.$polipilih.'","'.$grup.'","Rawat Jalan","'.$gruptambahawal.'","'.$nama_grup.'")';
					
					mysql_query($sqlinsert_04)or die(mysql_error());
				}else{
					$gruptambah = $tindakan;
					$sqlnamagrup = 'SELECT nama_tindakan
									FROM m_tarif2012
									WHERE kode_tindakan =  "'.$gruptambah.'" ';
					$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
					$rowtindakannama = mysql_fetch_array($tindakannama);
					$nama_grup = $rowtindakannama['nama_tindakan'];
					$sqlnamakelas = 'SELECT kelas
										FROM m_tarif2012
										WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
					$tindakannamakelas = mysql_query($sqlnamakelas) or die (mysql_error());
					$rowtindakannamakelas = mysql_fetch_array($tindakannamakelas);
					$nama_kelas = $rowtindakannamakelas['kelas'];
								
					if ($hit == ''){
						$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "14"';
						$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
						$rowtindakan042 = mysql_fetch_array($tindakan042);
						$tindakantambah042 = zero($rowtindakan042['kotind02']+1,2);
						$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
											VALUES ("'.$kolamp.'","'.$polipilih.'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah042.'.'.$kelas.'","'.$tindakanbaru1.'","'.$nama_kelas.'")';
						mysql_query($sqlinsert_04)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "14"';
							$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
							$rowtindakan042 = mysql_fetch_array($tindakan042);
							$tindakantambah042 = zero($rowtindakan042['kotind02']+1,2);
								
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_042 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
												VALUES ("'.$kolamp.'","'.$polipilih.'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah042.'.'.$kelas.'","'.$tindakanbaru.'","'.$nama_kelas.'")';
							mysql_query($sqlinsert_042)or die(mysql_error());	
						$t++;
						}
					}
				}
			}else {
				if($tindakannama != ''){
					$sqltindakan = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind2
									FROM m_tarif2012
									WHERE kode_gruptindakan =  "'.$grup.'" and CHAR_LENGTH(kode_tindakan) = "8"';
					$rowsqltindakan = mysql_query($sqltindakan) or die (mysql_error());
					$row2sqltindakan = mysql_fetch_array($rowsqltindakan);

					$sblum = $row2sqltindakan['kotind2']+1;
					$gruptambahawal = $grup.'.'.zero($sblum,2);
					$nama_grup  = $tindakannama;
					$sqlnamagrup1 = 'SELECT nama_tindakan
									FROM m_tarif2012
									WHERE kode_tindakan =  "'.$grup.'" ';
					$tindakannama1 = mysql_query($sqlnamagrup1) or die (mysql_error());
					$rowtindakannama1 = mysql_fetch_array($tindakannama1);
					$nama_grup1 = $rowtindakannama1['nama_tindakan'];
					$sqlnamakelas = 'SELECT kelas
									FROM m_tarif2012
									WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
					$tindakannamakelas = mysql_query($sqlnamakelas) or die (mysql_error());
					$rowtindakannamakelas = mysql_fetch_array($tindakannamakelas);
					$nama_kelas = $rowtindakannamakelas['kelas'];
					$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
											
										VALUES ("03", "'.intval($poli).'","'.$grup.'","'.$nama_grup1.'","'.$gruptambahawal.'","'.$tindakannama.'","'.$nama_kelas.'")';
					
					mysql_query($sqlinsert_04)or die(mysql_error());
				}else{
					$gruptambah = $tindakan;
					$sqlnamagrup = 'SELECT nama_tindakan
									FROM m_tarif2012
									WHERE kode_tindakan =  "'.$gruptambah.'" ';
					$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
					$rowtindakannama = mysql_fetch_array($tindakannama);
					$nama_grup = $rowtindakannama['nama_tindakan'];
					$sqlnamakelas = 'SELECT kelas
									FROM m_tarif2012
									WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
					$tindakannamakelas = mysql_query($sqlnamakelas) or die (mysql_error());
					$rowtindakannamakelas = mysql_fetch_array($tindakannamakelas);
					$nama_kelas = $rowtindakannamakelas['kelas'];
								
					if ($hit == ''){
						$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "14"';
						$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
						$rowtindakan042 = mysql_fetch_array($tindakan042);
						$tindakantambah042 = zero($rowtindakan042['kotind02']+1,2);
						$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
											VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah042.'.'.$kelas.'","'.$tindakanbaru1.'","'.$nama_kelas.'")';
						mysql_query($sqlinsert_04)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
											FROM m_tarif2012
											WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "14"';
							$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
							$rowtindakan042 = mysql_fetch_array($tindakan042);
							$tindakantambah042 = zero($rowtindakan042['kotind02']+1,2);
									
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_042 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
												VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah042.'.'.$kelas.'","'.$tindakanbaru.'","'.$nama_kelas.'")';
							mysql_query($sqlinsert_042)or die(mysql_error());	
						$t++;
						}
					}
				}
			}
		}
	}
	
	if ($kolamp == "04"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "04" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_05 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "04","Pelayanan Kamar Operasi","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_05)or die(mysql_error());
		}else{
			if ($grup == "04.02"){
				if($tindakannama != ''){
					$sqltindakan = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind2
									FROM m_tarif2012
									WHERE kode_gruptindakan =  "04.02" and CHAR_LENGTH(kode_tindakan) = "8"';
					$rowsqltindakan = mysql_query($sqltindakan) or die (mysql_error());
					$row2sqltindakan = mysql_fetch_array($rowsqltindakan);

					$sblum = $row2sqltindakan['kotind2']+1;
					$gruptambahawal = $grup.'.'.zero($sblum,2);
					$nama_grup  = $tindakannama;
					$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											
										VALUES ("04", "15","04.02","Operasi Bedah","'.$gruptambahawal.'","'.$nama_grup.'")';
					
					mysql_query($sqlinsert_04)or die(mysql_error());
				}else{
						$gruptambah = $tindakan;
						$sqlnamagrup = 'SELECT nama_tindakan
										FROM m_tarif2012
										WHERE kode_tindakan =  "'.$gruptambah.'" ';
						$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
						$rowtindakannama = mysql_fetch_array($tindakannama);
						$nama_grup = $rowtindakannama['nama_tindakan'];
						$sqlnamakelas = 'SELECT kelas
										FROM m_tarif2012
										WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
						$tindakannamakelas = mysql_query($sqlnamakelas) or die (mysql_error());
						$rowtindakannamakelas = mysql_fetch_array($tindakannamakelas);
						$nama_kelas = $rowtindakannamakelas['kelas'];
								
						if ($hit == ''){
							$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "14"';
										$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
										$rowtindakan042 = mysql_fetch_array($tindakan042);
										$tindakantambah042 = zero($rowtindakan042['kotind02']+1,2);
								$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
											VALUES ("'.$kolamp.'","15","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah042.'.'.$kelas.'","'.$tindakanbaru1.'","'.$nama_kelas.'")';
								mysql_query($sqlinsert_04)or die(mysql_error());
							}else{
								$t=1;
								while ($t<=$hit){
									$sqltndkan042 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "14"';
										$tindakan042 = mysql_query($sqltndkan042) or die (mysql_error());
										$rowtindakan042 = mysql_fetch_array($tindakan042);
										$tindakantambah042 = zero($rowtindakan042['kotind02']+1,2);
									
									$tindakanbaru = $_POST['tindakanbaru'.$t];
									$sqlinsert_042 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
														VALUES ("'.$kolamp.'","15","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah042.'.'.$kelas.'","'.$tindakanbaru.'","'.$nama_kelas.'")';
									mysql_query($sqlinsert_042)or die(mysql_error());	
								$t++;
							}
						}
					
				}
			}else {
				$gruptambah = $grup;
				$sqlnamagrup = 'SELECT nama_tindakan
								FROM m_tarif2012
								WHERE kode_tindakan =  "'.$grup.'" ';
				$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
				$rowtindakannama = mysql_fetch_array($tindakannama);
				$nama_grup = $rowtindakannama['nama_tindakan'];
				$sqlnamakelas = 'SELECT kelas
								FROM m_tarif2012
								WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
				$tindakannamakelas = mysql_query($sqlnamakelas) or die (mysql_error());
				$rowtindakannamakelas = mysql_fetch_array($tindakannamakelas);
				$nama_kelas = $rowtindakannamakelas['kelas'];

				if ($hit == ''){
						$sqltndkan04 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
								$tindakan04 = mysql_query($sqltndkan04) or die (mysql_error());
								$rowtindakan04 = mysql_fetch_array($tindakan04);
								$tindakantambah04 = zero($rowtindakan04['kotind02']+1,2);
								
						$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
									VALUES ("'.$kolamp.'","15","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah04.'.'.$kelas.'","'.$tindakanbaru1.'","'.$nama_kelas.'")';
						mysql_query($sqlinsert_04)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan05 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
								$tindakan04 = mysql_query($sqltndkan04) or die (mysql_error());
								$rowtindakan04 = mysql_fetch_array($tindakan04);
								$tindakantambah04 = zero($rowtindakan04['kotind02']+1,2);
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_04 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
												VALUES ("'.$kolamp.'","15","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah04.'.'.$kelas.'","'.$tindakanbaru.'","'.$nama_kelas.'")';
							mysql_query($sqlinsert_04)or die(mysql_error());	
						$t++;
					}
				}
			}
		}
	}
	
	if ($kolamp == "05"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "05" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_05 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "05","Pelayanan Kamar Bersalin","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_05)or die(mysql_error());
		}else{
			if ($grup == "05.01"){
				?><script>alert("Pemeriksaan dan Konsultasi kamar bersalin sudah ada");window.location="../m_tarif/index.php";</script>;<?
			}else {
				$gruptambah = $grup;
				$sqlnamagrup = 'SELECT nama_tindakan
								FROM m_tarif2012
								WHERE kode_tindakan =  "'.$grup.'" ';
				$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
				$rowtindakannama = mysql_fetch_array($tindakannama);
				$nama_grup = $rowtindakannama['nama_tindakan'];
				$sqlnamakelas = 'SELECT kelas
								FROM m_tarif2012
								WHERE kelas IS NOT NULL and substr(kode_tindakan,-2) =  "'.$kelas.'"  ';
				$tindakannamakelas = mysql_query($sqlnamakelas) or die (mysql_error());
				$rowtindakannamakelas = mysql_fetch_array($tindakannamakelas);
				$nama_kelas = $rowtindakannamakelas['kelas'];

				if ($hit == ''){
						$sqltndkan05 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
								$tindakan05 = mysql_query($sqltndkan05) or die (mysql_error());
								$rowtindakan05 = mysql_fetch_array($tindakan05);
								$tindakantambah05 = zero($rowtindakan05['kotind02']+1,2);
								
						$sqlinsert_05 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
									VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah05.'.'.$kelas.'","'.$tindakanbaru1.'","'.$rowtindakannamakelas['kelas'].'")';
						mysql_query($sqlinsert_05)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan05 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
								$tindakan05 = mysql_query($sqltndkan05) or die (mysql_error());
								$rowtindakan05 = mysql_fetch_array($tindakan05);
								$tindakantambah05 = zero($rowtindakan05['kotind02']+1,2);
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_05 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan,kelas) 
												VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah05.'.'.$kelas.'","'.$tindakanbaru.'","'.$rowtindakannamakelas['kelas'].'")';
							mysql_query($sqlinsert_05)or die(mysql_error());	
						$t++;
					}
				}
			}
		}
	}
	
	if ($kolamp == "06"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "06" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_06 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "'.intval($poli).'","Penunjang Medis","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_06)or die(mysql_error());
		}else{
			if($grup == "06.01"){
				if($tindakannama != ''){
					$sqltindakan = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind2
									FROM m_tarif2012
									WHERE kode_gruptindakan =  "06.01" and CHAR_LENGTH(kode_tindakan) = "8"';
					$rowsqltindakan = mysql_query($sqltindakan) or die (mysql_error());
					$row2sqltindakan = mysql_fetch_array($rowsqltindakan);

					$sblum = $row2sqltindakan['kotind2']+1;
					$gruptambahawal = $grup.'.'.zero($sblum,2);
					$nama_grup  = $tindakannama;
					$sqlinsert_06 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											
										VALUES ("06", "'.intval($poli).'","06.01","Laboratorium Klinik","'.$gruptambahawal.'","'.$nama_grup.'")';
					
					mysql_query($sqlinsert_06)or die(mysql_error());
				}else{
					if ($tindakan == "06.01.14"){
						if($subtindakannama != ''){
							$sqltindakansub = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind2
											FROM m_tarif2012
											WHERE kode_gruptindakan =  "06.01.14" and CHAR_LENGTH(kode_tindakan) = "11"';
							$rowsqltindakansub = mysql_query($sqltindakansub) or die (mysql_error());
							$row2sqltindakansub = mysql_fetch_array($rowsqltindakansub);

							$sblumsub = $row2sqltindakansub['kotind2']+1;
							$gruptambahawalsub = $tindakan.'.'.zero($sblumsub,2);
							$nama_grupsub  = $subtindakannama;
							$sqlinsert_06sub = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
													
												VALUES ("06", "'.intval($poli).'","06.01.14","Pemeriksaan Patologi Anantomi","'.$gruptambahawalsub.'","'.$nama_grupsub.'")';
							
							mysql_query($sqlinsert_06sub)or die(mysql_error());
						}else{
							$gruptambahsub = $subtindakan;
							$sqlnamagrupsub = 'SELECT nama_tindakan
											FROM m_tarif2012
											WHERE kode_tindakan =  "'.$gruptambahsub.'" ';
							$tindakannamasub = mysql_query($sqlnamagrupsub) or die (mysql_error());
							$rowtindakannamasub = mysql_fetch_array($tindakannamasub);
							$nama_grupsub = $rowtindakannamasub['nama_tindakan'];
									
							if ($hit == ''){
								$sqltndkan06sub = 'SELECT SUBSTR( MAX( kode_tindakan ),13,2) AS kotind02
											FROM m_tarif2012
											WHERE kode_gruptindakan =  "'.$gruptambahsub.'" and CHAR_LENGTH(kode_tindakan) = "14"';
											$tindakan06sub = mysql_query($sqltndkan06sub) or die (mysql_error());
											$rowtindakan06sub = mysql_fetch_array($tindakan06sub);
											$tindakantambah06sub = zero($rowtindakan06sub['kotind02']+1,2);
									$sqlinsert_06sub = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
												VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambahsub.'","'.$rowtindakannamasub['nama_tindakan'].'","'.$gruptambahsub.'.'.$tindakantambah06sub.'","'.$tindakanbaru1.'")';
									mysql_query($sqlinsert_06sub)or die(mysql_error());
								}else{
									$t=1;
									while ($t<=$hit){
										$sqltndkan06sub = 'SELECT SUBSTR( MAX( kode_tindakan ),13,2) AS kotind02
											FROM m_tarif2012
											WHERE kode_gruptindakan =  "'.$gruptambahsub.'" and CHAR_LENGTH(kode_tindakan) = "14"';
											$tindakan06sub = mysql_query($sqltndkan06sub) or die (mysql_error());
											$rowtindakan06sub = mysql_fetch_array($tindakan06sub);
											$tindakantambah06sub = zero($rowtindakan06sub['kotind02']+1,2);
										
										$tindakanbarusub = $_POST['tindakanbaru'.$t];
										$sqlinsert_06sub = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
															VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambahsub.'","'.$rowtindakannamasub['nama_tindakan'].'","'.$gruptambahsub.'.'.$tindakantambah06sub.'","'.$tindakanbarusub.'")';
										mysql_query($sqlinsert_06sub)or die(mysql_error());	
									$t++;
								}
							}
						}
					}else {	
						$gruptambah = $tindakan;
						$sqlnamagrup = 'SELECT nama_tindakan
										FROM m_tarif2012
										WHERE kode_tindakan =  "'.$gruptambah.'" ';
						$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
						$rowtindakannama = mysql_fetch_array($tindakannama);
						$nama_grup = $rowtindakannama['nama_tindakan'];
								
						if ($hit == ''){
							$sqltndkan06 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
										$tindakan06 = mysql_query($sqltndkan06) or die (mysql_error());
										$rowtindakan06 = mysql_fetch_array($tindakan06);
										$tindakantambah06 = zero($rowtindakan06['kotind02']+1,2);
								$sqlinsert_06 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah06.'","'.$tindakanbaru1.'")';
								mysql_query($sqlinsert_06)or die(mysql_error());
							}else{
								$t=1;
								while ($t<=$hit){
									$sqltndkan06 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
										FROM m_tarif2012
										WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
										$tindakan06 = mysql_query($sqltndkan06) or die (mysql_error());
										$rowtindakan06 = mysql_fetch_array($tindakan06);
										$tindakantambah06 = zero($rowtindakan06['kotind02']+1,2);
									
									$tindakanbaru = $_POST['tindakanbaru'.$t];
									$sqlinsert_06 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
														VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah06.'","'.$tindakanbaru.'")';
									mysql_query($sqlinsert_06)or die(mysql_error());	
								$t++;
							}
						}
					}
				}
			}else {
				$gruptambah = $grup;
				$sqlnamagrup = 'SELECT nama_tindakan
								FROM m_tarif2012
								WHERE kode_tindakan =  "'.$grup.'" ';
				$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
				$rowtindakannama = mysql_fetch_array($tindakannama);
				$nama_grup = $rowtindakannama['nama_tindakan'];
						
				if ($hit == ''){
					$sqltndkan06 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
								$tindakan06 = mysql_query($sqltndkan06) or die (mysql_error());
								$rowtindakan06 = mysql_fetch_array($tindakan06);
								$tindakantambah06 = zero($rowtindakan06['kotind02']+1,2);
						$sqlinsert_06 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah06.'","'.$tindakanbaru1.'")';
						mysql_query($sqlinsert_06)or die(mysql_error());
					}else{
						$t=1;
						while ($t<=$hit){
							$sqltndkan06 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
								$tindakan06 = mysql_query($sqltndkan06) or die (mysql_error());
								$rowtindakan06 = mysql_fetch_array($tindakan06);
								$tindakantambah06 = zero($rowtindakan06['kotind02']+1,2);
							
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_06 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
												VALUES ("'.$kolamp.'","'.intval($poli).'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah06.'","'.$tindakanbaru.'")';
							mysql_query($sqlinsert_06)or die(mysql_error());	
						$t++;
					}
				}
			}
		}

	}
	
	if ($kolamp == "07"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "07" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_07 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "07","Pelayanan Farmasi","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_07)or die(mysql_error());
		}else{
			$gruptambah = $grup;
			$sqlnamagrup = 'SELECT nama_tindakan
							FROM m_tarif2012
							WHERE kode_tindakan =  "'.$grup.'" ';
			$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
			$rowtindakannama = mysql_fetch_array($tindakannama);
			$nama_grup = $rowtindakannama['nama_tindakan'];
					
			if ($hit == ''){
				$sqltndkan07 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
							$tindakan07 = mysql_query($sqltndkan07) or die (mysql_error());
							$rowtindakan07 = mysql_fetch_array($tindakan07);
							$tindakantambah07 = zero($rowtindakan07['kotind02']+1,2);
					$sqlinsert_07 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
								VALUES ("'.$kolamp.'","14","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah07.'","'.$tindakanbaru1.'")';
					mysql_query($sqlinsert_07)or die(mysql_error());
				}else{
					$t=1;
					while ($t<=$hit){
						$sqltndkan07 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
							$tindakan07 = mysql_query($sqltndkan07) or die (mysql_error());
							$rowtindakan07 = mysql_fetch_array($tindakan07);
							$tindakantambah07 = zero($rowtindakan07['kotind02']+1,2);
						
						$tindakanbaru = $_POST['tindakanbaru'.$t];
						$sqlinsert_07 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											VALUES ("'.$kolamp.'","14","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah07.'","'.$tindakanbaru.'")';
						mysql_query($sqlinsert_07)or die(mysql_error());	
					$t++;
				}
			}
			
		}
	}
	
	if ($kolamp == "08"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "08" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_08 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "08","Ruang Khusus","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_08)or die(mysql_error());
		}else{
			$gruptambah = $grup;
			$sqlnamagrup = 'SELECT nama_tindakan
							FROM m_tarif2012
							WHERE kode_tindakan =  "'.$grup.'" ';
			$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
			$rowtindakannama = mysql_fetch_array($tindakannama);
			$nama_grup = $rowtindakannama['nama_tindakan'];
					
			if ($hit == ''){
					if ($gruptambah == "08.01.01" || $gruptambah == "08.01.02" || $gruptambah == "08.01.03"){
						$sqltndkan08 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
							$tindakan08 = mysql_query($sqltndkan08) or die (mysql_error());
							$rowtindakan08 = mysql_fetch_array($tindakan08);
							$tindakantambah08 = zero($rowtindakan08['kotind02']+1,2);
						$sqlinsert_08 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										VALUES ("'.$kolamp.'","0","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah08.'","'.$tindakanbaru1.'")';
							mysql_query($sqlinsert_08)or die(mysql_error());
					}else {
						$sqltndkan08 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
							$tindakan08 = mysql_query($sqltndkan08) or die (mysql_error());
							$rowtindakan08 = mysql_fetch_array($tindakan08);
							$tindakantambah08 = zero($rowtindakan08['kotind02']+1,2);
						$sqlinsert_08 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										VALUES ("'.$kolamp.'","0","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah08.'","'.$tindakanbaru1.'")';
							mysql_query($sqlinsert_08)or die(mysql_error());
					}
				}else{

					$t=1;
					while ($t<=$hit){
						if ($gruptambah == "08.01.01" || $gruptambah == "08.01.02" || $gruptambah == "08.01.03"){
							$sqltndkan08 = 'SELECT SUBSTR( MAX( kode_tindakan ),10,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "11"';
								$tindakan08 = mysql_query($sqltndkan08) or die (mysql_error());
								$rowtindakan08 = mysql_fetch_array($tindakan08);
								$tindakantambah08 = zero($rowtindakan08['kotind02']+1,2);
							
							$tindakanbaru = $_POST['tindakanbaru'.$t];
							$sqlinsert_08 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
												VALUES ("'.$kolamp.'","0","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah08.'","'.$tindakanbaru.'")';
							mysql_query($sqlinsert_08)or die(mysql_error());

						}else {
							$sqltndkan08 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
								FROM m_tarif2012
								WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
								$tindakan08 = mysql_query($sqltndkan08) or die (mysql_error());
								$rowtindakan08 = mysql_fetch_array($tindakan08);
								$tindakantambah08 = zero($rowtindakan08['kotind02']+1,2);
							
							$tindakanbaru = $_POST['tindakanbaru'.$t];
								$sqlinsert_08 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
													VALUES ("'.$kolamp.'","0","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah08.'","'.$tindakanbaru.'")';
								mysql_query($sqlinsert_08)or die(mysql_error());
						}
					$t++;
					}
				}
		}
	}
	
	if ($kolamp == "09"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "09" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.'.zero($sblum,2);
			$nama_grup  = $grupnama;
			$sqlinsert_09 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "09","Pelayanan Pemulasaran Jenazah","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_09)or die(mysql_error());
		}else{
			$gruptambah = $grup;
			$sqlnamagrup = 'SELECT nama_tindakan
							FROM m_tarif2012
							WHERE kode_tindakan =  "'.$grup.'" ';
			$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
			$rowtindakannama = mysql_fetch_array($tindakannama);
			$nama_grup = $rowtindakannama['nama_tindakan'];
					
			if ($hit == ''){
				$sqltndkan09 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
							$tindakan09 = mysql_query($sqltndkan09) or die (mysql_error());
							$rowtindakan09 = mysql_fetch_array($tindakan09);
							$tindakantambah09 = zero($rowtindakan09['kotind02']+1,2);
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
								VALUES ("'.$kolamp.'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah09.'","'.$tindakanbaru1.'")';
					mysql_query($sqlinsert_01)or die(mysql_error());
				}else{
					$t=1;
					while ($t<=$hit){
						$sqltndkan09 = 'SELECT SUBSTR( MAX( kode_tindakan ),7,2) AS kotind02
							FROM m_tarif2012
							WHERE kode_gruptindakan =  "'.$gruptambah.'" and CHAR_LENGTH(kode_tindakan) = "8"';
							$tindakan09 = mysql_query($sqltndkan09) or die (mysql_error());
							$rowtindakan09 = mysql_fetch_array($tindakan09);
							$tindakantambah09 = zero($rowtindakan09['kotind02']+1,2);
						
						$tindakanbaru = $_POST['tindakanbaru'.$t];
						$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
											VALUES ("'.$kolamp.'","'.$gruptambah.'","'.$rowtindakannama['nama_tindakan'].'","'.$gruptambah.'.'.$tindakantambah09.'","'.$tindakanbaru.'")';
						mysql_query($sqlinsert_01)or die(mysql_error());	
					$t++;
				}
			}
			
		}
	}
?>
<SCRIPT language="JavaScript">
    alert("Data Telah Disimpan.");
    window.location="../m_tarif/index.php";
</SCRIPT><?php
}
}
?>

