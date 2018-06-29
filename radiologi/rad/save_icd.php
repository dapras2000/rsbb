<?php session_start();
include("../include/connect.php");

$idxdaftar = $_POST['idxdaftar'];
$icd_code = $_POST['icd_code'];


	$sql = "UPDATE t_diagnosadanterapi SET ICD_CODE = '".$icd_code."'
		WHERE IDXDAFTAR = '".$idxdaftar."'";
  		$get = mysql_query($sql);

?>
<script language="javascript">
window.location="../index.php?link=13";
</script>