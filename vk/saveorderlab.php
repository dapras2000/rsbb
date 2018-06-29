<?php session_start();
 include("../include/connect.php");
 include("inc/function.php");
 
$nomr = $_POST['txtNoMR'];
$idxdaftar = $_POST['txtIdxDaftar'];
$kddokter = $_POST['txtKdDokter'];
$tglreg = $_POST['txtTglReg'];
$kdpoly = $_POST['txtKdPoly'];
$nip = $_SESSION['NIP'];

$qry=mysql_query("SELECT * FROM m_maxnobyr");
$get_data = mysql_fetch_assoc($qry);
$maxnobyr = $get_data['nomor'];

$total = 0;

$ip = getRealIpAddr();
$sql="SELECT tmp_cartorderlab.KODEJASA, tmp_cartorderlab.QTY, m_lab.kode_tarif,
  			m_tarif.tarif, tmp_cartorderlab.IP, tmp_cartorderlab.KET 
      FROM tmp_cartorderlab
      INNER JOIN m_lab ON (tmp_cartorderlab.KODEJASA = m_lab.kode_jasa)
      INNER JOIN m_tarif ON (m_lab.kode_tarif = m_tarif.kode)
	  WHERE tmp_cartorderlab.IP = '$ip' ORDER BY KODEJASA";
$row = mysql_query($sql)or die(mysql_error());

while($data = mysql_fetch_array($row)){
	 $kode_jasa = $data['KODEJASA'];
	 $kode_tarif = $data['kode_tarif'];
	 $tarifrs = $data['tarif'];
	 $qty =  $data['QTY'];
	 $ket = $data['KET'];
	 
	 $total = $total + $tarifrs; 
	 
	 if($kode_jasa != ""){
			@mysql_query("INSERT INTO t_orderlab(KODE, QTY, IDXDAFTAR, NOMR, TANGGAL, DRPENGIRIM, KDPOLY, KET, RAJAL) VALUES ('$kode_jasa', $qty, '$idxdaftar', '$nomr', '$tglreg', '$kddokter', '$kdpoly', '$ket', '1')")or die(mysql_error());
			
			
			@mysql_query("INSERT INTO t_billrajal (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('$kode_tarif', '$nomr', '$kdpoly', '$tglreg', '$nip', 1, '$idxdaftar', '$maxnobyr', '$tarifrs', '')");

	 }
}

mysql_query("DELETE FROM tmp_cartorderlab WHERE tmp_cartorderlab.IP = '$ip'");

mysql_query("INSERT INTO t_bayarrajal (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS)
					  VALUES ('$nomr', '$idxdaftar', '$maxnobyr', $total)");
		
mysql_query("UPDATE m_maxnobyr SET nomor=nomor+1")or die(mysql_error());

$psn="Save Data Order Lab Success.";
header("Location:../index.php?pesan=$psn&menu=3&link=51&menu=5&nomr=".$nomr."&idx=".$idxdaftar);
exit;

?>