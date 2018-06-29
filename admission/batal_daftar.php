<? 
include('../include/connect.php');
#mysql_select_db($database_conrawatinap,$conrawatinap);
$ins="UPDATE t_orderadmission SET `STATUS` = '1' WHERE  t_orderadmission.IDXORDER ='".$_GET['no']."'";
mysql_query($ins);
header("Location:../index.php?link=17a");
?>
<!--<script language="javascript">
alert("Sukses Menghapus Data");
window.location="../index.php?link=171&no=";
</script>-->
