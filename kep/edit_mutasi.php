<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
$NIP=$_POST['NIP'];
if($_POST['TEMKERTUJ2'] == "L"){
	$TEMKER2 = $_POST['TEMKERTUJ2']." ".$_POST['NAMALAINTUJ'];
}else{
	$TEMKER2 = $_POST['TEMKERTUJ2'];
}
  
  $sqlupdate_pasien = "UPDATE m_perawat SET
				  TEMKERTUJ  = '".trim($_POST['TEMKERTUJ'])."',
				  TEMKERTUJ2 = '".$TEMKER2."',  
				  TGLMUTASI  = '".trim($_POST['TGLLAHIR'])."'
			WHERE IDPERAWAT = '".trim($_POST['IDPERAWAT'])."' ";
			mysql_query($sqlupdate_pasien)or die(mysql_error());
 ?>
  <script language="javascript">
	alert("Simpan Mutasi Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=list_kep";
 </script>