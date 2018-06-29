<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
if($_GET['edit']=="kualitas"){
	$sqlinsert_pendaftaran = " INSERT INTO m_supvis (KODESUP, METSUP, JADSUP, TOPSUP, SUP, YGSUP, HASSUP) VALUES('K','".trim($_POST['METSUP'])."','".trim($_POST['TGLLAHIR'])."','".trim($_POST['TOPSUP'])."','".trim($_POST['SUP'])."','".trim($_POST['YGSUP'])."','".trim($_POST['HASSUP'])."')";
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
 ?>
  <script language="javascript">
	alert("Tambah Supervisi Kualitas Asuhan Keperawatan Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=supvis";
 </script>

 <?
} else if($_GET['edit']=="manajemen"){
	$sqlinsert_pendaftaran = " INSERT INTO m_supvis (KODESUP, KEPRU, KEPKEP, KEPSEK, METSUP, JADSUP, TOPSUP, SUP, YGSUP, HASSUP) VALUES('M','".trim($_POST['KEPRU'])."','".trim($_POST['KEPKEP'])."','".trim($_POST['KEPSEK'])."','".trim($_POST['METSUP'])."','".trim($_POST['TGLREG'])."','".trim($_POST['TOPSUP'])."','".trim($_POST['SUP'])."','".trim($_POST['YGSUP'])."','".trim($_POST['HASSUP'])."')";
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
 ?>
 <script language="javascript">
	alert("Tambah Supervisi Manajemen Pelayanan Keperawatan Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=supvis";
 </script>
 <?
} else if($_GET['edit']=="luar"){
	$sqlinsert_pendaftaran = " INSERT INTO m_supvis (KODESUP, JADSUP, TOPSUP, SUP, YGSUP, HASSUP) VALUES('L','".trim($_POST['tgl_pesan'])."','".trim($_POST['TOPSUP'])."','".trim($_POST['SUP'])."','".trim($_POST['YGSUP'])."','".trim($_POST['HASSUP'])."')";
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
 ?>
 <script language="javascript">
	alert("Tambah Supervisi di Luar Jam Kerja Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=supvis";
 </script>
 <?
}
?>