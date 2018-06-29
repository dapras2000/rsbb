<? session_start();
require_once("../../include/connect.php");

$iddaftar=$_POST['idxdaftar'];
$nomr=$_POST['nomr'];
$resume=$_POST['resume'];
$dokter=$_POST['dokter'];

if(empty($_POST['idx'])){
	$sql = "INSERT INTO t_ekg (idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter, kd_tarif)
			VALUES('".$iddaftar."',now(),'".$resume."','".$dokter."', '01050201')";
}else{
    $sql = "UPDATE t_ekg
			SET tanggal_periksa = now(),
  			hasil_periksa = '".$resume."',
  			kd_dokter = '".$dokter."'
			WHERE idx = ".$_POST['idx'];
}
mysql_query($sql);

$qry=mysql_query("SELECT * FROM m_maxnobill");
$get_data = mysql_fetch_assoc($qry);
$maxnobyr = $get_data['nomor'];	

$qry_tarif=mysql_query("SELECT * FROM m_tarif where kode = '01050201'");
$get_tarif = mysql_fetch_assoc($qry_tarif);
$tarifrs = $get_tarif['tarif'];	

mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('01050201', '".$nomr."', '9', curdate(), '".$_SESSION['NIP']."', 1, '".$iddaftar."', '$maxnobyr', '$tarifrs', '')");

mysql_query("INSERT INTO t_bayarrajal (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS)
					  VALUES ('".$nomr."', '".$iddaftar."', '$maxnobyr', $tarifrs)");
		
mysql_query("UPDATE m_maxnobill SET nomor=nomor+1")or die(mysql_error());
?>

<script language="javascript">
alert("Update Sukess");
window.location="../../index.php?link=51&nomr=<?=$nomr?>&menu=8&idx=<?=$iddaftar?>";
</script>