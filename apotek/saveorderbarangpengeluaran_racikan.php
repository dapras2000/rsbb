<?php
session_start();
include("../include/connect.php");
include("inc/function.php");
$nip = $_SESSION['NIP'];
$kdunit = $_SESSION['KDUNIT'];
if(!empty($_GET['idxracik'])){
	$idxracik = $_GET['idxracik'];
	if($_GET['opt']=="2"){
	   @mysql_query("UPDATE  t_permintaan_apotek_rajal_racikan SET status_acc = '2',
					nip_keluar = '".$nip."',
					jmlh_keluar = NULL,
					tgl_keluar = NULL
					WHERE idxracik = '$idxracik' and idxpesanobat")or die(mysql_error());
	   echo "Tidak disetujui";
	}else if($_GET['opt']=="1"){
   	   if(!empty($_GET['jml'])){
	   		$jml = $_GET['jml'];
		}else{
			$sqlobatjml = "SELECT  t_permintaan_apotek_rajal_racikan.jumlah
				 		  FROM
				          		 t_permintaan_apotek_rajal_racikan
				          WHERE  t_permintaan_apotek_rajal_racikan.idxracik = '$idxracik'";
		    $getobatjml = mysql_query ($sqlobatjml)or die(mysql_error());
	        $datajmlobat = mysql_fetch_assoc($getobatjml);
			$jml = $datajmlobat['jumlah'];
		}
	   
	   $tgl = date("Y-m-d");
	   @mysql_query("UPDATE  t_permintaan_apotek_rajal_racikan SET status_acc = '1',
					jmlh_keluar = $jml,
					tgl_keluar = '$tgl',
					nip_keluar = '".$nip."'
					WHERE idxracik = '$idxracik'")or die(mysql_error());	   
	
	   echo "Sudah disetujui";
	}
}