<?
include("../include/connect.php");
$ins="delete from t_admission where id_admission='".$_GET['id']."'";
mysql_query($ins);
header("Location:../index.php?link=171&no=".$_GET['no']);
?>
<!--<script language="javascript">
alert("Sukses Menghapus Data");
window.location="../index.php?link=171&no=";
</script>-->
