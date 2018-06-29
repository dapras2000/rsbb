<?php session_start();
include 'include/connect.php';
include 'include/function.php';
$dokter	= $_REQUEST['dokter'];
$jenis = "e";
$faktor = 1;
if($_REQUEST['cito'] == 'c'){
	$jenis = 'c';
	$faktor = 1.25;
}
$sql=mysql_query("select * from tmp_cartbayar where IP='".getRealIpAddr()."' and ID = '".$_REQUEST["id"]."' and KDDOKTER = '".$dokter."' and JENIS = '".$jenis."'");
if(mysql_num_rows($sql) > 0){
	mysql_query("update tmp_cartbayar set QTY=QTY+1 where IP='".getRealIpAddr()."' and ID='".$_REQUEST["id"]."' and KDDOKTER = '".$dokter."' and JENIS = '".$jenis."'");
}else{
	$tarif	= getTarif($_REQUEST['kode']);
	mysql_query('insert into tmp_cartbayar set KODETARIF = "'.$_REQUEST['kode'].'", IP = "'.getRealIpAddr().'", ID = "'.$_REQUEST['id'].'", QTY=1, poly ='.$_REQUEST['poly'].',KDDOKTER = "'.$dokter.'",UNIT="'.$_SESSION['KDUNIT'].'", TARIF = "'.$tarif['tarif'] * $faktor.'", DISCOUNT="0", TOTTARIF="'.$tarif['tarif'] * $faktor.'", JASA_SARANA = "'.$tarif['jasa_sarana'] * $faktor.'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'] * $faktor.'", JENIS = "'.$jenis.'"');
}
?>