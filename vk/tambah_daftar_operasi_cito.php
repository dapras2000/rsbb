<?
session_start();
$nomr= $_POST['nomroperasi'];
$tgloperasi=$_POST['tgl_operasi'];
$jammulai=$_POST['jammulai'];
$jamselesai=$_POST['jamselesai'];
$diagnosa= $_POST['diagnosa'];
$tindakan=$_POST['tindakan'];
$jenisanastesi="";
$metodeanastesi="";
$dokteroperator=$_POST['dokteroperator'];
$dokteranastesi=$_POST['dokteranastesi'];
$dokteranak=$_POST['dokteranak'];
$asistenoperator=$_POST['asistenoperator'];
$asistenanastesi=$_POST['asistenanastesi'];
$asistenanak=$_POST['asistenanak'];
$perawatinstrumen=$_POST['perawatinstrumen'];
$perawatsirkuler=$_POST['perawatsirkuler'];
$carabayar=$_POST['carabayar'];
$j_operasi=$_POST['j_operasi'];
$idxdaftar=$_POST['idxdaftar'];

include("../include/connect.php");
$ins_operasi="INSERT INTO t_operasi_cito Values('','$nomr','$tgl_operasi','$jammulai','NULL','$diagnosa','$tindakan','$jenisanastesi','$metodeanastesi','$dokteroperator','$dokteranastesi','$dokteranak','$asistenoperator','$asistenanastesi','$asistenanak','$perawatinstrumen','$perawatsirkuler','','','','','','$carabayar','0', '$j_operasi','$idxdaftar')";
mysql_query($ins_operasi);
header('Location:'._BASE_.'/index.php?link=51&nomr='.$nomr.'&menu=8&idx='.$idx.'&psn=sukses');
?>
