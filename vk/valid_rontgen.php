<?php 
include("../include/connect.php");

$x = 0;
$total = 0;

$sql_rad = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad, m_radiologi.nama_rad, 
			 m_tarif.tarif, m_radiologi.kode_tarif
			FROM m_radiologi
			INNER JOIN m_tarif ON (m_radiologi.kode_tarif = m_tarif.kode)
			WHERE m_radiologi.gr_rad <> '-'";
$get_rad = mysql_query($sql_rad);

if($_POST['dd_klinik']==""){
	$psn="<p>Anda Belum Mengisi Dengan Dignosa Klinik Field.</p>";
}else{

$qry=mysql_query("SELECT * FROM m_maxnobyr");
$get_data = mysql_fetch_assoc($qry);
$maxnobyr = $get_data['nomor'];	
	
	
	while($dat_rad = mysql_fetch_array($get_rad)){
	
	  if(isset($_POST['rad'.$dat_rad['kd_rad']])){
	      $kd_rad = $dat_rad['kd_rad'];
		  $kode_tarif = $dat_rad['kode_tarif'];
		  $tarifrs = $dat_rad['tarif'];
		  $total = $total +  $tarifrs;
		  
		  mysql_query("INSERT INTO t_radiologi (TGLORDER, JENISPHOTO, DIAGNOSA, DRPENGIRIM, POLYPENGIRIM,
  IDXDAFTAR, NOMR, NIPKIRIM, RAJAL) VALUES('$_POST[txtTglReg]','$kd_rad','$_POST[dd_klinik]','$_POST[txtKdDokter]','$_POST[txtKdPoly]','$_POST[txtIdxDaftar]','$_POST[txtNoMR]','$_POST[txtNip]','1')")or die(mysql_error());
        
		
		mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('$kode_tarif', '$_POST[txtNoMR]', '$_POST[txtKdPoly]', '$_POST[txtTglReg]', '$_POST[txtNip]', 1, '$_POST[txtIdxDaftar]', '$maxnobyr', '$tarifrs', '')");
		
		
		$x = 1;
	  }
	}

if($x == 1){		
	$psn="Input Data Berhasil";
	mysql_query("INSERT INTO t_bayarrajal (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS)
					  VALUES ('$_POST[txtNoMR]', '".$_POST[txtIdxDaftar]."', '$maxnobyr', $total)");
		
    mysql_query("UPDATE m_maxnobyr SET nomor=nomor+1")or die(mysql_error());
}else{
    $psn="<p>Anda Belum Mengisi Dengan Item Radiologi Field.</p>";
 }
}
header("Location:../index.php?pesan=$psn&menu=4&link=51&nomr=".$_POST['txtNoMR']."&idx=".$_POST['txtIdxDaftar']);
exit;
?>