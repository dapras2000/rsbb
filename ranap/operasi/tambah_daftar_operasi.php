<?php session_start();
$nomr		= $_POST['nomr'];
$diagnosa	= $_POST['diagnosa'];
$idxdaftar	= $_POST['idxdaftar'];
$kdpoly		= $_POST['kdpoly']; 
$kddokter	= $_POST['kddokter']; 
$tglrencana	= $_POST['tgl_operasi'];

include("../../include/connect.php");
include("../../include/function.php");

$ss = mysql_query('select * from t_operasi where idxdaftar = "'.$idxdaftar.'" and status != "selesai"');
if(mysql_num_rows($ss) > 0){
	mysql_query('delete from t_operasi where idxdaftar = "'.$idxdaftar.' and status != "selesai" and kode_dokteroperator is null');
}

$ins_operasi="INSERT INTO t_operasi(nomr, diagnosa, KDUNIT, IDXDAFTAR,TGLORDER, DRPENGIRIM, RAJAL, NIP)
VALUES('".$nomr."', '".$diagnosa."', ".$_SESSION['KDUNIT'].", ".$idxdaftar.", '".$tglrencana."', '".$kddokter."', 0, '".$_SESSION['NIP']."')";

mysql_query($ins_operasi);
if($_SESSION['KDUNIT'] == 19){
	header('Location:'._BASE_.'index.php?link=121&nomr='.$nomr.'&id_admission='.$idxdaftar.'&psn=sukses');
}else{
	header('Location:'._BASE_.'index.php?link=5vkranap&nomr='.$nomr.'&idx='.$idxdaftar.'&psn=sukses');
}
//header('Location:../../index.php?link=121&nomr='.$nomr.'&id_admission='.$idxdaftar.'&psn=sukses');
?>
