<?php session_start();
include("../include/connect.php");

$idxdaftar = $_POST['id_admission'];
$icd_code = $_POST['icd_code'];


	$sql = "UPDATE t_resumepulang SET icdkeluar= '".$icd_code."'
		WHERE idadmission = '".$idxdaftar."'";
  		$get = mysql_query($sql);

?>
<script language="javascript">
window.location="../index.php?link=138&page=<?=$_POST['page']?>&tgl_kunjungan=<?=$_POST['tgl_kunjungan']?>&tgl_kunjungan2=<?=$_POST['tgl_kunjungan2']?>";
</script>