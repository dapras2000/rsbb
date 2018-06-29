<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
$NIP=$_POST['NIP'];
$tampungPROGPENG = "";
foreach($_POST['PROGPENG'] as $PROGPENG) 
{
	$tampungPROGPENG = $tampungPROGPENG.$PROGPENG.",";
}
$tampungPROGPENG = substr_replace($tampungPROGPENG ,"",-1);

  $sqlupdate_pasien = "UPDATE m_perawat SET
				  PROGPENDIDIKAN  = '".trim($_POST['PROGPENDIDIKAN'])."',
				  PROGPENG = '".$tampungPROGPENG."'
			WHERE IDPERAWAT = '".trim($_POST['IDPERAWAT'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());
 ?>
  <script language="javascript">
	alert("Simpan Program Pengembangan Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=list_kep";
 </script>