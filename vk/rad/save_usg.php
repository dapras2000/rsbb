<? session_start();
require_once("../../include/connect.php");

if(!empty($_GET['opt'])){
		$iddaftar=$_GET['idxdaftar'];
		$nomr=$_GET['nomr'];
		mysql_query("DELETE FROM t_usg WHERE t_usg.idx = ".$_GET['idx'])or die(mysql_error());
}else{

$iddaftar=$_POST['idxdaftar'];
$nomr=$_POST['nomr'];
$resume=$_POST['resume'];
$dokter=$_POST['dokter'];

$qry=mysql_query("SELECT * FROM m_maxnobill");
$get_data = mysql_fetch_assoc($qry);
$maxnobyr = $get_data['nomor'];
$total = 0;

if(empty($_POST['USG_qty'])){
  	$usg_qty = "1";
}else{
	$usg_qty = $_POST['USG_qty'];
}

if(empty($_POST['Dopler_qty'])){
  	$dopler_qty = "1";
}else{
	$dopler_qty = $_POST['Dopler_qty'];
}

if(empty($_POST['CTG_qty'])){
  	$ctg_qty = "1";
}else{
	$ctg_qty = $_POST['CTG_qty'];
}

if(!empty($_POST['USG'])){

	$qry_tarif=mysql_query("SELECT * FROM m_tarif where kode = 01050202");
	$get_tarif = mysql_fetch_assoc($qry_tarif);
	$tarifrs = $get_tarif['tarif'];	
	
	$total = $total + $tarifrs;

	mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('01050202', '".$nomr."', '10', curdate(), '".$_SESSION['NIP']."', ".$usg_qty.", '".$iddaftar."', '$maxnobyr',
					'$tarifrs', '')");
	
	mysql_query("INSERT INTO t_usg (idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter, KDUNIT, JNS_ELEKTROMEDIK, QTY)
		VALUES('".$iddaftar."',now(),'".$resume."','".$dokter."', 10, 'USG', ".$usg_qty.")");
	
} 

if(!empty($_POST['Dopler'])){

  	$qry_tarif=mysql_query("SELECT * FROM m_tarif where kode = 01050203");
	$get_tarif = mysql_fetch_assoc($qry_tarif);
	$tarifrs = $get_tarif['tarif'];
	
	$total = $total + $tarifrs;

	mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('01050203', '".$nomr."', '10', curdate(), '".$_SESSION['NIP']."', ".$dopler_qty.", '".$iddaftar."', '$maxnobyr',
					'$tarifrs', '')");
	mysql_query("INSERT INTO t_usg (idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter, KDUNIT, JNS_ELEKTROMEDIK, QTY)
		VALUES('".$iddaftar."',now(),'".$resume."','".$dokter."', 10, 'Dopler', ".$dopler_qty.")");
}

if(!empty($_POST['CTG'])){

	$qry_tarif=mysql_query("SELECT * FROM m_tarif where kode = 01070305");
	$get_tarif = mysql_fetch_assoc($qry_tarif);
	$tarifrs = $get_tarif['tarif'];	
	
	$total = $total + $tarifrs;

	mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('01070305', '".$nomr."', '10', curdate(), '".$_SESSION['NIP']."', ".$ctg_qty.", '".$iddaftar."', '$maxnobyr',
					'$tarifrs', '')");
	mysql_query("INSERT INTO t_usg (idxdaftar, tanggal_periksa, hasil_periksa, kd_dokter, KDUNIT, JNS_ELEKTROMEDIK, QTY)
		VALUES('".$iddaftar."',now(),'".$resume."','".$dokter."', 10, 'CTG', ".$ctg_qty.")");
}

	
	mysql_query("INSERT INTO t_bayarrajal (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS)
					  VALUES ('".$nomr."', '".$iddaftar."', '$maxnobyr', $total)");
		
	mysql_query("UPDATE m_maxnobill SET nomor=nomor+1")or die(mysql_error());
}
?>
<script language="javascript">
alert("Update Sukess");
window.location="../../index.php?link=51&nomr=<?=$nomr?>&menu=8&idx=<?=$iddaftar?>";
</script>