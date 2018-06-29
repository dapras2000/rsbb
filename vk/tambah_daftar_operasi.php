<? session_start();
include("../include/connect.php");
$nomr		= $_POST['nomroperasi'];
$tgloperasi	=$_POST['tgl_operasi'];
$jammulai	=$_POST['jammulai'];
$jamselesai	=$_POST['jamselesai'];
$diagnosa	= $_POST['diagnosa'];
$tindakan=$_POST['tindakan'];
$jenisanastesi=$_POST['jenisanastesi'];
$metodeanastesi=$_POST['metodeanastesi'];
$dokteroperator=$_POST['dokteroperator'];
$dokteranastesi=$_POST['dokteranastesi'];
$dokteranak=$_POST['dokteranak'];
$asistenoperator=$_POST['asistenoperator'];
$asistenanastesi=$_POST['asistenanastesi'];
$asistenanak=$_POST['asistenanak'];
$perawatinstrumen=$_POST['perawatinstrumen'];
$perawatsirkuler=$_POST['perawatsirkuler'];
$carabayar=$_POST['carabayar'];
$unit=$_SESSION['KDUNIT'];
$idxdaftar=$_POST['idxdaftar'];
echo '<pre>';print_r($_REQUEST); echo '</pre>';

echo $ins_operasi="INSERT INTO t_operasi set 
nomr = '$nomr',
tanggal = '$tanggal',
jammulai = '$jammulai',
diagnosa = '$diagnosa',
tindakan = '$tindakan',
jenisanastesi = '$jenisanastesi',
metodeanastesi = '$metodeanastesi',
dokteroperator = '$dokteroperator',
dokteranastesi = '$dokteranastesi',
dokteranak = '$dokteranak',
asistenoperator = '$anastesioperator',
asistenanastesi = '$asistenanastesi',
anastesianak = '$anastesianak',
perawatinstrumen = '$perawatinstrumen',
perawatsilkuler = '$perawatsilkuler',
keteranganpasien = '$carabayar',
status = 0,
KDUNIT = '$unit',
IDXDAFTAR = '$idxdaftar',
RAJAL = 1";
exit;
//$ins_operasi="INSERT INTO t_operasi VALUES('','".$nomr."','".$tgloperasi."','".$jammulai."','".$jamselesai."','".$diagnosa."','".$tindakan."','".$jenisanastesi."','".$dokterbedah."','".$dokteranastesi."','".$dokteranak."','".$asisteninstrument."','".$asistensirkuler."','".$asistenbayi."','','','','','')";
mysql_query($ins_operasi);

if($_SESSION['KDUNIT']=='15'){
	header('Location:'._BASE_.'/index.php?link=20&psn=sukses');
}else if($_SESSION['KDUNIT']=='10'){
	header('Location:'._BASE_.'/index.php?link=51&nomr='.$nomr.'&menu=7&idx='.$idx.'&psn=sukses');
}else{
	header('Location:'._BASE_.'/index.php?link=51&nomr='.$nomr.'&menu=6&idx='.$idx.'&psn=sukses');
}

?>
