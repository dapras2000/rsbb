<?php 
 include("../include/connect.php");
 include("inc/function.php");
 
$nomr = $_POST['txtNoMR'];
$idxdaftar = $_POST['txtIdxDaftar'];
$kddokter = $_POST['txtKdDokter'];
$tglreg = $_POST['txtTglReg'];
$kdpoly = $_POST['txtKdPoly'];


$ip = getRealIpAddr();
$sql="SELECT KODEJASA, QTY, KET FROM  tmp_cartorderlab WHERE IP = '$ip' ORDER BY KODEJASA";
$row = mysql_query($sql)or die(mysql_error());

while($data = mysql_fetch_array($row)){
	 $kode_jasa = $data['KODEJASA'];
	 $ket =  $data['KET'];
	 $qty =  $data['QTY'];
	 if($kode_jasa != ""){
		@mysql_query("INSERT INTO t_orderlab(KODE, QTY, IDXDAFTAR, NOMR, TANGGAL, DRPENGIRIM, KDPOLY, KET) VALUES ('$kode_jasa', $qty, '$idxdaftar', '$nomr', '$tglreg', '$kddokter', '$kdpoly', '$ket')")or die(mysql_error());
	 }
}

$sql_del="DELETE FROM tmp_cartorderlab WHERE IP = '$ip'";
@mysql_query($sql_del);
?>

<script language="javascript" type="text/javascript" >
	window.location="<?php echo _BASE_;?>index.php?link=62&nomr=<?=$nomr?>&idx=<?=$idxdaftar?>";
</script>
