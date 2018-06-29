<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
$NIP=$_POST['NIP'];
$tampungpelmankep = "";
foreach($_POST['PELMANKEP'] as $pelmankep) 
{
	$tampungpelmankep = $tampungpelmankep.$pelmankep.",";
}
$tampungpelmankep = substr_replace($tampungpelmankep ,"",-1);
$tampungPELTEKKEPGAW = "";
foreach($_POST['PELTEKKEPGAW'] as $PELTEKKEPGAW) 
{
	$tampungPELTEKKEPGAW = $tampungPELTEKKEPGAW.$PELTEKKEPGAW.",";
}
$tampungPELTEKKEPGAW = substr_replace($tampungPELTEKKEPGAW ,"",-1);
$tampungPELTEKKEPMEDAH = "";
foreach($_POST['PELTEKKEPMEDAH'] as $PELTEKKEPMEDAH) 
{
	$tampungPELTEKKEPMEDAH = $tampungPELTEKKEPMEDAH.$PELTEKKEPMEDAH.",";
}
$tampungPELTEKKEPMEDAH = substr_replace($tampungPELTEKKEPMEDAH ,"",-1);
$tampungPELTEKKEPNAK = "";
foreach($_POST['PELTEKKEPNAK'] as $PELTEKKEPNAK) 
{
	$tampungPELTEKKEPNAK = $tampungPELTEKKEPNAK.$PELTEKKEPNAK.",";
}
$tampungPELTEKKEPNAK = substr_replace($tampungPELTEKKEPNAK ,"",-1);
$tampungPELTEKKEPMAT = "";
foreach($_POST['PELTEKKEPMAT'] as $PELTEKKEPMAT) 
{
	$tampungPELTEKKEPMAT = $tampungPELTEKKEPMAT.$PELTEKKEPMAT.",";
}
$tampungPELTEKKEPMAT = substr_replace($tampungPELTEKKEPMAT ,"",-1);
$tampungPELTEKKEPJIWA = "";
foreach($_POST['PELTEKKEPJIWA'] as $PELTEKKEPJIWA) 
{
	$tampungPELTEKKEPJIWA = $tampungPELTEKKEPJIWA.$PELTEKKEPJIWA.",";
}
$tampungPELTEKKEPJIWA = substr_replace($tampungPELTEKKEPJIWA ,"",-1);
if($_POST['TEMKER2'] == "L"){
	$TEMKER2 = $_POST['TEMKER2']." ".$_POST['NAMALAIN'];
}else{
	$TEMKER2 = $_POST['TEMKER2'];
}
if($_GET['edit']=="ok"){
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
$tmpTGLLAHIR = date('Y-m-d', strtotime(str_replace('/','-',$_POST['TGLLAHIR'])));
  
  $sqlupdate_pasien = "UPDATE m_perawat SET
				  NIP = '".$_POST['NIP']."',
				  NAMA  = '".trim($_POST['NAMA'])."',  
				  TEMPAT  = '".trim($_POST['TEMPAT'])."',  
				  TGLLAHIR  = '".trim($tmpTGLLAHIR)."', 
				  JENISKELAMIN  = '".trim($_POST['JENISKELAMIN'])."', 
				  ALAMAT  = '".trim($_POST['ALAMAT'])."', 
				  KELURAHAN  = '".trim($_POST['KELURAHAN'])."', 
				  KDKECAMATAN  = '".trim($_POST['KDKECAMATAN'])."', 
				  KOTA  = '".trim($_POST['KOTA'])."', 
				  KDPROVINSI  = '".trim($_POST['KDPROVINSI'])."', 
				  NOTELP  = '".trim($_POST['NOTELP'])."', 
				  NOKTP  = '".trim($_POST['NOKTP'])."',  
				  STATUS  = '".$status."', 
				  AGAMA  = '".$agama."',  
				  PENDIDIKAN  = '".$pendidikan."', 
				  ALAMAT_KTP  = '".trim($_POST['ALAMAT_KTP'])."',
				  JABFUNG  = '".trim($_POST['JABFUNG'])."',
				  JABSTRUK  = '".trim($_POST['JABSTRUK'])."',
				  JABLAIN  = '" . trim($_POST['JABLAIN']) . "',
				  LAMKER  = '".trim($_POST['LAMKER'])."',
				  TEMKER  = '".trim($_POST['TEMKER'])."',
				  PELMANKEP = '".$tampungpelmankep."',
				  PELTEKKEPGAW = '".$tampungPELTEKKEPGAW."',
				  PELTEKKEPMEDAH = '".$tampungPELTEKKEPMEDAH."',
				  PELTEKKEPNAK = '".$tampungPELTEKKEPNAK."',
				  PELTEKKEPMAT = '".$tampungPELTEKKEPMAT."',
				  PELTEKKEPJIWA = '".$tampungPELTEKKEPJIWA."',
				  TEMKER2 = '".$TEMKER2."'
			WHERE IDPERAWAT = '".trim($_POST['IDPERAWAT'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());
 ?>
  <script language="javascript">
	alert("Edit Data Perawat Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=list_kep";
 </script>

 <?
} else if($_GET['edit']=="no"){

if($_POST['NIP'] ==""){
	
 ?>
 <script language="javascript">
	alert("Maaf Input Perawat Belum Lengkap");
	window.location="<?php echo _BASE_;?>index.php?link=kep2";
 </script>
 <?
	} else {
	$tmpTGLLAHIR = date('Y-m-d', strtotime(str_replace('/','-',$_POST['TGLLAHIR'])));
 $sqlinsert_pendaftaran = " INSERT INTO m_perawat (NIP, NAMA, TEMPAT, TGLLAHIR, JENISKELAMIN, ALAMAT, KELURAHAN, KDKECAMATAN, KOTA, KDPROVINSI, NOTELP, NOKTP, STATUS, AGAMA, PENDIDIKAN, ALAMAT_KTP, JABFUNG, JABSTRUK, LAMKER, TEMKER, PELMANKEP, PELTEKKEPGAW, PELTEKKEPMEDAH, PELTEKKEPNAK, PELTEKKEPMAT, PELTEKKEPJIWA, TEMKER2, JABLAIN) VALUES('".trim($_POST['NIP'])."','".trim($_POST['NAMA'])."','".trim($_POST['TEMPAT'])."','".trim($tmpTGLLAHIR)."','".trim($_POST['JENISKELAMIN'])."','".trim($_POST['ALAMAT'])."','".trim($_POST['KELURAHAN'])."','".trim($_POST['KDKECAMATAN'])."','".trim($_POST['KOTA'])."','".trim($_POST['KDPROVINSI'])."','".trim($_POST['NOTELP'])."','".trim($_POST['NOKTP'])."','".trim($_POST['STATUS'])."','".trim($_POST['AGAMA'])."','".trim($_POST['PENDIDIKAN'])."','".trim($_POST['ALAMAT_KTP'])."','".trim($_POST['JABFUNG'])."','".trim($_POST['JABSTRUK'])."','".trim($_POST['LAMKER'])."','".trim($_POST['TEMKER'])."','".trim($_POST['JABLAIN'])."','".$tampungpelmankep."','".$tampungPELTEKKEPGAW."','".$tampungPELTEKKEPMEDAH."','".$tampungPELTEKKEPNAK."','".$tampungPELTEKKEPMAT."','".$tampungPELTEKKEPJIWA."','".$TEMKER2."')";
 echo'$$sqlinsert_pendaftaran';
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
 ?>
 <script language="javascript">
	alert("Penyimpanan Data Sukses ");
	window.location="<?php echo _BASE_;?>index.php?link=list_kep";
 </script>
 <?
// header('location:../?link=21');
	}
}

?>