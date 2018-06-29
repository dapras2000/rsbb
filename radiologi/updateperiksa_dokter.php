<? session_start();
include_once("../include/connect.php");
$larikdokter=$_POST['dokter'];
$idx_order 	= $_POST['idxorder']; 
$resume 	= $_POST['resume']; 
$edit1="update t_radiologi set HASILRESUME='".$resume."', DRRADIOLOGI='".$larikdokter."' where idxorderrad='".$idx_order."'";
mysql_query($edit1);
?>
<script language="javascript">
  alert("Update Sukess");
  window.location="<?php echo _BASE_;?>/index.php?link=71";
</script>