<?php session_start(); 
include("../include/connect.php");
if(!empty($_POST['idxDaftar'])){

$mulai = $_POST['jamMulai'];
$selesai = $_POST['jamSelesai'];
$idx_daftar = $_POST['idxDaftar'];
$nip = $_SESSION['NIP'];
$petugas = $_POST['petugas'];
$keterangan = $_POST['keterangan'];
$nolab =  $_POST['nolab'];
$shif =  $_POST['SHIF'];

$sql = "SELECT t_orderlab_aps.IDXORDERLAB, t_orderlab_aps.KODE, t_orderlab_aps.QTY,
  			   t_orderlab_aps.IDXDAFTAR, t_orderlab_aps.TANGGAL
		FROM m_lab
  		INNER JOIN t_orderlab_aps ON (m_lab.kode_jasa = t_orderlab_aps.KODE)
  	    WHERE t_orderlab_aps.IDXDAFTAR = '$idx_daftar' AND t_orderlab_aps.STATUS='0'";

$row = mysql_query($sql)or die(mysql_error());
while ($data = mysql_fetch_array($row)){
	
	if(!empty($_POST["hsl".$data['IDXORDERLAB']])){
		$id_lab = $data['IDXORDERLAB'];
		$hsl = $_POST["hsl".$data['IDXORDERLAB']];
			
		mysql_query("UPDATE t_orderlab_aps SET 
				 HASIL_PERIKSA = '$hsl', 
				 KETERANGAN = '$ket',
				 TGL_MULAI = '$mulai',
				 TGL_SELESAI = '$selesai',
				 STATUS = '1',
				 PETUGAS = '$petugas',
				 KETERANGAN = '$keterangan',
				 NOLAB = '$nolab',
				 SHIF = '$shif'
				 WHERE IDXORDERLAB = $id_lab") or die(mysql_error());	
	}
	
}

?>
<script language="javascript" type="text/javascript" >
	alert("Simpan Data Lab Sukses.");
	window.location="<?php echo _BASE_;?>index.php?link=l03";
</script>
<?
}
?>