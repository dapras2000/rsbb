<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
if(($_POST['implementasi'] =="") || ($_POST['evaluasi_s'] =="") || ($_POST['evaluasi_o'] =="") || ($_POST['evaluasi_a'] =="") || ($_POST['evaluasi_p'] =="")) {
 ?>
 <script language="javascript">
	alert("Maaf, Input Detail Diagnosa Keperawatan Belum Lengkap");
	window.location="<?php echo _BASE_;?>index.php?link=121&id_admission=<?=$_POST['idadmission']?>";
 </script>
 <?
 }else {
	if(!isset($_POST['id_detail_diagkep'])) {
		$sqlinsert_pendaftaran = " INSERT INTO t_detail_diagnosakep (id_diagnosakep, implementasi, evaluasi_s, evaluasi_o, evaluasi_a, evaluasi_p, perawat, tgl) VALUES('".trim($_POST['id_diagkep'])."','".$_POST['implementasi']."','".$_POST['evaluasi_s']."','".$_POST['evaluasi_o']."','".$_POST['evaluasi_a']."','".$_POST['evaluasi_p']."','".trim($_POST['perawat'])."',now())";
		mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
	 ?>
	 <script language="javascript">
		alert("Penyimpanan Data Sukses ");
		window.location="<?php echo _BASE_;?>index.php?link=121&id_admission=<?=$_POST['idadmission']?>";
	 </script>
	 <?
	}
}
?>