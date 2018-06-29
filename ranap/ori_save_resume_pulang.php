<?php session_start();
include("../include/connect.php"); 

$peny_kes = "";
$x = 1;
while($x <= 14){
	if(!empty($_POST['PENYKES_'.$x])){
		if($peny_kes == ""){
			$peny_kes = $_POST['PENYKES_'.$x];
		}else{
			$peny_kes = $peny_kes.", ".$_POST['PENYKES_'.$x];
		}
	}
$x++;	
}
#$dirujuk = $_REQUEST['DIRUJUK'];
$dirujuk = $_REQUEST['alasan_rujuk'];
if($_POST['idxpulang'] == ''){
	//if(empty($_POST['idxpulang'])){
	if($_REQUEST['STATUSPULANG'] != "4"){
		$s	= 'select LUNAS from t_bayarranap where nomr = "'.$_REQUEST['NOMR'].'" and IDXDAFTAR = "'.$_REQUEST['IDADMISSION'].'"';
		$s	= mysql_query($s);
		$d 	= mysql_fetch_assoc($s);
		if( ($d['LUNAS'] != '1') and (mysql_affected_rows($s) > 0) ){
			echo '<div style="border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;" align="left">';
			echo '<strong>Pasien belum melakukan pembayaran.</strong>';
			echo '</div>';
			return false;
		}
	}
	#$dirujuk = $_REQUEST['DIRUJUK'];
	#$dirujuk = $_REQUEST['alasan_rujuk'];
	$sql = 'INSERT INTO t_resumepulang (IDADMISSION, NOMR, JENISKELAMIN, KDRUANG, TGLMASUK, TGLKELUAR, DIAGNOSAPULANG, ICDKELUAR, ICDKELUAR2, ICDKELUAR3, ICDKELUAR4, STATUSPULANG, DIRUJUK, ALATBANTU, MOBILISASI, MSLHKEP, TKSD, TKDR, PENYKES, MGBPI, DOTB, OYDP, HPYDP, SK, SI, SR, KI, SKK, STBA, PALAMAT, NPNJMPT, HUBPASIEN, NIP) 
	VALUES ("'.$_POST['IDADMISSION'].'","'.$_POST['NOMR'].'","'.$_POST['JK'].'","'.$_POST['KDRUANG'].'","'.$_POST['TGLMASUK'].'","'.$_REQUEST['TGLKELUAR'].'","'.$_POST['DIAGNOSAPULANG'].'","'.$_POST['ICDKELUAR'].'","'.$_POST['ICDKELUAR2'].'","'.$_POST['ICDKELUAR3'].'","'.$_POST['ICDKELUAR4'].'","'.$_POST['STATUSPULANG'].'","'.$dirujuk.'","'.$_POST['ALATBANTU'].'","'.$_POST['MOBILISASI'].'","'.$_POST['MSLHKEP'].'","'.$_POST['TKSD'].'","'.$_POST['TKDR'].'","'.$peny_kes.'","'.$_POST['MGBPI'].'","'.$_POST['DOTB'].'","'.$_POST['OYDP'].'","'.$_POST['HPYDP'].'","'.$_POST['SK'].'","'.$_POST['SI'].'","'.$_POST['SR'].'","'.$_POST['KI'].'","'.$_POST['SKK'].'","'.$_POST['STBA'].'","'.$_POST['PALAMAT'].'","'.$_POST['NPNJMPT'].'","'.$_POST['HUBPASIEN'].'","'.$_SESSION['NIP'].'")';
}else{
	$sql = "UPDATE t_resumepulang SET KDRUANG = '".$_POST['KDRUANG']."',
			  TGLKELUAR = '".$_REQUEST['TGLKELUAR']."',
			  DIAGNOSAPULANG = '".$_POST['DIAGNOSAPULANG']."',
			  ICDKELUAR = '".$_POST['ICDKELUAR']."',
			  ICDKELUAR2 = '".$_POST['ICDKELUAR2']."',
			  ICDKELUAR3 = '".$_POST['ICDKELUAR3']."',
			  ICDKELUAR4 = '".$_POST['ICDKELUAR4']."',
			  STATUSPULANG = '".$_POST['STATUSPULANG']."',
			  DIRUJUK = '".$dirujuk."',
			  ALATBANTU = '".$_POST['ALATBANTU']."',
			  MOBILISASI = '".$_POST['MOBILISASI']."',
			  MSLHKEP = '".$_POST['MSLHKEP']."',
			  TKSD = '".$_POST['TKSD']."',
			  TKDR = '".$_POST['TKDR']."',
			  PENYKES = '".$peny_kes."',
			  MGBPI = '".$_POST['MGBPI']."',
			  DOTB = '".$_POST['DOTB']."',
			  OYDP = '".$_POST['OYDP']."',
			  HPYDP = '".$_POST['HPYDP']."',
			  SK = '".$_POST['SK']."',
			  SI = '".$_POST['SI']."',
			  SR = '".$_POST['SR']."',
			  KI = '".$_POST['KI']."',
			  SKK = '".$_POST['SKK']."',
			  STBA = '".$_POST['STBA']."',
			  PALAMAT = '".$_POST['PALAMAT']."',
			  NPNJMPT = '".$_POST['NPNJMPT']."',
			  HUBPASIEN = '".$_POST['HUBPASIEN']."',
			  NIP = '".$_SESSION['NIP']."'
		 WHERE IDXPULANG = ".$_POST['idxpulang']; 	
}
$qry = mysql_query($sql);
if(!empty($qry)){
	$s	= 'SELECT sum(tottarifrs)-sum(deposit+totaskes+totcostsharing+jmbayar) selisih FROM `t_bayarranap` where nomr = "'.$_REQUEST['NOMR'].'" and IDXDAFTAR = "'.$_REQUEST['IDADMISSION'].'"';
	$s	= mysql_query($s);
	$s2	= 'SELECT * FROM `t_bayarranap` where NOMR = "'.$_REQUEST['NOMR'].'" and IDXDAFTAR = "'.$_REQUEST['IDADMISSION'].'"';
	$s3	= mysql_query($s2);
	$d 	= mysql_fetch_assoc($s);
	if(mysql_num_rows($s3) <= 0){
		$sqls = "UPDATE t_admission SET keluarrs='".$_POST['TGLKELUAR']."', icd_keluar='".$_POST['ICDKELUAR']."' WHERE id_admission='".$_POST['IDADMISSION']."'";
		mysql_query($sqls);
		echo '<div style="border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;" align="left">';
		echo "<strong>Input data sukses!</strong>";
		echo '</div>';
		return false;
	} else if( ($d['selisih'] != '0.00') || (intval($d['selisih']) > 0)){
		echo '<div style="border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;" align="left">';
		echo '<strong>Pasien belum lunas dalam melakukan pembayaran.</strong><br>';
		echo "<strong>Data tidak dapat di simpan</strong>";
		echo '</div>';
	}else{
		$sqls = "UPDATE t_admission SET keluarrs='".$_POST['TGLKELUAR']."', icd_keluar='".$_POST['ICDKELUAR']."' WHERE id_admission='".$_POST['IDADMISSION']."'";
		mysql_query($sqls);
		echo '<div style="border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;" align="left">';
		echo "<strong>Input data sukses!</strong>";
		echo '</div>';
	}
} else {
	echo '<div style="border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;" align="left">';
	echo "<strong>Data tidak dapat di simpan</strong>";
	echo '</div>';
}
?>