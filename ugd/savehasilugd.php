<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#093; width:95%; background-color:#FFF;" align="left">
<?php 
include("../include/connect.php");
$txtNoMR = $_POST['txtNoMR'];
$txtIdxDaftar = $_POST['txtIdxDaftar'];
$hasil_penanganan = $_POST['hasil_penanganan'];
$die_less2h = $_POST['die_less2h'];
$kllnonkll = $_POST['kllnonkll'];
$ket_penyebab = $_POST['ket_penyebab'];
$pelayanan = $_POST['pelayanan'];
$dirujuk = $_POST['dirujuk'];
$dasarrujuk = $_POST['dasarrujuk'];
$diantar = $_POST['diantar'];

$sql="INSERT INTO t_hasilugd VALUES('','$txtIdxDaftar','$txtNoMR','$hasil_penanganan','$die_less2h','$ket_penyebab','$dirujuk','$dasarrujuk','$diantar','$pelayanan','$kllnonkll')";
if($sql){
mysql_query($sql);
echo "<strong>Sukses!</strong>";
}
?>
</div>