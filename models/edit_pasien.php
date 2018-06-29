<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
$nomr=$_POST['NOMR'];
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
  $sqlupdate_pasien = "UPDATE m_pasien SET
				  NOMR = '".$_POST['NOMR']."',
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
				  SUAMI_ORTU  = '".trim($_POST['SUAMI_ORTU'])."', 
				  PEKERJAAN  = '".trim($_POST['PEKERJAAN'])."',  
				  STATUS  = '".$status."', 
				  AGAMA  = '".$agama."',  
				  PENDIDIKAN  = '".$pendidikan."', 
				  KDCARABAYAR  = '".trim($_POST['KDCARABAYAR'])."',  
				  NIP  = '".trim($_SESSION['NIP'])."',
				  ALAMAT_KTP  = '".trim($_POST['ALAMAT_KTP'])."',
				  TGLDAFTAR  = '".trim($_POST['awaldaftar'])."'
			WHERE NOMR = '".trim($_POST['NOMRKEY'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());
 ?>
  <script language="javascript">
	alert("Edit Data Pasien Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=21";
 </script>

 <?
}

if($_POST['NOMR'] =="" || $_POST['KDDOKTER'] =="" || $_POST['KDPOLY'] =="" || $_POST['KDRUJUK'] =="" || $_POST['KDCARABAYAR'] =="" || $_POST['SHIFT'] ==""){
	
 ?>
 <script language="javascript">
	alert("Maaf Input Pendaftaran Belum Lengkap");
	window.location="<?php echo _BASE_;?>index.php?link=24&nomr=<? echo $nomr; ?>";
 </script>
 <?
	}
 $sqlinsert_pendaftaran = " INSERT INTO t_pendaftaran (NOMR, TGLREG, KDDOKTER, KDPOLY, KDRUJUK, KDCARABAYAR, NOJAMINAN, SHIFT, `STATUS`, PASIENBARU, NIP) VALUES('".trim($_POST['NOMR'])."','".trim($_POST['TGLREG'])."',".trim($_POST['KDDOKTER']).",".trim($_POST['KDPOLY']).",".trim($_POST['KDRUJUK']).",".trim($_POST['KDCARABAYAR']).",'".trim($_POST['NOJAMINAN'])."',".trim($_POST['SHIFT']).",0,".$_POST['PASIENBARU'].",'".trim($_SESSION['NIP'])."')";
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());	
 	
  $sqlupdate_pasien = "UPDATE m_pasien SET
				  NOMR = '".$_POST['NOMR']."'
				  NAMA  = '".trim($_POST['NAMA'])."', 
				  TEMPAT  = '".trim($_POST['TEMPAT'])."',  
				  TGLLAHIR  = '".trim($tmpTGLLAHIR)."', 
				  JENISKELAMIN  = '".trim($_POST['JENISKELAMIN'])."', 
				  ALAMAT  = '".trim($_POST['ALAMAT'])."', 
				  KELURAHAN  = '".trim($_POST['KELURAHAN'])."', 
				  KDKECAMATAN  = ".trim($_POST['KDKECAMATAN']).", 
				  KOTA  = '".trim($_POST['KOTA'])."', 
				  NOTELP  = '".trim($_POST['NOTELP'])."', 
				  NOKTP  = '".trim($_POST['NOKTP'])."',  
				  SUAMI_ORTU  = '".trim($_POST['SUAMI_ORTU'])."', 
				  PEKERJAAN  = '".trim($_POST['PEKERJAAN'])."',  
				  STATUS  = ".$status.", 
				  AGAMA  = ".$agama.",  
				  PENDIDIKAN  = ".$pendidikan.", 
				  KDCARABAYAR  = ".trim($_POST['KDCARABAYAR']).",  
				  NIP  = '".trim($_SESSION['NIP'])."'
			WHERE NOMR = '".trim($_POST['NOMRKEY'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());	

 ?>
 <script language="javascript">
	alert("Update Data Sukses ");
	window.location="<?php echo _BASE_;?>index.php?link=2";
 </script>
 <?
// header('location:../?link=21');

?>