<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
$_SESSION['hal']="2"; 
$sql_dokter	= mysql_query("SELECT * from m_penugasan_perawat where id='$_POST[id]'");
$ketemu= mysql_num_rows($sql_dokter);
$n = 0;
while($dd = mysql_fetch_array($sql_dokter)){
	++$n;
}
if($ketemu <= 0){
	$sqlinsert_pendaftaran = " INSERT INTO m_penugasan_perawat (KETUATIM, ANGGOTATIM, ANGGOTATIM2, ANGGOTATIM3, ANGGOTATIM4, ANGGOTATIM5, PEMBAGIAN1, MODULER1, MODULER2, PEMBAGIAN2, PRIMER1, PRIMER2, PEMBAGIAN3, CCM, PEMBAGIAN4, TANGGAL) VALUES('".trim($_POST['KETUATIM'])."','".trim($_POST['ANGGOTATIM'])."','".trim($_POST['ANGGOTATIM2'])."','".trim($_POST['ANGGOTATIM3'])."','".trim($_POST['ANGGOTATIM4'])."','".trim($_POST['ANGGOTATIM5'])."','".trim($_POST['PEMBAGIAN1'])."','".trim($_POST['MODULER1'])."','".trim($_POST['MODULER2'])."','".trim($_POST['PEMBAGIAN2'])."','".trim($_POST['PRIMER1'])."','".trim($_POST['PRIMER2'])."','".trim($_POST['PEMBAGIAN3'])."','".trim($_POST['CCM'])."','".trim($_POST['PEMBAGIAN4'])."','".trim($_POST['tgl'])."')";
	mysql_query($sqlinsert_pendaftaran)or die(mysql_error());}
else if($n > 0) {
	$sqlupdate_pasien = "UPDATE m_penugasan_perawat SET
				  KETUATIM  = '".trim($_POST['KETUATIM'])."',
				  ANGGOTATIM = '".trim($_POST['ANGGOTATIM'])."',
				  ANGGOTATIM2 = '".trim($_POST['ANGGOTATIM2'])."',
				  ANGGOTATIM3 = '".trim($_POST['ANGGOTATIM3'])."',
				  ANGGOTATIM4 = '".trim($_POST['ANGGOTATIM4'])."',
				  ANGGOTATIM5 = '".trim($_POST['ANGGOTATIM5'])."',
				  PEMBAGIAN1 = '".trim($_POST['PEMBAGIAN1'])."',
				  MODULER1 = '".trim($_POST['MODULER1'])."',
				  MODULER2 = '".trim($_POST['MODULER2'])."',
				  PEMBAGIAN2 = '".trim($_POST['PEMBAGIAN2'])."',
				  PRIMER1 = '".trim($_POST['PRIMER1'])."',
				  PRIMER2 = '".trim($_POST['PRIMER2'])."',
				  PEMBAGIAN3 = '".trim($_POST['PEMBAGIAN3'])."',
				  CCM = '".trim($_POST['CCM'])."',
				  PEMBAGIAN4 = '".trim($_POST['PEMBAGIAN4'])."',
				  TANGGAL= '".trim($_POST['tgl'])."'
					where id= '".trim($_POST['id'])."'
				   ";
	mysql_query($sqlupdate_pasien)or die(mysql_error());
}
 ?>
  <script language="javascript">
	alert("Simpan Metode Penugasan Sukses");
	window.location="<?php echo _BASE_; ?>index.php?link=met_gas";
 </script>