<?php
include("../include/connect.php");

$bulan = "";
if(!empty($_POST['bulan'])){
	$bulan =$_POST['bulan']; 
} 

$tahun = "";
if(!empty($_POST['tahun'])){
	$tahun =$_POST['tahun']; 
} 

$group = "";
if(!empty($_POST['group'])){
	$group =$_POST['group']; 
} 

if(strlen($bulan)==1){
 $bl = "0".$bulan;
}else{
 $bl = $bulan;
}

$sql="SELECT 
	  m_obat.hide_when_print,
	  m_obat.kode_obat,
	  m_obat.nama_obat,
	  m_obat.satuan,
	  (SELECT '".$tahun."-".$bl."-01' - INTERVAL 1 MONTH) AS LASTDATE, 
		(SELECT saldo FROM t_obat_stok WHERE kode_obat = m_obat.kode_obat AND YEAR(tanggal) = YEAR(LASTDATE) AND MONTH(tanggal) = MONTH(LASTDATE) ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAWAL, 
		  view_lap_gudang.APBN,
		  view_lap_gudang.APBD1,
		  view_lap_gudang.APBD2,
		  view_lap_gudang.LAINLAIN,
		  view_lap_gudang.DALAM,
		  view_lap_gudang.KBKD,
		  view_lap_gudang.UGD,
		  view_lap_gudang.VK,
		  view_lap_gudang.LAB,
		  view_lap_gudang.OK,
		  view_lap_gudang.RANAP,	
  		  m_obat.harga,
  		  view_lap_gudang.TAHUN,
  		  view_lap_gudang.BULAN,
          (SELECT saldo FROM t_obat_stok WHERE kode_obat = m_obat.kode_obat AND YEAR(tanggal) = '".$tahun."' AND MONTH(tanggal) = '".$bulan."' ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR  
FROM
  m_obat LEFT JOIN view_lap_gudang ON m_obat.kode_obat=view_lap_gudang.KODE AND TAHUN = '".$tahun."' AND BULAN = '".$bulan."'
WHERE  m_obat.group_obat = '".$group."' AND m_obat.hide_when_print = '0'";

$lap_header = "Laporan Penerimaan Pengeluaran Gudang Tahun ".$tahun." Bulan ".$bulan;
$filename = "Lap_Gudang";

$rs=array();
$ret=mysql_query($sql);
if($ret) {
  $rs = mysql_fetch_array($ret);
}
include("excelexport.php");
?>