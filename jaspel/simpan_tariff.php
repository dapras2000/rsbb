<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");

echo "Proses belum bisa";
$kolamp = $_POST['kolamp'];
$grup	= $_POST['GRUP'];
$tindakan = $_POST['KDTINDAKAN'];
$subtindakan = $_POST['SUBTINDAKAN'];
$poli = $_POST['poli'];
$profesi = $_POST['profesi'];
$dokter = $_POST['dokter'];
$kelas = $_POST['kelas'];
$grupnama = $_POST['GRUPNAMA'];
$tindakanbaru1 = $_POST['tindakanbaru1'];
$hit = $_POST['hit'];
$grupnama = $_POST['GRUPNAMA'];




echo " &&kolamp : ".$kolamp; 
echo " &&grup : ".$grup;	
echo " &&tindakan : ".$tindakan ;
echo " &&subtindakan : ".$subtindakan; 
echo " &&poli : ".$poli ;
echo " &&profesi : ".$profesi ;
echo " &&dokter : ".$dokter ;
echo " &&kelas : ".$kelas ;
echo " &&GRUPNAMA  : ".$grupnama ;
echo " &&hit  : ".$hit ;
echo " &&tindakanbaru1  : ".$tindakanbaru1 ;

if(isset($_POST['simpan'])){
	if ($kolamp == "01"){
		if($grupnama != ''){
			$sqlgrup = 'SELECT SUBSTR( MAX( kode_tindakan ),4,2) AS kotind2
							FROM m_tarif2012
							WHERE kode_lampiran =  "01" and CHAR_LENGTH(kode_tindakan) = "5"';
			$rowsqlgrup = mysql_query($sqlgrup) or die (mysql_error());
			$row2sqlgrup = mysql_fetch_array($rowsqlgrup);

			$sblum = $row2sqlgrup['kotind2']+1;
			$gruptambahawal = $kolamp.'.0'.$sblum;
			$gruptambah = $kolamp.'.0'.$sblum;
			$nama_grup  = $grupnama;
			$sqlinsert_00 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "01","Pelayanan Rawat Jalan","'.$gruptambahawal.'","'.$nama_grup.'")';
			
			mysql_query($sqlinsert_00)or die(mysql_error());
		}else{
			$gruptambah = $grup;
			$sqlnamagrup = 'SELECT nama_tindakan
							FROM m_tarif2012
							WHERE kode_tindakan =  "'.$grup.'" ';
			$tindakannama = mysql_query($sqlnamagrup) or die (mysql_error());
			$rowtindakannama = mysql_fetch_array($tindakannama);
			$nama_grup = $rowtindakannama['nama_tindakan'];
			$sqltndkan = 'SELECT SUBSTR( MAX( kode_gruptindakan ),7,2) AS kotind
							FROM m_tarif2012
							WHERE kode_lampiran =  "01" and CHAR_LENGTH(kode_gruptindakan) = "8"';
			$tindakan = mysql_query($sqltndkan) or die (mysql_error());
			$rowtindakan = mysql_fetch_array($tindakan);

			$tindakantambah = $rowtindakan['kotind']+1;
				
		
			$baru = $gruptambah.".".$tindakantambah;
				
			echo "ananan ".$baru;
				
			$sqlnamapoli = 'SELECT nama
							FROM m_poly
							WHERE kode =  "'.$poli.'" ';
			$namapoli = mysql_query($sqlnamapoli) or die (mysql_error());
			$rownamapoli = mysql_fetch_array($namapoli);

			$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi).'","'.$gruptambah.'","'.$nama_grup.'","'.$baru.'","'.$nama_grup.' '.$rownamapoli['nama'].'")';
			
			mysql_query($sqlinsert_01)or die(mysql_error());
		}


		if ($gruptambah == "01.01"){
			$i = 1;
			$x = 1;
			while($i <= 3 && $x <= 3){
				if ($i == '1'){
					$profesi2 = "1";
					$baru4 = "Pemeriksaan dan Konsultasi dokter spesialis";
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi2).'","'.$baru.'","'.$nama_grup.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
			
					mysql_query($sqlinsert_01)or die(mysql_error());
				} else if ($i == '2'){
					$profesi2 = "0";
					$baru4 = "Pemeriksaan dan Konsultasi dokter umum";
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi2).'","'.$baru.'","'.$nama_grup.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
			
					mysql_query($sqlinsert_01)or die(mysql_error());
				}else {
					$profesi2 = "3";
					$baru4 = "Pemeriksaan dan Konsultasi tenaga ahli lain";
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
									
								VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi2).'","'.$baru.'","'.$nama_grup.' '.$rownamapoli['nama'].'","'.$baru.'.0'.$x.'","'.$baru4.'")';
			
					mysql_query($sqlinsert_01)or die(mysql_error());
				}
				$i++;
				$x++;
			}
		}
		if ($grup != "01.01"){
			if ($hit == ''){
				$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
							VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi).'","'.$baru.'","'.$rowtindakannama['nama_tindakan'].'","'.$baru.'.001","'.$tindakanbaru1.'")';
				mysql_query($sqlinsert_01)or die(mysql_error());
			}else{
				for ($t=1;$t<=$hit;$t++){
					
					$tindakanbaru = $_POST['tindakanbaru'.$t];
					$sqlinsert_01 = 'INSERT INTO m_tarif2012 (kode_lampiran, kode_unit, kode_profesi, kode_gruptindakan, nama_gruptindakan, kode_tindakan, nama_tindakan) 
										VALUES ("'.$kolamp.'", "'.intval($poli).'","'.intval($profesi).'","'.$baru.'","'.$rowtindakannama['nama_tindakan'].' '.$rownamapoli['nama'].'","'.$baru.'.00'.$t.'","'.$tindakanbaru.'")';
					mysql_query($sqlinsert_01)or die(mysql_error());	
				
				}
			}
		}
		
	}

	if ($kolamp == "02"){
		echo "kode lampiran 02";
	}
	
	if ($kolamp == "03"){
		echo "kode lampiran 03";
	}
	
	if ($kolamp == "04"){
		echo "kode lampiran 04";
	}
	
	if ($kolamp == "05"){
		echo "kode lampiran 05";
	}
	
	if ($kolamp == "06"){
		echo "kode lampiran 06";
	}
	
	if ($kolamp == "07"){
		echo "kode lampiran 07";
	}
	
	if ($kolamp == "08"){
		echo "kode lampiran 08";
	}
	
	if ($kolamp == "08"){
		echo "kode lampiran 09";
	}
	
}
?>
<SCRIPT language="JavaScript">
    alert("Data Telah Disimpan.");
    window.location="../index.php?link=jas11";
</SCRIPT>
