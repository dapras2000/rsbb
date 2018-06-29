<?
$idoperasi=$_GET['idoperasi'];
$tanggal=$_GET['tanggal'];
//$nourut;
include("../include/connect.php");
$ret_operasi="delete from t_operasi_tindakan_medis where nourut='".$_GET['nourut']."'";
mysql_query($ret_operasi);
header("Location:../index.php?link=209&idoperasi=".$idoperasi."&tanggal=".$tanggal."");
?>

