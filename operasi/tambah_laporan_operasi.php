<?php session_start();
include '../include/connect.php';
include '../include/function.php';

$tindakan		= $_POST['tindakan'];
$pembedahan		= $_POST['pembedahan'];
$pemeriksaanPA	= $_POST['pemeriksaanPA'];
$jaringan		= $_POST['jaringan'];
$macamoperasi	= $_POST['macamoperasi'];
$jamselesai		= $_POST['jamselesai'];
$jammulai		= $_POST['jammulai'];
$laporan		= $_POST['laporan'];

$idxdaftar		= $_REQUEST['idxdaftar'];
$nomr			= $_REQUEST['nomr'];
$jnsoperasi		= $_REQUEST['jnsoperasi'];

$icd9			= $_REQUEST['icd9'];
$icd10			= $_REQUEST['icd10'];
$keluar			= $_REQUEST['keluar'];


$dokteroperator			= getDokterName($_POST['dokteroperator']);
$kode_dokteroperator 	= $_POST['dokteroperator'];

$dokteranastesi			= getDokterName($_POST['dokteranastesi']);
$kode_dokteranastesi 	= $_POST['dokteranastesi'];

$dokteranak			= getDokterName($_POST['dokteranak']);
$kode_dokteranak 	= $_POST['dokteranak'];

$asistenoperator= $_POST['asistenoperator'];
$perawatinstrumen= $_POST['perawatinstrumen'];
$perawatsirkuler= $_POST['perawatsirkuler'];


	// Jika pasien dari kamar operasi dan statusnya di pulangkan maka kamar langsung kosong kembali.
if( ($_REQUEST['noruang'] == 15) && ($keluar == 'pulang') ){
	mysql_query('update t_admission set keluarrs = NOW(), NIP = "'.$_SESSION['NIP'].'" where id_admission = "'.$idxdaftar.'" and nomr = "'.$nomr.'"');
}
	
if($jamselesai != ''){
	$jamselesai = 'jamselesai = "'.$jamselesai.'"';
}else{
	$jamselesai = 'jamselesai = CURTIME()';
}

$update="UPDATE t_operasi SET jammulai='".$jammulai."',tindakan='".$tindakan."',pembedahan='".$pembedahan."',pemeriksaanPA='".$pemeriksaanPA."',jaringan='".$jaringan."',macamoperasi='".$macamoperasi."',jamselesai='".$jamselesai."',laporan='".$laporan."', dokteroperator = '".$dokteroperator."', dokteranastesi = '".$dokteranastesi."', kode_dokteroperator = '".$kode_dokteroperator."', kode_dokteranastesi = '".$kode_dokteranastesi."', dokteranak = '".$dokteranak."', kode_dokteranak = '".$kode_dokteranak."',
asistenoperator = '".$asistenoperator."', perawatinstrumen = '".$perawatinstrumen."',
perawatsirkuler = '".$perawatsirkuler."', ".$jamselesai.", ICD9= '".$icd9."', ICD10 = '".$icd10."', KELUAR = '".$keluar."',
status = 'selesai' WHERE id_operasi='".$_POST['id']."'";
mysql_query($update) or die(mysql_error());

?>
<SCRIPT language="JavaScript">
alert("Data Telah Disimpan.")
window.location="index.php?link=20";
</SCRIPT>

