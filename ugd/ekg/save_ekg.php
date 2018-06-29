<? session_start();
include("../../include/connect.php");
include("../../include/function.php");

$iddaftar=$_POST['idxdaftar'];
$nomr=$_POST['nomr'];
$resume=$_POST['resume'];
$dokter=$_POST['dokter'];

if(empty($_REQUEST['idx_ekg'])){
	$sql = "INSERT INTO t_ekg (idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter, kd_tarif) VALUES('".$iddaftar."',now(),'".$resume."','".$dokter."', '06.03.05')";
	mysql_query($sql);
	
	mysql_query('insert into tmp_cartbayar set KODETARIF = "06.03.05", QTY = 1, poly = "'.$_SESSION['KDUNIT'].'", IP = "'.getRealIpAddr().'"');
	
	$sql_pr='CALL pr_savebill_tindakanrajal_dokter("'.$_REQUEST['nomr'].'",1,"'.$_SESSION['NIP'].'","'.$_REQUEST['idxdaftar'].'","'.date("Y-m-d").'",0,0,"'.getRealIpAddr().'",'.$_REQUEST['carabayar'].','.$_SESSION['KDUNIT'].',0,"'.$_REQUEST['dokter'].'")';
	mysql_query($sql_pr);
	
	mysql_query('delete from tmp_cartbayar where IP = "'.getRealIpAddr().'"');
}else{
    $sql = "UPDATE t_ekg SET tanggal_periksa = now(), hasil_periksa = '".$resume."', kd_dokter = '".$dokter."' WHERE idx = ".$_POST['idx_ekg'];
	mysql_query($sql);
}
#$qry=mysql_query("SELECT * FROM m_maxnobill");
#$get_data = mysql_fetch_assoc($qry);
#$maxnobyr = $get_data['nomor'];
#$qry_tarif=mysql_query("SELECT * FROM m_tarif2012 where kode_tindakan = '06.03.05'");
#$get_tarif = mysql_fetch_assoc($qry_tarif);
#$tarifrs = $get_tarif['tarif'];
#mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL, TARIFRS, KETERANGAN)
#VALUES ('01050201', '".$nomr."', '9', curdate(), '".$_SESSION['NIP']."', 1, '".$iddaftar."', '$maxnobyr', '$tarifrs', '')");
#mysql_query("INSERT INTO t_bayarrajal (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS) VALUES ('".$nomr."', '".$iddaftar."', '$maxnobyr', $tarifrs)");	
#mysql_query("UPDATE m_maxnobill SET nomor=nomor+1")or die(mysql_error());
?>
<script language="javascript">
alert("Update Sukess");
window.location="../../index.php?link=51&nomr=<?=$nomr?>&menu=8&idx=<?=$iddaftar?>";
</script>