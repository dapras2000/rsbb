<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
if(($_POST['implementasi'] =="") || ($_POST['evaluasi_s'] =="") || ($_POST['evaluasi_o'] =="") || ($_POST['evaluasi_a'] =="") || ($_POST['evaluasi_p'] =="")) {
 ?>
 <script language="javascript">
	alert("Maaf Input Detail Diagnosa Keperawatan Belum Lengkap");
	window.location="<?php echo _BASE_;?>index.php?link=det_diagnosa_kep&NOMR=<?=$_POST['nomr']?>&nama=<?=$_POST['nama']?>&idadmission=<?=$_POST['idadmission']?>&iddiagkep=<?=$_POST['id_diagkep']?>";
 </script>
 <?
} else {
	if(!isset($_POST['id_detail_diagkep'])) {
		$sqlinsert_pendaftaran = " INSERT INTO t_detail_diagnosakep (id_diagnosakep, implementasi, evaluasi_s, evaluasi_o, evaluasi_a, evaluasi_p, perawat, tgl) VALUES('".trim($_POST['id_diagkep'])."','".$_POST['implementasi']."','".$_POST['evaluasi_s']."','".$_POST['evaluasi_o']."','".$_POST['evaluasi_a']."','".$_POST['evaluasi_p']."','".trim($_POST['perawat'])."',now())";
		mysql_query($sqlinsert_pendaftaran)or die(mysql_error());
	 ?>
	 <script language="javascript">
		alert("Penyimpanan Data Sukses ");
		window.location="<?php echo _BASE_;?>index.php?link=det_diagnosa_kep&NOMR=<?=$_POST['nomr']?>&nama=<?=$_POST['nama']?>&idadmission=<?=$_POST['idadmission']?>&iddiagkep=<?=$_POST['id_diagkep']?>";
	 </script>
	 <?
	} else {
		$sqlupdate = "UPDATE t_detail_diagnosakep SET
						  id_diagnosakep = '".trim($_POST['id_diagkep'])."',
						  implementasi  = '".$_POST['implementasi']."',
						  evaluasi_s  = '".$_POST['evaluasi_s']."',
						  evaluasi_o  = '".$_POST['evaluasi_o']."', 
						  evaluasi_a  = '".$_POST['evaluasi_a']."', 
						  evaluasi_p  = '".$_POST['evaluasi_p']."',
						  perawat= '".$_POST['perawat']."'
					WHERE id_detail_diagnosakep = '".trim($_POST['id_detail_diagkep'])."' ";
					mysql_query($sqlupdate)or die(mysql_error());
		 ?>
		  <script language="javascript">
			alert("Edit Data Detail Diagnosa Keperawatan Sukses");
			window.location="<?php echo _BASE_; ?>index.php?link=det_diagnosa_kep&NOMR=<?=$_POST['nomr']?>&nama=<?=$_POST['nama']?>&idadmission=<?=$_POST['idadmission']?>&iddiagkep=<?=$_POST['id_diagkep']?>";
		 </script>

		 <?
	}
}
?>