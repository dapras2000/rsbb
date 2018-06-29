<? session_start();
include("../include/connect.php");
if(isset($_POST['update'])){
   	$_POST['NOMR'];
   	$_POST['IDXDAFTAR2'];
	$update_bill	= mysql_query('update t_billrajal set KDDOKTER = "'.$_REQUEST['dokter'].'", mulai = NOW() where IDXDAFTAR = "'.$_POST['IDXDAFTAR2'].'"');
	
	$qry_masuk = "UPDATE t_pendaftaran SET KDDOKTER = '".$_POST['dokter']."' WHERE NOMR = '".$_POST['NOMR']."' AND IDXDAFTAR='".$_POST['IDXDAFTAR2']."'";
	$query	= mysql_query($qry_masuk);
}
?>