<?php session_start();
include("../include/connect.php");
include("../include/function.php");

if(empty($_POST['PENDIDIKAN'])){
	$pendidikan = "NULL";
}else{
	$pendidikan = $_POST['PENDIDIKAN'];
}
if(empty($_POST['AGAMA'])){
	$agama = "NULL";
}else{
	$agama = $_POST['AGAMA'];
}
if(empty($_POST['STATUS'])){
	$status = "NULL";
}else{
	$status = $_POST['STATUS'];
}
if(!empty($_POST['KDDOKTER'])){
	   $dokter = trim($_POST['KDDOKTER']);
	}else{
	   $dokter = "NULL";
}

$nomr 		= "";
$sql_nomr 	= "select NOMR from m_pasien_aps order by NOMR desc limit 1";
$get_nomr 	= mysql_query($sql_nomr);
if(mysql_num_rows($get_nomr) > 0){
     $dat_nomr = mysql_fetch_assoc($get_nomr);
	 $nomrx = $dat_nomr['NOMR'] + 1;
	 $nomr = substr("00000",0,5-strlen($nomrx)).$nomrx;
}else{
     $nomr = "00001";
}

$tmpTGLLAHIR = date('Y-m-d', strtotime(str_replace('/','-',$_POST['TGLLAHIR'])));
$sqlinsert_pasien = "INSERT INTO m_pasien_aps ( NOMR, NAMA, TEMPAT, TGLLAHIR, JENISKELAMIN, ALAMAT, KELURAHAN, KDKECAMATAN, KOTA, KDPROVINSI, NOTELP, NOKTP, SUAMI_ORTU,PEKERJAAN, STATUS,AGAMA, PENDIDIKAN,KDCARABAYAR, NIP)
VALUES('".$nomr."','".trim($_POST['NAMA'])."','".trim($_POST['TEMPAT'])."','".trim($tmpTGLLAHIR)."','".trim($_POST['JENISKELAMIN'])."','".trim($_POST['ALAMAT'])."','".trim($_POST['KELURAHAN'])."','".trim($_POST['KDKECAMATAN'])."','".trim($_POST['KOTA'])."','".trim($_POST['KDPROVINSI'])."','".trim($_POST['NOTELP'])."','".trim($_POST['NOKTP'])."','".trim($_POST['SUAMI_ORTU'])."','".trim($_POST['PEKERJAAN'])."','".trim($status)."','".trim($agama)."','".trim($pendidikan)."','".trim($_POST['KDCARABAYAR'])."','".trim($_SESSION['NIP'])."')";
mysql_query($sqlinsert_pasien)or die(mysql_error());	

$sqlinsert_pendaftaran_aps = " INSERT INTO t_pendaftaran_aps (NOMR, TGLREG, KDDOKTER, KDPOLY, KDRUJUK, KDCARABAYAR, NOJAMINAN, SHIFT, `STATUS`, PASIENBARU, NIP, KETRUJUK, UNIT) VALUES('".$nomr."','".trim($_POST['TGLREG'])."',".$dokter.","."NULL".",".trim($_POST['KDRUJUK']).",".trim($_POST['KDCARABAYAR']).",'".trim($_POST['NOJAMINAN'])."',".trim($_POST['SHIFT']).",0,"."NULL".",'".trim($_SESSION['NIP'])."','".trim($_POST['KETRUJUK'])."','l')";
$sqldaf = mysql_query($sqlinsert_pendaftaran_aps)or die(mysql_error());
$idxdaftar = mysql_insert_id();

# inser to tmp_carorderlab ( pendaftaran sebagai pasien lab )
mysql_query('insert into tmp_cartorderrad set IP ="'.getRealIpAddr().'", KET = "APS", UNIT = "'.$_SESSION['KDUNIT'].'", NOMR = "'.$nomr.'", IDXDAFTAR = "'.$idxdaftar.'", TGLDAFTAR = "'.date('Y-m-d').'", NIP = "'.$_SESSION['NIP'].'", APS = "1",RAJAL = "1", CARABAYAR = "'.$_REQUEST['KDCARABAYAR'].'"');

header("Location:../index.php?link=7&idx=".$idxdaftar);
#exit;
?>

