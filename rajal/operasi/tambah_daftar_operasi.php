<? session_start();
$nomr= $_POST['nomr'];
$diagnosa= $_POST['diagnosa'];
$idxdaftar=$_POST['idxdaftar'];
$kdpoly=$_POST['kdpoly']; 
$kddokter=$_POST['kddokter']; 
$tglrencana=$_POST['tgl_operasi'];

include("../../include/connect.php");
$ins_operasi="INSERT INTO t_operasi(nomr, diagnosa, KDUNIT, IDXDAFTAR,TGLORDER, DRPENGIRIM, RAJAL, NIP,JNSOPERASI) VALUES('".$nomr."', '".$diagnosa."', ".$_SESSION['KDUNIT'].", ".$idxdaftar.", '".$tglrencana."', '".$kddokter."', 1, '".$_SESSION['NIP']."','".$_REQUEST['jenis_operasi']."')";

mysql_query($ins_operasi);
header('Location:'._BASE_.'/index.php?link=51&nomr='.$nomr.'&menu=6&idx='.$idxdaftar.'&psn=sukses');
?>
