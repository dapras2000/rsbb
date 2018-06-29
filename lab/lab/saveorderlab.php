<?php session_start();
include("../../include/connect.php");
include("../inc/function.php");
$idxdaftar = $_POST['idxdaftar'];
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

if($kode_jasa != ""){
			
			$sql_s = "SELECT kode_jasa, group_jasa FROM m_lab
						WHERE group_jasa = '".$kode_jasa."'";
			$get_s = mysql_query($sql_s);	
			if(mysql_num_rows($get_s) > 0){
				
				while($dat_s = mysql_fetch_array($get_s)){
					$kode_jasa_s = $dat_s['kode_jasa']; 
					@mysql_query("INSERT INTO t_orderlab_aps(KODE, QTY, IDXDAFTAR, TANGGAL) VALUES ('$kode_jasa_s', $qty, '$idxdaftar', curdate())")or die(mysql_error());
				}
				
			
			}else{
			
		@mysql_query("INSERT INTO t_orderlab_aps(KODE, QTY, IDXDAFTAR, TANGGAL) VALUES ('$kode_jasa', $qty, '$idxdaftar', curdate())")or die(mysql_error());
			
			}
			
		}
}
mysql_query("DELETE FROM tmp_cartorderlab WHERE tmp_cartorderlab.IP = '$ip'");
?>
<script language="javascript" >
alert("Data Telah Disimpan.");
window.location="../../index.php?link=l03&idx=<?=$idxdaftar?>";
</script>
<?
exit;
?>