<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
$NIP=$_POST['NIP'];
  $sqlupdate_pasien = "UPDATE m_perawat SET
				  ALASAN  = '".trim($_POST['ALASAN'])."',
				  TGLKELUAR  = '".trim($_POST['TGLLAHIR'])."'
			WHERE IDPERAWAT = '".trim($_POST['IDPERAWAT'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());
 ?>
  <script language="javascript">
	alert("Simpan Pengajuan Keluar Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=list_kep";
 </script>