<?php
 include("../include/connect.php");
 include("function.php");
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
$sql = "INSERT INTO t_resep (IDXDAFTAR, NORESEP, TANGGAL,KDDOKTER, KDPOLY, NOMR, KETERANGAN, NIP, STATUS) VALUES('$_POST[txtIdxDaftar]','$maxnorsp',  now(),'$_POST[txtKdDokter]','$_POST[txtKdPoly]','$_POST[txtNoMR]','$_POST[keterangan]','$_POST[txtNip]','0')";
mysql_query($sql)or die(mysql_error());
//echo"<b>Input Sukses</b>";
header("Location:../index.php?pesan=Input Sukses&link=51&nomr=".$_POST['txtNoMR']."&idx=".$_POST['txtIdxDaftar']);
exit;
?>