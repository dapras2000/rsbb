<?php session_start();
 include("../../include/connect.php");
 include("../inc/function.php");
 
$nomr = $_POST['txtNoMR'];
$idxdaftar = $_POST['txtIdxDaftar'];
$kddokter = $_POST['txtKdDokter'];
//$tglreg = $_POST['txtTglReg'];
$kdpoly = $_POST['txtKdPoly'];
$nip = $_SESSION['NIP'];

$tglreg = date('Y-m-d');

$qry=mysql_query("SELECT * FROM m_maxnobill");
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
			
			$sql_s = "SELECT kode_jasa, group_jasa FROM m_lab
						WHERE group_jasa = '".$kode_jasa."'";
			$get_s = mysql_query($sql_s);	
			if(mysql_num_rows($get_s) > 0){
				
				while($dat_s = mysql_fetch_array($get_s)){
					$kode_jasa_s = $dat_s['kode_jasa']; 
					@mysql_query("INSERT INTO t_orderlab(KODE, QTY, IDXDAFTAR, NOMR, TANGGAL, DRPENGIRIM, KDPOLY, KET, RAJAL) VALUES ('$kode_jasa_s', $qty, '$idxdaftar', '$nomr', '$tglreg', '$kddokter', '$kdpoly', '$ket', '0')")or die(mysql_error());
				}
				
			
			}else{
			
			@mysql_query("INSERT INTO t_orderlab(KODE, QTY, IDXDAFTAR, NOMR, TANGGAL, DRPENGIRIM, KDPOLY, KET, RAJAL) VALUES ('$kode_jasa', $qty, '$idxdaftar', '$nomr', '$tglreg', '$kddokter', '$kdpoly', '$ket', '0')")or die(mysql_error());
			
			}
			
			@mysql_query("INSERT INTO t_billranap (KODETARIF, NOMR, KDPOLY, TANGGAL, NIP, QTY, IDXDAFTAR, NOBILL,
  									TARIFRS, KETERANGAN)
					 VALUES ('$kode_tarif', '$nomr', '$kdpoly', curdate(), '$nip', 1, '$idxdaftar', '$maxnobyr', '$tarifrs', '')");

	 }
}

mysql_query("DELETE FROM tmp_cartorderlab WHERE tmp_cartorderlab.IP = '$ip'");

mysql_query("INSERT INTO t_bayarranap (NOMR, IDXDAFTAR, NOBILL, TOTTARIFRS)
					  VALUES ('$nomr', '$idxdaftar', '$maxnobyr', $total)");

mysql_query("UPDATE m_maxnobill SET nomor=nomor+1")or die(mysql_error());

echo "<strong>Save Data Order Lab Success.</strong>";
//header("Location:../../index.php?pesan=$psn&&link=51&menu=4&nomr=".$nomr."&idx=".$idxdaftar);
exit;
?>