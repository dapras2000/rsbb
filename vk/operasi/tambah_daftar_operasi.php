<? session_start();
$nomr		= $_POST['nomr'];
$diagnosa	= $_POST['diagnosa'];
$idxdaftar	= $_POST['idxdaftar'];
$kdpoly		= $_POST['kdpoly']; 
$kddokter	= $_POST['kddokter']; 

if(!empty($_POST['cito'])){
	$jnsoperasi = "c"; 
}

if(!empty($_POST['elektif'])){
	$jnsoperasi = "e"; 
}

include("../../include/connect.php");

if(empty($_POST['id_operasi'])){
$ins_operasi="INSERT INTO t_operasi(nomr, diagnosa, KDUNIT, IDXDAFTAR, TGLORDER, DRPENGIRIM, RAJAL, NIP, JNSOPERASI) VALUES('".$nomr."', '".$diagnosa."', ".$_SESSION['KDUNIT'].", ".$idxdaftar.", '".$_POST['tgl_operasi']."', '".$kddokter."', 1, '".$_SESSION['NIP']."', '".$jnsoperasi."')";
}else{
$ins_operasi="UPDATE t_operasi
				SET diagnosa = '".$diagnosa."',
				JNSOPERASI = '".$jnsoperasi."',
				TGLORDER = '".$_POST['tgl_operasi']."',
				DRPENGIRIM = '".$kddokter."'
			WHERE id_operasi = ".$_POST['id_operasi'];	
	
}

mysql_query($ins_operasi);
header('Location:'._BASE_.'/index.php?link=51&nomr='.$nomr.'&menu=7&idx='.$idxdaftar.'&psn=sukses');
?>
