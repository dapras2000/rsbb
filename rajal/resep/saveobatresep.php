<?php
 include("../../include/connect.php");
 include("../inc/function.php");
$max = mysql_query("SELECT nomor from m_maxnorsp where bulan=month(current_date()) and tahun=year(current_date())");
$data = mysql_fetch_assoc($max);
$maxnorsp=$data['nomor'];

if(!$maxnorsp){
	$maxnorsp = 1;
	mysql_query("insert into m_maxnorsp (tahun,bulan,nomor) values( year(current_date()),month(current_date()),".$maxnorsp.")");
}else{
	$maxnorsp = $maxnorsp+1;
	mysql_query("update m_maxnorsp set nomor=".$maxnorsp." where bulan=month(current_date()) and tahun=year(current_date())");	 
}
$sql = "INSERT INTO t_resep (IDXDAFTAR, NORESEP, TANGGAL,KDDOKTER, KDPOLY, NOMR, NIP, STATUS, RAJAL) VALUES('$_POST[txtIdxDaftar]','$maxnorsp',  now(),'$_POST[txtKdDokter]','$_POST[txtKdPoly]','$_POST[txtNoMR]','$_POST[txtNip]','0','1')";
mysql_query($sql)or die(mysql_error());


$ip = getRealIpAddr();
mysql_query("INSERT INTO t_resep_detail(NAMA_OBAT, SEDIAAN, ATURAN_PAKAI, JUMLAH, NORESEP, TANGGAL)	SELECT tmp_cartresep.NAMA_OBAT, tmp_cartresep.SEDIAAN, tmp_cartresep.ATURAN_PAKAI,	tmp_cartresep.JUMLAH,'".$maxnorsp."', now()	FROM tmp_cartresep WHERE tmp_cartresep.IP = '".$ip."'"); 
mysql_query("DELETE FROM tmp_cartresep WHERE tmp_cartresep.IP = '".$ip."'");

header("Location:../../index.php?pesan=Input Sukses&menu=1&link=51&nomr=".$_POST['txtNoMR']."&idx=".$_POST['txtIdxDaftar']);
exit;
?>