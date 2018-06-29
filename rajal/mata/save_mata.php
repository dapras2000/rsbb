<? session_start();
require_once("../../include/connect.php");

$iddaftar=$_POST['idx'];
$nomr=$_POST['nomr'];
$resume=$_POST['resume'];
$dokter=$_POST['dokter'];

$sql = "INSERT INTO t_usg (idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter, JNS_ELEKTROMEDIK, KDUNIT)
		VALUES('".$iddaftar."',now(),'".$resume."','".$dokter."', 'MATA', 2)";
mysql_query($sql);

$qry=mysql_query("SELECT * FROM m_maxnobill");
$get_data = mysql_fetch_assoc($qry);
$maxnobyr = $get_data['nomor'];	

$qry_tarif=mysql_query("SELECT * FROM m_tarif where kode = '02220222'");
$get_tarif = mysql_fetch_assoc($qry_tarif);
$tarifrs = $get_tarif['tarif'];	

mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('02220222', '".$nomr."', '29', curdate(), '".$_SESSION['NIP']."', 1, '".$iddaftar."', '$maxnobyr', '$tarifrs', '')");

mysql_query("INSERT INTO t_bayarrajal (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS)
					  VALUES ('".$nomr."', '".$iddaftar."', '$maxnobyr', $tarifrs)");
		
mysql_query("UPDATE m_maxnobill SET nomor=nomor+1")or die(mysql_error());
?>

<script language="javascript">
alert("Update Sukess");
window.location="../../index.php?link=51&nomr=<?=$nomr?>&menu=9&idx=<?=$iddaftar?>";
</script>