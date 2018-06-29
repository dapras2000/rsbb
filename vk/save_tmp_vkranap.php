<?php session_start();
include '../include/connect.php';
include '../include/function.php';
$faktor = 1;
$jenis = 'e';
if($_REQUEST['cito'] == 'c'){
	$faktor = 1.25;
	$jenis = 'c';
}
$sql=mysql_query("select * from tmp_cartbayar where IP='".getRealIpAddr()."' and KODETARIF = '".$_REQUEST["kode"]."' and JENIS = '".$jenis."' and KDDOKTER = '".$_REQUEST['dokter']."'");
if(mysql_num_rows($sql) > 0){
	mysql_query("update tmp_cartbayar set QTY=QTY+1 where IP='".getRealIpAddr()."' and KODETARIF='".$_REQUEST["kode"]."' and JENIS = '".$jenis."' and KDDOKTER = '".$_REQUEST['dokter']."'");
}else{
	$tarif	= getTarif($_REQUEST['kode']);
	mysql_query('insert into tmp_cartbayar set KODETARIF = "'.$_REQUEST['kode'].'", IP = "'.getRealIpAddr().'", ID = "'.$_REQUEST['id'].'", QTY=1, poly ='.$_REQUEST['ruang'].', KDDOKTER = "'.$_REQUEST['dokter'].'", UNIT = "'.$_SESSION['KDUNIT'].'", TARIF = "'.$tarif['tarif'] * $faktor.'", DISCOUNT="0", TOTTARIF="'.$tarif['tarif'] * $faktor.'", JASA_SARANA = "'.$tarif['jasa_sarana'] * $faktor.'", JASA_PELAYANAN = "'.$tarif['jasa_pelayanan'] * $faktor.'", JENIS = "'.$jenis.'"');
}
?>