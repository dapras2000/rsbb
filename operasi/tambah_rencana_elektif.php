<?
//$nomr= $_POST['nomr'];
$tgloperasi=$_POST['tgl_operasi'];
//$jammulai=$_POST['jammulai'];
//$jamselesai=$_POST['jamselesai'];
$diagnosa= $_POST['diagnosa'];
$keterangan= $_POST['keterangan'];
//$tindakan=$_POST['tindakan'];
//$jenisanastesi=$_POST['jenisanastesi'];
//$metodeanastesi=$_POST['metodeanastesi'];
$dokteroperator=$_POST['dokteroperator'];
$dokteranastesi=$_POST['dokteranastesi'];
$no=$_POST['nomroperasi'];
$nomr=explode('-',$no);

//$dokteranak=$_POST['dokteranak'];
//$asistenoperator=$_POST['asistenoperator'];
//$asistenanastesi=$_POST['asistenanastesi'];
//$asistenanak=$_POST['asistenanak'];
//$perawatinstrumen=$_POST['perawatinstrumen'];
//$perawatsirkuler=$_POST['perawatsirkuler'];
include("../include/connect.php");
$ins_operasi="INSERT INTO t_operasi Values('','".$nomr[0]."','$tgl_operasi','NULL','NULL','$diagnosa','','','','$dokteroperator','$dokteranastesi','','','','','','','','','','','','$keterangan')";
mysql_query($ins_operasi);
header('Location:'._BASE_.'/index.php?link=205&psn=sukses');


?>
